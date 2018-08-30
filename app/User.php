<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'nhanvien';
    protected $primaryKey = 'NV_MA';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    /*protected $fillable = [
        'name', 'email', 'password',
    ];*/

    protected $fillable = [
        'NV_TEN', 'NV_GIOITINH', 'NV_NGAYSINH', 'NV_DIACHI', 'NV_SDT', 'NV_TENDANGNHAP', 'NV_MATKHAU',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function invoice_in(){
        return $this->hasMany('App\InvoiceIn','NV_MA','NV_MA');
    }

    public function kind_of_account(){
        return $this->belongsTo('App\KindOfAccount','LTK_MA','NV_MA');
    }

    public function invoice(){
        return $this->hasMany('App\Invoice','NV_MA','NV_MA');
    }

    public function order(){
        return $this->hasMany('App\Order','NV_MA','NV_MA');
    }
}
