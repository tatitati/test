<?php
use Bbc\Radio\App\Services\BbcRadioService;

$app->get('/',  function ($request, $response) {
    return $this->renderer->render($response, 'index.twig', []);
});