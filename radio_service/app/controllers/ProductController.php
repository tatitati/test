<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use GuzzleHttp\Client;
use Bbc\Radio\Services\BbcRadioService;


$app->get(
	'/product/{search_string}',
    function () use ($app, $container) {
        echo '<pre>';
        /** @var BbcRadioService $serviceBbcRadio */
		$serviceBbcRadio = $container['service_bbc_radio'];
        $response = $serviceBbcRadio->searchByString('arse');
        print_r($response);
        die();

});
