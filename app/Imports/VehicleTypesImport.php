<?php

namespace App\Imports;

use App\Models\VehicleType;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class VehicleTypesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new VehicleType([
            'capacity' => $row[0],
            'description' => $row[1],
            'volume' => $row[2],
        ]);
    }
}
