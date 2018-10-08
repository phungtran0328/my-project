<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Role extends Model
{
    protected $table = 'phanquyen';
    protected $primaryKey = [
        'Q_MA', 'NV_MA',
    ];
    public $timestamps = false;
}
