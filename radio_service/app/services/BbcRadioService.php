<?php
namespace Bbc\Radio\Services;

use GuzzleHttp\Client;

class BbcRadioService
{
    const URL_BBC = 'http://www.bbc.co.uk';

    /**
     * @var Client
     */
    private $guzzleClientHttp;

    public function __construct(Client $guzzleClientHttp)
    {
        $this->guzzleClientHttp = $guzzleClientHttp;
    }

    /**
     * @param $string
     *
     * @return string
     */
    public function searchByString($string)
    {
        return $this->guzzleClientHttp
            ->request(
                'GET',
                self::URL_BBC . sprintf('/programmes/a-z/by/%s/current.json', $string)
            )->getBody()
            ->getContents();
    }
}