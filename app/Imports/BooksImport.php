<?php

namespace App\Imports;

use App\Book;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BooksImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row){
            $file = 'D:\\LuanVan\\image\\'.$row[9];
            $destination = 'D:\\LuanVan\\htdocs\\bookstore\\public\\images\\avatar\\'.$row[9];
            copy($file, $destination);
            $date = date('Y-m-d',mktime(0,0,0,1,$row[6]-1,1900));
            Book::create([
                'NXB_MA' => $row[0],
                'LS_MA' => $row[1],
                'LB_MA' => $row[2],
                'S_TEN' => $row[3],
                'S_SLTON' => 0,
                'S_KICHTHUOC' => $row[4],
                'S_SOTRANG' => $row[5],
                'S_NGAYXB' => $date,
                'S_LUOTXEM' => 0,
                'S_TAIBAN' => $row[7],
                'S_GIOITHIEU' => $row[8],
                'S_GIA' => 0,
                'S_AVATAR' => $row[9],
            ]);
        }
    }
}
