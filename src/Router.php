<?php

namespace Codemonster\Router;

class Router
{
    protected $controllerFactory = null;
    protected RouteCollection $routes;

    public function __construct()
    {
        $this->routes = new RouteCollection();
    }

    public function get(string $path, mixed $handler): self
    {
        $this->routes->add('GET', $path, $handler);

        return $this;
    }

    public function post(string $path, mixed $handler): self
    {
        $this->routes->add('POST', $path, $handler);

        return $this;
    }

    public function any(string $path, mixed $handler): self
    {
        $this->routes->add(['GET', 'POST'], $path, $handler);

        return $this;
    }

    public function dispatch(string $method, string $uri): mixed
    {
        $route = $this->routes->match($method, $uri);

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
}
