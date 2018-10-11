<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'hoadon';
    protected $primaryKey = 'HD_MA';

    public function customer(){
        return $this->belongsTo('App\Customer','KH_MA','HD_MA');
    }

    public function user(){
        return $this->belongsTo('App\User','NV_MA','HD_MA');
    }

    public function book(){
        return $this->belongsToMany('App\Book','hd_chitiet','HD_MA','S_MA')->withPivot('HDCT_SOLUONG','HDCT_GIA');
    }
}
