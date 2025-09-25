<?php

declare(strict_types=1);

namespace App\Service\ResponseStrategy;

use Psr\Http\Message\ResponseInterface;

interface ResponseStrategyInterface
{
    /**
     * @param array<string, mixed> $data
     */
    public function render(array $data = []): ResponseInterface;
}
