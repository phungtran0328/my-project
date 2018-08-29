<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceIn extends Model
{
    protected $table = 'phieunhap';
    protected $primaryKey = 'PN_MA';

    public function user(){
        return $this->belongsTo('App\User','NV_MA','PN_MA');
    }

    public function release_company(){
        return $this->belongsTo('App\ReleaseCompany','CTPH_MA','PN_MA');
    }

    public function book(){
        return $this->belongsToMany('App\Book','','PN_MA','S_MA');
    }
}
