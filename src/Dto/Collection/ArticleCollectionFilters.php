<?php

declare(strict_types=1);

namespace App\Dto\Collection;

final class ArticleCollectionFilters implements \JsonSerializable
{
    // Define filter properties here, e.g.:
    // public ?string $title = null;

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return [];
    }
}
