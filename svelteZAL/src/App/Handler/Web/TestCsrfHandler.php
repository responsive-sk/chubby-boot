<?php

declare(strict_types=1);

namespace App\Handler\Web;

use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class TestCsrfHandler implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        // This endpoint is protected by CSRF middleware
        // If CSRF is working, POST requests without valid token will be blocked
        return new JsonResponse([
            'message' => 'CSRF test successful',
            'method' => $request->getMethod(),
            'timestamp' => date('Y-m-d H:i:s'),
        ]);
    }
}
