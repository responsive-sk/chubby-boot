<?php

declare(strict_types=1);

namespace App\Handler\Web;

use App\Service\ResponseStrategy\ResponseStrategySelector;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class ComponentDemoHandler extends AbstractHandler
{
    public function __construct(?TemplateRendererInterface $template = null)
    {
        parent::__construct($template);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return $this->htmlResponse('app::component-demo', [
            'message' => 'This HTML fragment is rendered server-side and can be swapped by HTMX.',
        ]);
    }
}
