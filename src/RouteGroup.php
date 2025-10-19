<?php

namespace Codemonster\Router;

class RouteGroup
{
    protected string $prefix;
    protected $callback;
    protected Router $router;
    protected array $middleware = [];

    public function __construct(string $prefix, callable $callback, Router $router)
    {
        $this->prefix = rtrim($prefix, '/');
        $this->callback = $callback;
        $this->router = $router;
    }

    public function middleware(string|array $middleware): static
    {
        foreach ((array)$middleware as $m) {
            $this->middleware[] = $m;
        }

        return $this;
    }

    public function run(): void
    {
        ($this->callback)($this);
    }

    public function get(string $path, mixed $handler): Route
    {
        $route = $this->router->get($this->prefix . $path, $handler);
        $route->middleware($this->middleware);

        return $route;
    }

    public function post(string $path, mixed $handler): Route
    {
        $route = $this->router->post($this->prefix . $path, $handler);
        $route->middleware($this->middleware);

        return $route;
    }
}
