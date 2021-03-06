<?php

namespace App\Imports;

use App\Models\DeliveryRoute;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class DeliveryServiceBillsImport implements WithMultipleSheets
{
    public static $delivery_routes_map = [];
    public static $services_map = [];
    public function sheets(): array
    {
        return [
            0 => new FirstSheetDeliveryRouteImport(),
            1 => new SecondSheetServiceImport(),
            2 => new ThirdSheetBillsImport(),
        ];
    }
}
