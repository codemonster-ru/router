<?php

namespace Codemonster\Router;

class Dispatcher
{
    public function dispatch(Route $route, array $params = []): mixed
    {
        $handler = $route->handler;

        if (is_callable($handler)) {
            return call_user_func_array($handler, $params);
        }

        if (is_array($handler)) {
            [$class, $method] = $handler;
            $instance = new $class();

            return $instance->$method(...$params);
        }

        if (is_string($handler) && str_contains($handler, '@')) {
            [$class, $method] = explode('@', $handler);
            $instance = new $class();

            return $instance->$method(...$params);
        }

        return $handler;
    }
}
