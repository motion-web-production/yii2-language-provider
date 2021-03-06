<?php

return [
    'id' => 'test-app',
    'class' => \yii\console\Application::className(),

    'basePath' => Yii::getAlias('@tests'),
    'vendorPath' => Yii::getAlias('@vendor'),
    'runtimePath' => Yii::getAlias('@tests/_output'),

    'bootstrap' => [],

    'components' => [
        'db' => [
            'class' => \yii\db\Connection::className(),
            'dsn' => 'sqlite:' . Yii::getAlias('@tests/_output/test.db'),
            'username' => '',
            'password' => '',
            'charset' => 'utf8',
        ],
    ],
];
