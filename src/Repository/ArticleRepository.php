<?php

declare(strict_types=1);

namespace App\Repository;

use App\Collection\CollectionInterface;
use App\Collection\ArticleCollection;
use App\Model\ModelInterface;
use App\Model\Article;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

final class ArticleRepository implements RepositoryInterface
{
    public function __construct(private EntityManager $entityManager) {}

    /**
     * @param CollectionInterface|ArticleCollection $articleCollection
     */
    public function resolveCollection(CollectionInterface $articleCollection): void
    {
        if (!$articleCollection instanceof ArticleCollection) {
            throw new \TypeError(
                \sprintf(
                    '%s() expects parameter 1 to be %s, %s given',
                    __METHOD__,
                    ArticleCollection::class,
                    $articleCollection::class
                )
            );
        }

        /** @var EntityRepository $entityRepository */
        $entityRepository = $this->entityManager->getRepository(Article::class);

        $queryBuilder = $entityRepository->createQueryBuilder('a');

        $filters = $articleCollection->getFilters();

        if (isset($filters['title'])) {
            $queryBuilder->andWhere($queryBuilder->expr()->like('a.title', ':title'));
            $queryBuilder->setParameter('title', '%'.$filters['title'].'%');
        }

        if (isset($filters['tag'])) {
            $queryBuilder->andWhere($queryBuilder->expr()->like('a.tag', ':tag'));
            $queryBuilder->setParameter('tag', '%'.$filters['tag'].'%');
        }

        $countQueryBuilder = clone $queryBuilder;
        $countQueryBuilder->select($queryBuilder->expr()->count('a.id'));

        $articleCollection->setCount((int) $countQueryBuilder->getQuery()->getSingleScalarResult());

        $itemsQueryBuilder = clone $queryBuilder;

        foreach ($articleCollection->getSort() as $field => $order) {
            $itemsQueryBuilder->addOrderBy(\sprintf('a.%s', $field), $order);
        }

        $itemsQueryBuilder->setFirstResult($articleCollection->getOffset());
        $itemsQueryBuilder->setMaxResults($articleCollection->getLimit());

        $articleCollection->setItems($itemsQueryBuilder->getQuery()->getResult());
    }

    public function findById(string $id): ?Article
    {
        return $this->entityManager->find(Article::class, $id);
    }

    public function persist(ModelInterface $article): void
    {
        if (!$article instanceof Article) {
            throw new \TypeError(
                \sprintf(
                    '%s() expects parameter 1 to be %s, %s given',
                    __METHOD__,
                    Article::class,
                    $article::class
                )
            );
        }

        $this->entityManager->persist($article);
    }

    public function remove(ModelInterface $article): void
    {
        if (!$article instanceof Article) {
            throw new \TypeError(
                \sprintf(
                    '%s() expects parameter 1 to be %s, %s given',
                    __METHOD__,
                    Article::class,
                    $article::class
                )
            );
        }

        $this->entityManager->remove($article);
    }

    public function flush(): void
    {
        $this->entityManager->flush();
    }
}
