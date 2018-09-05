<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceDetails extends Model
{
    protected $table = 'hd_chitiet';
    protected $primaryKey = [
        'S_MA', 'HD_MA',
    ];

    public $timestamps = false;
}
