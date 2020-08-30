<?php
use App\Products;
use App\Customers;
use App\Employees;
use Carbon\Carbon;

class SalesSeeder extends CSVSeeder
{
    public string $table = 'sales';
    public string $filepath = "database/seeds/data/sales.csv";

    public function transform($row)
    {
        $names = explode(' ', $row['customer name']);

        $first_name = array_shift($names);
        $last_name = implode(' ', $names);
        $customer = Customers::where('first_name', $first_name)->where('last_name', $last_name)->first();

        $date = '';
        if (isset($row['date'])) {
            // transform date to be recent (source data ends in July 2020)
            $date = Carbon::createFromFormat('d/m/y', $row['date'])->addMonths(2);
        }

        return [
            'invoice_id' => $row['invoiceId'] ?? '',
            'date' => $date ?? "",
            'product_id' => Products::where('name', $row['product_name'])->first()->id,
            'customer_id' => $customer->id,
            'employee_id' => Employees::where('name', $row['sales_person'])->first()->id,
        ];
    }
}
