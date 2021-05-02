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
            'completed_deliveries' => $row[1],
            'number_of_deliveries' => $row[2],
            'warehouse_id' => $row[3],
            'courier_id' => $row[4],
            'vehicle_id' => $row[5],
        ]);
    }
}
