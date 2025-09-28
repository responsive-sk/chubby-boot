<?php

declare(strict_types=1);

namespace App\Handler\Htmx;

use App\Handler\AbstractHandler;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class PartialApi extends AbstractHandler implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $params = $request->getQueryParams();
        $page = isset($params['page']) && is_string($params['page']) ? $params['page'] : 'default';

        /** @var array<string, string> $fragments */
        $fragments = [];
        if ($this->template instanceof TemplateRendererInterface) {
            $fragments = [
                'hero' => $this->template->render('partials/hero', ['title' => 'Dynamic Hero']),
                'features' => $this->template->render('partials/features', []),
                'stats' => $this->template->render('partials/stats', []),
            ];
        }

        return $this->htmxFragment($fragments[$page] ?? 'Fragment not found');
    }
}
