<?php

declare(strict_types=1);

namespace App\Handler;

use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Laminas\Diactoros\Response;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;

readonly abstract class AbstractHandler
{
    public function __construct(protected ?TemplateRendererInterface $template = null)
    {
    }

    /**
     * @param array<string, mixed> $data
     */
    protected function htmlResponse(string $template, array $data = []): ResponseInterface
    {
        if ($this->template === null) {
            return new JsonResponse($data);
        }

        return new HtmlResponse($this->template->render($template, $data));
    }

    /**
     * @param array<string, mixed> $data
     */
    protected function jsonResponse(array $data): ResponseInterface
    {
        return new JsonResponse($data);
    }

    protected function htmxFragment(string $html): ResponseInterface
    {
        $response = new Response();
        $response->getBody()->write($html);
        return $response->withHeader('Content-Type', 'text/html');
    }
}
