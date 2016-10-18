<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use GuzzleHttp\Client;

$app->get(
	'/product/{id}',
	function (Request $request, Response $response) {
	    $searchToString = $request->getAttribute('search_to_string');
		$client = new Client(['base_uri' => 'http://www.google.com']);
		$response = $client->request('GET', '/');

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
