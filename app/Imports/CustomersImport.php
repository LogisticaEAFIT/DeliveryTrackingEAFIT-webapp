<?php

namespace App\Imports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CustomersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Customer([
            'name' => $row[0],
            'phone_number' => $row[1],
            'address' => $row[2],
            'latitude' => $row[3],
            'longitude' => $row[4],
            'observations' => $row[5],
            'company_id' => $row[6],
        ]);
    }
}
