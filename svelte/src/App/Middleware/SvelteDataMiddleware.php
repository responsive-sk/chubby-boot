<?php

declare(strict_types=1);

namespace App\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\HtmlResponse;

class SvelteDataMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $response = $handler->handle($request);

        // Pridaj hydration data IBA pre HTML responses
        if ($response instanceof HtmlResponse) {
            $hydrationData = $this->getHydrationData($request);
            $response = $this->injectHydrationData($response, $hydrationData);
        }

        return $response;
    }

    /** @return array<string, mixed> */
    private function getHydrationData(ServerRequestInterface $request): array
    {
        /** @var ?\Mezzio\Router\Route $route */
        $route = $request->getAttribute('route');

        return [
            // Základné app data
            'app' => [
                'env' => getenv('APP_ENV') ?: 'production',
                'debug' => (bool) getenv('APP_DEBUG'),
                'url' => (string) $request->getUri(),
                'route' => $route?->getName(),
            ],

            // User data
            'user' => $request->getAttribute('user') ?? null,

            // CSRF token
            'csrf' => $this->getCsrfToken($request),

            // Route-specific data
            'routeParams' => $route?->getOptions() ?? [],

            // Request data
            'query' => $request->getQueryParams(),
        ];
    }

    /** @param array<string, mixed> $data */
    private function injectHydrationData(HtmlResponse $response, array $data): HtmlResponse
    {
        $content = (string) $response->getBody();

        $script = sprintf(
            '<script>window.__APP_DATA__ = %s;</script>',
            json_encode($data, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP)
        );

        // Vlož script pred closing </body>
        if (strpos($content, '</body>') !== false) {
            $content = str_replace('</body>', $script . '</body>', $content);
        } else {
            // Fallback: pridaj na koniec
            $content .= $script;
        }

        $response->getBody()->rewind();
        $response->getBody()->write($content);

        return $response;
    }

    private function getCsrfToken(ServerRequestInterface $request): ?string
    {
        $guard = $request->getAttribute(\Mezzio\Csrf\CsrfMiddleware::GUARD_ATTRIBUTE);
        if (!is_object($guard)) {
            return null;
        }
        if (method_exists($guard, 'generateToken')) {
            $token = $guard->generateToken();
            return is_string($token) ? $token : null;
        }
        if (method_exists($guard, 'getToken')) {
            $token = $guard->getToken();
            return is_string($token) ? $token : null;
        }
        return null;
    }
}
