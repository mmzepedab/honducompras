<?php

class StatsController extends Controller
{
        /**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
    
        /**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','AreaStats','institutionStats'),
				'roles'=>array('helpdesk_admin','helpdesk_central','helpdesk_officer'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
       
        
	public function actionIndex()
	{
                $this->render('index');	
                
        }
        
        public function actionAreaStats()
	{
		$this->render('areaStats');
	}
        
        public function actionInstitutionStats()
	{
		$this->render('institutionStats');
	}
        
        public function timeAreaStats()
	{
		$this->render('timeStats');
	}

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
}