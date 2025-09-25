<?php

declare(strict_types=1);

namespace App\RequestHandler;

use App\Collection\ArticleCollection;
use App\Repository\ArticleRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\HtmlResponse;

final class ArticleListHtmlRequestHandler implements RequestHandlerInterface
{
    public function __construct(
        private ArticleRepository $articleRepository
    ) {}

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $articleCollection = new ArticleCollection();
        $this->articleRepository->resolveCollection($articleCollection);
        $articles = $articleCollection->getItems();

        $html = '<ul class="space-y-4">';
        foreach ($articles as $article) {
            $html .= '<li class="border p-4 rounded">';
            $html .= '<h3 class="text-lg font-semibold">' . htmlspecialchars($article->title) . '</h3>';
            $html .= '<p>' . htmlspecialchars($article->content) . '</p>';
            if ($article->tag) {
                $html .= '<p>Tag: ' . htmlspecialchars($article->tag) . '</p>';
            }
            if ($article->category) {
                $html .= '<p>Category: ' . htmlspecialchars($article->category->name) . '</p>';
            }
            $html .= '<button class="mr-2 px-2 py-1 bg-blue-500 text-white rounded" hx-get="/api/articles/edit/' . $article->id . '" hx-target="#article-form-container" hx-swap="innerHTML">Edit</button>';
            $html .= '<button class="px-2 py-1 bg-red-500 text-white rounded" hx-delete="/api/articles/' . $article->id . '" hx-confirm="Are you sure?" hx-trigger="click" hx-target="#article-list" hx-swap="innerHTML">Delete</button>';
            $html .= '</li>';
        }
        $html .= '</ul>';

        return new HtmlResponse($html);
    }
}
