<?php

namespace Tests\Feature;

use App\Sales;
use Carbon\Carbon;
use Tests\TestCase;

class SalesStats extends TestCase
{
    public function test_view_daily_sales_count()
    {
        $this->withoutExceptionHandling();
        $date1 = Carbon::createFromFormat('Y-m-d', '2020-08-09');
        $date2 = Carbon::createFromFormat('Y-m-d', '2020-08-01');
        $date3 = Carbon::createFromFormat('Y-m-d', '2020-07-21');
        factory(Sales::class, 3)->create(['date' => $date1]);
        factory(Sales::class, 1)->create(['date' => $date2]);
        factory(Sales::class, 6)->create(['date' => $date3]);
        $response = $this->get('/api/stats/daily?from=' . $date3->format('Y-m-d') . '&to=' . $date1->format('Y-m-d'));
        $this->assertNotEmpty($response->json());
        $this->assertEquals(3, $response->json($date1->format('Y-m-d')));
        $this->assertEquals(1, $response->json($date2->format('Y-m-d')));
        $this->assertEquals(6, $response->json($date3->format('Y-m-d')));

        // check dates are in ascending order
        $lastDate = "";

        foreach ($response->json() as $date => $count) {
            if ($lastDate) {
                $this->assertLessThanOrEqual($lastDate, $date);
            }
            $lastDate = $date;
        }
    }
}
