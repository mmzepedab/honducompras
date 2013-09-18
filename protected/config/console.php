<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Console Application',

	// preloading 'log' component
	'preload'=>array('log'),

	// application components
	'components'=>array(
		
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
            
                'authManager'=>array( 
                        'class'=>'CDbAuthManager', 
                        'connectionID'=>'db',
                        'itemTable'=>'tbl_auth_item',
                        'itemChildTable'=>'tbl_auth_item_child',
                        'assignmentTable'=>'tbl_auth_assignment',    
                    
                ),
		
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
			),
		),
	),
);