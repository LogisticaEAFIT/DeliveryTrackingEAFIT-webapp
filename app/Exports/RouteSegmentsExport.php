<?php

namespace App\Exports;

use App\Models\RouteSegment;
use Maatwebsite\Excel\Concerns\FromCollection;

class RouteSegmentsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return RouteSegment::all();
    }
}
