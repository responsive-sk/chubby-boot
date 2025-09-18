<?php

declare(strict_types=1);

namespace App\ServiceFactory\Repository;

use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

final class ArticleRepositoryFactory
{
    public function __invoke(ContainerInterface $container): ArticleRepository
    {
        return new ArticleRepository($container->get(EntityManager::class));
    }
}
