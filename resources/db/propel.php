<?php
return [
    'propel' => [
        'database' => [
            'connections' => [
                'default' => [
                    'adapter' => 'mysql',
                    'dsn' => 'mysql:host=localhost;dbname=uacatalog',
                    'user' => 'root',
                    'password' => '',
                    'settings' => [
                        'charset' => 'utf8',
                        'queries' => [
                            'utf8' => 'SET NAMES utf8 COLLATE utf8_unicode_ci, COLLATION_CONNECTION = utf8_unicode_ci, COLLATION_DATABASE = utf8_unicode_ci, COLLATION_SERVER = utf8_unicode_ci'
                        ]
                    ]
                ]
            ]
        ]
    ]
];
