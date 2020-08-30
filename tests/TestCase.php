<?php

namespace Tests;

use Illuminate\Testing\TestResponse;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use PHPUnit\Framework\Assert;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // allows us to use $response->data($key) to check
        // data was passed to views
        TestResponse::macro('data', function ($key) {
            $data = $this->original->getData();
            if (!isset($data[$key])) {
                throw new \Exception("Key \"$key\" not found in response data");
            }

            return $data[$key];
        });
    }
}
