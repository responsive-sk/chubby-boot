<?php

declare(strict_types=1);

namespace App\ServiceFactory\RequestHandler\Api\Crud;

use App\Parsing\ArticleParsing;
use App\Repository\ArticleRepository;
use App\RequestHandler\Api\Crud\UpdateRequestHandler;
use Chubbyphp\DecodeEncode\Decoder\DecoderInterface;
use Chubbyphp\DecodeEncode\Encoder\EncoderInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseFactoryInterface;

final class ArticleUpdateRequestHandlerFactory
{
    public function __invoke(ContainerInterface $container): UpdateRequestHandler
    {
        return new UpdateRequestHandler(
            $container->get(DecoderInterface::class),
            $container->get(ArticleParsing::class),
            $container->get(ArticleRepository::class),
            $container->get(EncoderInterface::class),
            $container->get(ResponseFactoryInterface::class),
        );
    }
}
