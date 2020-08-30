<?php

namespace Tests\Feature;

use App\Customers;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CustomersSearchTest extends TestCase
{
    public function test_search_customers()
    {
        $customers = factory(Customers::class)->createMany(
            [
                [
                    'first_name' => 'Jeff',
                ],
                [
                    'last_name' => 'Sjefsson'
                ]
            ]
        );


        $response = $this->get('/api/customers/search?s=Jef');
        $response->assertSuccessful();
        $firstFoundCustomerId = $response->json()[0];
        $this->assertCount(2, $response->json());
        $this->assertEquals($customers[0]->id, $firstFoundCustomerId['id']);
    }
}
