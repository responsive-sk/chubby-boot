<?php

declare(strict_types=1);

namespace App\ServiceFactory\RequestHandler\Api\Crud;

use App\Parsing\ArticleParsing;
use App\Repository\ArticleRepository;
use App\RequestHandler\Api\Crud\ListRequestHandler;
use Chubbyphp\DecodeEncode\Encoder\EncoderInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseFactoryInterface;

final class ArticleListRequestHandlerFactory
{
    public function __invoke(ContainerInterface $container): ListRequestHandler
    {
        return new ListRequestHandler(
            $container->get(ArticleParsing::class),
            $container->get(ArticleRepository::class),
            $container->get(EncoderInterface::class),
            $container->get(ResponseFactoryInterface::class),
        );
    }
}
