<?php
use Bbc\Radio\App\Services\BbcRadioService;
use GuzzleHttp\Client;

$pimpleContainer['guzzle_http_client'] = function () {
    return new Client([]);
};

$pimpleContainer['service_product'] = function ($pimpleContainer) {
    return new \Bbc\Radio\App\Services\ProductService($pimpleContainer['guzzle_http_client']);
};



