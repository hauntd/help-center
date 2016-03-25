<?php

$params = array_merge(
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

$db = array_merge(
    require(__DIR__ . '/db.php'),
    require(__DIR__ . '/db-local.php')
);

$config = [
    'id' => 'hc-web',
    'name' => 'Help Center',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'defaultRoute' => 'frontend/post/index',
    'modules' => [
        'frontend' => [
            'class' => app\modules\frontend\Module::class,
        ],
        'management' => [
            'class' => app\modules\management\Module::class,
        ],
    ],
    'components' => [
        'assetManager' => [
            'appendTimestamp' => true,
            'forceCopy' => YII_DEBUG,
        ],
        'cache' => [
            'class' => yii\caching\FileCache::class,
        ],
        'user' => [
            'class' => app\components\WebUser::class,
            'identityClass' => app\models\User::class,
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => yii\swiftmailer\Mailer::class,
            'useFileTransport' => true,
        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => yii\i18n\PhpMessageSource::class,
                    'basePath' => '@app/messages',
                    'sourceLanguage' => 'en-US',
                ],
            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => require(__DIR__ . '/routes.php'),
        ],
    ],
    'params' => $params,
];

return $config;
