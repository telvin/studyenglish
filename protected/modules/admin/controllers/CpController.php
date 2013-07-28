<?php

class CpController extends AdminController
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

    public function actionCategory()
    {
        $model=new Category;

        // uncomment the following code to enable ajax-based validation
        /*
        if(isset($_POST['ajax']) && $_POST['ajax']==='category-category-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        */

        if(isset($_POST['Category']))
        {
            $model->attributes=$_POST['Category'];
            if($model->validate())
            {
                // form inputs are valid, do something here
                return;
            }
        }
        $this->render('category',array('model'=>$model));
    }

    public function actionWord(){

        //$words = Word::model()->findAll();
        //$data=array_map(create_function('$m','return $m->getAttributes();'),$words);


        $this->render('word', array('rates'=>$rates));
    }

    public function actionMeaning(){

    }

    public function actionGallery(){

    }

    public function actionUser(){

    }
}