<?php

namespace Tests\Feature;

use App\Sales;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiSalesTest extends TestCase
{
    public function test_view_sales()
    {
        $this->withoutExceptionHandling();
        $sales = factory(Sales::class, 5)->create(['employee_id' => 1]);

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
                'employee_id' => 1,
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

}