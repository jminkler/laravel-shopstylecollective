<?php
/**
 * Created by PhpStorm.
 * User: jarret
 * Date: 3/24/18
 * Time: 9:06 PM
 */

namespace Jminkler\LaravelShopstyleCollective;

use GuzzleHttp\Client;
use Log;

class ShopstyleCollectiveService
{
    protected $apiKey;
    protected $base_url;
    protected $options;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
        $this->base_uri = config('shopstyle.base_uri');
        $this->client = new Client([
            'base_uri' => $this->base_uri,
            'timeout' => 2.0,
            'debug' => true,
        ]);
        $this->options = ['pid' => $this->apiKey];
    }

    public function categories($cat = null, $depth = null)
    {
        $action = 'categories';
        $options = $this->getCategoriesOptions($cat, $depth);

        return $this->getJsonResponse($action, $options);
    }

    public function brands()
    {
        $action = 'brands';

        return $this->getJsonResponse($action);
    }

    private function getJson($response)
    {
        $json = json_decode($response->getBody()->getContents());
        return $json;
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     */
    private function get($action, $options)
    {
        $options['query'] = http_build_query(array_merge($this->options, $options));
        Log::info(__CLASS__, [$options]);
        $response = $this->client->get(
            $action,
            $options
        );
        return $response;
    }

    /**
     * @param $cat
     * @param $depth
     * @return array
     */
    private function getCategoriesOptions($cat, $depth)
    {
        $options = [];
        if ($cat) {
            $options['cat'] = $cat;
        }
        if ($depth) {
            $options['depth'] = $depth;
        }
        return $options;
    }

    /**
     * @param $action
     * @param $options
     * @return null
     */
    private function getJsonResponse($action, $options = [])
    {
        $response = $this->get($action, $options);

        if ($response->getBody()) {
            $json = $this->getJson($response);
            if (count($json->$action) > 0) {
                return $json->$action;
            }

            return $json->metadata->root;
        }

        return null;
    }


}