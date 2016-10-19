<?php
use Bbc\Radio\Services\BbcRadioService;

$app->get('/product/{search_string}',  function ($request, $response) use ($pimpleContainer) {
        /** @var BbcRadioService $serviceBbcRadio */
        $att = $request->getAttribute('search_string');
        /** @var BbcRadioService $serviceBbcRadio */
		$serviceBbcRadio = $pimpleContainer['service_bbc_radio'];
        return $serviceBbcRadio->searchByString($att);
});
