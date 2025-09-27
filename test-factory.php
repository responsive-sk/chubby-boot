<?php

require __DIR__ . '/vendor/autoload.php';

use App\ServiceFactory\Doctrine\EntityManagerFactory;
use Psr\Container\ContainerInterface;

class TestContainer implements ContainerInterface {
    private array $services = [];
    
    public function get($id) {
        if (!$this->has($id)) {
            throw new \RuntimeException("Service not found: $id");
        }
        return $this->services[$id];
    }
    
    public function has($id): bool {
        return isset($this->services[$id]);
    }
    
    public function set($id, $service): void {
        $this->services[$id] = $service;
    }
}

// Create a test container with minimal configuration
$container = new TestContainer();
$container->set('config', [
    'doctrine' => [
        'dbal' => [
            'connection' => [
                'driver' => 'pdo_sqlite',
                'path' => __DIR__ . '/database/database.sqlite',
            ],
        ],
        'orm' => [
            'configuration' => [
                'proxyDir' => sys_get_temp_dir(),
                'autoGenerateProxyClasses' => true,
            ],
        ],
    ],
]);

// Create and test the factory
$factory = new \App\ServiceFactory\Doctrine\EntityManagerFactory();
try {
    $entityManager = $factory($container);
    echo "Successfully created EntityManager!\n";
    
    // Test a simple query
    $connection = $entityManager->getConnection();
    $connection->executeQuery('SELECT 1');
    echo "Database connection successful!\n";
    
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
    echo $e->getTraceAsString() . "\n";
}
