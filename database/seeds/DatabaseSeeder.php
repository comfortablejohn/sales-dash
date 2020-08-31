<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call([
             CustomersSeeder::class,
             EmployeesSeeder::class,
             ProductsSeeder::class,
             SalesSeeder::class,
         ]);
    }
}
