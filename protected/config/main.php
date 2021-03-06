<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'话题',
	'language'=>'zh_cn',
	// preloading 'log' component
	'preload'=>array('log', 'bootstrap',),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'333333',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
			'generatorPaths' => array(
          		'bootstrap.gii'
          	),
		),
	),

	// application components
	'components'=>array(
		'bootstrap' => array(
	      'class' => 'ext.yiibooster.components.Bootstrap',
	      'responsiveCss' => true,
		),
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		'clientScript' => array(
			'packages'=>array(
		        /*'jquery'=>array(
		          'baseUrl'=>'//ajax.googleapis.com/ajax/libs/jquery/1/',
		          'js'=>array('jquery.min.js'),
		        ),
		        'bbq'=>false,*/
				//'jquery'=>false,
	      	),
		),
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=bbs',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
			'enableProfiling' => true,
			'enableParamLogging' => true
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
				/*
				array(
						'class'=>'ext.yii-debug-toolbar.YiiDebugToolbarRoute',
						'ipFilters'=>array('127.0.0.1'),
				),
				// uncomment the following to show log messages on web pages
				
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
		'mandrill'=>array(
		    'class'=>'ext.mandrill.src.Mandrill',
		    'apikey'=>'mebWn8tUBGuKAdsABI-qAg',
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'377289825@qq.com',
	),
);