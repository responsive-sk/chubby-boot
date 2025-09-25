<?php

declare(strict_types=1);

namespace App\Handler\Web;

use App\Service\ResponseStrategy\ResponseStrategySelector;
use Mezzio\Router\RouterInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;

use function assert;

final class HomePageHandlerFactory
{
    public function __invoke(ContainerInterface $container): RequestHandlerInterface
    {
        $router = $container->get(RouterInterface::class);
        assert($router instanceof RouterInterface);

        $responseStrategySelector = $container->get(ResponseStrategySelector::class);
        assert($responseStrategySelector instanceof ResponseStrategySelector);

        return new HomePageHandler('Mezzio', $router, $responseStrategySelector);
    }
}
