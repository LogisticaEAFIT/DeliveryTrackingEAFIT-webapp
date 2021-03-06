<?php

namespace App\Imports;

use App\Http\Controllers\DeliveryRouteController;
use App\Models\Service;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class SecondSheetServiceImport implements ToCollection, SkipsEmptyRows
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
            $service = new Service();
            $service->setLowerTimeWindow($row[1]);
            $service->setUpperTimeWindow($row[2]);
            $service->setRouteOrder($row[3]);
            $service->setLatitude($row[4]);
            $service->setLongitude($row[5]);
            $service->setDeliveryRouteId(DeliveryServiceBillsImport::$delivery_routes_map[$row[6]]);
            $service->validateModel();

            $service->save();

            $delivery_route_controller = new DeliveryRouteController;
            $delivery_route_controller->updateDeliveryRouteValues($service->getDeliveryRouteId());
            $services_map[$row[0]] = $service->getId();
        }
        DeliveryServiceBillsImport::$services_map = $services_map;
    }
}
