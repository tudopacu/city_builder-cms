<?php

return [
    'class' => 'yii\redis\Connection',
    'hostname' => getenv('REDIS_HOST'),
    'port' => (int)(getenv('REDIS_PORT')),
    'database' => (int)(getenv('REDIS_DATABASE')),
    'password' => getenv('REDIS_PASSWORD') ?: null,
];
