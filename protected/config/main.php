<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
        'language'=>'es',
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Honducompras',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>false,
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
            
                'rbam'=>array(
                    // RBAM Configuration
                ),
		
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		
		'Date' => array(
     		'class'=>'application.components.Date',
     		//And integer that holds the offset of hours from GMT e.g. 4 for GMT +4
     		'offset' =>-6,
		),
            
                'authManager'=>array( 
                'class'=>'CDbAuthManager', 
                'connectionID'=>'db',
                'itemTable'=>'tbl_auth_item',
                'itemChildTable'=>'tbl_auth_item_child',
                'assignmentTable'=>'tbl_auth_assignment',    
                    
                ),
		
		// uncomment the following to enable URLs in path-format
		/*
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		*/
		// uncomment the following to use a MySQL database
		
            
//                // MySQL database on Oncae Server
//		'db'=>array(
//                            'connectionString' => 'mysql:host=localhost;dbname=honducompras',
//                            'emulatePrepare' => true,
//                            'username' => 'root',
//                            'password' => '',
//                            'charset' => 'utf8',
//                    ),
            
//                // MSSql database on Oncae Server
		'db'=>array(
                            'connectionString' => 'sqlsrv:Server=localhost\SQLEXPRESS;Database=honducompras',
                            'username' => 'sa',
                            'password' => 'H0nduc0mpr@s',
                            'charset' => 'utf8',
                    ),
            
            

		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);