<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KindOfAccount extends Model
{
    protected $table = 'loaitaikhoan';
    protected $primaryKey = 'LTK_MA';

    public function user(){
        return $this->belongsToMany('App\User','phanquyen','LTK_MA','NV_MA');
    }
}
