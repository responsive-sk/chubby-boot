<?php

declare(strict_types=1);

namespace App\Dto\Collection;

use App\Collection\CollectionInterface;

interface CollectionRequestInterface
{
    public function createCollection(): CollectionInterface;

    public function toCollection(): CollectionInterface;

    /**
     * @return array<string, mixed>
     */
    public function toCollectionResponse(CollectionInterface $collection): array;
}
