<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'phanquyen';
    protected $primaryKey = [
        'LTK_MA', 'NV_MA',
    ];
    public $timestamps = false;
}
