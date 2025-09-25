<?php

declare(strict_types=1);

namespace App\Handler\Api;

use App\Handler\AbstractHandler;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

use function time;

use Psr\Http\Server\RequestHandlerInterface;

final readonly class PingHandler extends AbstractHandler implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return $this->jsonResponse(['ack' => time()]);
    }
}
