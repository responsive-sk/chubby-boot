<?php

namespace App\View\Twig;

use Mezzio\Csrf\CsrfMiddleware;
use Mezzio\Csrf\CsrfGuardInterface;
use Psr\Http\Message\ServerRequestInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class CsrfExtension extends AbstractExtension
{
    public function __construct() {}

    public function getFunctions(): array
    {
        return [
            new TwigFunction('csrf_token', [$this, 'getToken'], ['needs_context' => true]),
            new TwigFunction('csrf_input', [$this, 'getTokenInput'], ['needs_context' => true]),
        ];
    }

    /** @param array<string, mixed> $context */
    public function getToken($context): string
    {
        /** @var ServerRequestInterface|null $request */
        $request = $context['request'] ?? null;
        if (!$request) {
            return '';
        }
        /** @var CsrfGuardInterface|null $guard */
        $guard = $request->getAttribute(CsrfMiddleware::GUARD_ATTRIBUTE);
        return $guard ? $guard->generateToken() : '';
    }

    /** @param array<string, mixed> $context */
    public function getTokenInput($context): string
    {
        return sprintf(
            '<input type="hidden" name="csrf" value="%s">',
            htmlspecialchars($this->getToken($context), ENT_QUOTES, 'UTF-8')
        );
    }
}
