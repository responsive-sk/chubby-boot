<?php

declare(strict_types=1);

namespace App\Dto\Collection;

use App\Collection\CollectionInterface;
use App\Collection\ArticleCollection;

final class ArticleCollectionRequest implements CollectionRequestInterface
{
    public int $offset;

    public int $limit;

    public ArticleCollectionFilters $filters;

    public ArticleCollectionSort $sort;

    public function createCollection(): CollectionInterface
    {
        $collection = new ArticleCollection();
        $collection->setOffset($this->offset);
        $collection->setLimit($this->limit);
        $collection->setFilters((array) $this->filters);
        $collection->setSort((array) $this->sort);

        return $collection;
    }

    public function toCollection(): CollectionInterface
    {
        return $this->createCollection();
    }

    /**
     * @return array<string, mixed>
     */
    public function toCollectionResponse(CollectionInterface $collection): array
    {
        return [
            'offset' => $this->offset,
            'limit' => $this->limit,
            'filters' => (array) $this->filters,
            'sort' => (array) $this->sort,
            'items' => $collection->getItems(),
            'count' => $collection->getCount(),
            '_type' => 'articleCollection',
        ];
    }
}
