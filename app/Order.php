<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'donhang';
    protected $primaryKey = 'DH_MA';

    public function customer(){
        return $this->belongsTo('App\Customer','KH_MA','DH_MA');
    }

    public function user(){
        return $this->belongsTo('App\User','NV_MA','DH_MA');
    }

    public function book(){
        return $this->belongsToMany('App\Book','','DH_MA','S_MA');
    }
}
