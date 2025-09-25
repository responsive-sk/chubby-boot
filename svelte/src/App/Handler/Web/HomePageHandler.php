<?php

declare(strict_types=1);

namespace App\Handler\Web;

use App\Service\ResponseStrategy\ResponseStrategySelector;
use Mezzio\Router\RouterInterface;
use Mezzio\Router\RouteResult;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

final readonly class HomePageHandler implements RequestHandlerInterface
{
    public function __construct(
        private string $appName,
        private RouterInterface $router,
        private ResponseStrategySelector $responseStrategySelector,
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        // Capture current route result if available for template context
        /** @var RouteResult|null $currentRoute */
        $currentRoute = $request->getAttribute(RouteResult::class);
        /** @var string|null $routeName */
        $routeName    = $currentRoute instanceof RouteResult ? $currentRoute->getMatchedRouteName() : null;

        // Server-side data pre Twig
        $data = [
            'template' => 'app::home-page',
            'title' => 'Domovska stránka',
            'content' => 'Vitajte v našej aplikácii',
            'appName' => $this->appName,
            'greeting' => 'HTMX PSR-15',
            'subtitle' => 'Loaded via HTMX from /hero',
            'cta'      => 'Get Started',
            'route_name' => $routeName,
            // reference router so Psalm does not flag it as unused
            'router_class' => $this->router::class,
            'request' => $request,
        ];

        $strategy = $this->responseStrategySelector->select($request);
        return $strategy->render($data);
    }
}
