<?php

namespace Tests\Feature;

use App\Sales;
use Carbon\Carbon;
use Tests\TestCase;

class SalesDataGridTest extends TestCase
{
    public function test_view_sales_data_grid_starts_with_previous_months_sales()
    {
        $this->withoutExceptionHandling();

        $to = Carbon::now();
        $from = Carbon::now()->subMonth();

        factory(Sales::class)->createMany(
            [
                [
                    'date' => $to->copy()->subDay(),
                ],
                [
                    'date' => $to->copy()->subDay(2),
                ],
                [
                    'date' => $to->copy()->subDay(3),
                ],
                [
                    // one out of range
                    'date' => $to->copy()->subMonth(3),
                ],
            ]
        );

        $salesData = Sales::byDateRange($from, $to)->get();

        $response = $this->get('/data');
        $response->assertSuccessful();
        $response->assertViewIs('data-grid.show');

        $injectedSales = $response->data('sales');

        $this->assertNotEmpty($injectedSales);
        $this->assertCount(3, $injectedSales);
        $this->assertCount($salesData->count(), $injectedSales);
    }
}
