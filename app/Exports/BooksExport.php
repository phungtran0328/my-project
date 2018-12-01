<?php

namespace App\Exports;

use App\Book;
use App\CoverType;
use App\KindOfBook;
use App\Promotion;
use App\Publisher;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BooksExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    public function headings(): array
    {
        // TODO: Implement headings() method.
        return [
            '#',
            'KM_MA',
            'NXB_MA',
            'LS_MA',
            'LB_MA',
            'Tên sách',
            'SLT',
            'Kích thước',
            'Số trang',
            'Ngày XB',
            'Lượt xem',
            'Tái bản',
            'Giới thiệu',
            'Giá',
            'Avatar',
            'Created',
            'Updated'
        ];
    }

    public function query()
    {
        return Book::query();
    }

    /**
     * @var Book $book
     */
    public function map($book): array
    {
        $temp_promotion = Promotion::where('KM_MA',$book->KM_MA)->first();
        if (isset($temp_promotion)){
            $promotion = $temp_promotion->KM_CHITIET;
        }else{
            $promotion = '';
        }
        $publisher = Publisher::where('NXB_MA',$book->NXB_MA)->first();
        $type = CoverType::where('LB_MA', $book->LB_MA)->first();
        $kind = KindOfBook::where('LS_MA',$book->LS_MA)->first();
        return [
            $book->S_MA,
            $promotion,
            $publisher->NXB_TEN,
            $kind->LS_TEN,
            $type->LB_TEN,
            $book->S_TEN,
            $book->S_SLTON,
            $book->S_KICHTHUOC,
            $book->S_SOTRANG,
            $book->S_NGAYXB,
            $book->S_LUOTXEM,
            $book->S_TAIBAN,
            $book->S_GIOITHIEU,
            $book->S_GIA,
            $book->S_AVATAR,
            $book->CREATED_AT,
            $book->UPDATED_AT
        ];
    }
}
