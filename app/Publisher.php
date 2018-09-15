<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    protected $table = 'nhaxuatban';
    protected $primaryKey = 'NXB_MA';

    public function book(){
        return $this->hasMany('App\Book','NXB_MA');
    }
}
