<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\Model\Article;
use App\Model\Category;
use Chubbyphp\Laminas\Config\Config;
use Chubbyphp\Laminas\Config\ContainerFactory;
use Doctrine\ORM\EntityManagerInterface;

// Load environment variables
$env = getenv('APP_ENV') ?: 'dev';

// Load configuration
$config = require __DIR__ . '/../config/' . $env . '.php';

// Create container with configuration
$container = (new ContainerFactory())(
    new Config($config),
    $env
);

/** @var EntityManagerInterface $entityManager */
$entityManager = $container->get(EntityManagerInterface::class);

// Create a test category if it doesn't exist
$category = $entityManager->getRepository(Category::class)->findOneBy(['name' => 'Test Category']);

if (!$category) {
    $category = new Category();
    $category->setName('Test Category');
    $category->setImage('test-category.jpg');
    $entityManager->persist($category);
    $entityManager->flush();
}

// Create a test article
$article = new Article();
$article->setTitle('Test Article');
$article->setContent('This is a test article content.');
$article->setTag('test');
$article->setImage('test-article.jpg');
$article->setCategory($category);

$entityManager->persist($article);
$entityManager->flush();

echo "Test article created successfully!\n";
