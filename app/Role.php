<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'quyen';
    protected $primaryKey = 'Q_MA';

    protected $fillable = ['Q_TEN','Q_QUYEN'];

    protected $casts = [
        'Q_QUYEN'=>'array',
    ];

    public function users(){
        return $this->belongsToMany('App\User','phanquyen','Q_MA','NV_MA');
    }

    //Kiểm tra danh sách các quyền được truy cập
    public function hasAccess(array $permissions) : bool
    {
        foreach ($permissions as $permission) {
            if ($this->hasPermission($permission))
                return true;
        }
        return false;
    }

    private function hasPermission(string $permission) : bool
    {
        return $this->Q_QUYEN[$permission] ?? false;
    }
}
