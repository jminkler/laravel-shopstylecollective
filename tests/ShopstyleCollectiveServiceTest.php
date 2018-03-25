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

    /** @test */
    public function can_list_all_colors()
    {
        $obj = new ShopstyleCollectiveService(config('shopstyle.api_key'));

        $brands = $obj->colors();


        $color = collect($brands)->filter(function ($value, $key) {
            return $value->name == 'Brown';
        })->count();

        $this->assertEquals(1, $color, 'We have colors');
    }

    /** @test */
    public function can_list_all_retailers()
    {
        $obj = new ShopstyleCollectiveService(config('shopstyle.api_key'));

        $brands = $obj->retailers();


        $brands = collect($brands)->filter(function ($value, $key) {
            return $value->name == 'Nordstrom';
        })->count();

        $this->assertEquals(1, $brands, 'We have retailers');
    }

    /** @test */
    public function can_get_single_product()
    {
        $obj = new ShopstyleCollectiveService(config('shopstyle.api_key'));

        $product = $obj->products('359131344');


        $this->assertEquals('359131344', $product->id, 'We have the product');
        $this->assertEquals('Matthew Williamson Jungle Whispers Gown', $product->name, 'We have the product');
    }

    /** @test */
    public function can_get_price_filters()
    {
        $obj = new ShopstyleCollectiveService(config('shopstyle.api_key'));

        $filters = $obj->priceFilters();


        $filter = collect($filters)->filter(function ($value, $key) {
            return $value->id == 7;
        })->count();


        $this->assertEquals(1, $filter, 'We have the product');

    }

}