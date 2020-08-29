<?php


class CustomersSeeder extends CSVSeeder
{
    public string $table = 'customers';
    public string $filepath = "database/seeds/data/customers.csv";

    public function transform($row)
    {
        return [
            'first_name' => $row['first_name'] ?? "",
            'last_name'  => $row['last_name'] ?? "",
            'email'      => $row['email'] ?? "",
            'street'     => $row['street'] ?? "",
            'city'       => $row['city'] ?? "",
            'gender'     => $row['gender'] ?? "",
        ];
    }
}
