<?php

namespace Codemonster\Router;

class Router
{
    protected $controllerFactory = null;
    protected RouteCollection $routes;
    protected array $groupStack = [];

    public function __construct()
    {
        $this->routes = new RouteCollection();
    }

    public function get(string $path, mixed $handler): Route
    {
        $route = new Route('GET', $path, $handler);

        $this->routes->add('GET', $path, $handler);

        return $route;
    }

    public function post(string $path, mixed $handler): Route
    {
        $route = new Route('POST', $path, $handler);

        $this->routes->add('POST', $path, $handler);

        return $route;
    }

    public function any(string $path, mixed $handler): Route
    {
        $methods = ['GET', 'POST'];
        $route = new Route($methods, $path, $handler);

        $this->routes->add($methods, $path, $handler);

        return $route;
    }

    public function dispatch(string $method, string $uri): mixed
    {
        $uri = parse_url($uri, PHP_URL_PATH);
        $uri = rtrim($uri, '/');
        $uri = $uri === '' ? '/' : $uri;

        $route = $this->routes->match($method, $uri);

        if (!$route && $uri !== '/') {
            $alt = $uri . '/';
            $route = $this->routes->match($method, $alt);
        }

        if (!$route) {
            return null;
        }

        $dispatcher = new Dispatcher($this);

        return $dispatcher->dispatch($route);
    }

    public function setControllerFactory(callable $factory): void
    {
        $this->controllerFactory = $factory;
    }

    public function getControllerFactory(): ?callable
    {
        return $this->controllerFactory;
    }

    public function group(string $prefix, callable $callback): RouteGroup
    {
        $group = new RouteGroup($prefix, $callback, $this);

        $this->groupStack[] = $group;

        $group->run();

        array_pop($this->groupStack);

        return $group;
    }
}
