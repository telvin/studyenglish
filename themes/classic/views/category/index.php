<form method="post" action="<?php echo Yii::app()->createUrl('category/index') ?>" >
    <?php $i = 1;  foreach($rates as $item){?>
        <input type="radio" name="rates[]" value="<?php echo $i?>" /><?php echo $item->rate?>
        <input type="hidden" name="rate<?php echo $i?>" value="<?php echo $item->rate?>" />
        <input type="hidden" name="membership<?php echo $i?>" value="<?php echo $item->member_id?>" />
    <?php $i++;}?>

    <input type="submit" />
</form>

<!--<input type="radio" name="rates[]" value="1">
    <input type="hidden" name="membership1" value="" >;

    <input type="radio" name="rates[]" value="2">
    <input type="hidden" name="membership2" value="" >;

    <input type="radio" name="rates[]" value="3">
    <input type="hidden" name="membership3" value="" >;-->