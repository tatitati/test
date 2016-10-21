<?php

namespace Bbc\Radio\App\Tests\Functional;

use Bbc\Radio\App\Src\CustomSlimApp;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use Slim\App;
use Slim\Http\Request;
use GuzzleHttp\Psr7\Response;
use Slim\Http\Environment;
use Pimple;

/**
 * This is an example class that shows how you could set up a method that
 * runs the application. Note that it doesn't cover all use-cases and is
 * tuned to the specifics of this skeleton app, so if your needs are
 * different, you'll need to change it.
 */
class BaseTestCase extends \PHPUnit_Framework_TestCase
{
    /** @var CustomSlimApp */
    private $app;

    /**
     * Use middleware when running application?
     *
     * @var bool
     */
    protected $withMiddleware = true;

    public function setupApp()
    {
        // Use the application settings
        $settings = require __DIR__ . '/../../src/settings.php';

        // Instantiate the application
        $app = new CustomSlimApp($settings);

        $servicesContainer = new Pimple\Container();
        require __DIR__ . '/../../src/servicesContainer.php';
        $app->setServicesContainer($servicesContainer);

        // Set up dependencies
        require __DIR__ . '/../../src/dependencies.php';

        // Register middleware
        if ($this->withMiddleware) {
            require __DIR__ . '/../../src/middleware.php';
        }

        // Register routes
        require __DIR__ . '/../../src/routes.php';

        $this->app = $app;
    }

    /**
     * Process the application given a request method and URI
     *
     * @param string $requestMethod the request method (e.g. GET, POST, etc.)
     * @param string $requestUri the request URI
     * @param array|object|null $requestData the request data
     * @return \Slim\Http\Response
     */
    public function runApp($requestMethod, $requestUri, $requestData = null)
    {
        // Process the application
        // Create a mock environment for testing with
        $environment = Environment::mock(
            [
                'REQUEST_METHOD' => $requestMethod,
                'REQUEST_URI' => $requestUri
            ]
        );

        // Set up a request object based on the environment
        $request = Request::createFromEnvironment($environment);

        // Add request data, if it exists
        if (isset($requestData)) {
            $request = $request->withParsedBody($requestData);
        }

        // Set up a response object
        $response = new Response();


        $response = $this->app->process($request, $response);

        // Return the response
        return $response;
    }

    public function mockHttpResponse($code = null, $headers=[], $stringBodyContent)
    {
        $fakeResponse = new Response(
            $code,
            $headers,
            $stringBodyContent
        );

        $mock    = new MockHandler([$fakeResponse]);
        $handler = HandlerStack::create($mock);

        return new Client(['handler' => $handler]);
    }

    public function mockServiceInContainer($keyContainer, $mockService)
    {
        $servicesContainer = $this->app->getServicesContainer();
        $servicesContainer[$keyContainer] = function() use ($mockService) {
            return $mockService;
        };

        $this->app->setServicesContainer($servicesContainer);
    }
}
