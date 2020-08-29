<?php

namespace Tests\Unit;

use App\Employees;
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
                    'employee_id' => 1,
                    'date' => Carbon::createFromFormat('Y-m-d', '2020-08-05'),
                ],
                [
                    'employee_id' => 1,
                    'date' => Carbon::createFromFormat('Y-m-d', '2020-08-01'),
                ],
                [
                    'employee_id' => 1,
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
                'employee_id' => 1,
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

        $this->assertEquals($salesByEmployee->count(), $foundSales->count());
        foreach ($foundSales as $sale) {
            $this->assertEquals($employee->id, $sale->employee_id);
        }
    }
}
