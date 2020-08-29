<?php

namespace Tests\Feature;

use App\Customers;
use App\Sales;
use Tests\TestCase;

class ApiCustomerSalesTest extends TestCase
{
    public function test_index_sales_by_customer()
    {
        $this->withoutExceptionHandling();
        factory(Sales::class, 3)->create();

        $customer = factory(Customers::class)->create();
        $salesByCustomer = factory(Sales::class)->createMany(
            [
                [ 'customer_id' => $customer->id ],
                [ 'customer_id' => $customer->id ],
                [ 'customer_id' => $customer->id ],
            ]
        );

        $response = $this->get("api/customers/{$customer->id}/sales");

        $this->assertCount($salesByCustomer->count(), $response->json());
        foreach ($response->json() as $saleJson) {
            $this->assertEquals($customer->id, $saleJson['customer_id']);
        }
    }
}
