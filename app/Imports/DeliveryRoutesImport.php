<?php

namespace App\Imports;

use App\Models\DeliveryRoute;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DeliveryRoutesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new DeliveryRoute([
            'date' => $row[0],
            'warehouse_id' => $row[1],
            'courier_id' => $row[2],
            'vehicle_id' => $row[3],
        ]);
    }
}
