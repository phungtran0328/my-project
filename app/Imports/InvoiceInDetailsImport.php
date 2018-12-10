<?php

namespace App\Imports;

use App\InvoiceInDetails;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class InvoiceInDetailsImport implements ToModel
{
    public function model(array $rows)
    {
        /*$temp = [
            'S_MA'=>$rows[0],
            'PN_MA'=>$rows[1],
            'PNCT_SOLUONG'=>$rows[2],
            'PNCT_GIA'=>$rows[3]
        ];*/
//        dd($temp);
//        $abc = InvoiceInDetails::insert($temp);

        /*$temp = new InvoiceInDetails();
        $temp->S_MA = intval($rows[0]);
        $temp->PN_MA = intval($rows[1]);
        $temp->PNCT_SOLUONG = intval($rows[2]);
        $temp->PNCT_GIA = intval($rows[3]);

        dd($temp);*/
        return new InvoiceInDetails([
            'S_MA'=>$rows[0],
            'PN_MA'=>$rows[1],
            'PNCT_SOLUONG'=>$rows[2],
            'PNCT_GIA'=>$rows[3]
        ]);
    }
}
