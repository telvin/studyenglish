<?php

class DefaultController extends AdminController
{
    public $no_visible_elements = false;
    public function actionIndex()
    {
        $this->adminMenu = array(
            array('label' => 'Admin Operations'),
            array('label' => 'Dashboard Home', 'icon' => 'home', 'url' => array('default/index#'), 'active' => true),
            array('label' => 'Demo 1', 'icon' => 'refresh', 'url' => array('demo1')),
            array('label' => 'Demo 2', 'icon' => 'user', 'url' => array('demo2')),
            array('label' => 'Demo 3', 'icon' => 'cog', 'url' => array('demo3')),
            array('label' => 'Demo 4', 'icon' => 'book', 'url' => array('demo4'))
        );

        $this->render('index');
    }

    public function actionLogin(){
        $this->no_visible_elements=true;

        $this->render('login');
    }
}