<?php

declare(strict_types=1);

namespace App\ServiceFactory\Doctrine;

use Doctrine\Common\EventManager;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Driver\AttributeDriver;
use Psr\Container\ContainerInterface;

class EntityManagerFactory
{
    public function __invoke(ContainerInterface $container): EntityManagerInterface
    {
        $config = $container->get('config')['doctrine'] ?? [];

        // Create ORM configuration first
        $configuration = $this->createConfiguration($config['orm']['configuration'] ?? []);
        
        // Create event manager
        $eventManager = new EventManager();

        // Set up database connection parameters
        $connectionParams = $config['dbal']['connection'] ?? [];
        
        // Create connection with proper configuration
        $connection = DriverManager::getConnection($connectionParams);
        
        // Create the EntityManager
        return new EntityManager(
            $connection,
            $configuration,
            $eventManager
        );
    }

    public static function create(ContainerInterface $container): self
    {
        return new self();
    }

    /**
     * @param array<string, mixed> $config
     */
    private function createConfiguration(array $config): Configuration
    {
        $configuration = new Configuration();

        // Set up metadata driver
        $driver = new AttributeDriver([
            __DIR__.'/../../src/Model',
        ]);
        $configuration->setMetadataDriverImpl($driver);

        // Set up proxy configuration
        $configuration->setProxyDir($config['proxyDir'] ?? sys_get_temp_dir());
        $configuration->setProxyNamespace('DoctrineProxies');
        $configuration->setAutoGenerateProxyClasses($config['autoGenerateProxyClasses'] ?? true);

        return $configuration;
    }
}
