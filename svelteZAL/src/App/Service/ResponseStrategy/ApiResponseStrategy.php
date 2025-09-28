<?php

declare(strict_types=1);

namespace App\Service\ResponseStrategy;

use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;

class ApiResponseStrategy implements ResponseStrategyInterface
{
    /**
     * @param array<string, mixed> $data
     */
    public function render(array $data = []): ResponseInterface
    {
        return new JsonResponse($data);
    }
}
