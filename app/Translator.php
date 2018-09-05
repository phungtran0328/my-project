<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Translator extends Model
{
    protected $table = 'dichsach';

    protected $primaryKey = [
        'TG_MA', 'S_MA',
    ];
    public $timestamps = false;
}
