<?php

namespace Tests\Feature;

use App\Sales;
use App\SalesStats;
use Carbon\Carbon;
use Tests\TestCase;

class SalesDashboardTest extends TestCase
{
    public function test_view_sales_dashboard_page()
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

        $sales = Sales::byDateRange($from, $to)->get();

        $totalsByDay = SalesStats::totalsByDay($sales);

        $response = $this->get('/dashboard');
        $response->assertSuccessful();
        $response->assertViewIs('dashboard.show');
        $injectedDailyStats = $response->data('totals_by_day');

        $this->assertCount(3, $injectedDailyStats);
        $this->assertCount(count($totalsByDay), $injectedDailyStats);

        $this->assertEquals($from->format('Y-m-d'), $response->data('from_date'));
        $this->assertEquals($to->format('Y-m-d'), $response->data('to_date'));

        foreach ($injectedDailyStats as $date => $count) {
            $this->assertEquals($totalsByDay[$date], $count);
        }
    }
}
