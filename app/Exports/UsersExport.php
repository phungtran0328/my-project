<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

class UsersExport implements FromQuery
{
    use Exportable;

    public function query()
    {
        return User::query();
    }

    public function map($user):array
    {
        if (strlen($user->NV_MATKHAU) < 60){
            $username = $user->TENDANGNHAP;
            $password = $user->NV_MATKHAU;
        }else{
            $username = '';
            $password = '';
        }
        return [
            $username,
            $password
        ];
    }
}
