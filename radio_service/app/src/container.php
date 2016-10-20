<?php
use Bbc\Radio\Services\BbcRadioService;
use GuzzleHttp\Client;

$pimpleContainer['guzzle_http_client'] = function () {
    return new Client([]);
};

$pimpleContainer['service_bbc_radio'] = function ($pimpleContainer) {
    return new BbcRadioService($pimpleContainer['guzzle_http_client']);
};



