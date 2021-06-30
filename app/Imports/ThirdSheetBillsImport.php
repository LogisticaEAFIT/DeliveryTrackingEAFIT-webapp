<?php

namespace App\Imports;

use App\Models\Bill;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ThirdSheetBillsImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            Bill::create([
                'observations' => $row[0],
                'amount_to_be_paid' => $row[1],
                'paid_in_advance' => $row[2],
                'amount_paid' => $row[3],
                'payment_type' => $row[4],
                'customer_id' => $row[5],
                'service_id' => $GLOBALS["services_map"][$row[6]],
                'vendor_id' => $row[7],
            ]);
        }
    }
}
