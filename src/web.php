<?php

declare(strict_types=1);

namespace App;

use Chubbyphp\Framework\Application;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\MiddlewareInterface;
use App\RequestHandler\HomePageRequestHandler;
use App\RequestHandler\ArticleListHtmlRequestHandler;


require __DIR__.'/../vendor/autoload.php';

return static function (string $env) {
    /** @var ContainerInterface $container */
    $container = require __DIR__.'/../config/container_simple.php';

    return new Application($container->get(MiddlewareInterface::class.'[]'));

    $app->get('/', \App\RequestHandler\HomePageRequestHandler::class);
    $app->get('/articles', \App\RequestHandler\ArticleListHtmlRequestHandler::class);

};
