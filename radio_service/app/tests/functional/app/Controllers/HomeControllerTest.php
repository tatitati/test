<?php

namespace Bbc\Radio\App\Tests\Functional\Controllers;

use Bbc\Radio\App\Services\ProductService;
use Bbc\Radio\App\Tests\Functional\BaseTestCase;
use GuzzleHttp\Client;
use Guzzle\Plugin\Mock\MockPlugin;
use GuzzleHttp\Handler\MockHandler;
use Guzzle\Stream\Stream;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\HandlerStack;

class HomeControllerTest extends BaseTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->setupApp();
    }

    public function testRouteHome()
    {
        $response = $this->runApp('GET', '/');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('BBC test', (string)$response->getBody());
    }
}