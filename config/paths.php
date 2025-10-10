<?php

declare(strict_types=1);

return [
    'base_path' => realpath(__DIR__ . '/../'),
    'paths' => [
        'templates' => realpath(__DIR__ . '/../templates'),
        'content' => realpath(__DIR__ . '/../content'),
        'public' => realpath(__DIR__ . '/../public'),
        // Add more custom paths as needed
    ],
    'preset' => 'slim4', // Use Slim 4 preset for predefined paths
];
