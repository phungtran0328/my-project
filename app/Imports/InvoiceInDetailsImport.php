<?php

namespace App\Imports;

use App\InvoiceInDetails;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class InvoiceInDetailsImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        $i = 0;
        $data = array();
        foreach ($rows as $row){
            $data[$i] = [
                'S_MA' => $row[0],
                'PN_MA' => $row[1],
                'PNCT_SOLUONG' => $row[2],
                'PNCT_GIA' => $row[3]
            ];
            $i++;
        }
        InvoiceInDetails::insert($data);
    }
}
