<?php

declare(strict_types=1);

namespace App\Service\ResponseStrategy;

use Laminas\Diactoros\Response;
use Psr\Http\Message\ResponseInterface;

class FragmentResponseStrategy implements ResponseStrategyInterface
{
    /**
     * @param array<string, mixed> $data
     */
    public function render(array $data = []): ResponseInterface
    {
        $html = $data['html'] ?? '';
        $response = new Response();
        $response->getBody()->write($html);
        return $response->withHeader('Content-Type', 'text/html');
    }
}
