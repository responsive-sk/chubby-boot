<?php

declare(strict_types=1);

namespace App\RequestHandler\Api\Crud;

use App\Parsing\ParsingInterface;
use App\Repository\RepositoryInterface;
use Chubbyphp\DecodeEncode\Encoder\EncoderInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class ListRequestHandler implements RequestHandlerInterface
{
    public function __construct(
        private ParsingInterface $parsing,
        private RepositoryInterface $repository,
        private EncoderInterface $encoder,
        private ResponseFactoryInterface $responseFactory,
    ) {}

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $collectionRequest = $this->parsing->getCollectionRequestSchema($request)->parse($request);
        $collection = $collectionRequest->toCollection();

        $this->repository->resolveCollection($collection);

        $collectionResponse = $collectionRequest->toCollectionResponse($collection);

        $response = $this->responseFactory->createResponse();
        $response->getBody()->write($this->encoder->encode($collectionResponse, 'application/json'));

        return $response->withHeader('Content-Type', 'application/json');
    }
}
