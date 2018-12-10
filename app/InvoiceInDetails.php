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
    protected $fillable=['S_MA','PN_MA','PNCT_SOLUONG','PNCT_GIA'];
}
