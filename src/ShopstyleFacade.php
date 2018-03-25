<?php

namespace Jminkler\LaravelShopstyleCollective;

use Illuminate\Support\Facades\Facade;

class ShopstyleFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'shopstyle-collective';
    }
}