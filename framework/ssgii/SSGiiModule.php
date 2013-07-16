<?php
/**
 * SSGiiModule class file.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @link http://www.yiiframework.com/
 * @copyright Copyright &copy; 2008-2011 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

Yii::import('system.ssgii.CCodeGenerator');
Yii::import('system.ssgii.CCodeModel');
Yii::import('system.ssgii.CCodeFile');
Yii::import('system.ssgii.CCodeForm');

/**
 * SSGiiModule is a module that provides Web-based code generation capabilities.
 *
 * To use SSGiiModule, you must include it as a module in the application configuration like the following:
 * <pre>
 * return array(
 *     ......
 *     'modules'=>array(
 *         'ssgii'=>array(
 *             'class'=>'system.ssgii.SSGiiModule',
 *             'password'=>***choose a password***
 *         ),
 *     ),
 * )
 * </pre>
 *
 * Because SSGiiModule generates new code files on the server, you should only use it on your own
 * development machine. To prevent other people from using this module, it is required that
 * you specify a secret password in the configuration. Later when you access
 * the module via browser, you will be prompted to enter the correct password.
 *
 * By default, SSGiiModule can only be accessed by localhost. You may configure its {@link ipFilters}
 * property if you want to make it accessible on other machines.
 *
 * With the above configuration, you will be able to access SSGiiModule in your browser using
 * the following URL:
 *
 * http://localhost/path/to/index.php?r=ssgii
 *
 * If your application is using path-format URLs with some customized URL rules, you may need to add
 * the following URLs in your application configuration in order to access SSGiiModule:
 * <pre>
 * 'components'=>array(
 *     'urlManager'=>array(
 *         'urlFormat'=>'path',
 *         'rules'=>array(
 *             'ssgii'=>'ssgii',
 *             'ssgii/<controller:\w+>'=>'ssgii/<controller>',
 *             'ssgii/<controller:\w+>/<action:\w+>'=>'ssgii/<controller>/<action>',
 *             ...other rules...
 *         ),
 *     )
 * )
 * </pre>
 *
 * You can then access SSGiiModule via:
 *
 * http://localhost/path/to/index.php/ssgii
 *
 * @property string $assetsUrl The base URL that contains all published asset files of ssgii.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @package system.ssgii
 * @since 1.1.2
 */
class SSGiiModule extends CWebModule
{
	/**
	 * @var string the password that can be used to access SSGiiModule.
	 * If this property is set false, then SSGiiModule can be accessed without password
	 * (DO NOT DO THIS UNLESS YOU KNOW THE CONSEQUENCE!!!)
	 */
	public $password;
	/**
	 * @var array the IP filters that specify which IP addresses are allowed to access SSGiiModule.
	 * Each array element represents a single filter. A filter can be either an IP address
	 * or an address with wildcard (e.g. 192.168.0.*) to represent a network segment.
	 * If you want to allow all IPs to access ssgii, you may set this property to be false
	 * (DO NOT DO THIS UNLESS YOU KNOW THE CONSEQUENCE!!!)
	 * The default value is array('127.0.0.1', '::1'), which means SSGiiModule can only be accessed
	 * on the localhost.
	 */
	public $ipFilters=array('127.0.0.1','::1');
	/**
	 * @var array a list of path aliases that refer to the directories containing code generators.
	 * The directory referred by a single path alias may contain multiple code generators, each stored
	 * under a sub-directory whose name is the generator name.
	 * Defaults to array('application.ssgii').
	 */
	public $generatorPaths=array('application.ssgii');
	/**
	 * @var integer the permission to be set for newly generated code files.
	 * This value will be used by PHP chmod function.
	 * Defaults to 0666, meaning the file is read-writable by all users.
	 */
	public $newFileMode=0666;
	/**
	 * @var integer the permission to be set for newly generated directories.
	 * This value will be used by PHP chmod function.
	 * Defaults to 0777, meaning the directory can be read, written and executed by all users.
	 */
	public $newDirMode=0777;

	private $_assetsUrl;

	/**
	 * Initializes the ssgii module.
	 */
	public function init()
	{
		parent::init();
		Yii::app()->setComponents(array(
			'errorHandler'=>array(
				'class'=>'CErrorHandler',
				'errorAction'=>$this->getId().'/default/error',
			),
			'user'=>array(
				'class'=>'CWebUser',
				'stateKeyPrefix'=>'ssgii',
				'loginUrl'=>Yii::app()->createUrl($this->getId().'/default/login'),
			),
			'widgetFactory' => array(
				'class'=>'CWidgetFactory',
				'widgets' => array()
			)
		), false);
		$this->generatorPaths[]='ssgii.generators';
		$this->controllerMap=$this->findGenerators();
	}

	/**
	 * @return string the base URL that contains all published asset files of ssgii.
	 */
	public function getAssetsUrl()
	{
		if($this->_assetsUrl===null)
			$this->_assetsUrl=Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('ssgii.assets'));
		return $this->_assetsUrl;
	}

	/**
	 * @param string $value the base URL that contains all published asset files of ssgii.
	 */
	public function setAssetsUrl($value)
	{
		$this->_assetsUrl=$value;
	}

	/**
	 * Performs access check to ssgii.
	 * This method will check to see if user IP and password are correct if they attempt
	 * to access actions other than "default/login" and "default/error".
	 * @param CController $controller the controller to be accessed.
	 * @param CAction $action the action to be accessed.
	 * @return boolean whether the action should be executed.
	 */
	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			$route=$controller->id.'/'.$action->id;
			if(!$this->allowIp(Yii::app()->request->userHostAddress) && $route!=='default/error')
				throw new CHttpException(403,"You are not allowed to access this page.");

			$publicPages=array(
				'default/login',
				'default/error',
			);
//			if($this->password!==false && Yii::app()->user->isGuest && !in_array($route,$publicPages))
//				Yii::app()->user->loginRequired();
//			else
//				return true;

            return true;
		}
		return false;
	}

	/**
	 * Checks to see if the user IP is allowed by {@link ipFilters}.
	 * @param string $ip the user IP
	 * @return boolean whether the user IP is allowed by {@link ipFilters}.
	 */
	protected function allowIp($ip)
	{
		if(empty($this->ipFilters))
			return true;
		foreach($this->ipFilters as $filter)
		{
			if($filter==='*' || $filter===$ip || (($pos=strpos($filter,'*'))!==false && !strncmp($ip,$filter,$pos)))
				return true;
		}
		return false;
	}

	/**
	 * Finds all available code generators and their code templates.
	 * @return array
	 */
	protected function findGenerators()
	{
		$generators=array();
		$n=count($this->generatorPaths);
		for($i=$n-1;$i>=0;--$i)
		{
			$alias=$this->generatorPaths[$i];
			$path=Yii::getPathOfAlias($alias);
			if($path===false || !is_dir($path))
				continue;

			$names=scandir($path);
			foreach($names as $name)
			{
				if($name[0]!=='.' && is_dir($path.'/'.$name))
				{
					$className=ucfirst($name).'Generator';
					if(is_file("$path/$name/$className.php"))
					{
						$generators[$name]=array(
							'class'=>"$alias.$name.$className",
						);
					}

					if(isset($generators[$name]) && is_dir("$path/$name/templates"))
					{
						$templatePath="$path/$name/templates";
						$dirs=scandir($templatePath);
						foreach($dirs as $dir)
						{
							if($dir[0]!=='.' && is_dir($templatePath.'/'.$dir))
								$generators[$name]['templates'][$dir]=strtr($templatePath.'/'.$dir,array('/'=>DIRECTORY_SEPARATOR,'\\'=>DIRECTORY_SEPARATOR));
						}
					}
				}
			}
		}

		return $generators;
	}

    public function SSGenModel($tableName, $modelName){
        $_ccodeGen = $this->controllerMap;

        $ccodeGen = new CCodeGenerator('', null);


        //$ccodeGen=new ReflectionClass(get_class($_ccodeGen['controller']['class']));

        $ccodeGen->codeModel = 'ssgii.generators.model.ModelCode';

        $model=$ccodeGen->ssAutoGenModel($tableName, $modelName);
        return ($model);

    }
}