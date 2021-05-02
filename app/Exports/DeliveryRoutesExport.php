<?php

namespace App\Exports;

use App\Models\DeliveryRoute;
use Maatwebsite\Excel\Concerns\FromCollection;

class DeliveryRoutesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DeliveryRoute::all();
    }
}
