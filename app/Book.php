<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'sach'; //Khai báo table nếu không theo quy định đặt tên, nếu Model là Book thì table là books laravel ngầm hiểu
    protected $primaryKey = 'S_MA'; //Mặc định khóa chính sẽ là id, nếu không dùng id thì khai báo
    protected $dates = ['CREATED_AT','UPDATED_AT'];
    protected $fillable = ['KM_MA','NXB_MA','LS_MA','LB_MA','S_TEN','S_SLTON',
        'S_KICHTHUOC','S_SOTRANG','S_NGAYXB','S_LUOTXEM','S_TAIBAN','S_GIOITHIEU','S_GIA','S_AVATAR'];
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

    public function getBookPromotion($id){
        $book = Book::where('S_MA', $id)->first();
        $date = strtotime(date('Y-m-d H:i:s'));
        $image = $book->S_AVATAR;
        $promotion = $book->promotion()->first();
        if (isset($promotion)){
            $start = strtotime($promotion->KM_APDUNG);
            $temp_end = $promotion->KM_HANDUNG; // Số ngày áp dụng
            if ($temp_end>1){
                $end = strtotime("+".$temp_end." days", $start); //Lấy ngày áp dụng + số ngày áp dụng
            }
            else{
                $end = strtotime("+".$temp_end." day", $start);
            }
            if (($start<=$date) and ($date<=$end)){
                return $results = array(
                    'id'=>$id,
                    'name'=>$book->S_TEN,
                    'price'=>$book->S_GIA,
                    'image'=>$image,
                    'in_stock'=>$book->S_SLTON,
                    'sale'=>($book->S_GIA)*(1-$promotion->KM_GIAM));
            }else{
                return $results = array(
                    'id'=>$id,
                    'name'=>$book->S_TEN,
                    'price'=>$book->S_GIA,
                    'image'=>$image,
                    'in_stock'=>$book->S_SLTON,
                );
            }
        }else{
            return $results = array(
                'id'=>$id,
                'name'=>$book->S_TEN,
                'price'=>$book->S_GIA,
                'image'=>$image,
                'in_stock'=>$book->S_SLTON,
            );
        }
    }

    public function getKindOfBook(array $ids_book, $id){
//        $ids_book = array('id'=>..., 'name'=>....)
        $i = 0 ;
        $data = array();
        foreach ($ids_book as $item){
            $book = Book::where('S_MA', $item['id'])->first();
            if ($book->LS_MA == $id){
                $data[$i] = [
                    'id'=>$item['id'],
                    'name'=>$book->S_TEN,
                    'price'=>$book->S_GIA
                ];
                $i++;
            }
        }
        return $data;
    }
}
