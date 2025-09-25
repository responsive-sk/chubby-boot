<?php

declare(strict_types=1);

namespace App\Handler\Web;

use App\Handler\AbstractHandler;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

final readonly class CoolIndexHandler extends AbstractHandler implements RequestHandlerInterface
{
    public function __construct(?TemplateRendererInterface $template = null)
    {
        parent::__construct($template);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $data = [
            'title'       => 'Mezzio + Svelte | Modern PHP Frontend',
            'description' => 'A modern, SEO-friendly landing page powered by Mezzio, Svelte, HTMX and Tailwind CSS.',
            'canonical'   => '/cool',
        ];

        return $this->htmlResponse('app::cool-index', $data);
    }
}
