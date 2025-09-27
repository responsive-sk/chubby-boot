<?php

declare(strict_types=1);

use App\Model\Article;
use App\Model\Category;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;
use Doctrine\ORM\Tools\Console\EntityManagerProvider;

require __DIR__ . '/../vendor/autoload.php';

// Get the application container
$container = require __DIR__ . '/../config/container.php';

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
