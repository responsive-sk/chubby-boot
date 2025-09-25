<?php

declare(strict_types=1);

namespace App\Handler\Web;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;
use function assert;

final class ComponentDemoHandlerFactory
{
    public function __invoke(ContainerInterface $container): ComponentDemoHandler
    {
        $template = null;
        if ($container->has(TemplateRendererInterface::class)) {
            $service = $container->get(TemplateRendererInterface::class);
            assert($service instanceof TemplateRendererInterface);
            $template = $service;
        }

        return new ComponentDemoHandler($template);
    }
}
