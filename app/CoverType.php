<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoverType extends Model
{
    protected $table = 'loaibia';
    protected $primaryKey = 'LB_MA';
    protected $dates = ['CREATED_AT','UPDATED_AT'];

    public function book(){
        return $this->hasMany('App\Book','LB_MA');
    }
}
