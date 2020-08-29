<?php

namespace Tests\Feature;

use App\Sales;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SalesDataGridTest extends TestCase
{
    public function test_view_sales_data_grid_starts_with_previous_months_sales()
    {
        $this->withoutExceptionHandling();

        $to = Carbon::now();
        $from = Carbon::now()->subMonth();

        $sales = factory(Sales::class, 4)->create(['employee_id' => 1]);

        $salesData = Sales::byDateRange($from, $to)->get();

        $response = $this->get('/data');
        $response->assertSuccessful();
        $response->assertViewIs('data-grid.show');

        $injectedSales = $response->data('sales');

        $this->assertNotEmpty($injectedSales);
        $this->assertCount($salesData->count(), $injectedSales);
    }
}
