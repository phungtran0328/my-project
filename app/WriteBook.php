<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WriteBook extends Model
{
    protected $table = 'tg_vietsach';
    protected $primaryKey = [
        'TG_MA', 'S_MA',
    ];
    public $incrementing=false;
    public $timestamps = false;
}
