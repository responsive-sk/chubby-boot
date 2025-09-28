<?php

declare(strict_types=1);

namespace App\Tests\Unit\Collection;

use App\Collection\CollectionInterface;
use App\Collection\ArticleCollection;

/**
 * @covers \App\Collection\ArticleCollection
 *
 * @internal
 */
final class ArticleCollectionTest extends CollectionTest
{
    protected function getCollection(): CollectionInterface
    {
        return new ArticleCollection();
    }
}
