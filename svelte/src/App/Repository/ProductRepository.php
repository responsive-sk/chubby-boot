<?php

declare(strict_types=1);

namespace App\Repository;

class ProductRepository implements ProductRepositoryInterface
{
    /** @var array<array<string, mixed>> $products */
    private array $products = [
        [
            'id' => 1,
            'name' => 'Svelte 5 Component',
            'description' => 'Modern reactive component',
            'price' => 29.99,
            'featured' => true,
            'createdAt' => '2024-01-01',
        ],
        [
            'id' => 2,
            'name' => 'HTMX Integration',
            'description' => 'Seamless HTMX integration',
            'price' => 19.99,
            'featured' => true,
            'createdAt' => '2024-01-02',
        ],
        [
            'id' => 3,
            'name' => 'Tailwind CSS Kit',
            'description' => 'Beautiful UI components',
            'price' => 39.99,
            'featured' => false,
            'createdAt' => '2024-01-03',
        ],
    ];

    /**
     * @param array<string, mixed> $criteria
     * @param array<string, string> $orderBy
     * @return array<array<string, mixed>>
     */
    public function findBy(array $criteria, array $orderBy = [], ?int $limit = null): array
    {
        $results = array_filter($this->products, /** @param array<string, mixed> $product */ function ($product) use ($criteria) {
            foreach ($criteria as $key => $value) {
                if (!isset($product[$key]) || $product[$key] !== $value) {
                    return false;
                }
            }
            return true;
        });

        if ($orderBy) {
            usort($results, /** @param array<string, mixed> $a */ /** @param array<string, mixed> $b */ function ($a, $b) use ($orderBy) {
                foreach ($orderBy as $field => $direction) {
                    /** @var string $direction */
                    $dir = strtolower($direction) === 'desc' ? -1 : 1;
                    if ($a[$field] < $b[$field]) return -1 * $dir;
                    if ($a[$field] > $b[$field]) return 1 * $dir;
                }
                return 0;
            });
        }

        if ($limit) {
            $results = array_slice($results, 0, $limit);
        }

        return array_values($results);
    }

    /** @return array<array<string, mixed>> */
    public function search(string $query, int $page = 1): array
    {
        $results = array_filter($this->products, /** @param array<string, mixed> $product */ function ($product) use ($query) {
            /** @var string $name */
            $name = $product['name'];
            /** @var string $description */
            $description = $product['description'];
            return stripos($name, $query) !== false ||
                   stripos($description, $query) !== false;
        });

        $perPage = 10;
        $offset = ($page - 1) * $perPage;

        return array_slice(array_values($results), $offset, $perPage);
    }

    /** @return array<string, mixed>|null */
    public function find(int $id): ?array
    {
        foreach ($this->products as $product) {
            if ($product['id'] === $id) {
                return $product;
            }
        }
        return null;
    }
}
