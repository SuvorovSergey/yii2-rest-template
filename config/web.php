<?php

use components\web\ErrorHandler;
use yii\web\JsonParser;
use yii\web\JsonResponseFormatter;
use yii\web\Response;
use yii\debug\Module;
use yii\log\FileTarget;
use yii\caching\FileCache;

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'app',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'homeUrl' => '/',
    'defaultRoute' => 'api',

    'components' => [
        'request' => [
            'cookieValidationKey' => '4-5OrSgWoeV5W-4trYsxTFhBKbi_v9gA',
            'parsers' => [
                'application/json' => JsonParser::class,
            ],
        ],

        'response' => [
            'charset' => 'UTF-8',
            'format' => Response::FORMAT_JSON,
            'formatters' => [
                Response::FORMAT_JSON => [
                    'class' => JsonResponseFormatter::class,
                    'prettyPrint' => YII_DEBUG,
                    'encodeOptions' => JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE,
                ],
            ],
        ],
        'cache' => [
            'class' => FileCache::class,
        ],
        'errorHandler' => [
            'class' => ErrorHandler::class,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],

    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => Module::class,
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => \yii\gii\Module::class,
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
