<?php
namespace Bbc\Radio\App\Services;

use GuzzleHttp\Client;

class ProductService
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
     * @return string[]|null
     */
    public function searchByString($string)
    {
        return $this->guzzleClientHttp
            ->get(self::URL_BBC . sprintf('/programmes/a-z/by/%s/current.json', $string))
            ->getBody()
            ->getContents();
    }
}