<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SalesDataGridTest extends TestCase
{
    public function test_view_sales_data_grid()
    {
        $this->withoutExceptionHandling();

        $response = $this->get('/data');
        $response->assertSuccessful();
        $response->assertViewIs('data-grid.show');
    }
}
