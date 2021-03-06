<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'nhanvien';
    protected $primaryKey = 'NV_MA';
    protected $dates = ['CREATED_AT','UPDATED_AT'];

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
        'NV_MATKHAU', 'remember_token',
    ];

    public function getAuthPassword()
    {
        //bắt buộc phải có vì tên trường không phải là 'password'
        return $this->NV_MATKHAU;
    }

    public function invoice_in(){
        return $this->hasMany('App\InvoiceIn','NV_MA','NV_MA');
    }

    public function roles(){
        return $this->belongsToMany('App\Role','phanquyen','NV_MA','Q_MA');
    }
    //column 1: tên bảng kết nối, c2: bảng được sinh ra do n-n
    //c3: khóa chính của model (User), c4: khóa chính của function đang định nghĩa (kind_of_account)

    public function invoice(){
        return $this->hasMany('App\Invoice','NV_MA','NV_MA');
    }

    public function order(){
        return $this->hasMany('App\Order','NV_MA','NV_MA');
    }

    /**
     * Checks if User has access to $permissions.
     * @param array $permissions
     * @return bool
     */
    public function hasAccess(array $permissions) : bool
    {
        // check if the permission is available in any role
        foreach ($this->roles as $role) {
            if($role->hasAccess($permissions)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Checks if the user belongs to role.
     * @param string $roleSlug
     * @return bool
     */
    public function inRole(string $roleSlug)
    {
        return $this->roles()->where('Q_TEN', $roleSlug)->count() == 1;
    }
}
