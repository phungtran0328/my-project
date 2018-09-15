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
        return $this->belongsTo('App\CoverType','LB_MA');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kind_of_book(){
        return $this->belongsTo(KindOfBook::class,'LS_MA');
    }

    public function image(){
        return $this->hasMany('App\Image','S_MA');
    }

    public function publisher(){
        return $this->belongsTo('App\Publisher','NXB_MA');
    }

    public function promotion(){
        return $this->belongsTo('App\Promotion','KM_MA');
    }

    public function order(){
        return $this->belongsToMany('App\Order','dh_chitiet','S_MA','DH_MA')->withPivot('DHCT_SOLUONG','DHCT_GIA');
    }
    //Mặc định quan hệ n-n chỉ thêm khóa chính nên cần withPivot để thêm các cột khác
    public function invoice(){
        return $this->belongsToMany('App\Invoice','hd_chitiet','S_MA','HD_MA')->withPivot('HDCT_SOLUONG','HDCT_GIA');
    }

    public function invoice_in(){
        return $this->belongsToMany('App\InvoiceIn','pn_chitiet','S_MA','PN_MA')->withPivot('PNCT_SOLUONG','PNCT_GIA');
    }

    public function author(){
        return $this->belongsToMany('App\Author','tg_vietsach','S_MA','TG_MA');
    }

    public function translator(){
        return $this->belongsToMany('App\Author','dichsach', 'S_MA', 'TG_MA')->withPivot('DICHGIA');
    }
}
