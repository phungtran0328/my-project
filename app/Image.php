<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'hinhanh';
    protected $primaryKey = 'HA_MA';

    public function book(){
        return $this->belongsTo('App\Book','S_MA','HA_MA');
    }
}
