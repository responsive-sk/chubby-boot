<?php

declare(strict_types=1);

namespace App\ServiceFactory\Http;

use Laminas\Diactoros\ResponseFactory;

final class ResponseFactoryFactory
{
    public function __invoke(): ResponseFactory
    {
        return new ResponseFactory();
    }
}
