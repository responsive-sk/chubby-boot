<?php

declare(strict_types=1);

namespace App\Parsing;

use App\Collection\CollectionInterface;
use App\Dto\Collection\ArticleCollectionFilters;
use App\Dto\Collection\ArticleCollectionRequest;
use App\Dto\Collection\ArticleCollectionResponse;
use App\Dto\Collection\ArticleCollectionSort;
use App\Dto\Model\ArticleRequest;
use App\Dto\Model\ArticleResponse;
use Chubbyphp\Framework\Router\UrlGeneratorInterface;
use Chubbyphp\Parsing\ParserInterface;
use Chubbyphp\Parsing\Schema\ObjectSchemaInterface;
use Psr\Http\Message\ServerRequestInterface;

final class ArticleParsing implements ParsingInterface
{
    private ?ObjectSchemaInterface $collectionRequestSchema = null;

    private ?ObjectSchemaInterface $collectionResponseSchema = null;

    private ?ObjectSchemaInterface $modelRequestSchema = null;

    private ?ObjectSchemaInterface $modelResponseSchema = null;

    public function __construct(
        private ParserInterface $parser,
        private UrlGeneratorInterface $urlGenerator,
    ) {}

    public function getCollectionRequestSchema(ServerRequestInterface $request): ObjectSchemaInterface
    {
        if (null === $this->collectionRequestSchema) {
            $p = $this->parser;

            $this->collectionRequestSchema = $p->object([
                'offset' => $p->union([$p->string()->toInt(), $p->int()->default(CollectionInterface::LIMIT)]),
                'limit' => $p->union([
                    $p->string()->toInt(),
                    $p->int()->default(CollectionInterface::LIMIT),
                ]),
                'filters' => $p->object([
                    'title' => $p->string()->nullable()->default(null),
                    'tag' => $p->string()->nullable()->default(null),
                ], ArticleCollectionFilters::class)->strict()->default([]),
                'sort' => $p->object([
                    'title' => $p->union([
                        $p->literal('asc'),
                        $p->literal('desc'),
                    ])->nullable()->default(null),
                ], ArticleCollectionSort::class)->strict()->default([]),
            ], ArticleCollectionRequest::class)->strict();
        }

        return $this->collectionRequestSchema;
    }

    public function getCollectionResponseSchema(ServerRequestInterface $request): ObjectSchemaInterface
    {
        if (null === $this->collectionResponseSchema) {
            $p = $this->parser;

            $this->collectionResponseSchema = $p->object([
                'offset' => $p->int(),
                'limit' => $p->int(),
                'filters' => $p->object([
                    'title' => $p->string()->nullable(),
                    'tag' => $p->string()->nullable(),
                ], ArticleCollectionFilters::class)->strict(),
                'sort' => $p->object([
                    'title' => $p->union([
                        $p->literal('asc'),
                        $p->literal('desc'),
                    ])->nullable()->default(null),
                ], ArticleCollectionSort::class)->strict(),
                'items' => $p->array($this->getModelResponseSchema($request)),
                'count' => $p->int(),
                '_type' => $p->literal('articleCollection')->default('articleCollection'),
            ], ArticleCollectionResponse::class)
                ->strict()
                ->postParse(function (ArticleCollectionResponse $articleCollectionResponse) {
                    $queryParams = [
                        'offset' => $articleCollectionResponse->offset,
                        'limit' => $articleCollectionResponse->limit,
                        'filters' => $articleCollectionResponse->filters->jsonSerialize(),
                        'sort' => $articleCollectionResponse->sort->jsonSerialize(),
                    ];

                    $articleCollectionResponse->_links = [
                        'list' => [
                            'href' => $this->urlGenerator->generatePath('article_list', [], $queryParams),
                            'templated' => false,
                            'rel' => [],
                            'attributes' => ['method' => 'GET'],
                        ],
                        'create' => [
                            'href' => $this->urlGenerator->generatePath('article_create'),
                            'templated' => false,
                            'rel' => [],
                            'attributes' => ['method' => 'POST'],
                        ],
                    ];

                    return $articleCollectionResponse;
                })
                ->postParse(static function (object $object): array {
                    $json = json_encode($object);

                    return json_decode($json, true);
                })
            ;
        }

        return $this->collectionResponseSchema;
    }

    public function getModelRequestSchema(ServerRequestInterface $request): ObjectSchemaInterface
    {
        if (null === $this->modelRequestSchema) {
            $p = $this->parser;

            $this->modelRequestSchema = $p->object([
                'title' => $p->string()->minLength(1),
                'content' => $p->string()->minLength(1),
                'tag' => $p->string()->minLength(1)->nullable(),
                'image' => $p->string()->nullable(),
                'category' => $p->object()->nullable(),
            ], ArticleRequest::class)->strict(['id', 'createdAt', 'updatedAt', '_type', '_links']);
        }

        return $this->modelRequestSchema;
    }

    public function getModelResponseSchema(ServerRequestInterface $request): ObjectSchemaInterface
    {
        if (null === $this->modelResponseSchema) {
            $p = $this->parser;

            $this->modelResponseSchema = $p->object([
                'id' => $p->string(),
                'createdAt' => $p->dateTime()->toString(),
                'updatedAt' => $p->dateTime()->nullable()->toString(),
                'title' => $p->string(),
                'content' => $p->string(),
                'tag' => $p->string()->nullable(),
                'image' => $p->string()->nullable(),
                'category' => $p->object()->nullable(),
                '_type' => $p->literal('article')->default('article'),
            ], ArticleResponse::class)->strict()
                ->postParse(function (ArticleResponse $articleResponse) {
                    $articleResponse->_links = [
                        'read' => [
                            'href' => $this->urlGenerator->generatePath('article_read', ['id' => $articleResponse->id]),
                            'templated' => false,
                            'rel' => [],
                            'attributes' => ['method' => 'GET'],
                        ],
                        'update' => [
                            'href' => $this->urlGenerator->generatePath('article_update', ['id' => $articleResponse->id]),
                            'templated' => false,
                            'rel' => [],
                            'attributes' => ['method' => 'PUT'],
                        ],
                        'delete' => [
                            'href' => $this->urlGenerator->generatePath('article_delete', ['id' => $articleResponse->id]),
                            'templated' => false,
                            'rel' => [],
                            'attributes' => ['method' => 'DELETE'],
                        ],
                    ];

                    return $articleResponse;
                })
                ->postParse(static function (object $object): array {
                    $json = json_encode($object);

                    return json_decode($json, true);
                })
            ;
        }

        return $this->modelResponseSchema;
    }
}
