<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'donhang';
    protected $primaryKey = 'DH_MA';

    public function customer(){
        return $this->belongsTo('App\Customer','KH_MA');
    }

    public function user(){
        return $this->belongsTo('App\User','NV_MA');
    }

    public function book(){
        return $this->belongsToMany('App\Book','dh_chitiet','DH_MA','S_MA')->withPivot('DHCT_SOLUONG','DHCT_GIA');
    }
}
