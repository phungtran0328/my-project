<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'sach'; //Khai báo table nếu không theo quy định đặt tên, nếu Model là Book thì table là books laravel ngầm hiểu
    protected $primaryKey = 'S_MA'; //Mặc định khóa chính sẽ là id, nếu không dùng id thì khai báo

    //Khi định nghĩa quan hệ không nhất thiết có khóa chính vì nó đã được khai báo ở $primaryKey, nhưng cần có khóa ngoại
    //Khi gọi tới relation nhất định không được all() mà phải có điều kiện
    //$a=Book::find(1)
    //$b=$a->kind_of_book()->get() trả về một mảng
    //Khi dùng $b phải foreach

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cover_type(){
        return $this->belongsTo('App\CoverType','LB_MA','S_MA');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kind_of_book(){
        return $this->belongsTo(KindOfBook::class,'LS_MA');
    }

    public function image(){
        return $this->hasMany('App\Image','S_MA','S_MA');
    }

    public function publisher(){
        return $this->belongsTo('App\Publisher','NXB_MA','S_MA');
    }

    public function promotion(){
        return $this->belongsTo('App\Promotion','KM_MA','S_MA');
    }

    public function order(){
        return $this->belongsToMany('App\Order','','S_MA','DH_MA');
    }

    public function invoice(){
        return $this->belongsToMany('App\Invoice','','S_MA','HD_MA');
    }

    public function invoice_in(){
        return $this->belongsToMany('App\InvoiceIn','','S_MA','PN_MA');
    }
}
