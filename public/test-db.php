<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\Model\Article;
use App\Model\Category;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\AttributeDriver;
use Doctrine\ORM\Tools\SchemaTool;

// Database connection configuration
$dbParams = [
    'driver' => 'pdo_sqlite',
    'path' => __DIR__ . '/../database/database.sqlite',
];

// Create a simple "default" Doctrine ORM configuration for Attributes
$isDevMode = true;
$config = new Configuration();

// Set up metadata driver
$driver = new AttributeDriver([__DIR__ . "/../src/Model"]);
$config->setMetadataDriverImpl($driver);

// Set up proxy configuration
$config->setProxyDir(sys_get_temp_dir());
$config->setProxyNamespace('DoctrineProxies');
$config->setAutoGenerateProxyClasses($isDevMode);

// Create the EntityManager
$connection = DriverManager::getConnection($dbParams);
$entityManager = new EntityManager($connection, $config);

// Test the connection
try {
    // Test database connection
    $connection = $entityManager->getConnection();
    $connection->executeQuery('SELECT 1');
    echo "Successfully connected to the database!\n";
    
    // Create schema if it doesn't exist
    $schemaTool = new SchemaTool($entityManager);
    $classes = [
        $entityManager->getClassMetadata(Article::class),
        $entityManager->getClassMetadata(Category::class),
    ];
    
    $schemaTool->updateSchema($classes);
    echo "Database schema updated!\n";
    
    // Try to fetch articles
    $articles = $entityManager->getRepository(Article::class)->findAll();
    echo "Found " . count($articles) . " articles.\n";
    
    // If no articles, create a test one
    if (empty($articles)) {
        echo "Creating a test article...\n";
        
        $category = new Category();
        $category->setName('Test Category');
        $category->setImage('test-category.jpg');
        
        $article = new Article();
        $article->setTitle('Test Article');
        $article->setContent('This is a test article.');
        $article->setCategory($category);
        
        $entityManager->persist($category);
        $entityManager->persist($article);
        $entityManager->flush();
        
        echo "Test article created successfully!\n";
    }
    
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "Trace: " . $e->getTraceAsString() . "\n";
}
