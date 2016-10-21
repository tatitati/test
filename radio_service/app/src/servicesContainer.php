<?php
use Bbc\Radio\App\Services\BbcRadioService;
use GuzzleHttp\Client;

$servicesContainer['guzzle_http_client'] = function () {
    return new Client([]);
};

$servicesContainer['service_product'] = function ($servicesContainer) {
    return new \Bbc\Radio\App\Services\ProductService($servicesContainer['guzzle_http_client']);
};



