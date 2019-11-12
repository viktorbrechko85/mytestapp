<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=yii2basic',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],
        'assetManager' => [
            'bundles' => [
                'dosamigos\google\maps\MapAsset' => [
                    'options' => [
                        'key' => 'AIzaSyCbNSNnyzCZhfN57aV-UBVN-RLZjhh4uQ0',
                        'libraries' => 'places',
                        'v' => '3.exp',
                        'sensor'=> 'false'
                    ]
                ],
                'bundles' => [
                    'kartik\form\ActiveFormAsset' => [
                        'bsDependencyEnabled' => false // do not load bootstrap assets for a specific asset bundle
                    ],
                ],
            ]
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'cache' => 'cache',
            'defaultRoles'    => ['guest'],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',  // Подключаем файловое кэширование данных
        ],
    ],
];
