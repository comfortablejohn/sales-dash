<?php

namespace Tests\Feature;

use App\Employees;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EmployeesTest extends TestCase
{
    public function test_get_employee()
    {
        $employee = factory(Employees::class)->create();
        $foundEmployee = Employees::find($employee->id);
        $this->assertEquals($employee->id, $foundEmployee->id);
    }
}
