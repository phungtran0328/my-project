<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KindOfBook extends Model
{
    protected $table = 'loaisach';
    protected $primaryKey = 'LS_MA';
    protected $dates = ['CREATED_AT','UPDATED_AT'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function book(){
        return $this->hasMany(Book::class, 'LS_MA');
    }
    //c1: tên model của function cần, c2: khóa ngoại, c3: khóa chính
}
