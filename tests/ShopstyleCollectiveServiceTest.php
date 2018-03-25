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

    /** @test */
    public function can_list_categories_depth_1()
    {
        $obj = new ShopstyleCollectiveService(config('shopstyle.api_key'));

        $categories = $obj->categories(null, 1);
        $this->assertTrue(count($categories) > 0, 'We have categories');
    }

    /** @test */
    public function can_list_categories_mens_dress_shirts()
    {
        $obj = new ShopstyleCollectiveService(config('shopstyle.api_key'));

        $categories = $obj->categories(214);

        $this->assertEquals('mens-dress-shirts', $categories->id, 'We have mens-dress-shirts');
    }

    /** @test */
    public function can_list_all_brands()
    {
        $obj = new ShopstyleCollectiveService(config('shopstyle.api_key'));

        $brands = $obj->brands();


        $brands = collect($brands)->filter(function ($value, $key) {
            return $value->name == 'Dooney & Bourke';
        })->count();

        $this->assertEquals(1, $brands, 'We have brands');
    }
}