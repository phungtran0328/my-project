<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KindOfAccount extends Model
{
    protected $table = 'loaitaikhoan';
    protected $primaryKey = 'LTK_MA';

    public function user(){
        return $this->hasMany('App\User','LTK_MA','LTK_MA');
    }
}
