<?php

namespace App\Imports;

use App\Book;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BooksImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $file = "D:/LuanVan/image/".$row['avatar'];
        $path = "D:/LuanVan/htdocs/bookstore/public/images/avatar/".$row['avatar'];
        rename($file,$path);
        return new Book([
            'KM_MA' => $row['km_ma'],
            'NXB_MA' => $row['nxb_ma'],
            'LS_MA' => $row['ls_ma'],
            'LB_MA' => $row['lb_ma'],
            'S_TEN' => $row['name'],
            'S_SLTON' => 0,
            'S_KICHTHUOC' => $row['size'],
            'S_SOTRANG' => $row['page_number'],
            'S_NGAYXB' => $row['publish_date'],
            'S_LUOTXEM' => 0,
            'S_TAIBAN' => $row['republish'],
            'S_GIOITHIEU' => $row['review'],
            'S_GIA' => 0,
            'S_AVATAR' => $row['avatar'],
        ]);
        /*foreach ($row as $item){
            $book = new Book();
            $book->KM_MA = $item['km_ma'];
            $book->NXB_MA = $item['nxb_ma'];
            $book->LS_MA = $item['ls_ma'];
            $book->LB_MA = $item['lb_ma'];
            $book->S_TEN = $item['name'];
            $book->S_SLTON = 0;
            $book->S_KICHTHUOC = $item['size'];
            $book->S_SOTRANG = $item['page_number'];
            $book->S_NGAYXB = $item['publish_date'];
            $book->S_LUOTXEM = 0;
            $book->S_TAIBAN = $item['republish'];
            $book->S_GIOITHIEU = $item['review'];
            $book->S_GIA = 0;
            $book->S_AVATAR = $item['avatar'];
            $book->save();

        }*/
    }
}
