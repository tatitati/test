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

class ProductControllerTest extends BaseTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->setupApp();
    }

    public function testProductSearchNoResults()
    {
        $this->mockServiceInContainer(
            'guzzle_http_client',
            $this->mockHttpResponse(
                200,
                ['Content-Type'=>'application/json'],
                file_get_contents(__DIR__ . '/../mock_strings/product_search_notfound.txt')
            )
        );

        $response = $this->runApp('GET', '/product/string_with_no_results');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('no results', (string)$response->getBody());
    }

    public function testProductSearchWithResults()
    {
        $this->mockServiceInContainer(
            'guzzle_http_client',
            $this->mockHttpResponse(
                200,
                ['Content-Type'=>'application/json'],
                file_get_contents(__DIR__ . '/../mock_strings/product_search_found.txt')
            )
        );

        $response = $this->runApp('GET', '/product/string_with_no_results');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('"title":"Marseille 2013"', (string)$response->getBody());
        $this->assertContains('"title":"The \'arse that Jack Built"', (string)$response->getBody());
        $this->assertContains('"title":"When Wars End"', (string)$response->getBody());
    }
}