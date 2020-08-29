<?php

namespace Tests\Unit;

use App\Customers;
use App\Sales;
use Tests\TestCase;

class CustomersTest extends TestCase
{
    public function test_get_sales_relation()
    {
        $this->withoutExceptionHandling();
        $customer = factory(Customers::class)->create();

        factory(Sales::class, 5)->create();
        $salesByCustomer = factory(Sales::class, 5)->create(
            [
                'customer_id' => $customer->id,
            ]
        );

        $foundSales = $customer->sales;

        $this->assertNotEmpty($foundSales);
        $this->assertCount(count($salesByCustomer), $foundSales);
    }
}
