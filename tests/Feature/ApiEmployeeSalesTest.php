<?php

namespace Tests\Feature;

use App\Employees;
use App\Sales;
use Tests\TestCase;

class ApiEmployeeSalesTest extends TestCase
{
    public function test_index_sales_by_customer()
    {
        $this->withoutExceptionHandling();
        factory(Sales::class, 3)->create();

        $employee = factory(Employees::class)->create();
        $salesByEmployee = factory(Sales::class)->createMany(
            [
                [ 'employee_id' => $employee->id ],
                [ 'employee_id' => $employee->id ],
                [ 'employee_id' => $employee->id ],
            ]
        );

        $response = $this->get("api/employees/{$employee->id}/sales");

        $this->assertCount($salesByEmployee->count(), $response->json());

        foreach ($response->json() as $saleJson) {
            $this->assertEquals($employee->id, $saleJson['employee_id']);
        }
    }
}
