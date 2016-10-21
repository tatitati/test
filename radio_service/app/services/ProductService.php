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
        $response = $this->guzzleClientHttp
            ->get(self::URL_BBC . sprintf('/programmes/a-z/by/%s/current.json', $string))
            ->getBody()
            ->getContents();


        // check and return results
        $resultsSearch = json_decode($response, true);
        $foundProducts = isset($resultsSearch['atoz']['tleo_titles']) && !empty($resultsSearch['atoz']['tleo_titles']);

        if (true === $foundProducts) {
            return $resultsSearch['atoz']['tleo_titles'];
        }

        return null;
    }
}