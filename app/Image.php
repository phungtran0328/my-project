<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'hinhanh';
    protected $primaryKey = 'HA_MA';
    protected $fillable = [
        'HA_URL'
    ];
    protected $dates = ['CREATED_AT','UPDATED_AT'];

    public function book(){
        return $this->belongsTo('App\Book','S_MA');
    }
}
