<?php

declare(strict_types=1);

namespace App\Handler\Htmx;

use App\Service\ResponseStrategy\ResponseStrategySelector;
use Psr\Container\ContainerInterface;

final class ContentHandlerFactory
{
    public function __invoke(ContainerInterface $container): ContentHandler
    {
        $responseStrategySelector = $container->get(ResponseStrategySelector::class);
        \assert($responseStrategySelector instanceof ResponseStrategySelector);

        return new ContentHandler($responseStrategySelector);
    }
}
