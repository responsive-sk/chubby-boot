<?php

declare(strict_types=1);

namespace App\Orm;

use App\Model\Category;
use Chubbyphp\Laminas\Config\Doctrine\Persistence\Mapping\Driver\ClassMapMappingInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;
use Doctrine\ORM\Mapping\ClassMetadata as ORMClassMetadata;
use Doctrine\Persistence\Mapping\ClassMetadata;

final class ArticleMapping implements ClassMapMappingInterface
{
    /**
     * @param ClassMetadata<Article> $metadata
     */
    public function configureMapping(ClassMetadata $metadata): void
    {
        $builder = new ClassMetadataBuilder($metadata);
        $builder->setTable('articles');
        $builder->createField('id', Types::GUID)->makePrimaryKey()->build();
        $builder->addField('createdAt', Types::DATETIME_IMMUTABLE);
        $builder->addField('updatedAt', Types::DATETIME_IMMUTABLE, ['nullable' => true]);
        $builder->addField('title', Types::STRING);
        $builder->addField('content', Types::TEXT);
        $builder->addField('tag', Types::STRING, ['nullable' => true]);
        $builder->addField('image', Types::STRING, ['nullable' => true]);
        $builder->createManyToOne('category', Category::class)
            ->addJoinColumn('category_id', 'id')
            ->inversedBy('articles')
            ->build()
        ;
    }
}
