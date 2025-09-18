<?php

declare(strict_types=1);

use Slim\Psr7\Factory\ServerRequestFactory;

/** @var Chubbyphp\Framework\Application $web */
$env = getenv('APP_ENV') ?: 'dev';
$web = (require __DIR__ . '/../src/web.php')($env);
$web->emit($web->handle((new ServerRequestFactory())->createFromGlobals()));
