<?php
use App\Products;
use App\Customers;
use App\Employees;

class ProductsSeeder extends CSVSeeder
{
    public string $table = 'sales';
    public string $filepath = "database/seeds/data/sales.csv";

    public function transform($row)
    {
        $names = explode(' ', $row['customer name']);
        $customer =
        return [
            'invoice_id' => $row['invoiceId'] ?? '',
            'date' => $row['date'] ?? "",
            'product_id' => Products::where('name', $row['name'])->first()->id,
            'customer_id' =>
        ];
    }
}
