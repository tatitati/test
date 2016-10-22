<?php

$app->get('/product',  function ($request, $response) use ($app) {
        return 'ok';
});

$app->get('/product/{search_string}',  function ($request, $response) use ($app) {
        $att = $request->getAttribute('search_string');
        /** @var ProductService $serviceBbcRadio */
		$serviceBbcRadio = $app->getServicesContainer()['service_product'];
        return $serviceBbcRadio->searchByString($att);

});
