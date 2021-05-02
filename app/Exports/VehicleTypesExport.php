<?php

namespace App\Exports;

use App\Models\VehicleType;
use Maatwebsite\Excel\Concerns\FromCollection;

class VehicleTypesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return VehicleType::all();
    }
}
