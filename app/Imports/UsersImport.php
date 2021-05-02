<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Vehicle;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'name' => $row[0],
            'email' => $row[1],
            'password' => $row[2],
            'id_card_number' => $row[3],
            'role' => $row[4],
            'company_id' => $row[5],
            'warehouse_id' => $row[6],
        ]);
    }
}
