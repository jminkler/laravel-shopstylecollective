<?php

namespace Jminkler\LaravelShopstyleCollective\Tests;

use Illuminate\Foundation\Bootstrap\LoadEnvironmentVariables;
use Jminkler\LaravelShopstyleCollective\ShopstyleCollectiveServiceProvider;
use Jminkler\LaravelShopstyleCollective\ShopstyleFacade;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{

    protected function getEnvironmentSetUp($app)
    {
        // make sure, our .env file is loaded
        $app->useEnvironmentPath(__DIR__ . '/..');
        $app->bootstrapWith([LoadEnvironmentVariables::class]);
        parent::getEnvironmentSetUp($app);
    }

    protected function getPackageProviders($app)
    {
        return [ShopstyleCollectiveServiceProvider::class];
    }

    protected function getPackageAliases($app)
    {
        return [
            'Shopstyle' => ShopstyleFacade::class,
        ];
    }
}
