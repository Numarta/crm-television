<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
	//'timeZone' => 'Asia/Krasnoyarsk',
	'name' => 'АИС',
	'language' => 'ru-RU',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
	
	/*
	 'modules' => [ 
        'oauth2' => [ 
            'class' => \filsh\yii2\oauth2server\Module::class,
            'components' => [ 
                'request' => function () { 
                    return \filsh\yii2\oauth2server\Request::createFromGlobals();
                },
                'response' => [
                    'class' => \filsh\yii2\oauth2server\Response::class,
                ],
            ],
	
	
	'modules' => [
        'oauth2' => [
            'class' => \filsh\yii2\oauth2server\Module::class,            
            'tokenParamName' => 'accessToken',
            'tokenAccessLifetime' => 3600 * 24,
            'storageMap' => [
                'user_credentials' => 'app\models\User',
            ],
            'grantTypes' => [
				'authorization_code' => [
                    'class' => 'OAuth2\GrantType\AuthorizationCode',
                ],
                'user_credentials' => [
                    'class' => 'OAuth2\GrantType\UserCredentials',
					'allow_public_clients' => false
                ],
                'refresh_token' => [
                    'class' => 'OAuth2\GrantType\RefreshToken',
                    'always_issue_new_refresh_token' => !true
                ],
			],
				
			'components' => [ 
                'request' => function () { 
                    return \filsh\yii2\oauth2server\Request::createFromGlobals();
                },
                'response' => [
                    'class' => \filsh\yii2\oauth2server\Response::class,
                ],
            ],            
        ],
    ],
	*/
    'components' => [
		
	
		'formatter' => [  
			//'defaultTimeZone' => 'Asia/Krasnoyarsk',
            //'timeZone' => 'GMT+3',
            'dateFormat' => 'dd.MM.yyyy',
            'timeFormat' => 'HH:mm',
            'datetimeFormat' => 'dd.MM.yyyy HH:mm',				
			//'decimalSeparator' => '.',
			'thousandSeparator' => ' ',
			'currencyCode' => ' ',			
        ],
		'i18n' => [
			'translations' => [	
				'app' => [
					'class' => 'yii\i18n\PhpMessageSource',
					//'sourceLanguage' => 'en-US',
					'basePath' => '@app/messages',
				],
				'api' => [
					'class' => 'yii\i18n\PhpMessageSource',
					//'sourceLanguage' => 'en-US',
					'basePath' => '@app/messages',
				],
				/*
				'conquer/oauth2' => [
					'class' => \yii\i18n\PhpMessageSource::class,
					'basePath' => '@conquer/oauth2/messages',
				],
				*/
			],
		],
		'urlManager' => [
			'class' => 'yii\web\UrlManager',
			'enablePrettyUrl' => true, 
			'enableStrictParsing' => true,
			'showScriptName' => false,
            'rules' => [
							//'oauth2/<action:\w+>' => 'oauth2/rest/<action>',	
                            '/' => 'site/index',
                            '<controller>/<action>/<id:\d+>' => '<controller>/<action>',
                            '<controller>/<action>' => '<controller>/<action>',
                            //'POST oauth2/<action:\w+>' => 'oauth2/rest/<action>',
							

			],

		],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'aaaaaaaasdqwesda1234dsxcvsdfgksfdtg0234234edfsdfsdfqwer',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
