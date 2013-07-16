<?php

function mergeWithQStrings($array=array(), $queryStringObject=null)
{

    $extractQStrings = get_object_vars($queryStringObject);
    $mergeArray = array_merge($extractQStrings, $array); // duplicate key of array will overwrite one from $queryStringObject

    foreach($mergeArray as $key=>$value){

        //remove key has empty value
        if(empty($value)){
            unset($mergeArray[$key]);
        }
    }
    return $mergeArray;
}

function isLocalHostRequest(){
    return (strpos($_SERVER['HTTP_HOST'],'localhost')!==false);
}

function getLimitText($input, $length, $continueText="..."){
    $resultString = $input;
    if($input!= ""){
        if(strlen($input) > $length){
            $resultString = sprintf("%s%s", substr($input, 0, $length-strlen($continueText)-1), $continueText);
        }
    }

    return $resultString;
}

function getCustomLimitText($input, $length, $allowUpperCaseCharCount, $lengthWhenReachUpperCaseLimit=0, $continueText="..."){
    $resultString = $input;
    if($input!= ""){

        if(countUppercase($input) > $allowUpperCaseCharCount)
        {
            if($lengthWhenReachUpperCaseLimit == 0)
                $lengthWhenReachUpperCaseLimit = $allowUpperCaseCharCount;
        }

        if($length > $lengthWhenReachUpperCaseLimit){
            return  getLimitText($input, $lengthWhenReachUpperCaseLimit, $continueText);
        }else{
            return getLimitText($input, $length, $continueText);
        }
    }

    return $resultString;
}

function countUppercase($str){
    //preg_match_all("/\b[A-Z][A-Za-z0-9]+\b/",$str,$matches);
    preg_match_all('/[A-Z]/',$str,$matches);
    return count($matches[0]);
}

function array_object_merge($array1, $array2){
    $merged_array = array_merge($array1, $array2);
    return get_array_unique($merged_array);
}

function get_array_unique($array, $keep_key_assoc = false)
{
    $duplicate_keys = array();
    $tmp         = array();

    foreach ($array as $key=>$val)
    {
        // convert objects to arrays, in_array() does not support objects
        if (is_object($val))
            $val = (array)$val;

        if (!in_array($val, $tmp))
            $tmp[] = $val;
        else
            $duplicate_keys[] = $key;
    }

    foreach ($duplicate_keys as $key)
        unset($array[$key]);

    return $keep_key_assoc ? $array : array_values($array);
}

function MakeTextFile($filePath, $text_content){

    file_put_contents($filePath, $text_content);
}

function imageTag($src, $max_size=1,$attributes = array()){

    $newWidth = 1;
    $newHeight = 1;
    $attributesString = "";

    $extension = $ext = pathinfo($src, PATHINFO_EXTENSION);

    $width = 1;
    $height = 1;

    //do not use file_exists because we are using absolute path, example: http://localhost:8081/signsmart/uploads/adminfolder/member/image_name.png

    if (isFileExistInAbsolutePath($src)){

        if($extension == "svg"){
            //get width and height of svg file

            $xmlget = simplexml_load_file($src);

            $xmlattributes = $xmlget->attributes();
            $width = (string) $xmlattributes->width;
            $height = (string) $xmlattributes->height;
        }
        else{
            list($width, $height) = getimagesize($src);
        }

    }

    if($max_size>0){

        if($width <= $height){
            $ratio = round($height/$max_size,2);

            $newWidth = round($width/ $ratio,0);
            $newHeight = $max_size;
        }
        else{
            $ratio = round($width/$max_size,2);

            $newHeight = round($width/ $ratio,0);
            $newWidth = $max_size;
        }
    }

    foreach($attributes as $key=>$value){
        $attributesString .= sprintf(" %s='%s'", $key, $value);
    }

    //return sprintf("<img src='%s' width='%s' height='%s' %s />", $src, $newWidth, $newHeight,$attributesString);
    return sprintf("<img src='%s' %s />", $src, $newWidth, $newHeight,$attributesString);

}

function isFileExistInAbsolutePath($absolutePath){
    return is_array(@getimagesize($absolutePath));
}

//round up properly. Example: 46.955 => 46.95
function floorp($val, $precision)
{
    $mult = pow(10, $precision);
    return floor($val * $mult) / $mult;
}

//$symbol maybe '$'
function toFormatMoney($val,$r=2, $symbol='')
{
    $n = $val;
    $c = is_float($n) ? 1 : number_format($n,$r);
    $d = '.';
    $t = ',';
    $sign = ($n < 0) ? '-' : '';
    $i = $n=number_format(abs($n),$r);
    $j = (($j = $i.length) > 3) ? $j % 3 : 0;

    return  $symbol.$sign .($j ? substr($i,0, $j) + $t : '').preg_replace('/(\d{3})(?=\d)/',"$1" + $t,substr($i,$j)) ;

}

function recursiveGlob($dir, $ext) {
    $globFiles = glob("$dir/*.$ext");
    $globDirs  = glob("$dir/*", GLOB_ONLYDIR);

    foreach ($globDirs as $dir) {
        recursiveGlob($dir, $ext);
    }

    foreach ($globFiles as $file) {
        include_once $file;
    }
}

function isNullOrEmptyString($var){
    return (!isset($var) || trim($var)==='');
}


