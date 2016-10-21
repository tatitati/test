<?php
use Bbc\Radio\App\Services\BbcRadioService;

$app->get('/product/{search_string}',  function ($request, $response) use ($pimpleContainer) {
        $att = $request->getAttribute('search_string');

        /** @var BbcRadioService $serviceBbcRadio */
		$serviceBbcRadio = $pimpleContainer['service_bbc_radio'];
        $resultsSearch   = $serviceBbcRadio->searchByString($att);

        if (null === $resultsSearch) {
                return 'Not found';
        }

        return json_encode($resultsSearch);
});
