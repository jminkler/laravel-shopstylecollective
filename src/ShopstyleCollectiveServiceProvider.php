<?php

namespace Jminkler\LaravelShopstyleCollective;

use Illuminate\Support\ServiceProvider;

class ShopstyleCollectiveServiceProvider extends ServiceProvider
{
    protected $defer = true;

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/shopstyle.php' => config_path('shopstyle.php'),
        ]);

    }

    public function register()
    {
        $this->app->singleton('shopstyle-collective', function($app){
            $config = $app->make('config');

            $apiKey = $config->get('shopstyle.api_key');

            return new ShopstyleCollectiveService($apiKey);
        });

        if ($this->app->config->get('shopstyle') === null) {
            $this->app->config->set('shopstyle', require __DIR__ . '/../config/shopstyle.php');
        }
    }

    public function provides()
    {
        return ['shopstyle-collective'];
    }
}