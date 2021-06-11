<?php

namespace App\Imports;

use App\Models\Bill;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BillsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Bill([
            'observations' => $row[0],
            'amount_to_be_paid' => $row[1],
            'paid_in_advance' => $row[2],
            'amount_paid' => $row[3],
            'payment_type' => $row[4],
            'customer_id' => $row[5],
            'service_id' => $row[6],
            'vendor_id' => $row[7],
        ]);
    }
}
