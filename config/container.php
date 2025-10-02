<?php

declare(strict_types=1);

use Chubbyphp\Container\Container;
use Chubbyphp\Laminas\Config\Config;
use Chubbyphp\Laminas\Config\ContainerFactory;
use Chubbyphp\Framework\Router\FastRoute\RouteMatcher;
use Chubbyphp\Framework\Router\RoutesByName;
use Chubbyphp\Framework\Router\Route;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

date_default_timezone_set('UTC');
$env = getenv('APP_ENV') ?: 'dev';

// Načítajte základnú konfiguráciu
$baseConfig = require __DIR__ . '/' . $env . '.php';

// Odstráňte existujúce route konfigurácie
unset(
    $baseConfig[\Chubbyphp\Framework\Router\RouteMatcherInterface::class],
    $baseConfig[\Chubbyphp\Framework\Router\FastRoute\RouteMatcher::class],
    $baseConfig[\Chubbyphp\Framework\Router\RoutesByNameInterface::class],
    $baseConfig['routes']
);

// ⭐⭐️ VYTVORTE ROUTES ⭐⭐️
$routes = [
    Route::get('/api/ping', 'api_ping_final', new class implements RequestHandlerInterface {
        public function handle(ServerRequestInterface $request): ResponseInterface
        {
            $response = new \Laminas\Diactoros\Response();
            $response->getBody()->write('PONG - IT FINALLY WORKS!');
            return $response;
        }
    }),
    
    Route::get('/articles', 'articles_list_final', new class implements RequestHandlerInterface {
        public function handle(ServerRequestInterface $request): ResponseInterface
        {
            $response = new \Laminas\Diactoros\Response();
            $response->getBody()->write('ARTICLES - IT FINALLY WORKS!');
            return $response;
        }
    }),
    
    Route::get('/', 'home_final', new class implements RequestHandlerInterface {
        public function handle(ServerRequestInterface $request): ResponseInterface
        {
            $response = new \Laminas\Diactoros\Response();
            $response->getBody()->write('HOME - IT FINALLY WORKS!');
            return $response;
        }
    }),
];

// ⭐⭐️ POUŽITE OFICIÁLNU ROUTESBYNAME TRIEDU ⭐⭐️
$routesByName = new RoutesByName($routes);

// ⭐⭐️ KONEČNÁ KONFIGURÁCIA ⭐⭐️
$fullConfig = array_merge($baseConfig, [
    \Chubbyphp\Framework\Router\RouteMatcherInterface::class => static function () use ($routesByName) {
        return new RouteMatcher($routesByName);
    },
    
    \Chubbyphp\Framework\Router\FastRoute\RouteMatcher::class => static function () use ($routesByName) {
        return new RouteMatcher($routesByName);
    },
    
    \Chubbyphp\Framework\Router\RoutesByNameInterface::class => static function () use ($routesByName) {
        return $routesByName;
    },
]);

echo "=== FINAL CONFIG: Clean routes only ===\n";
foreach ($routes as $route) {
    echo "  " . $route->getMethod() . " " . $route->getPath() . " -> " . $route->getName() . "\n";
}

$container = (new ContainerFactory())(
    new Config($fullConfig),
    new Container()
);

return $container;