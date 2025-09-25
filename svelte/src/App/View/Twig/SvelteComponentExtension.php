<?php

declare(strict_types=1);

namespace App\View\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class SvelteComponentExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('svelte_component', [$this, 'renderSvelteComponent'], ['is_safe' => ['html']]),
        ];
    }

    /**
     * Render a mount point for a Svelte component with props as JSON data attribute.
     *
     * @param string $componentName The name of the Svelte component
     * @param array $props The props to pass to the component
     * @param string|null $html Optional HTML content to include inside the div
     * @return string The HTML mount point
     */
    public function renderSvelteComponent(string $componentName, array $props = [], ?string $html = null): string
    {
        $jsonProps = htmlspecialchars(json_encode($props, JSON_HEX_APOS | JSON_HEX_QUOT), ENT_QUOTES, 'UTF-8');
        $mountId = 'svelte-' . strtolower(preg_replace('/[^a-z0-9]+/i', '-', $componentName));

        return sprintf(
            '<div id="%s" data-component="%s" data-props=\'%s\'>%s</div>',
            $mountId,
            htmlspecialchars($componentName, ENT_QUOTES, 'UTF-8'),
            $jsonProps,
            $html ?? ''
        );
    }
}
