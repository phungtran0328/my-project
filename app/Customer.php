<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 08/29/2018
 * Time: 12:36 PM
 */

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use Notifiable;

    protected $table = 'khachhang';
    protected $primaryKey = 'KH_MA';
    protected $guarded = 'customer';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    /*protected $fillable = [
        'name', 'email', 'password',
    ];*/

    protected $fillable = [
        'KH_TEN', 'KH_GIOITINH', 'KH_NGAYSINH', 'KH_DIACHI', 'KH_SDT', 'KH_EMAIL', 'KH_MATKHAU',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function order(){
        return $this->hasMany('App\Order','KH_MA','KH_MA');
    }

    public function invoice(){
        return $this->hasMany('App\Invoice','KH_MA','KH_MA');
    }
}