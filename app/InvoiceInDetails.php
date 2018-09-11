<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceInDetails extends Model
{
    protected $table = 'pn_chitiet';
    protected $primaryKey = [
        'S_MA', 'PN_MA',
    ];

    public $timestamps = false;
}