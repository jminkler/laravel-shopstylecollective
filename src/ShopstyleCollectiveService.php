<?php
/**
 * Created by PhpStorm.
 * User: jarret
 * Date: 3/24/18
 * Time: 9:06 PM
 */

namespace Jminkler\LaravelShopstyleCollective;

use Cache;
use GuzzleHttp\Client;

class ShopstyleCollectiveService
{
    const CACHE_PREFIX = 'shopstyle_';
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
        $options = $this->getCategoriesOptions($cat, $depth);

        return $this->getJsonResponse(__FUNCTION__, $options);
    }

    public function brands()
    {
        return $this->getJsonResponse(__FUNCTION__);
    }

    public function colors()
    {
        return $this->getJsonResponse(__FUNCTION__);
    }

    public function retailers()
    {
        return $this->getJsonResponse(__FUNCTION__);
    }

    public function priceFilters()
    {
        return $this->getJsonResponse(__FUNCTION__);
    }

    public function products($id)
    {
        return $this->getJsonResponse(__FUNCTION__ . '/' . $id);
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
        return Cache::remember(self::CACHE_PREFIX . $action, 60, function () use ($action, $options) {
            $response = $this->get($action, $options);

            if ($response->getBody()) {
                $json = $this->getJson($response);
                if (isset($json->$action) && count($json->$action) > 0) {
                    return $json->$action;
                } else if (isset($json->id)) {
                    return $json;
                }

                return $json->metadata->root;
            }

            return null;
        });

    }


}