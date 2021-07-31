<?php

return [
    'database' => [
        'dbname' => 'todo_app',
        'username' => 'dpuser',
        'password' => 'rootdb123123',
        'driver' => 'mysql',
        'host' => '127.0.0.1',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ],
    ],
    'DEBUG' => true
];