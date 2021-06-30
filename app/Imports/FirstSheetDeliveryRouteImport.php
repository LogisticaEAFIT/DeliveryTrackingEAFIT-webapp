<?php

namespace App\Imports;

use App\Models\Bill;
use App\Models\DeliveryRoute;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FirstSheetDeliveryRouteImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        $delivery_routes_map = [];
        foreach ($rows as $row) 
        {
            $delivery_route = DeliveryRoute::create([
                'date' => $row[1],
                'warehouse_id' => $row[2],
                'courier_id' => $row[3],
                'vehicle_id' => $row[4],
            ]);
            $delivery_routes_map[$row[0]] = $delivery_route->getId();   
        }
        $GLOBALS["delivery_routes_map"] = $delivery_routes_map;
    }
    
}
