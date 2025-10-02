<?php

declare(strict_types=1);

use Chubbyphp\Framework\Router\Route;
use App\RequestHandler\PingRequestHandler;
use App\RequestHandler\OpenapiRequestHandler;
use App\RequestHandler\Api\Crud\ListRequestHandler;
use App\RequestHandler\Api\Crud\CreateRequestHandler;
use App\RequestHandler\Api\Crud\ReadRequestHandler;
use App\RequestHandler\Api\Crud\UpdateRequestHandler;
use App\RequestHandler\Api\Crud\DeleteRequestHandler;

return [
    Route::get('/api/ping', 'api_ping', PingRequestHandler::class),
    Route::get('/api/openapi', 'api_openapi', OpenapiRequestHandler::class),
    Route::get('/api/articles', 'api_articles_list', ListRequestHandler::class),
    Route::post('/api/articles', 'api_articles_create', CreateRequestHandler::class),
    Route::get('/api/articles/{id}', 'api_articles_read', ReadRequestHandler::class),
    Route::put('/api/articles/{id}', 'api_articles_update', UpdateRequestHandler::class),
    Route::delete('/api/articles/{id}', 'api_articles_delete', DeleteRequestHandler::class),
    // Ďalšie API routes...
];