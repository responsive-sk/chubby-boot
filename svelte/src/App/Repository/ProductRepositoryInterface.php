<?php

declare(strict_types=1);

namespace App\Repository;

interface ProductRepositoryInterface
{
    /**
     * @param array<string, mixed> $criteria
     * @param array<string, string> $orderBy
     * @return array<array<string, mixed>>
     */
    public function findBy(array $criteria, array $orderBy = [], ?int $limit = null): array;

    /** @return array<array<string, mixed>> */
    public function search(string $query, int $page = 1): array;

    /** @return array<string, mixed>|null */
    public function find(int $id): ?array;
}
