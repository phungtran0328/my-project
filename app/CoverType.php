<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoverType extends Model
{
    protected $table = 'loaibia';
    protected $primaryKey = 'LB_MA';

    public function book(){
        return $this->hasMany('App\Book','LB_MA');
    }
}
