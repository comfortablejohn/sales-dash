<?php

class ProductsSeeder extends CSVSeeder
{
    public string $table = 'products';
    public string $filepath = "database/seeds/data/products.csv";

    public function transform($row)
    {
        return [
            'name'   => $row['name'] ?? "",
            'price'  => $row['price'] ?? "",
        ];
    }
}
