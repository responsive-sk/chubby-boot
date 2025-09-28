<?php

declare(strict_types=1);

namespace App\Tests\Unit\ServiceFactory\Parsing;

use App\Parsing\ArticleParsing;
use App\ServiceFactory\Parsing\ArticleParsingFactory;
use Chubbyphp\Framework\Router\UrlGeneratorInterface;
use Chubbyphp\Mock\MockMethod\WithReturn;
use Chubbyphp\Mock\MockObjectBuilder;
use Chubbyphp\Parsing\ParserInterface;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;

/**
 * @covers \App\ServiceFactory\Parsing\ArticleParsingFactory
 *
 * @internal
 */
final class ArticleParsingFactoryTest extends TestCase
{
    public function testInvoke(): void
    {
        $builder = new MockObjectBuilder();

        /** @var ParserInterface $parser */
        $parser = $builder->create(ParserInterface::class, []);

        /** @var UrlGeneratorInterface $urlGenerator */
        $urlGenerator = $builder->create(UrlGeneratorInterface::class, []);

        /** @var ContainerInterface $container */
        $container = $builder->create(ContainerInterface::class, [
            new WithReturn('get', [ParserInterface::class], $parser),
            new WithReturn('get', [UrlGeneratorInterface::class], $urlGenerator),
        ]);

        $factory = new ArticleParsingFactory();

        self::assertInstanceOf(ArticleParsing::class, $factory($container));
    }
}
