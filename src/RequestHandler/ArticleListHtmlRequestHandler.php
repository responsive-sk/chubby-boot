<?php

declare(strict_types=1);

namespace App\RequestHandler;

use App\Collection\ArticleCollection;
use App\Repository\ArticleRepository;
use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class ArticleListHtmlRequestHandler implements RequestHandlerInterface
{
    public function __construct(
        private TemplateRendererInterface $template,
        private ArticleRepository $articleRepository
    ) {}

    public static function create(ContainerInterface $container): self
    {
        return new self(
            $container->get(TemplateRendererInterface::class),
            $container->get(ArticleRepository::class)
        );
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $page = (int)($request->getQueryParams()['page'] ?? 1);
        $limit = 6;
        $offset = ($page - 1) * $limit;

        $articleCollection = new ArticleCollection();
        $articleCollection->setLimit($limit);
        $articleCollection->setOffset($offset);
        $this->articleRepository->resolveCollection($articleCollection);
        $articles = $articleCollection->getItems();

        return new HtmlResponse(
            $this->template->render('partials/articles-list.html.twig', [
                'articles' => $articles,
                'page' => $page
            ])
        );
    }
}
