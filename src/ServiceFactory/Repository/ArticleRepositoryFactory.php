<?php

declare(strict_types=1);

namespace App\ServiceFactory\Repository;

use App\Repository\ArticleRepository;
use App\ServiceFactory\Doctrine\EntityManagerFactory;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerInterface;

final class ArticleRepositoryFactory
{
    public function __invoke(ContainerInterface $container): ArticleRepository
    {
        $entityManager = $container->get(EntityManagerInterface::class);

        // Ensure we have an EntityManager instance, not a factory
        if ($entityManager instanceof EntityManagerFactory) {
            $entityManager = $entityManager($container);
        }

        return new ArticleRepository($entityManager);
    }
}
