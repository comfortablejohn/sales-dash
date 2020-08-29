<?php

namespace Tests\Unit;

use App\Products;
use App\Sales;
use Tests\TestCase;

class ProductsTest extends TestCase
{
    public function test_get_sales_relation()
    {
        $this->withoutExceptionHandling();
        $product = factory(Products::class)->create();

        $productSales = factory(Sales::class, 5)->create(
            [
                'product_id' => $product->id
            ]
        );

        $relationSales = $product->sales;
        $this->assertCount($productSales->count(), $relationSales);
        foreach ($relationSales as $relationSale)
        {
            $this->assertEquals($product->id, $relationSale->product_id);
        }
    }
}
