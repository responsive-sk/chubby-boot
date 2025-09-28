<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\ProductRepositoryInterface;

class ProductService
{
    public function __construct(
        private ProductRepositoryInterface $productRepository
    ) {}

    /** @return array<array<string, mixed>> */
    public function getFeaturedProducts(int $limit = 10): array
    {
        return $this->productRepository->findBy(
            ['featured' => true],
            ['createdAt' => 'DESC'],
            $limit
        );
    }

    /** @return array<array<string, mixed>> */
    public function searchProducts(string $query, int $page = 1): array
    {
        return $this->productRepository->search($query, $page);
    }
}
