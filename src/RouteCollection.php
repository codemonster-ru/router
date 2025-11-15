<?php

namespace Codemonster\Router;

class RouteCollection
{
    /** @var Route[] */
    protected array $routes = [];

    public function addRoute(Route $route): void
    {
        $this->routes[] = $route;
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
