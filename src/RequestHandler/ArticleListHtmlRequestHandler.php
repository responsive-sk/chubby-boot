<?php

declare(strict_types=1);

namespace App\RequestHandler;

use App\Collection\ArticleCollection;
use App\Repository\ArticleRepository;
use Laminas\Diactoros\Response\HtmlResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

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
            if (!$article instanceof \App\Model\Article) {
                continue; // Skip if not an Article
            }
            
            $html .= '<li class="border p-4 rounded">';
            $html .= '<h3 class="text-lg font-semibold">'.htmlspecialchars($article->getTitle()).'</h3>';
            $html .= '<p>'.htmlspecialchars($article->getContent()).'</p>';
            
            $tag = $article->getTag();
            if ($tag) {
                $html .= '<p>Tag: '.htmlspecialchars($tag).'</p>';
            }
            
            $category = $article->getCategory();
            if ($category) {
                $html .= '<p>Category: '.htmlspecialchars($category->getName()).'</p>';
            }
            
            $html .= '<button class="mr-2 px-2 py-1 bg-blue-500 text-white rounded" hx-get="/api/articles/edit/'.$article->getId().'" hx-target="#article-form-container" hx-swap="innerHTML">Edit</button>';
            $html .= '<button class="px-2 py-1 bg-red-500 text-white rounded" hx-delete="/api/articles/'.$article->getId().'" hx-confirm="Are you sure?" hx-trigger="click" hx-target="#article-list" hx-swap="innerHTML">Delete</button>';
            $html .= '</li>';
        }
        $html .= '</ul>';

        return new HtmlResponse($html);
    }
}
