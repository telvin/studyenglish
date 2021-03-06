<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
    public $layout='//layouts/container2';

	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
        $this->layout='//layouts/container1';
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'

        Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/digy/functions.js', CClientScript::POS_END);
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
        Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl .'/css/login-flip.css');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/misc/login-flip.js', CClientScript::POS_END);

		$model=new LoginForm;
        $model2 = new ForgotPwForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login()){
                $this->redirect(Yii::app()->user->returnUrl);
            }

		}
        elseif($_POST['ForgotPwForm']){
            $model->attributes=$_POST['ForgotForm'];
            if($model->validate() && $model->check_email_exist())
            {
                // send email and update account
                $user_email = User::model()->find('email=:email', array(':email' => $model->email));

                $msg = Commons::buildEmailContent(1,
                    array('name'		=>	$user_email->first_name . ' ' . $user_email->last_name,
                        'FULL_NAME'		=>	$user_email->login_name,
                        'RESET_PASSWORD_URL' =>	Yii::app()->createAbsoluteUrl('site/resetpassword')), $subject);
                $from_mail	=	Yii::app()->params['fromEmail'];
                Commons::sendMail($from_mail, $model->email, 'Forgot password from SignSmart', $msg, true, "", "");
            }
        }

		// display the login form
		$this->render('login',array('model'=>$model,'model2'=>$model2));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

    public function actionResetPassword(){
        $this->render('reset-password');
    }
}