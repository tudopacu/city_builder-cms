<?php

return [
    'class' => 'yii\redis\Connection',
    'hostname' => getenv('REDIS_HOST') ?: 'localhost',
    'port' => (int)(getenv('REDIS_PORT') ?: 6379),
    'database' => (int)(getenv('REDIS_DATABASE') ?: 0),
    'password' => getenv('REDIS_PASSWORD') ?: null,
];
