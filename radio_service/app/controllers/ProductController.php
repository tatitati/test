<?php

$app->get('/product/{search_string}',  function ($request, $response) use ($app) {
        $att = $request->getAttribute('search_string');
        /** @var ProductService $serviceBbcRadio */
		$serviceBbcRadio = $app->getServicesContainer()['service_product'];
        $resultsSearch   = $serviceBbcRadio->searchByString($att);

        if (null === $resultsSearch) {
                return 'no results';
        }

        return json_encode($resultsSearch);
});
