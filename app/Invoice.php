<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Invoice extends Model
{
    protected $table = 'hoadon';
    protected $primaryKey = 'HD_MA';
    protected $dates = ['CREATED_AT','UPDATED_AT'];

    public function customer(){
        return $this->belongsTo('App\Customer','KH_MA');
    }

    public function user(){
        return $this->belongsTo('App\User','NV_MA');
    }

    public function book(){
        return $this->belongsToMany('App\Book','hd_chitiet','HD_MA','S_MA')->withPivot('HDCT_SOLUONG','HDCT_GIA');
    }

    public function year(){
        $first = Invoice::orderBy('CREATED_AT','asc')->first();
        $last = Invoice::orderBy('CREATED_AT','desc')->first();
        $first_year = Carbon::createFromFormat('Y-m-d H:i:s',$first->CREATED_AT)->year;
        $last_year = Carbon::createFromFormat('Y-m-d H:i:s',$last->CREATED_AT)->year;
        $data = array();
        $j = 0;
        for ($i=$first_year; $i<=$last_year; $i++){
            $data[$j] = $i;
            $j++;
        }
        return $data;
    }

    //Lấy mảng hóa đơn chi tiết tháng, năm hiện tại, gồm sách, số lượng (sum), giá (sum(sl*giá))
    //gộp số lượng theo mã sách => trong cùng 1 hóa đơn
    public function getSumKindOfBook(int $month, int $year){
        return DB::table('hd_chitiet')
                ->join('hoadon','hd_chitiet.HD_MA','=','hoadon.HD_MA')
                ->select('S_MA',DB::raw('sum(HDCT_SOLUONG) as qty'), DB::raw('sum(HDCT_GIA*HDCT_SOLUONG) as total'))
                ->whereMonth('hoadon.CREATED_AT', $month)
                ->whereYear('hoadon.CREATED_AT', $year)
                ->groupBy('S_MA')
                ->orderBy('qty','desc')
                ->get();
    }

    //khách hàng mua nhiều (qty)
    //gộp qty theo khách hàng trong bảng hóa đơn (desc), tháng, năm hiện tại
    public function getSumCustomer(int $month, int $year){
        $customer = DB::table('hd_chitiet')
            ->join('hoadon','hoadon.HD_MA','=','hd_chitiet.HD_MA')
            ->select('hoadon.KH_MA',DB::raw('sum(HDCT_SOLUONG) as qty'),DB::raw('sum(HDCT_GIA*HDCT_SOLUONG) as total'))
            ->whereMonth('CREATED_AT','=', $month)
            ->whereYear('CREATED_AT','=', $year)
            ->groupBy('hoadon.KH_MA')
            ->orderBy('qty','desc')
            ->get();
        $data = array();
        $e = 0;
        foreach ($customer as $item){
            $temp = Customer::where('KH_MA', $item->KH_MA)->first();
            $data[$e] = [
                'name'=>$temp->KH_TEN,
                'address'=>$temp->fulladdress,
                'phone'=>$temp->KH_SDT,
                'email'=>$temp->KH_EMAIL,
                'qty'=>$item->qty,
                'total'=>$item->total
            ];
            $e++;
        }
        return $data;
    }

    public function getSumBook(int $date, int $month, int $year){
        if ($date!=0){
            $invoices = DB::table('hd_chitiet')
                ->join('hoadon','hd_chitiet.HD_MA','=','hoadon.HD_MA')
                ->select('S_MA',DB::raw('sum(HDCT_SOLUONG) as qty'), DB::raw('sum(HDCT_GIA*HDCT_SOLUONG) as total'))
                ->whereDay('hoadon.CREATED_AT', $date)
                ->whereMonth('hoadon.CREATED_AT', $month)
                ->whereYear('hoadon.CREATED_AT', $year)
                ->groupBy('S_MA')
                ->orderBy('qty','desc')
                ->get();
        }
        else{
            $invoices = DB::table('hd_chitiet')
                ->join('hoadon','hd_chitiet.HD_MA','=','hoadon.HD_MA')
                ->select('S_MA',DB::raw('sum(HDCT_SOLUONG) as qty'), DB::raw('sum(HDCT_GIA*HDCT_SOLUONG) as total'))
                ->whereMonth('hoadon.CREATED_AT', $month)
                ->whereYear('hoadon.CREATED_AT', $year)
                ->groupBy('S_MA')
                ->orderBy('qty','desc')
                ->get();
        }
        $data = array();
        $i = 0;
        foreach ($invoices as $invoice){
            $book = Book::where('S_MA',$invoice->S_MA)->first();
            $data[$i]=[
                'name'=>$book->S_TEN,
                'qty'=>$invoice->qty,
                'price'=>$invoice->total
            ];
            $i++;
        }
        return $data;
    }
}
