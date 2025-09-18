<?php

declare(strict_types=1);

namespace App\Tests\Unit\ServiceFactory\Framework;

use App\Middleware\ApiExceptionMiddleware as MiddlewareApiExceptionMiddleware;
use App\Model\Pet;
use App\RequestHandler\Api\Crud\CreateRequestHandler;
use App\RequestHandler\Api\Crud\DeleteRequestHandler;
use App\RequestHandler\Api\Crud\ListRequestHandler;
use App\RequestHandler\Api\Crud\ReadRequestHandler;
use App\RequestHandler\Api\Crud\UpdateRequestHandler;
use App\RequestHandler\OpenapiRequestHandler;
use App\RequestHandler\PingRequestHandler;
use App\ServiceFactory\Framework\RoutesByNameFactory;
use Chubbyphp\Framework\Middleware\LazyMiddleware;
use Chubbyphp\Framework\RequestHandler\LazyRequestHandler;
use Chubbyphp\Framework\Router\Route;
use Chubbyphp\Mock\MockObjectBuilder;
use Chubbyphp\Negotiation\Middleware\AcceptMiddleware;
use Chubbyphp\Negotiation\Middleware\ContentTypeMiddleware;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;

/**
 * @covers \App\ServiceFactory\Framework\RoutesByNameFactory
 *
 * @internal
 */
final class RoutesByNameFactoryTest extends TestCase
{
    public function testInvoke(): void
    {
        $builder = new MockObjectBuilder();

        /** @var ContainerInterface $container */
        $container = $builder->create(ContainerInterface::class, []);

        $ping = new LazyRequestHandler($container, PingRequestHandler::class);
        $openApi = new LazyRequestHandler($container, OpenapiRequestHandler::class);

        $accept = new LazyMiddleware($container, AcceptMiddleware::class);
        $contentType = new LazyMiddleware($container, ContentTypeMiddleware::class);
        $apiExceptionMiddleware = new LazyMiddleware($container, MiddlewareApiExceptionMiddleware::class);

        $articleList = new LazyRequestHandler($container, ListRequestHandler::class);
        $articleCreate = new LazyRequestHandler($container, CreateRequestHandler::class);
        $articleRead = new LazyRequestHandler($container, ReadRequestHandler::class);
        $articleUpdate = new LazyRequestHandler($container, UpdateRequestHandler::class);
        $articleDelete = new LazyRequestHandler($container, DeleteRequestHandler::class);

        $factory = new RoutesByNameFactory();

        self::assertEquals([
            'root' => Route::get('/', 'root', $ping),
            'ping' => Route::get('/ping', 'ping', $ping),
            'openapi' => Route::get('/openapi', 'openapi', $openApi),
            'article_list' => Route::get('/api/articles', 'article_list', $articleList, [$accept, $apiExceptionMiddleware]),
            'article_create' => Route::post('/api/articles', 'article_create', $articleCreate, [$accept, $apiExceptionMiddleware, $contentType]),
            'article_read' => Route::get('/api/articles/{id}', 'article_read', $articleRead, [$accept, $apiExceptionMiddleware]),
            'article_update' => Route::put('/api/articles/{id}', 'article_update', $articleUpdate, [$accept, $apiExceptionMiddleware, $contentType]),
            'article_delete' => Route::delete('/api/articles/{id}', 'article_delete', $articleDelete, [$accept, $apiExceptionMiddleware]),
        ], $factory($container)->getRoutesByName());
    }
}
