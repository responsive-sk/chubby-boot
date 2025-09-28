<?php

declare(strict_types=1);

namespace App\Tests\Unit\ServiceFactory\RequestHandler\Api\Crud;

use App\Parsing\ParsingInterface;
use App\Parsing\ArticleParsing;
use App\Repository\ArticleRepository;
use App\Repository\RepositoryInterface;
use App\RequestHandler\Api\Crud\ListRequestHandler;
use App\ServiceFactory\RequestHandler\Api\Crud\ArticleListRequestHandlerFactory;
use Chubbyphp\DecodeEncode\Encoder\EncoderInterface;
use Chubbyphp\Mock\MockMethod\WithReturn;
use Chubbyphp\Mock\MockObjectBuilder;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseFactoryInterface;

/**
 * @covers \App\ServiceFactory\RequestHandler\Api\Crud\ArticleListRequestHandlerFactory
 *
 * @internal
 */
final class ArticleListRequestHandlerFactoryTest extends TestCase
{
    public function testInvoke(): void
    {
        $builder = new MockObjectBuilder();

        /** @var ParsingInterface $articleParsing */
        $articleParsing = $builder->create(ParsingInterface::class, []);

        /** @var RepositoryInterface $articleRepository */
        $articleRepository = $builder->create(RepositoryInterface::class, []);

        /** @var EncoderInterface $encoder */
        $encoder = $builder->create(EncoderInterface::class, []);

        /** @var ResponseFactoryInterface $responseFactory */
        $responseFactory = $builder->create(ResponseFactoryInterface::class, []);

        /** @var ContainerInterface $container */
        $container = $builder->create(ContainerInterface::class, [
            new WithReturn('get', [ArticleParsing::class], $articleParsing),
            new WithReturn('get', [ArticleRepository::class], $articleRepository),
            new WithReturn('get', [EncoderInterface::class], $encoder),
            new WithReturn('get', [ResponseFactoryInterface::class], $responseFactory),
        ]);

        $factory = new ArticleListRequestHandlerFactory();

        self::assertInstanceOf(ListRequestHandler::class, $factory($container));
    }
}
