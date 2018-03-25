<?php
/**
 * Created by PhpStorm.
 * User: jarret
 * Date: 3/24/18
 * Time: 9:06 PM
 */

namespace Jminkler\LaravelShopstyleCollective;

use Guzzlehttp\Client;

class ShopstyleCollectiveService
{
    protected $apiKey;
    protected $base_url;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
        $this->client = new Client(['base_url' => config('shopstyle.base_url')]);

    }

    public function categories()
    {
        return $this->client->get('categories', ['pid' => $this->apiKey]);
    }

}