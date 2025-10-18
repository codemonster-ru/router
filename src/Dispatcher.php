<?php

namespace Codemonster\Router;

class Dispatcher
{
    protected ?Router $router = null;

    public function __construct(?Router $router = null)
    {
        $this->router = $router;
    }

    public function dispatch(Route $route, array $params = []): mixed
    {
        $handler = $route->handler;

        if (is_callable($handler)) {
            return call_user_func_array($handler, $params);
        }

        if (is_array($handler)) {
            [$class, $method] = $handler;

            $instance = $this->makeController($class);

            return $instance->$method(...$params);
        }

        if (is_string($handler) && str_contains($handler, '@')) {
            [$class, $method] = explode('@', $handler);

            $instance = $this->makeController($class);

            return $instance->$method(...$params);
        }

        return $handler;
    }

    protected function makeController(string $class): object
    {
        if (!$this->router) {
            return new $class();
        }

        $factory = $this->router->getControllerFactory();

        if ($factory && is_callable($factory)) {
            return $factory($class);
        }

        return new $class();
    }
}
