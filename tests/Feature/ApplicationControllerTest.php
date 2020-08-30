<?php

namespace Tests\Feature;

use Tests\TestCase;

class ApplicationControllerTest extends TestCase
{
    public function test_view_sales_dashboard_page()
    {
        $this->withoutExceptionHandling();
        $response = $this->get('/dashboard');
        $response->assertSuccessful();
        $response->assertViewIs('app.show');
    }

    public function test_view_sales_data_page()
    {
        $this->withoutExceptionHandling();
        $response = $this->get('/data');
        $response->assertSuccessful();
        $response->assertViewIs('app.show');
    }

}
