<?php

namespace Tests\Feature;

use App\Employees;
use App\Sales;
use Tests\TestCase;

class EmployeesTest extends TestCase
{
    public function test_get_employee()
    {
        $employee = factory(Employees::class)->create();
        $foundEmployee = Employees::find($employee->id);
        $this->assertEquals($employee->id, $foundEmployee->id);
    }

    public function test_get_sales_relation()
    {
        $this->withoutExceptionHandling();
        $employee = factory(Employees::class)->create();

        factory(Sales::class, 5)->create();
        $salesByEmployee = factory(Sales::class, 5)->create(
            [
                'employee_id' => $employee->id,
            ]
        );

        $foundSales = $employee->sales;

        $this->assertNotEmpty($foundSales);
        $this->assertCount(count($salesByEmployee), $foundSales);
    }
}
