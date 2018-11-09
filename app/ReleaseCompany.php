<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReleaseCompany extends Model
{
    protected $table = 'ctphathanh';
    protected $primaryKey = 'CTPH_MA';
    protected $dates = ['CREATED_AT','UPDATED_AT'];

    public function invoice_in(){
        return $this->hasMany('App\InvoiceIn','CTPH_MA');
    }
}
