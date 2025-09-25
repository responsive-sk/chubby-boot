<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\ProductRepositoryInterface;
use Psr\Container\ContainerInterface;

class ProductServiceFactory
{
    public function __invoke(ContainerInterface $container): ProductService
    {
        /** @var ProductRepositoryInterface $productRepository */
        $productRepository = $container->get(ProductRepositoryInterface::class);

        return new ProductService($productRepository);
    }
}
