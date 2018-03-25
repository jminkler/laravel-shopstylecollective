<?php

namespace Jminkler\LaravelShopstyleCollective;

use Illuminate\Support\ServiceProvider;

class ShopstyleCollectiveServiceProvider extends ServiceProvider
{
    protected $defer = true;

    public function boot()
    {


    }

    public function register()
    {
        $this->app->singleton('shopstyle-collective', function($app){
            $config = $app->make('config');

            $apiKey = $config->get('shopstyle.api_key');

            return new ShopstyleCollectiveService($apiKey);
        });
    }

    public function provides()
    {
        return ['shopstyle-collective'];
    }
}