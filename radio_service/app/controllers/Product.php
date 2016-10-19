<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use GuzzleHttp\Client;

$app->get(
	'/product/{search_string}',
	function (Request $request, Response $response) {
		$searchString  = $request->getAttribute('search_string');

		$baseUrl       = 'http://www.bbc.co.uk';
		$requestUrl    = sprintf('/programmes/a-z/by/%s/current.json', $searchString);

		$response = (new Client(['base_uri' => $baseUrl]))->request('GET', $requestUrl);

		return $response;
});


$app->post(
	'/person', 
	function (Request $request, Response $response) {
	$name = $request->getParsedBody()['name'];	
    //$name = $request->getAttribute('name');

    // $response->getBody()->write("Hello, $name");
    // return $response->withStatus(302);

    return $response->withJson(
    	['name' => $name, 'age' => 40], 
    	302
	);
});
