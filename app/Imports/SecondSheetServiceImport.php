<?php

namespace App\Imports;

use App\Models\Service;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SecondSheetServiceImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        $services_map = [];
        foreach ($rows as $row) 
        {
            $service = Service::create([
                'lower_time_window' => $row[1],
                'upper_time_window' => $row[2],
                'route_order' => $row[3],
                'latitude' => $row[4],
                'longitude' => $row[5],
                'delivery_route_id' => $GLOBALS["delivery_routes_map"][$row[6]],
            ]);
            $services_map[$row[0]] = $service->getId();
        }
        $GLOBALS["services_map"] = $services_map;
    }
}
