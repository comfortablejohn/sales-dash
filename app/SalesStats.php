<?php
namespace App;

use Illuminate\Database\Eloquent\Collection;

class SalesStats {
    public static function totalsByDay(Collection $sales)
    {
        $totalsByDay = [];

        foreach ($sales as $sale) {
            $dateString = $sale->date->format('Y-m-d');
            if (!array_key_exists($dateString, $totalsByDay)) {
                $totalsByDay[$dateString] = 0;
            }

            $totalsByDay[$dateString] = $totalsByDay[$dateString] + 1;
        }

        return $totalsByDay;
    }
}
