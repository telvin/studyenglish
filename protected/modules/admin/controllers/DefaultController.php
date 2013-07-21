<?php

class DefaultController extends AdminController
{
    public $no_visible_elements = false;
    public $layout = "main";
    public function actionIndex()
    {
        /*
        $this->adminMenu = array(
            array('label' => 'Admin Operations'),
            array('label' => 'Dashboard Home', 'icon' => 'home', 'url' => array('default/index#'), 'active' => true),
            array('label' => 'Demo 1', 'icon' => 'refresh', 'url' => array('demo1')),
            array('label' => 'Demo 2', 'icon' => 'user', 'url' => array('demo2')),
            array('label' => 'Demo 3', 'icon' => 'cog', 'url' => array('demo3')),
            array('label' => 'Demo 4', 'icon' => 'book', 'url' => array('demo4'))
        );

        */
        $this->render('index');
    }

    public function actionLogin(){
        $this->no_visible_elements=true;

        $model=new LoginForm;

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
        // display the login form
        $this->render('login',array('model'=>$model));
    }

    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect($this->createUrl('default/login'));
    }

    public function actionBlank(){

        $this->render('blank');
    }

    public function actionCalendar(){

        $this->render('calendar');
    }

    public function actionChart(){

        $this->render('chart');
    }

    public function actionFileManager(){

        $this->render('file-manager');
    }

    public function actionForm(){

        $this->render('form');
    }

    public function actionGallery(){

        $this->render('gallery');
    }

    public function actionGrid(){

        $this->render('grid');
    }

    public function actionIcon(){

        $this->render('icon');
    }

    public function actionTable(){

        $this->render('table');
    }

    public function actionTypography(){

        $this->render('typography');
    }

    public function actionTour(){

        $this->render('tour');
    }

    public function actionUi(){

        $this->render('ui');
    }

    public function actionError(){
        $this->layout = '//layouts/empty';
        $this->render('error');
    }
}