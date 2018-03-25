<?php

namespace Jminkler\LaravelShopstyleCollective\Tests;


use Jminkler\LaravelShopstyleCollective\ShopstyleCollectiveService;

class ShopstyleCollectiveServiceTest extends TestCase
{

    /** @test */
    public function can_list_categories()
    {
        $obj = new ShopstyleCollectiveService(config('shopstyle.api_key'));

        $categories = $obj->categories();

        $this->assertTrue(count($categories) > 0, 'We have categories');

    }
}