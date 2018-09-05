<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    protected $table = 'dh_chitiet';
    protected $primaryKey = [
        'S_MA', 'DH_MA',
    ];
    public $timestamps = false;
}
