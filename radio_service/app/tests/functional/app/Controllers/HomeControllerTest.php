<?php

namespace Bbc\Radio\App\Tests\Functional\Controllers;

use Bbc\Radio\App\Tests\Functional\BaseTestCase;

class HomeControllerTest extends BaseTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->setupApp();
    }

    /**
     * Test routing for home controller
     */
    public function testRouteHome()
    {
        $response = $this->runApp('GET', '/');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('BBC test', (string)$response->getBody());
    }
}