<?php

declare(strict_types=1);

namespace App\ServiceFactory\Parsing;

use App\Parsing\ArticleParsing;
use Chubbyphp\Framework\Router\UrlGeneratorInterface;
use Chubbyphp\Parsing\ParserInterface;
use Psr\Container\ContainerInterface;

final class ArticleParsingFactory
{
    public function __invoke(ContainerInterface $container): ArticleParsing
    {
        return new ArticleParsing(
            $container->get(ParserInterface::class),
            $container->get(UrlGeneratorInterface::class),
        );
    }
}
