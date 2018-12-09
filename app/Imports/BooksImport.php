<?php

namespace App\Imports;

use App\Book;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BooksImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Book([
            'KM_MA' => $row['km_ma'],
            'NXB_MA' => $row['nxb_ma'],
            'LS_MA' => $row['ls_ma'],
            'LB_MA' => $row['lb_ma'],
            'S_TEN' => $row['ten'],
            'S_SLTON' => $row['slton'],
            'S_KICHTHUOC' => $row['kichthuoc'],
            'S_SOTRANG' => $row['sotrang'],
            'S_NGAYXB' => $row['ngayxb'],
            'S_LUOTXEM' => $row['luotxem'],
            'S_TAIBAN' => $row['taiban'],
            'S_GIOITHIEU' => $row['gioithieu'],
            'S_GIA' => $row['gia'],
            'S_AVATAR' => $row['avatar'],
        ]);
    }
}
