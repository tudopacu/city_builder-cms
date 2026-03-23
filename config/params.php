<?php

return [
    'adminEmail' => 'admin@example.com',
    'senderEmail' => 'noreply@example.com',
    'senderName' => 'Example.com mailer',
    'bsDependencyEnabled' => false,
    'bsVersion' => '5.x',
    'smartbill' => [
        'username' => '',  // Smartbill account email
        'token'    => '',  // Smartbill API token
        'cif'      => '',  // Company fiscal code (CIF)
        'series'   => 'FCMS',  // Default invoice series
    ],
];
