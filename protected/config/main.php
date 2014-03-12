<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Web Application',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		/*
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'Enter Your Password Here',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		*/
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

                'classes' => 'site/classes',
                'main_classes' => 'site/mainClasses',
                'opened_class' => 'site/openedClass',
                'jobs' => 'site/jobs',
                'classes' => 'site/classes',

				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),

		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
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