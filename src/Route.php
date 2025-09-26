<?php

namespace Codemonster\Router;

class Route
{
    public function __construct(
        public array $methods,
        public string $path,
        public mixed $handler
    ) {
    }
}
