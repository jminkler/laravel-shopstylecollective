<?php
/**
 * Created by PhpStorm.
 * User: jarret
 * Date: 3/24/18
 * Time: 9:06 PM
 */

namespace Jminkler\LaravelShopstyleCollective;

use GuzzleHttp\Client;

class ShopstyleCollectiveService
{
    protected $apiKey;
    protected $base_url;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
        $this->client = new Client([
            'base_uri' => config('shopstyle.base_uri'),
            'timeout' => 2.0,
            'debug' => true,
        ]);

    }

    public function categories()
    {
        $url = config('shopstyle.base_uri', 'http://api.shopstyle.com/api/v2') . '/categories';

        return $this->client->request(
            'GET',
            $url,
            ['query' => 'pid=' . $this->apiKey]
        );

    }

}