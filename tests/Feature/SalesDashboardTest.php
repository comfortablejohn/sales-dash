<?php

namespace Tests\Feature;

use Tests\TestCase;

class SalesDashboardTest extends TestCase
{
    public function test_view_sales_dashboard_page()
    {
        $this->withoutExceptionHandling();

        $response = $this->get('/dashboard');
        $response->assertSuccessful();
        $response->assertViewIs('dashboard.show');
    }
}
