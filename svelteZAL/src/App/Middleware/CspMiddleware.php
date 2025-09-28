<?php

declare(strict_types=1);

namespace App\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class CspMiddleware implements MiddlewareInterface
{
    /** @param array<string, string|array<string>> $cspConfig */
    public function __construct(
        private array $cspConfig
    ) {}

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $response = $handler->handle($request);

        $cspHeader = $this->buildCspHeader($this->cspConfig);

        return $response->withHeader('Content-Security-Policy', $cspHeader);
    }

    /** @param array<string, string|array<string>> $config */
    private function buildCspHeader(array $config): string
    {
        $directives = [];

        foreach ($config as $directive => $values) {
            if (is_array($values)) {
                $directives[] = $directive . ' ' . implode(' ', array_map('strval', $values));
            } else {
                $directives[] = $directive . ' ' . strval($values);
            }
        }

        return implode('; ', $directives);
    }
}
