<?php
require __DIR__ . '/vendor/autoload.php';

$container = require __DIR__ . '/config/container.php';

echo "=== RouteMatcher Debug ===\n";

if ($container->has(\Chubbyphp\Framework\Router\RouteMatcherInterface::class)) {
    $routeMatcher = $container->get(\Chubbyphp\Framework\Router\RouteMatcherInterface::class);
    echo "✓ RouteMatcher: " . get_class($routeMatcher) . "\n";
    
    // Test matching pre konkrétne routes
    $testPaths = ['/api/ping', '/articles', '/'];
    
    foreach ($testPaths as $path) {
        echo "\nTesting: $path\n";
        
        // Vytvorte request
        $request = new \Laminas\Diactoros\ServerRequest([], [], $path, 'GET');
        
        try {
            $result = $routeMatcher->match($request);
            echo "✓ MATCH: " . $result->getName() . "\n";
            echo "  Handler: " . get_class($result->getRequestHandler()) . "\n";
        } catch (\Chubbyphp\HttpException\HttpException $e) {
            echo "✗ NOT FOUND: " . $e->getMessage() . "\n";
        } catch (Exception $e) {
            echo "✗ ERROR: " . $e->getMessage() . "\n";
        }
    }
} else {
    echo "✗ RouteMatcher not found\n";
}

// Skontrolujme aj či máme správny RouteMatcher v kontajneri
echo "\n=== Container Check ===\n";
$services = [
    \Chubbyphp\Framework\Router\RouteMatcherInterface::class,
    \Chubbyphp\Framework\Router\FastRoute\RouteMatcher::class,
];

foreach ($services as $service) {
    if ($container->has($service)) {
        echo "✓ $service\n";
    } else {
        echo "✗ $service\n";
    }
}