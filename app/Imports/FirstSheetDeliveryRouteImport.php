<?php

namespace App\Imports;

use App\Models\Bill;
use App\Models\DeliveryRoute;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class FirstSheetDeliveryRouteImport implements ToCollection, SkipsEmptyRows
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
            $delivery_route = new DeliveryRoute();
            $delivery_route->setDate($row[1]);
            $delivery_route->setWarehouseId($row[2]);
            $delivery_route->setCourierId($row[3]);
            $delivery_route->setVehicleId($row[4]);
            $delivery_route->validateModel();

            $delivery_route->save();
            $delivery_routes_map[$row[0]] = $delivery_route->getId();
        }
        DeliveryServiceBillsImport::$delivery_routes_map = $delivery_routes_map;
    }
    
}
