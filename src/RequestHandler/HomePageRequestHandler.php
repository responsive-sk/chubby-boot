<?php

declare(strict_types=1);

namespace App\RequestHandler;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\HtmlResponse;

final class HomePageRequestHandler implements RequestHandlerInterface
{
    private TemplateRendererInterface $template;

    public function __construct(TemplateRendererInterface $template)
    {
        $this->template = $template;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $data = [
            'title' => 'Boson PHP - Build Native Desktop Apps with PHP',
            'description' => 'Turn your PHP projects into cross-platform native applications for Windows, Linux and macOS.',
            'navigation' => [
                ['name' => 'Home', 'href' => '/', 'current' => true],
                ['name' => 'Articles', 'href' => '/articles'],
                ['name' => 'Docs', 'href' => '/docs/latest'],
                ['name' => 'Download', 'href' => '/download'],
                ['name' => 'About', 'href' => '/about']
            ],
            'features' => [
                [
                    'icon' => '⚡',
                    'title' => 'Lightning Fast',
                    'description' => 'Optimized performance for desktop applications'
                ],
                [
                    'icon' => '🌍', 
                    'title' => 'Cross-Platform',
                    'description' => 'Works on Windows, Linux, and macOS'
                ],
                [
                    'icon' => '💝',
                    'title' => 'PHP Native', 
                    'description' => 'Use your existing PHP skills and codebase'
                ]
            ]
        ];

        $html = $this->template->render('app/home-page.html.twig', $data);
        return new HtmlResponse($html);
    }
}