<?php

declare(strict_types=1);

namespace App\Tests\Unit\ServiceFactory\Repository;

use App\Repository\ArticleRepository;
use App\ServiceFactory\Repository\ArticleRepositoryFactory;
use Chubbyphp\Mock\MockMethod\WithReturn;
use Chubbyphp\Mock\MockObjectBuilder;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;

/**
 * @covers \App\ServiceFactory\Repository\ArticleRepositoryFactory
 *
 * @internal
 */
final class ArticleRepositoryFactoryTest extends TestCase
{
    public function testInvoke(): void
    {
        $builder = new MockObjectBuilder();

        /** @var EntityManagerInterface $entityManager */
        $entityManager = $builder->create(EntityManagerInterface::class, []);

        /** @var ContainerInterface $container */
        $container = $builder->create(ContainerInterface::class, [
            new WithReturn('get', [EntityManagerInterface::class], $entityManager),
        ]);

        $factory = new ArticleRepositoryFactory();

        self::assertInstanceOf(ArticleRepository::class, $factory($container));
    }
}
