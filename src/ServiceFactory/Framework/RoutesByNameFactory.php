<?php

declare(strict_types=1);

namespace App\ServiceFactory\Framework;

use App\Middleware\ApiExceptionMiddleware;
use App\RequestHandler\Api\Crud\CreateRequestHandler as BaseCreateRequestHandler;
use App\RequestHandler\Api\Crud\DeleteRequestHandler as BaseDeleteRequestHandler;
use App\RequestHandler\Api\Crud\ListRequestHandler as BaseListRequestHandler;
use App\RequestHandler\Api\Crud\ReadRequestHandler as BaseReadRequestHandler;
use App\RequestHandler\Api\Crud\UpdateRequestHandler as BaseUpdateRequestHandler;
use App\RequestHandler\OpenapiRequestHandler;
use App\RequestHandler\PingRequestHandler;
use Chubbyphp\Framework\Middleware\LazyMiddleware;
use Chubbyphp\Framework\RequestHandler\LazyRequestHandler;
use Chubbyphp\Framework\Router\Group;
use Chubbyphp\Framework\Router\Route;
use Chubbyphp\Framework\Router\RoutesByName;
use Chubbyphp\Framework\Router\RoutesByNameInterface;
use Chubbyphp\Negotiation\Middleware\AcceptMiddleware;
use Chubbyphp\Negotiation\Middleware\ContentTypeMiddleware;
use Psr\Container\ContainerInterface;

final class RoutesByNameFactory
{
    public function __invoke(ContainerInterface $container): RoutesByNameInterface
    {
        $ping = new LazyRequestHandler($container, PingRequestHandler::class);
        $openApi = new LazyRequestHandler($container, OpenapiRequestHandler::class);
        $articleListHtml = new LazyRequestHandler($container, \App\RequestHandler\ArticleListHtmlRequestHandler::class);

        $accept = new LazyMiddleware($container, AcceptMiddleware::class);
        $contentType = new LazyMiddleware($container, ContentTypeMiddleware::class);
        $apiExceptionMiddleware = new LazyMiddleware($container, ApiExceptionMiddleware::class);

        $articleList = new LazyRequestHandler($container, BaseListRequestHandler::class);
        $articleCreate = new LazyRequestHandler($container, BaseCreateRequestHandler::class);
        $articleRead = new LazyRequestHandler($container, BaseReadRequestHandler::class);
        $articleUpdate = new LazyRequestHandler($container, BaseUpdateRequestHandler::class);
        $articleDelete = new LazyRequestHandler($container, BaseDeleteRequestHandler::class);

        return new RoutesByName(
            Group::create('', [
                Route::get('/', 'home', new \App\RequestHandler\HomePageRequestHandler($container->get(\Mezzio\Template\TemplateRendererInterface::class))),
                Route::get('/ping', 'ping', $ping),
                Route::get('/openapi', 'openapi', $openApi),
                Route::get('/articles/list', 'articleListHtml', $articleListHtml),
                Group::create('/api', [
                    Group::create('/articles', [
                        Route::get('', 'article_list', $articleList),
                        Route::post('', 'article_create', $articleCreate, [$contentType]),
                        Route::get('/{id}', 'article_read', $articleRead),
                        Route::put('/{id}', 'article_update', $articleUpdate, [$contentType]),
                        Route::delete('/{id}', 'article_delete', $articleDelete),
                    ]),
                ], [$accept, $apiExceptionMiddleware]),
            ])->getRoutes()
        );
    }
}
