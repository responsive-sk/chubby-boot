<?php

declare(strict_types=1);

namespace App\Tests\Unit\ServiceFactory\RequestHandler\Api\Crud;

use App\Parsing\ParsingInterface;
use App\Parsing\ArticleParsing;
use App\Repository\ArticleRepository;
use App\Repository\RepositoryInterface;
use App\RequestHandler\Api\Crud\CreateRequestHandler;
use App\ServiceFactory\RequestHandler\Api\Crud\ArticleCreateRequestHandlerFactory;
use Chubbyphp\DecodeEncode\Decoder\DecoderInterface;
use Chubbyphp\DecodeEncode\Encoder\EncoderInterface;
use Chubbyphp\Mock\MockMethod\WithReturn;
use Chubbyphp\Mock\MockObjectBuilder;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseFactoryInterface;

/**
 * @covers \App\ServiceFactory\RequestHandler\Api\Crud\ArticleCreateRequestHandlerFactory
 *
 * @internal
 */
final class ArticleCreateRequestHandlerFactoryTest extends TestCase
{
    public function testInvoke(): void
    {
        $builder = new MockObjectBuilder();

        /** @var DecoderInterface $decoder */
        $decoder = $builder->create(DecoderInterface::class, []);

        /** @var ParsingInterface $petParsing */
        $articleParsing = $builder->create(ParsingInterface::class, []);

        /** @var RepositoryInterface $petRepository */
        $articleRepository = $builder->create(RepositoryInterface::class, []);

        /** @var EncoderInterface $encoder */
        $encoder = $builder->create(EncoderInterface::class, []);

        /** @var ResponseFactoryInterface $responseFactory */
        $responseFactory = $builder->create(ResponseFactoryInterface::class, []);

        /** @var ContainerInterface $container */
        $container = $builder->create(ContainerInterface::class, [
            new WithReturn('get', [DecoderInterface::class], $decoder),
            new WithReturn('get', [ArticleParsing::class], $petParsing),
            new WithReturn('get', [ArticleRepository::class], $petRepository),
            new WithReturn('get', [EncoderInterface::class], $encoder),
            new WithReturn('get', [ResponseFactoryInterface::class], $responseFactory),
        ]);

        $factory = new ArticleCreateRequestHandlerFactory();

        self::assertInstanceOf(CreateRequestHandler::class, $factory($container));
    }
}
