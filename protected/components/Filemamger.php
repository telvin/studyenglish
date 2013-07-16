<?php
class Filemamger extends CApplicationComponent
{
    private $folder;

    public function mySpace($statusSpace=0,$member_id =0){
        // statusSpace (1,2,3)
        // 1 = The total of capacity user used.
        // 2 = The total of capacity user can use.
        // 3 = The percent of the capacity
        if($member_id == 0){
            $member_id = Yii::app()->user->getId();
        }
        $currentUser = Commons::getUserAccessing();
        if($currentUser['id'] == 'member_id'){
            $member_id = $currentUser['val'];
        }
        else{
            $memberInfo = AccountUser::model()->findByPk($currentUser['val']);
            $member_id = $memberInfo['member_id'];
        }
        $memberInfo = Member::model()->findByPk($member_id);
        $memberFolder = $memberInfo['upload_folder'];
        $infoMember = Member::model()->findByPk($member_id);
        $subType = $infoMember->member_type;
        $subInfo  =  Subscription::model()->findByAttributes(array('subscription_type_id'=>$subType));
        $storage = $subInfo->storage;


        $storageByByte = $storage*1024*1024*1024;
        if(empty($member_id))
            return 0;
        else{
            if($statusSpace ==1)
            {
                $spaceValue = Filemamger::getSpaceUsed($memberFolder);
            }
            else if($statusSpace ==2)
            {
                $spaceValue = Filemamger::getStatusSpace($memberFolder,$storageByByte);
            }
            else
            {
                if($storage == Resources::UNLIMITED_SETTING){
                    return Resources::UNLIMITED_LABEL;
                }
                else{
                    $spaceValue = Filemamger::converToStr($storageByByte);}
            }

            return $spaceValue;
        }


    }


    public function getStatusSpace($folder,$totalSpace){

        $dir = Yii::app()->basePath;
        $dir = str_replace(array('//', '\/', 'protected'), '', $dir);
        $dir = str_replace(array('\\'), '/', $dir);
        $dir = substr($dir, -1) == '/' ? $dir : $dir.'/';
        $path = 'uploads/'.$folder;
        $mydir = $dir.$path;
        //return $mydir;
        $file_size = Filemamger::getFile($mydir);
        Filemamger::getDirectory($mydir,0,$file_size);
//echo $file_size.'<br/>';
        if($file_size):
            $myValue = ($file_size*100)/$totalSpace;
            return $myValue;
        endif;
        return 0;
    }

    public function getSpaceUsed($folder){

        $dir = Yii::app()->basePath;
        $dir = str_replace(array('//', '\/', 'protected'), '', $dir);
        $dir = str_replace(array('\\'), '/', $dir);
        $dir = substr($dir, -1) == '/' ? $dir : $dir.'/';
        $path = 'uploads/'.$folder;
        $mydir = $dir.$path;
        //return $mydir;
        $file_size = Filemamger::getFile($mydir);
        Filemamger::getDirectory($mydir,0,$file_size);
//echo $file_size.'<br/>';
        if($file_size)
            $total_size = Filemamger::bytes_to_string($file_size, 1);
        if($total_size['str']):
            // echo($file_size).'-------';
            return $total_size['num'].$total_size['str'];
        endif;

    }
    /**********************************************************************************************************************************/
    public function getDirectory($path = '.', $level = 0,&$file_size ){
        if(!Filemamger::checkexistfolder($path)){
            $file_size =0;
            return $file_size;
        }
        //echo $path;
        //$file_size=Filemamger::getFile($path);
        $ignore = array( 'cgi-bin', '.', '..' );
        $dh = @opendir( $path );
        while( false !== ( $file = readdir( $dh ) ) ){
            if( !in_array( $file, $ignore ) ){
                if( is_dir( "$path/$file" ) ){
                    $file_size += Filemamger::getFile("$path/$file");
                    //echo "$path/$file";
                    Filemamger::getDirectory( "$path/$file", ($level+1),$file_size);
                }
            }
        }
        closedir($dh);

    }

    /**********************************************************************************************************************************/
    public function getFile($path = '.',$level = 0 ){
        error_reporting(1);
        // Get this folder and files name.
        $this_script = $path;
        $this_folder = trim($this_script);

        // Declare vars used beyond this point.
        $file_list = array();
        $folder_list = array();
        $total_size = 0;

        // Open the current directory...
        if ($handle = opendir($this_folder))
        {

            // ...start scanning through it.
            while (false !== ($file = readdir($handle)))
            {
                // Make sure we don't list this folder, file or their links.
                if ($file != "." && $file != ".." && $file != $this_script)
                {
                    $file=$this_script."/".$file;
                    // Get file info.
                    $stat			=	stat($file); // ... slow, but faster than using filemtime() & filesize() instead.
                    $info			=	pathinfo($file);
                    // Organize file info.
                    $item['name']		=	$info['basename'];
                    $item['lname']		=	strtolower($info['basename']);
                    $item['ext']		=	$info['extension'];
                    if($info['extension'] == '') $item['ext'] = '.';
                    $item['bytes']		=	$stat['size'];
                    $item['size']		=	Filemamger::bytes_to_string($stat['size'], 2);
                    $item['mtime']		=	$stat['mtime'];


                    // Add files to the file list...
                    if($info['extension'] != '')
                    {
                        array_push($file_list, $item);
                    }
                    // ...and folders to the folder list.
                    else
                    {
                        array_push($folder_list, $item);
                    }
                    // Clear stat() cache to free up memory (not really needed).
                    clearstatcache();
                    // Add this items file size to this folders total size
                    $total_size += $item['bytes'];
                }
            }
            // Close the directory when finished.
            closedir($handle);
        }
        return $total_size;
    }



    public function converToStr($sizevalue){
        $mySiteValue = Filemamger::bytes_to_string($sizevalue);
        $myValue =$mySiteValue['num'].$mySiteValue['str'];
        if($myValue == '1024MB'){
            $myValue= '1GB';
        }
        return $myValue;
    }

    /**
     *	@ http://us3.php.net/manual/en/function.filesize.php#84652
     */
    public function bytes_to_string($size, $precision = 0) {
        $sizes = array('YB', 'ZB', 'EB', 'PB', 'TB', 'GB', 'MB', 'KB', 'B');
        $total = count($sizes);
        while($total-- && $size >= 1024) $size /= 1024;
        $return['num'] = round($size, $precision);
        $return['str'] = $sizes[$total];
        return $return;
    }

//--------------------------------------------------------------  	
    public function checkexistfolder($folder_name)
    {
        $folder = $folder_name;
        if(is_dir($folder))
        {
            return true;
        }
        return false;
    }
}
?> 