<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

ini_set('max_execution_time', 3000);
ob_start('My_OB');
include_once('connectdb.php');

function My_OB($str, $flags)
{
    //remove UTF-8 BOM
    $str = preg_replace("/\xef\xbb\xbf/","",$str);

    return $str;
}

$basePath = dirname(__FILE__) . DIRECTORY_SEPARATOR . '..';
require_once $basePath . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'global.php';

spl_autoload_unregister(array('YiiBase','autoload'));


//include some library that required to auto load here

spl_autoload_register(array('YiiBase','autoload'));

return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Study English',

    'sourceLanguage'=>'00',
    'language'=>'en',
    'defaultController' => 'site',
    'theme'=> 'classic',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
        'application.helpers.*',
	),

	'modules'=>array(
        'admin' => array(
            'defaultController' => 'default',
        ),


        // uncomment the following to enable the Gii tool
        'gii'=>array(
            'class'=>'system.gii.GiiModule',
            'password'=>'password',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters'=>array('127.0.0.1','::1'),
        ),

        'ssgii'=>array(
            'class'=>'system.ssgii.SSGiiModule',
            //'password'=>'password',
            // If removed, ssgii defaults to localhost only. Edit carefully to taste.
            'ipFilters'=>array('127.0.0.1','::1'),
        ),
	),

	// application components
	'components'=>array(
        'excel'=>array(
            'class'=>'application.extensions.PHPExcel',
        ),
        'user'=>array(
            // enable cookie-based authentication
            'allowAutoLogin'=>true,
            'class'=>'WebUser',
        ),
        'mail' => array(
            'class' => 'application.extensions.yii-mail.YiiMail',
            'transportType'=>'smtp',
            'transportOptions'=>array(
                'host'=>'smtp.gmail.com',
                'username'=>'satthudepmu@gmail.com',
                'password'=>'hiepsi12',
                'port'=>'465', // or 587
                'encryption'=>'ssl',
                'timeout'=>'120',
            ),
            'viewPath' => 'application.mail',
            'logging' => true,
            'dryRun' => false
        ),
		// uncomment the following to enable URLs in path-format

		'urlManager'=>array(
			'urlFormat'=>'path',
            'showScriptName'=>false, //remove index.php once using Yii::app()->createUrl
            'caseSensitive'=>false,
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>'
			),
		),

        'db'=>$YiiDbConnection,
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
        'log'=>array(
            'class'=>'CLogRouter',
            'routes'=>array(
                array(
                    'class'=>'CFileLogRoute',
                    'levels'=>'error, warning, trace, info',
//                    'categories'=>'application.*',
                    'categories'=>'system.db.CDbCommand',
                ),
                // uncomment the following to show log messages on web pages
                /*array(
                    'class'=>'CWebLogRoute',
                ),*/
            ),
        ),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'no-reply@example.com',
	),
);