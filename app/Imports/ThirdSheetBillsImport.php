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
            $bill = new Bill();
            $bill->setObservations($row[0]);
            $bill->setAmountToBePaid($row[1]);
            $bill->setPaidInAdvance($row[2]);
            $bill->setAmountPaid($row[3]);
            $bill->setPaymentType($row[4]);
            $bill->setCustomerId($row[5]);
            $bill->setServiceId(DeliveryServiceBillsImport::$services_map[$row[6]]);
            $bill->setVendorId($row[7]);
            $bill->validateModel();

            $bill->save();
        }
    }
}
