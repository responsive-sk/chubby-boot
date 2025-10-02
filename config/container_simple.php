<?php

declare(strict_types=1);

use Chubbyphp\Container\Container;
use Chubbyphp\Laminas\Config\Config;
use Chubbyphp\Laminas\Config\ContainerFactory;
use Chubbyphp\Framework\Router\Route;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

date_default_timezone_set('UTC');
$env = getenv('APP_ENV') ?: 'dev';
$config = require __DIR__ . '/' . $env . '.php';

// ⭐⭐️ PRIDAŤ ROUTES PRIAMO DO EXISTUJÚCEHO ROUTESBYNAME ⭐⭐️
$originalRoutesByName = $config[\Chubbyphp\Framework\Router\RoutesByNameInterface::class] ?? null;

if ($originalRoutesByName && is_callable($originalRoutesByName)) {
    $originalRoutes = $originalRoutesByName()->getRoutesByName();
    
    // Pridajte naše chýbajúce routes
    $originalRoutes['api_ping'] = Route::get('/api/ping', 'api_ping', new class implements RequestHandlerInterface {
        public function handle(ServerRequestInterface $request): ResponseInterface
        {
            $response = new \Laminas\Diactoros\Response();
            $response->getBody()->write('PONG - IT WORKS!');
            return $response;
        }
    });
    
    $originalRoutes['articles_list'] = Route::get('/articles', 'articles_list', new class implements RequestHandlerInterface {
        public function handle(ServerRequestInterface $request): ResponseInterface
        {
            $response = new \Laminas\Diactoros\Response();
            $response->getBody()->write('ARTICLES - IT WORKS!');
            return $response;
        }
    });
    
    // Prepíšte RoutesByName s novými routes
    $config[\Chubbyphp\Framework\Router\RoutesByNameInterface::class] = static function () use ($originalRoutes) {
        return new \Chubbyphp\Framework\Router\RoutesByName($originalRoutes);
    };
    
    echo "=== ADDED MISSING ROUTES ===\n";
    echo "  GET /api/ping -> api_ping\n";
    echo "  GET /articles -> articles_list\n";
}

$container = (new ContainerFactory())(
    new Config($config),
    new Container()
);

return $container;