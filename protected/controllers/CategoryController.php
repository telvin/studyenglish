<?php

class CategoryController extends Controller
{

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/

    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules()
    {
        return array(
            array('allow',
                'users' => array('@'),
                //'expression' => for authenticated user
            ),
            array('deny', // deny all users to direct un-authenticated user to login
                'users' => array('*'),
            ),
        );
    }

    public $layout='//layouts/container2';

    public function actionIndex()
    {
        $this->render('index');
    }

    public function actionCreate()
    {
        $this->render('create-category');
    }
}