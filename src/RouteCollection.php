<?php

namespace Codemonster\Router;

class RouteCollection
{
    /** @var Route[] */
    protected array $routes = [];

    public function add(string|array $methods, string $path, mixed $handler): void
    {
        $this->routes[] = new Route((array) $methods, $path, $handler);
    }

    public function match(string $method, string $uri): ?Route
    {
        foreach ($this->routes as $route) {
            if (in_array($method, $route->methods, true) && $route->path === $uri) {
                return $route;
            }
        }

        return null;
    }
}
