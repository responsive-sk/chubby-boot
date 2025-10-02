<?php

declare(strict_types=1);

use Chubbyphp\Framework\Router\Route;
use App\RequestHandler\HomePageRequestHandler;
use App\RequestHandler\ArticleListHtmlRequestHandler;

return [
    Route::get('/', 'home', HomePageRequestHandler::class),
    Route::get('/articles', 'articles_list', ArticleListHtmlRequestHandler::class),
    // Ďalšie web routes...
];