<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 08/29/2018
 * Time: 12:36 PM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'khachhang';
    protected $primaryKey = 'KH_MA';

    public function order(){
        return $this->hasMany('App\Order','KH_MA','KH_MA');
    }

    public function invoice(){
        return $this->hasMany('App\Invoice','KH_MA','KH_MA');
    }
}