<?php

declare(strict_types=1);

namespace App\Tests\Unit\Repository;

use App\Collection\CollectionInterface;
use App\Collection\ArticleCollection;
use App\Dto\Collection\CollectionRequestInterface;
use App\Model\ModelInterface;
use App\Model\Article;
use App\Repository\ArticleRepository;
use Chubbyphp\Mock\MockMethod\WithoutReturn;
use Chubbyphp\Mock\MockMethod\WithReturn;
use Chubbyphp\Mock\MockMethod\WithReturnSelf;
use Chubbyphp\Mock\MockObjectBuilder;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\Query\Expr;
use Doctrine\ORM\Query\Expr\Comparison;
use Doctrine\ORM\Query\Expr\Func;
use Doctrine\ORM\QueryBuilder;
use PHPUnit\Framework\Attributes\DoesNotPerformAssertions;
use PHPUnit\Framework\TestCase;

/**
 * @covers \App\Repository\ArticleRepository
 *
 * @internal
 */
final class ArticleRepositoryTest extends TestCase
{
    public function testResolveCollectionWithWrongCollection(): void
    {
        $builder = new MockObjectBuilder();

        /** @var CollectionRequestInterface $collection */
        $collection = $builder->create(CollectionRequestInterface::class, []);

        $this->expectException(\TypeError::class);
        $this->expectExceptionMessage(
            'App\Repository\ArticleRepository::resolveCollection() expects parameter 1 to be App\Dto\Collection\ArticleCollectionRequest, '
            .'Chubbyphp\Mock\MockObject\MockObject given'
        );

        /** @var EntityManagerInterface $entityManager */
        $entityManager = $builder->create(EntityManagerInterface::class, []);

        $repository = new ArticleRepository($entityManager);
        $repository->resolveCollection($collection);
    }

    #[DoesNotPerformAssertions]
    public function testResolveCollection(): void
    {
        $article = new Article();

        $items = [$article];

        $collection = new ArticleCollection();
        $collection->setOffset(0);
        $collection->setLimit(20);
        $collection->setFilters(['name' => 'sample']);
        $collection->setSort(['name' => 'asc']);

        $builder = new MockObjectBuilder();

        /** @var Comparison $likeNameFunc */
        $likeNameFunc = $builder->create(Comparison::class, []);

        /** @var Func $countIdFunc */
        $countIdFunc = $builder->create(Func::class, []);

        /** @var Expr $expr */
        $expr = $builder->create(Expr::class, [
            new WithReturn('like', ['p.name', ':name'], $likeNameFunc),
            new WithReturn('count', ['p.id'], $countIdFunc),
        ]);

        /** @var Query $countQuery */
        $countQuery = $builder->create(Query::class, [
            new WithReturn('getSingleScalarResult', [], (string) \count($items)),
        ]);

        /** @var Query $itemsQuery */
        $itemsQuery = $builder->create(Query::class, [
            new WithReturn('getResult', [AbstractQuery::HYDRATE_OBJECT], $items),
        ]);

        /** @var QueryBuilder $queryBuilder */
        $queryBuilder = $builder->create(QueryBuilder::class, [
            new WithReturn('expr', [], $expr),
            new WithReturnSelf('andWhere', [[$likeNameFunc]]),
            new WithReturnSelf('setParameter', ['name', '%sample%', null]),
            new WithReturnSelf('__clone', []),
            new WithReturn('expr', [], $expr),
            new WithReturnSelf('select', [[$countIdFunc]]),
            new WithReturn('getQuery', [], $countQuery),
            new WithReturnSelf('__clone', []),
            new WithReturnSelf('addOrderBy', ['p.name', 'asc']),
            new WithReturnSelf('setFirstResult', [0]),
            new WithReturnSelf('setMaxResults', [20]),
            new WithReturn('getQuery', [], $itemsQuery),
        ]);

        /** @var EntityRepository $repository */
        $repositoryMock = $builder->create(EntityRepository::class, [
            new WithReturn('createQueryBuilder', ['p', null], $queryBuilder),
        ]);

        /** @var EntityManager $entityManager */
        $entityManager = $builder->create(EntityManager::class, [
            new WithReturn('getRepository', [Article::class], $repositoryMock),
        ]);

        $repository = new ArticleRepository($entityManager);
        $repository->resolveCollection($collection);
    }

    public function testFindById(): void
    {
        $article = new Article();

        $builder = new MockObjectBuilder();

        /** @var EntityManager $entityManager */
        $entityManager = $builder->create(EntityManager::class, [
            new WithReturn('find', [Article::class, '86c78085-edaf-4df9-95d0-563e45acf618', null, null], $article),
        ]);

        $repository = new ArticleRepository($entityManager);

        self::assertSame($article, $repository->findById('86c78085-edaf-4df9-95d0-563e45acf618'));
    }

    public function testPersistWithWrongModel(): void
    {
        $builder = new MockObjectBuilder();

        /** @var ModelInterface $model */
        $model = $builder->create(ModelInterface::class, []);

        $modelClass = $model::class;

        $this->expectException(\TypeError::class);
        $this->expectExceptionMessage(
            \sprintf(
                'App\Repository\ArticleRepository::persist() expects parameter 1 to be App\Model\Article, %s given',
                $modelClass
            )
        );

        /** @var EntityManagerInterface $entityManager */
        $entityManager = $builder->create(EntityManagerInterface::class, []);

        $repository = new ArticleRepository($entityManager);
        $repository->persist($model);
    }

    #[DoesNotPerformAssertions]
    public function testPersist(): void
    {
        $article = new Article();

        $builder = new MockObjectBuilder();

        /** @var EntityManagerInterface $entityManager */
        $entityManager = $builder->create(EntityManagerInterface::class, [
            new WithoutReturn('persist', [$article]),
        ]);

        $repository = new ArticleRepository($entityManager);
        $repository->persist($article);
    }

    public function testRemoveWithWrongModel(): void
    {
        $builder = new MockObjectBuilder();

        /** @var ModelInterface $model */
        $model = $builder->create(ModelInterface::class, []);

        $modelClass = $model::class;

        $this->expectException(\TypeError::class);
        $this->expectExceptionMessage(
            \sprintf(
                'App\Repository\ArticleRepository::remove() expects parameter 1 to be App\Model\Article, %s given',
                $modelClass
            )
        );

        /** @var EntityManager $entityManager */
        $entityManager = $builder->create(EntityManager::class, []);

        $repository = new ArticleRepository($entityManager);
        $repository->remove($model);
    }

    #[DoesNotPerformAssertions]
    public function testRemove(): void
    {
        $article = new Article();

        $builder = new MockObjectBuilder();

        /** @var EntityManager $entityManager */
        $entityManager = $builder->create(EntityManager::class, [
            new WithoutReturn('remove', [$article]),
        ]);

        $repository = new ArticleRepository($entityManager);
        $repository->remove($article);
    }

    #[DoesNotPerformAssertions]
    public function testFlush(): void
    {
        $builder = new MockObjectBuilder();

        /** @var EntityManager $entityManager */
        $entityManager = $builder->create(EntityManager::class, [
            new WithoutReturn('flush', []),
        ]);

        $repository = new ArticleRepository($entityManager);
        $repository->flush();
    }
}
