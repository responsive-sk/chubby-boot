<?php

declare(strict_types=1);

namespace App\ServiceFactory\RequestHandler\Api\Crud;

use App\Parsing\ArticleParsing;
use App\Repository\ArticleRepository;
use App\RequestHandler\Api\Crud\DeleteRequestHandler;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseFactoryInterface;

final class ArticleDeleteRequestHandlerFactory
{
    public function __invoke(ContainerInterface $container): DeleteRequestHandler
    {
        return new DeleteRequestHandler(
            $container->get(ArticleParsing::class),
            $container->get(ArticleRepository::class),
            $container->get(ResponseFactoryInterface::class),
        );
    }
}
