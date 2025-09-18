<?php

declare(strict_types=1);

namespace App;

use App\Model\Article;
use App\Model\Category;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\Uuid;

require __DIR__ . '/../vendor/autoload.php';

$env = getenv('APP_ENV') ?: 'dev';
$config = require __DIR__ . '/container.php';
$container = $config($env);

/** @var EntityManagerInterface $entityManager */
$entityManager = $container->get(EntityManagerInterface::class);

// Create sample categories
$techCategory = new Category();
$techCategory->setName('Technology');
$techCategory->setImage('https://example.com/tech.jpg');

$sportsCategory = new Category();
$sportsCategory->setName('Sports');
$sportsCategory->setImage('https://example.com/sports.jpg');

$lifestyleCategory = new Category();
$lifestyleCategory->setName('Lifestyle');
$lifestyleCategory->setImage('https://example.com/lifestyle.jpg');

$entityManager->persist($techCategory);
$entityManager->persist($sportsCategory);
$entityManager->persist($lifestyleCategory);

// Create sample articles
$article1 = new Article();
$article1->setTitle('Latest in AI Technology');
$article1->setContent('Artificial Intelligence is revolutionizing the tech industry...');
$article1->setTag('AI');
$article1->setImage('https://example.com/ai-article.jpg');
$article1->setCategory($techCategory);

$article2 = new Article();
$article2->setTitle('Football World Cup Updates');
$article2->setContent('The latest news from the football world cup...');
$article2->setTag('Football');
$article2->setImage('https://example.com/football.jpg');
$article2->setCategory($sportsCategory);

$article3 = new Article();
$article3->setTitle('Healthy Living Tips');
$article3->setContent('Discover the secrets to a healthier lifestyle...');
$article3->setTag('Health');
$article3->setImage('https://example.com/health.jpg');
$article3->setCategory($lifestyleCategory);

$article4 = new Article();
$article4->setTitle('Programming Best Practices');
$article4->setContent('Learn the best practices for software development...');
$article4->setTag('Programming');
$article4->setImage('https://example.com/programming.jpg');
$article4->setCategory($techCategory);

$article5 = new Article();
$article5->setTitle('Basketball Championship Highlights');
$article5->setContent('Relive the most exciting moments from the basketball championship...');
$article5->setTag('Basketball');
$article5->setImage('https://example.com/basketball.jpg');
$article5->setCategory($sportsCategory);

$entityManager->persist($article1);
$entityManager->persist($article2);
$entityManager->persist($article3);
$entityManager->persist($article4);
$entityManager->persist($article5);

// Flush to database
$entityManager->flush();

echo "Sample data seeded successfully!\n";
echo "Created 3 categories and 5 articles with various tags.\n";
