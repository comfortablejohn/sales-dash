<?php

namespace Tests\Unit;

use App\Customers;
use App\Employees;
use App\Products;
use App\Sales;
use Carbon\Carbon;
use Tests\TestCase;

class SalesTest extends TestCase
{
    public function test_find_by_date_range()
    {
        // one month
        $to = Carbon::createFromFormat('Y-m-d', '2020-08-05');
        $from = Carbon::createFromFormat('Y-m-d', '2020-07-05');

        $sales = factory(Sales::class)->createMany(
            [
                [
                    'date' => Carbon::createFromFormat('Y-m-d', '2020-08-05'),
                ],
                [
                    'date' => Carbon::createFromFormat('Y-m-d', '2020-08-01'),
                ],
                [
                    'date' => Carbon::createFromFormat('Y-m-d', '2020-07-01'),
                ]
            ]
        );

        $foundSales = Sales::byDateRange($from, $to)->get();
        $this->assertEquals(2, $foundSales->count());

        foreach ($foundSales as $sale) {
            $this->assertGreaterThanOrEqual($from, $sale->date);
            $this->assertLessThanOrEqual($to, $sale->date);
        }
    }

    public function test_date_column_is_date()
    {
        $today = Carbon::now();
        $sale = factory(Sales::class)->create(
            [
                'date' => $today,
            ]
        );

        $foundSale = Sales::find($sale->id);

        $this->assertInstanceOf(Carbon::class, $foundSale->date);
    }

    public function test_sales_by_employee()
    {
        $otherEmployee = factory(Employees::class)->create();
        $salesNotByEmployee = factory(Sales::class)->create( [ 'employee_id' => $otherEmployee->id ] );

        $employee = factory(Employees::class)->create();
        $salesByEmployee = factory(Sales::class, 2)->create( [ 'employee_id' => $employee->id ] );

        $foundSales = Sales::byEmployee($employee)->get();

        $this->assertCount($salesByEmployee->count(), $foundSales);
        foreach ($foundSales as $sale) {
            $this->assertEquals($employee->id, $sale->employee_id);
        }
    }

    public function test_get_employee_relation()
    {
        $employee = factory(Employees::class)->create();
        $sale = factory(Sales::class)->create(
            [
                'employee_id' => $employee->id,
            ]
        );

        $this->assertNotEmpty($sale->employee);
        $this->assertEquals($employee->id, $sale->employee->id);
        $this->assertEquals($employee->name, $sale->employee->name);
    }

    public function test_get_customer_relation()
    {
        $customer = factory(Customers::class)->create();
        $sale = factory(Sales::class)->create(
            [
                'customer_id' => $customer->id
            ]
        );
        $relationCustomer = $sale->customer;
        $this->assertEquals($customer->id, $relationCustomer->id);
    }

    public function test_get_product_relation()
    {
        $product = factory(Products::class)->create();
        $sale = factory(Sales::class)->create(
            [
                'product_id' => $product->id
            ]
        );
        $relationProduct = $sale->product;
        $this->assertEquals($product->id, $relationProduct->id);
    }
}
