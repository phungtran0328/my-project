<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceIn extends Model
{
    protected $table = 'phieunhap';
    protected $primaryKey = 'PN_MA';
    protected $dates = ['CREATED_AT','UPDATED_AT'];

    public function user(){
        return $this->belongsTo('App\User','NV_MA');
    }

    public function release_company(){
        return $this->belongsTo('App\ReleaseCompany','CTPH_MA');
    }

    public function book(){
        return $this->belongsToMany('App\Book','pn_chitiet','PN_MA','S_MA')->withPivot('PNCT_SOLUONG','PNCT_GIA');
    }
}
