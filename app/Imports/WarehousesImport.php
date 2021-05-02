<?php

namespace App\Imports;

use App\Models\Warehouse;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class WarehousesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Warehouse([
            'name' => $row[0],
            'description' => $row[1],
            'address' => $row[2],
            'latitude' => $row[3],
            'longitude' => $row[4],
            'company_id' => $row[5],
        ]);
    }
}
