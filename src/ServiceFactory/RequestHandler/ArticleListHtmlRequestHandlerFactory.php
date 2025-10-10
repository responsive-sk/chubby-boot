<?php

declare(strict_types=1);

namespace App\ServiceFactory\RequestHandler;

use App\Repository\ArticleRepository;
use App\RequestHandler\ArticleListHtmlRequestHandler;
use Psr\Container\ContainerInterface;

final class ArticleListHtmlRequestHandlerFactory
{
    public function __invoke(ContainerInterface $container): ArticleListHtmlRequestHandler
    {
        return new ArticleListHtmlRequestHandler(
            $container->get(\Mezzio\Template\TemplateRendererInterface::class),
            $container->get(ArticleRepository::class)
        );
    }
}
