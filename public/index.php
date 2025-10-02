<?php

declare(strict_types=1);

use Laminas\Diactoros\ServerRequestFactory;

/** @var Chubbyphp\Framework\Application $web */
$env = getenv('APP_ENV') ?: 'dev';
$web = (require __DIR__ . '/../src/web.php')($env);

echo "=== DEBUG: Handling request ===\n";
$request = ServerRequestFactory::fromGlobals();
echo "=== DEBUG: Request URI: " . $request->getUri()->getPath() . " ===\n";

$response = $web->handle($request);
$web->emit($response);