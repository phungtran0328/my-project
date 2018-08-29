<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KindOfBook extends Model
{
    protected $table = 'loaisach';
    protected $primaryKey = 'LS_MA';

    public function book(){
        return $this->hasMany('App\Book','LS_MA','LS_MA');
    }
}
