<?php
use Bbc\Radio\Services\BbcRadioService;

$app->get('/product/{search_string}',  function ($request, $response) use ($pimpleContainer) {
        $att = $request->getAttribute('search_string');

        /** @var BbcRadioService $serviceBbcRadio */
		$serviceBbcRadio = $pimpleContainer['service_bbc_radio'];
        $searchResults   = $serviceBbcRadio->searchByString($att);
        $results         = json_decode($searchResults, true);

        if (isset($results['atoz']['tleo_titles']) && !empty($results['atoz']['tleo_titles'])) {
                return json_encode($results['atoz']['tleo_titles']);
        }

        return 'Not found';
});
