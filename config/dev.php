<?php

declare(strict_types=1);

use Chubbyphp\Cors\Negotiation\Origin\AllowOriginRegex;
use Monolog\Level;

$config = require __DIR__.'/prod.php';

$config['chubbyphp']['cors']['allowOrigins']['^https?\:\/\/(localhost|127\.\d+.\d+.\d+)(\:\d+)?$'] = AllowOriginRegex::class;
$config['debug'] = true;
$config['doctrine']['cache'] = ['array' => []];
$config['doctrine']['orm']['configuration']['autoGenerateProxyClasses'] = true;
$config['fastroute']['cache'] = null;
$config['monolog']['level'] = Level::Notice;

// Ensure ArticleParsing factory is included
$config['dependencies']['factories']['App\Parsing\ArticleParsing'] = 'App\ServiceFactory\Parsing\ArticleParsingFactory';
$config['dependencies']['factories']['App\Repository\ArticleRepository'] = 'App\ServiceFactory\Repository\ArticleRepositoryFactory';

// Use custom EntityManager factory
$config['dependencies']['factories'][\Doctrine\ORM\EntityManagerInterface::class] = \App\ServiceFactory\Doctrine\EntityManagerFactory::class;

// Alias for backward compatibility
$config['dependencies']['aliases']['doctrine.entity_manager'] = \Doctrine\ORM\EntityManagerInterface::class;

return $config;
