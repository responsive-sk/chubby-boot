<?php
// debug_fastroute.php
require __DIR__ . '/vendor/autoload.php';

$container = require __DIR__ . '/config/container.php';

echo "=== FastRoute Debug ===\n";

if ($container->has(\Chubbyphp\Framework\Router\RouteMatcherInterface::class)) {
    $routeMatcher = $container->get(\Chubbyphp\Framework\Router\RouteMatcherInterface::class);
    echo "✓ RouteMatcher exists: " . get_class($routeMatcher) . "\n";
    
    // Test matching routes
    $testRoutes = [
        '/api/ping',
        '/articles',
        '/',
        '/api/articles',
        '/api/articles/1',
    ];
    
    foreach ($testRoutes as $testRoute) {
        $request = new \Laminas\Diactoros\ServerRequest([], [], $testRoute, 'GET');
        try {
            $result = $routeMatcher->match($request);
            echo "  ✓ $testRoute -> " . $result->getName() . "\n";
        } catch (Exception $e) {
            echo "  ✗ $testRoute -> " . $e->getMessage() . "\n";
        }
    }
} else {
    echo "✗ RouteMatcher not found\n";
}