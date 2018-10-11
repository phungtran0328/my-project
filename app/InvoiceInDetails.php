<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceInDetails extends Model
{
    protected $table = 'pn_chitiet';
    protected $primaryKey = [
        'S_MA', 'PN_MA',
    ];
//    protected $fillable=['PNCT_SOLUONG','PNCT_GIA'];
    public $timestamps = false;
}
