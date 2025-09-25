<?php

declare(strict_types=1);

namespace App\ServiceFactory\RequestHandler;

use App\RequestHandler\HomePageRequestHandler;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

final class HomePageRequestHandlerFactory
{
    public function __invoke(ContainerInterface $container): HomePageRequestHandler
    {
        return new HomePageRequestHandler(
            $container->get(TemplateRendererInterface::class)
        );
    }
}
