<?php

declare(strict_types=1);

use Chubbyphp\Container\Container;
use Chubbyphp\Laminas\Config\Config;
use Chubbyphp\Laminas\Config\ContainerFactory;

// Set the default timezone
date_default_timezone_set('UTC');

// Set the environment
$env = getenv('APP_ENV') ?: 'dev';

// Load configuration
$config = require __DIR__ . '/' . $env . '.php';

// Create container with configuration
$container = (new ContainerFactory())(
    new Config($config),
    new Container()
);

return $container;
