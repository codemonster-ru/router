<?php

namespace Codemonster\Router\Tests;

use Codemonster\Router\Router;
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{
    public function testGetRouteDispatches()
    {
        $router = new Router();
        $router->get('/hello', fn() => 'Hello World');

        $result = $router->dispatch('GET', '/hello');

        $this->assertEquals('Hello World', $result);
    }

    public function testRouteNotFound()
    {
        $router = new Router();
        $result = $router->dispatch('GET', '/missing');

        $this->assertNull($result);
    }
}
