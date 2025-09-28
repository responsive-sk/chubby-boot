<?php

declare(strict_types=1);

namespace App\Service\ResponseStrategy;

use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;

class PageResponseStrategy implements ResponseStrategyInterface
{
    public function __construct(private ?TemplateRendererInterface $template = null)
    {
    }

    /**
     * @param array<string, mixed> $data
     */
    public function render(array $data = []): ResponseInterface
    {
        $templateName = $data['template'] ?? '';
        unset($data['template']);

        if ($this->template === null) {
            return new JsonResponse($data);
        }

        return new HtmlResponse($this->template->render($templateName, $data));
    }
}
