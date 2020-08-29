<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CSVSeeder extends Seeder
{
    public string $filepath;
    public string $table;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = fopen(base_path($this->filepath), "r");
        $header = fgetcsv($file);
        $data = [];
        $now = Carbon::now()->format('Y-m-d H:i:s');
        while ($row = fgetcsv($file)) {
            $row = array_combine($header, $row);
            $row['created_at'] = $now;
            $row['updated_at'] = $now;
            $data[] = array_merge(
                [
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                $this->transform($row)
            );
        }

        DB::table($this->table)->insert($data);
    }

    public function transform($row)
    {
        return $row;
    }
}
