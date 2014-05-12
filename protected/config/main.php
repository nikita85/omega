<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

return array(
	'basePath' => dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'     => 'Omega Teaching',

	// preloading 'log' component
	'preload'  => array('log'),
        'language' => 'en',

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
                'application.models.behaviors.*',
		'application.components.*',
                'ext.giix-components.*',
	),

	'modules'=>array(

        'admin' => [
            'defaultController' => 'index',
            'layout' => 'main',
            'preload' => ['bootstrap'],
            'components' => [
                'bootstrap'=> [
                    'class'=>'ext.bootstrap.components.Bootstrap',
                    'responsiveCss' => true,
                ],
            ],
        ],
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'qwe123qwe',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
			'generatorPaths' => array(
                            'ext.giix-core', // giix generator
                        ),
		),
		
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format

		'urlManager'=>array(
			'urlFormat'=>'path',
                        'showScriptName' => false,
			'rules'=>array(

//                'market' => 'site/ourMarket',
//                'jobs' => 'site/jobs',
//                'tutors' => 'site/tutors',
//
//                'classes/<type:summer>/<view>'=>'site/summerClasses',
//                'classes/<type:summer>'=>'site/summerClasses',
//                'classes/<view>'  => 'site/classes',
//                'classes'  => 'site/classes',

//                '<controller:\w+>/<id:\d+>'                 =>'<controller>/view',
//                '<controller:\w+>/<action:\w+>/<id:\d+>'    =>'<controller>/<action>',
                '<controller:\w+>/<action:\w+>'             =>'<controller>/<action>',
//                '<controller:\w+>/<cact:\w+>/<action:\w+>'  =>'<controller>/<cact>',
                /*
                   Admin module
               */

//                'admin'                                         => 'admin/index/index',
//                'admin/<controller:\w+>'                        => 'admin/<controller>/index',
//                'admin/<controller:\w+>/<action:\w+>/<id:\d+>'  => 'admin/<controller>/<action>',
//                'admin/<controller:\w+>/<action:\w+>'           => 'admin/<controller>/<action>',

			),
		),
            
                'paypalButton'=>array(
                    'class'      => 'application.components.PayPalButton',
                    'merchantId' => 'nik_1492@yahoo.com',
                    'callBackUrl'=> 'http://ec2-204-236-149-253.us-west-1.compute.amazonaws.com/payment/callback',
                    'srcUrl'     => 'https://www.paypalobjects.com/js/external/paypal-button.min.js',
                    'sandBoxMode'=> true,
                ),

        'db' => require dirname(__FILE__) . DIRECTORY_SEPARATOR . 'db.php',
		// uncomment the following to use a MySQL database
		/*
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=testdrive',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),
		*/
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

        'mail' => array(
            'class' => 'ext.yii-mail.YiiMail',
            'transportType' => 'smtp',
            'transportOptions' => array(
                'host' => 'smtp.gmail.com',
                'username' => 'noreply@maximumtest.ru',
                'password' => 'Ga3ySY=Z.',
                'port' => '465',
                'encryption' => 'ssl',
            ),
            'viewPath' => 'application.views.mail',
            'logging' => true,
            'dryRun' => false
        ),

        'viewRenderer' => array(
            'class' => 'ext.phamlp.Haml',
            'ugly' => false,
            'style' => 'nested',
            'debug' => 0,
            'cache' => false,
            'fileExtension' => '.haml',
        ),

        'assetManager' => array(
            'class' => 'ext.phamlp.PBMAssetManager',
            'force' => YII_DEBUG,
            'parsers' => array(
                'sass' => array(
                    'class' => 'ext.phamlp.Sass',
                    'output' => 'css',
                    'options' => array(
                        'style' => 'nested',
                        'cache' => false,
                        'extensions' => array(
                            'compass' => array(
                                'project_path' => realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..'),
                                'relative_assets' => false,
                            )
                        )
                    ),
                ),
                'scss' => array(
                    'class' => 'ext.phamlp.Sass',
                    'output' => 'css',
                    'options' => array(
                        'style' => 'nested',
                        'cache' => false,
                        'extensions' => array(
                            'compass' => array(
                                'project_path' => realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..'),
                                'relative_assets' => false,
                            )
                        )
                    )
                ),
            )
        ),


	),

	// application-level parameters that can be accessed
	// using Yii::app()->paramsarray('paramName')
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);