<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $table = 'tacgia';
    protected $primaryKey = 'TG_MA';

    public function book(){
        return $this->belongsToMany('App\Book','tg_vietsach','TG_MA','S_MA');
    }

    public function translate_book(){
        return $this->belongsToMany('App\Book','dichsach','TG_MA','S_MA')->withPivot('DICHGIA');
    }
}
