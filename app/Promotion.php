<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $table = 'khuyenmai';
    protected $primaryKey = 'KM_MA';
    protected $dates = ['CREATED_AT','UPDATED_AT'];

    public function book(){
        return $this->hasMany('App\Book','KM_MA');
    }
}
