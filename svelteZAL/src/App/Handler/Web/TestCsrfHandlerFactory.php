<?php

declare(strict_types=1);

namespace App\Handler\Web;

use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;

class TestCsrfHandlerFactory
{
    public function __invoke(ContainerInterface $container): RequestHandlerInterface
    {
        return new TestCsrfHandler();
    }
}
