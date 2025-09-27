<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\Model\Article;
use App\Model\Category;
use Doctrine\ORM\EntityManagerInterface;

// Get the application container
$container = require __DIR__ . '/../config/container.php';

/** @var EntityManagerInterface $entityManager */
$entityManager = $container->get(EntityManagerInterface::class);

// Try to fetch articles
try {
    $articles = $entityManager->getRepository(Article::class)->findAll();
    
    echo "Found " . count($articles) . " articles.\n";
    
    foreach ($articles as $article) {
        echo "- " . $article->getTitle() . "\n";
    }
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "Trace: " . $e->getTraceAsString() . "\n";
}
