<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use GuzzleHttp\Client;
use Bbc\Radio\Services\BbcRadioService;
use Slim\App;


$app->get('/product/{search_string}',  function ($request, $response) use ($pimpleContainer) {
        /** @var BbcRadioService $serviceBbcRadio */
        $att = $request->getAttribute('search_string');

		$serviceBbcRadio = $pimpleContainer['service_bbc_radio'];
        return $serviceBbcRadio->searchByString($att);
});
