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

    public function test_get_customer_full_name()
    {
        $customer = factory(Customers::class)->create(
            [
                'first_name' => 'Bob',
                'last_name' => "Smith",
            ]
        );

        $this->assertEquals("Bob Smith", $customer->full_name);
    }
}
