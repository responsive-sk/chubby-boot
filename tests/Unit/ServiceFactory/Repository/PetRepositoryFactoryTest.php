<?php

declare(strict_types=1);

namespace App\Tests\Unit\ServiceFactory\Repository;

use App\Repository\PetRepository;
use App\ServiceFactory\Repository\PetRepositoryFactory;
use Chubbyphp\Mock\MockMethod\WithReturn;
use Chubbyphp\Mock\MockObjectBuilder;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;

/**
 * @covers \App\ServiceFactory\Repository\PetRepositoryFactory
 *
 * @internal
 */
final class PetRepositoryFactoryTest extends TestCase
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

        $factory = new PetRepositoryFactory();

        self::assertInstanceOf(PetRepository::class, $factory($container));
    }
}
