<?php

declare(strict_types=1);

namespace App\Service\ResponseStrategy;

use Psr\Http\Message\ServerRequestInterface;

class ResponseStrategySelector
{
    public function __construct(
        private ApiResponseStrategy $apiStrategy,
        private FragmentResponseStrategy $fragmentStrategy,
        private PageResponseStrategy $pageStrategy,
    ) {
    }

    public function select(ServerRequestInterface $request): ResponseStrategyInterface
    {
        $path = $request->getUri()->getPath();

        if (str_starts_with($path, '/api/')) {
            return $this->apiStrategy;
        }

        if (str_starts_with($path, '/fragments/')) {
            return $this->fragmentStrategy;
        }

        return $this->pageStrategy;
    }
}
