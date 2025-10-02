<?php
require __DIR__ . '/vendor/autoload.php';

$container = require __DIR__ . '/config/container.php';

echo "=== Finding All Routes ===\n";

if ($container->has(\Chubbyphp\Framework\Router\RoutesByNameInterface::class)) {
    $routesByName = $container->get(\Chubbyphp\Framework\Router\RoutesByNameInterface::class);
    $allRoutes = $routesByName->getRoutesByName();
    
    echo "Total routes in container: " . count($allRoutes) . "\n\n";
    
    foreach ($allRoutes as $name => $route) {
        echo "Route: " . $route->getMethod() . " " . $route->getPath() . " -> " . $name . "\n";
    }
} else {
    echo "RoutesByNameInterface not found\n";
}

// Skontrolujme aj priamo RouteMatcher
echo "\n=== RouteMatcher Internal Routes ===\n";
if ($container->has(\Chubbyphp\Framework\Router\RouteMatcherInterface::class)) {
    $routeMatcher = $container->get(\Chubbyphp\Framework\Router\RouteMatcherInterface::class);
    
    // Použite reflexiu na získanie interných routes
    $reflection = new ReflectionClass($routeMatcher);
    if ($reflection->hasProperty('routes')) {
        $routesProperty = $reflection->getProperty('routes');
        $routesProperty->setAccessible(true);
        $internalRoutes = $routesProperty->getValue($routeMatcher);
        
        echo "Internal routes in RouteMatcher: " . count($internalRoutes) . "\n";
        foreach ($internalRoutes as $name => $route) {
            echo "Internal: $name -> " . $route->getPath() . "\n";
        }
    }
}