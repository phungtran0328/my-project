<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class InvoiceIn extends Model
{
    protected $table = 'phieunhap';
    protected $primaryKey = 'PN_MA';
    protected $dates = ['CREATED_AT','UPDATED_AT'];

    public function user(){
        return $this->belongsTo('App\User','NV_MA');
    }

    public function release_company(){
        return $this->belongsTo('App\ReleaseCompany','CTPH_MA');
    }

    public function book(){
        return $this->belongsToMany('App\Book','pn_chitiet','PN_MA','S_MA')->withPivot('PNCT_SOLUONG','PNCT_GIA');
    }

    public function getSumBook(int $month, int $year){
        return DB::table('pn_chitiet')
            ->join('phieunhap','pn_chitiet.PN_MA','=','phieunhap.PN_MA')
            ->select('S_MA',DB::raw('sum(PNCT_SOLUONG) as qty'), DB::raw('sum(PNCT_GIA*PNCT_SOLUONG) as total'))
            ->whereMonth('phieunhap.CREATED_AT', $month)
            ->whereYear('phieunhap.CREATED_AT', $year)
            ->groupBy('S_MA')
            ->orderBy('qty','desc')
            ->get();
    }
}
