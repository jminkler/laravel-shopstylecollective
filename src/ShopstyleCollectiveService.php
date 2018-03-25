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

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
        $this->client = new Client();

    }

    public function search($keywords, array $options)
    {
        $this->client->get();
    }

}