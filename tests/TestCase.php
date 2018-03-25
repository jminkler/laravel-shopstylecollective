<?php

namespace lasselehtinen\MyPackage\Test;

use Jminkler\LaravelShopstyleCollective\ShopstyleCollectiveServiceProvider;
use Jminkler\LaravelShopstyleCollective\ShopstyleFacade;
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
