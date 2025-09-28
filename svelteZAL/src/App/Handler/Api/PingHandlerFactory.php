<?php

declare(strict_types=1);

namespace App\Handler\Api;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class PingHandlerFactory
{
    public function __invoke(ContainerInterface $container): RequestHandlerInterface
    {
        $templateRenderer = $container->get(TemplateRendererInterface::class);
        return new PingHandler($templateRenderer);
    }
}
