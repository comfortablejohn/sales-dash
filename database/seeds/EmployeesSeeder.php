<?php

class EmployeesSeeder extends CSVSeeder
{
    public string $table = 'employees';
    public string $filepath = "database/seeds/data/employee.csv";

    public function transform($row)
    {
        return [
            'name'   => $row['name'] ?? "",
        ];
    }
}
