<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=0" />

    <!-- pinned logo windows 8 -->
    <meta name="application-name" content="Study English"/>
    <meta name="msapplication-TileColor" content="#000000"/>
    <meta name="msapplication-TileImage" content="<?php echo Yii::app()->theme->baseUrl; ?>/images/favicon.png"/>

    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/reset.css" type="text/css" media="all" />
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/jquery-ui.css" type="text/css" media="all" />
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/jquery_impromptu.css" type="text/css" media="all" />
<!--    <link rel="stylesheet" href="--><?php //echo Yii::app()->theme->baseUrl; ?><!--/css/preview.css" type="text/css" media="all" />-->

    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/main.css" type="text/css" media="all" />


    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery-1.8.0.min.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/commons.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery-impromptu.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery-ui.min.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/spinner.js"></script>

    <link rel="shortcut icon" type="image/x-icon" href="<?php echo Yii::app()->theme->baseUrl; ?>/images/favicon.ico" />
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style.css" type="text/css" media="all" />
    <link href='http://fonts.googleapis.com/css?family=Coda' rel='stylesheet' type='text/css' />
    <link href='http://fonts.googleapis.com/css?family=Jura:400,500,600,300' rel='stylesheet' type='text/css' />

<!--    <script src="--><?php //echo Yii::app()->theme->baseUrl; ?><!--/js/digy/preview.js" type="text/javascript"></script>-->
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/digy/jquery.touchwipe.1.1.1.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/digy/jquery.carouFredSel-5.5.0-packed.js"></script>

    <!--[if lt IE 9]>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/digy/modernizr.custom.js"></script>
    <![endif]-->


	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<?php echo $content; ?>
</html>
