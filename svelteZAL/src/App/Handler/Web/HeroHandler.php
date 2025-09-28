<?php

declare(strict_types=1);

namespace App\Handler\Web;

use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

final readonly class HeroHandler implements RequestHandlerInterface
{
    public function __construct(private ?TemplateRendererInterface $template = null)
    {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $html = $this->template?->render('app::hero', [
            'title'    => 'Tailwind Hero',
            'subtitle' => 'Loaded via HTMX from /hero',
            'cta'      => 'Get Started',
        ]) ?? '<section class="p-8 text-center bg-slate-100 rounded">Hero (template renderer unavailable)</section>';

        return new HtmlResponse($html);
    }
}
