<?php

namespace App\Imports;

use App\Models\Service;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ServicesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Service([
            'lower_time_window' => $row[0],
            'upper_time_window' => $row[1],
            'latitude' => $row[2],
            'longitude' => $row[3],
            'route_order' => $row[4],
            'delivery_route_id' => $row[5],
        ]);
    }
}
