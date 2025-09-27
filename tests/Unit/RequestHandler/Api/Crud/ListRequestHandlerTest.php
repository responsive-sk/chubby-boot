<?php

declare(strict_types=1);

namespace App\Tests\Unit\RequestHandler\Api\Crud;

use App\Collection\CollectionInterface;
use App\Dto\Collection\CollectionRequestInterface;
use App\Parsing\ParsingInterface;
use App\Repository\RepositoryInterface;
use App\RequestHandler\Api\Crud\ListRequestHandler;
use Chubbyphp\DecodeEncode\Encoder\EncoderInterface;
use Chubbyphp\Mock\MockMethod\WithCallback;
use Chubbyphp\Mock\MockMethod\WithException;
use Chubbyphp\Mock\MockMethod\WithoutReturn;
use Chubbyphp\Mock\MockMethod\WithReturn;
use Chubbyphp\Mock\MockMethod\WithReturnSelf;
use Chubbyphp\Mock\MockObjectBuilder;
use Chubbyphp\Parsing\ParserErrorException;
use Chubbyphp\Parsing\Schema\ObjectSchemaInterface;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamInterface;

/**
 * @covers \App\RequestHandler\Api\Crud\ListRequestHandler
 *
 * @internal
 */
final class ListRequestHandlerTest extends TestCase
{
    public function testWithParsingError(): void
    {
        $parserErrorException = new ParserErrorException();

        $queryAsStdClass = new \stdClass();
        $queryAsStdClass->name = 'test';
        $queryAsArray = (array) $queryAsStdClass;

        $builder = new MockObjectBuilder();

        /** @var ServerRequestInterface $request */
        $request = $builder->create(ServerRequestInterface::class, [
            new WithReturn('getMethod', [], 'GET'),
            new WithReturn('getAttribute', ['accept', null], 'application/json'),
            new WithReturn('getQueryParams', [], $queryAsArray),
            new WithReturn('getRequestTarget', [], '/api/pets'),
            new WithReturn('getUri', [], new class() {
                public function getPath() { return '/api/pets'; }
                public function getQuery() { return ''; }
            }),
        ]);

        $collectionRequestSchema = $builder->create(ObjectSchemaInterface::class, [
            new WithException('parse', [$queryAsArray], $parserErrorException),
            new WithReturn('getDefaults', [], []),
        ]);

        /** @var ParsingInterface $parsing */
        $parsing = $builder->create(ParsingInterface::class, [
            new WithReturn('getCollectionRequestSchema', [$request], $collectionRequestSchema),
        ]);

        /** @var RepositoryInterface $repository */
        $repository = $builder->create(RepositoryInterface::class, []);

        /** @var EncoderInterface $encoder */
        $encoder = $builder->create(EncoderInterface::class, []);

        /** @var ResponseFactoryInterface $responseFactory */
        $responseFactory = $builder->create(ResponseFactoryInterface::class, []);

        $requestHandler = new ListRequestHandler(
            $parsing,
            $repository,
            $encoder,
            $responseFactory
        );

        try {
            $requestHandler->handle($request);
            self::fail('Expected Exception');
        } catch (ParserErrorException $e) {
            self::assertInstanceOf(ParserErrorException::class, $e);
        }
    }

    public function testSuccessful(): void
    {
        $queryAsStdClass = new \stdClass();
        $queryAsStdClass->name = 'test';
        $queryAsArray = (array) $queryAsStdClass;
        $queryAsJson = json_encode($queryAsArray);

        $builder = new MockObjectBuilder();

        /** @var StreamInterface $responseBody */
        $responseBody = $builder->create(StreamInterface::class, [
            new WithReturn('write', [$queryAsJson], \strlen($queryAsJson)),
        ]);

        /** @var ServerRequestInterface $request */
        $request = $builder->create(ServerRequestInterface::class, [
            new WithReturn('getMethod', [], 'GET'),
            new WithReturn('getAttribute', ['accept', null], 'application/json'),
            new WithReturn('getQueryParams', [], $queryAsArray),
            new WithReturn('getRequestTarget', [], '/api/pets'),
            new WithReturn('getUri', [], new class() {
                public function getPath() { return '/api/pets'; }
                public function getQuery() { return ''; }
            }),
        ]);

        /** @var ResponseInterface $response */
        $response = $builder->create(ResponseInterface::class, [
            new WithReturn('getBody', [], $responseBody),
            new WithReturnSelf('withHeader', ['Content-Type', 'application/json']),
            new WithReturn('getStatusCode', [], 200),
        ]);

        /** @var CollectionInterface $collection */
        $collection = $builder->create(CollectionInterface::class, []);

        /** @var CollectionRequestInterface $collectionRequest */
        $collectionRequest = $builder->create(CollectionRequestInterface::class, [
            new WithCallback('toCollection', static fn () => $collection),
            new WithCallback('toCollectionResponse', static fn () => $queryAsArray),
        ]);

        /** @var ObjectSchemaInterface $collectionRequestSchema */
        $collectionRequestSchema = $builder->create(ObjectSchemaInterface::class, [
            new WithReturn('parse', [$queryAsArray], $collectionRequest),
            new WithReturn('getDefaults', [], []),
        ]);

        /** @var ServerRequestInterface $request */
        $request = $builder->create(ServerRequestInterface::class, [
            new WithReturn('getMethod', [], 'GET'),
            new WithReturn('getAttribute', ['accept', null], 'application/json'),
            new WithReturn('getQueryParams', [], $queryAsArray),
            new WithReturn('getRequestTarget', [], '/api/pets'),
            new WithReturn('getUri', [], new class() {
                public function getPath() { return '/api/pets'; }
                public function getQuery() { return ''; }
            }),
        ]);

        /** @var ParsingInterface $parsing */
        $parsing = $builder->create(ParsingInterface::class, [
            new WithReturn('getCollectionRequestSchema', [$request], $collectionRequestSchema),
        ]);

        /** @var RepositoryInterface $repository */
        $repository = $builder->create(RepositoryInterface::class, [
            new WithoutReturn('resolveCollection', [$collection]),
        ]);

        /** @var EncoderInterface $encoder */
        $encoder = $builder->create(EncoderInterface::class, [
            new WithReturn('encode', [$queryAsArray, 'application/json'], $queryAsJson),
        ]);

        /** @var ResponseFactoryInterface $responseFactory */
        $responseFactory = $builder->create(ResponseFactoryInterface::class, [
            new WithReturn('createResponse', [200, ''], $response),
        ]);

        $requestHandler = new ListRequestHandler(
            $parsing,
            $repository,
            $encoder,
            $responseFactory
        );

        self::assertSame($response, $requestHandler->handle($request));
    }
}
