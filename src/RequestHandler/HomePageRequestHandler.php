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

final class HomePageRequestHandler implements RequestHandlerInterface
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
        // Fetch articles
        $articleCollection = new ArticleCollection();
        $this->articleRepository->resolveCollection($articleCollection);
        $articles = $articleCollection->getItems();

        $data = [
            'title' => 'Boson PHP - Build Native Desktop Apps with PHP',
            'description' => 'Turn your PHP projects into cross-platform native applications for Windows, Linux and macOS.',
            'articles' => $articles,
            'navigation' => [
                ['name' => 'Home', 'href' => '/', 'current' => true],
                ['name' => 'Articles', 'href' => '/articles'],
                ['name' => 'Docs', 'href' => '/docs/latest'],
                ['name' => 'Download', 'href' => '/download'],
                ['name' => 'About', 'href' => '/about'],
            ],
            'features' => [
                [
                    'icon' => '⚡',
                    'title' => 'Lightning Fast',
                    'description' => 'Optimized performance for desktop applications',
                ],
                [
                    'icon' => '🌍',
                    'title' => 'Cross-Platform',
                    'description' => 'Works on Windows, Linux, and macOS',
                ],
                [
                    'icon' => '💝',
                    'title' => 'PHP Native',
                    'description' => 'Use your existing PHP skills and codebase',
                ],
            ],
        ];

        $html = $this->template->render('app/home-page.html.twig', $data);

        return new HtmlResponse($html);
    }
}
