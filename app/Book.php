<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'sach';
    protected $primaryKey = 'S_MA';

    public function cover_type(){
        return $this->belongsTo('App\CoverType','LB_MA','S_MA');
    }

    public function kind_of_book(){
        return $this->belongsTo('App\KindOfBook','LS_MA','S_MA');
    }

    public function image(){
        return $this->hasMany('App\Image','S_MA','S_MA');
    }

    public function publisher(){
        return $this->belongsTo('App\Publisher','NXB_MA','S_MA');
    }

    public function promotion(){
        return $this->belongsTo('App\Promotion','KM_MA','S_MA');
    }

    public function order(){
        return $this->belongsToMany('App\Order','','S_MA','DH_MA');
    }

    public function invoice(){
        return $this->belongsToMany('App\Invoice','','S_MA','HD_MA');
    }

    public function invoice_in(){
        return $this->belongsToMany('App\InvoiceIn','','S_MA','PN_MA');
    }
}
