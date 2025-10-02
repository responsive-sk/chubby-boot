<?php

declare(strict_types=1);

use Chubbyphp\Framework\Router\Route;
use Chubbyphp\Framework\Router\RouteCollection;

return [
    RouteCollection::class => static function () {
        // Načítaj web routes
        $webRoutes = require __DIR__ . '/routes/web.php';
        // Načítaj API routes  
        $apiRoutes = require __DIR__ . '/routes/api.php';
        
        // Skombinuj všetky routes
        $allRoutes = array_merge($webRoutes, $apiRoutes);

        $routeCollection = new RouteCollection();
        foreach ($allRoutes as $route) {
            $routeCollection->add($route);
        }

        return $routeCollection;
    },
];