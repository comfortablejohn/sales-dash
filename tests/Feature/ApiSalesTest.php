<?php

namespace Tests\Feature;

use App\Customers;
use App\Employees;
use App\Sales;
use Tests\TestCase;

class ApiSalesTest extends TestCase
{
    public function test_view_sales()
    {
        $this->withoutExceptionHandling();
        $sales = factory(Sales::class, 5)->create();

        $response = $this->get('/api/sales');

        $response->assertSuccessful();
        $this->assertCount(count($sales), $response->json());
    }

    public function test_sales_ordered_by_date_by_default()
    {
        $this->withoutExceptionHandling();

        $salesData = [];

        for ($i = 1; $i < 5; $i++) {
            $salesData[] = [
                'date' => '2020-08-' . $i,
            ];
        }

        factory(Sales::class)->createMany($salesData);

        $response = $this->get('api/sales');

        $lastDate = "";

        $response->assertSuccessful();
        foreach ($response->json() as $saleJson) {
            if ($lastDate) {
                $this->assertLessThanOrEqual($lastDate, $saleJson['date']);
            }
            $lastDate = $saleJson['date'];
        }
    }

    public function test_results_include_sales_person()
    {
        $employee = factory(Employees::class)->create();
        factory(Sales::class, 5)->create(
            [
                'employee_id' => $employee->id,
            ]
        );

        $response = $this->get('api/sales');

        $response->assertSuccessful();
        $this->assertCount(5, $response->json());
        foreach ($response->json() as $saleJson) {
            $this->assertEquals($employee->name, $saleJson['sales_person']);
        }
    }

    public function test_results_include_customer()
    {
        $customer = factory(Customers::class)->create();
        factory(Sales::class, 5)->create(
            [
                'customer_id' => $customer->id,
            ]
        );

        $response = $this->get('api/sales');

        $response->assertSuccessful();
        $this->assertCount(5, $response->json());
        foreach ($response->json() as $saleJson) {
            $this->assertEquals($customer->first_name, $saleJson['customer']['first_name']);
            $this->assertEquals($customer->last_name, $saleJson['customer']['last_name']);
        }
    }
}
