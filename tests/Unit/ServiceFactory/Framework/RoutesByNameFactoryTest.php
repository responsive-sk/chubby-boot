<?php

declare(strict_types=1);

namespace App\Tests\Unit\ServiceFactory\Framework;

use App\Middleware\ApiExceptionMiddleware as MiddlewareApiExceptionMiddleware;
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

        $homePage = new LazyRequestHandler($container, 'App\RequestHandler\HomePageRequestHandler');
        $articleListHtml = new LazyRequestHandler($container, 'App\RequestHandler\ArticleListHtmlRequestHandler');

        $factory = new RoutesByNameFactory();

        $routes = $factory($container)->getRoutesByName();
        
        // Check that all expected routes exist
        self::assertArrayHasKey('home', $routes);
        self::assertArrayHasKey('ping', $routes);
        self::assertArrayHasKey('openapi', $routes);
        self::assertArrayHasKey('articleListHtml', $routes);
        self::assertArrayHasKey('article_list', $routes);
        self::assertArrayHasKey('article_create', $routes);
        self::assertArrayHasKey('article_read', $routes);
        self::assertArrayHasKey('article_update', $routes);
        self::assertArrayHasKey('article_delete', $routes);
        
        // Check some route details
        self::assertEquals('/', $routes['home']->getPath());
        self::assertEquals('GET', $routes['home']->getMethod());
        self::assertEquals('/articles/list', $routes['articleListHtml']->getPath());
        self::assertEquals('GET', $routes['articleListHtml']->getMethod());
        self::assertEquals('/api/articles', $routes['article_list']->getPath());
        self::assertEquals('GET', $routes['article_list']->getMethod());
    }
}
