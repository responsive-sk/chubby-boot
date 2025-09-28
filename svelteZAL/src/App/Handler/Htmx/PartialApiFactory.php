<?php

declare(strict_types=1);

namespace App\Handler\Htmx;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class PartialApiFactory
{
    public function __invoke(ContainerInterface $container): PartialApi
    {
        $template = $container->has(TemplateRendererInterface::class)
            ? $container->get(TemplateRendererInterface::class)
            : null;

        /** @var TemplateRendererInterface|null $template */
        return new PartialApi($template);
    }
}
