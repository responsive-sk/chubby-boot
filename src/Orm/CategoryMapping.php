<?php

declare(strict_types=1);

namespace App\Orm;

use App\Model\Article;
use Chubbyphp\Laminas\Config\Doctrine\Persistence\Mapping\Driver\ClassMapMappingInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;
use Doctrine\ORM\Mapping\ClassMetadata as ORMClassMetadata;
use Doctrine\Persistence\Mapping\ClassMetadata;

final class CategoryMapping implements ClassMapMappingInterface
{
    /**
     * @param ClassMetadata<\App\Model\Category> $metadata
     */
    public function configureMapping(ClassMetadata $metadata): void
    {
        if (!$metadata instanceof ORMClassMetadata) {
            throw new \RuntimeException(sprintf(
                'Expected metadata to be instance of %s, got %s',
                ORMClassMetadata::class,
                get_class($metadata)
            ));
        }
        
        $builder = new ClassMetadataBuilder($metadata);
        $builder->setTable('categories');
        $builder->createField('id', Types::GUID)->makePrimaryKey()->build();
        $builder->addField('createdAt', Types::DATETIME_IMMUTABLE);
        $builder->addField('updatedAt', Types::DATETIME_IMMUTABLE, ['nullable' => true]);
        $builder->addField('name', Types::STRING);
        $builder->addField('image', Types::STRING, ['nullable' => true]);
        $builder->createOneToMany('articles', Article::class)
            ->mappedBy('category')
            ->cascadeRemove()
            ->build()
        ;
    }
}
