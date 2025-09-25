<?php

declare(strict_types=1);

namespace App;

/**
 * The configuration provider for the App module
 *
 * @see https://docs.laminas.dev/laminas-component-installer/
 *
 * @psalm-suppress UnusedClass This class is referenced via config/config.php and strings
 */
final class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     *
     * @return array<string, mixed>
     */
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
        ];
    }

    /**
     * Returns the container dependencies
     *
     * @return array{invokables: array<class-string, class-string>, factories: array<class-string, class-string>}
     */
    public function getDependencies(): array
    {
        return [
            'invokables' => [
                // Remove PingHandler invokable registration because factory is used
            ],
            'factories'  => [
                Handler\Web\HomePageHandler::class      => Handler\Web\HomePageHandlerFactory::class,
                Handler\Web\ComponentDemoHandler::class => Handler\Web\ComponentDemoHandlerFactory::class,
                Handler\Web\CoolIndexHandler::class     => Handler\Web\CoolIndexHandlerFactory::class,
                Handler\Web\HeroHandler::class          => Handler\Web\HeroHandlerFactory::class,
                Handler\Api\PingHandler::class          => Handler\Api\PingHandlerFactory::class,
                Handler\Htmx\ContentHandler::class      => Handler\Htmx\ContentHandlerFactory::class,
                Handler\Web\TestFrontendHandler::class  => Handler\Web\TestFrontendHandlerFactory::class,
            ],
        ];
    }

    /**
     * Returns the templates configuration
     *
     * @return array{paths: array<string, list<string>>}
     */
    public function getTemplates(): array
    {
        return [
            'paths' => [
                'app'    => ['templates/app'],
                'error'  => ['templates/error'],
                'layout' => ['templates/layout'],
            ],
        ];
    }
}
