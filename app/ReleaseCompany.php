<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReleaseCompany extends Model
{
    protected $table = 'ctphathanh';
    protected $primaryKey = 'CTPH_MA';

    public function invoice_in(){
        return $this->hasMany('App\InvoiceIn','CTPH_MA');
    }
}
