<?php

namespace Jminkler\LaravelShopstyleCollective;

use Orchestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{
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
