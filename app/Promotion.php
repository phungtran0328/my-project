<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $table = 'khuyenmai';
    protected $primaryKey = 'KM_MA';

    public function book(){
        return $this->hasMany('App\Book','KM_MA');
    }
}
