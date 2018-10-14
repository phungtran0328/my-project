<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 08/29/2018
 * Time: 12:36 PM
 */

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use Notifiable;

    protected $table = 'khachhang';
    protected $primaryKey = 'KH_MA';
    protected $guarded = 'customer';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    /*protected $fillable = [
        'name', 'email', 'password',
    ];*/

    protected $fillable = [
        'KH_MA','KH_TEN', 'KH_GIOITINH', 'KH_NGAYSINH', 'KH_DIACHI', 'KH_SDT', 'KH_EMAIL', 'KH_MATKHAU',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'KH_MATKHAU', 'remember_token',
    ];

    protected $appends = ['full_address']; //Được trường mới 'full_address'

    public function getAuthPassword()
    {
        //bắt buộc phải có vì tên trường không phải là 'password'
        return $this->KH_MATKHAU;
    }

    /**
     * @return string
     */
    public function getFullAddressAttribute(){
        $city = new Customer();
        $cities=$city->getCity();
        $keys=array_keys($cities);
        $values=array_values($cities);
        for ($i=0;$i<count($cities);$i++){
            if ($this->attributes['KH_DIACHI2']==$keys[$i]){
                $name=$values[$i];
            }
        }
        return $this->attributes['KH_DIACHI'] . $name;
    }
    //Nối chuỗi địa chỉ với địa chỉ 2 (thành phố - để dành xét phí vận chuyển)

    public function order(){
        return $this->hasMany('App\Order','KH_MA','KH_MA');
    }

    public function invoice(){
        return $this->hasMany('App\Invoice','KH_MA','KH_MA');
    }

    public function getCity(){
        $cities=array(
            'AG'=>' An Giang', 'BR_VT'=>' Bà Rịa - Vũng Tàu', 'BG'=>' Bắc Giang', 'BK'=>' Bắc Kạn', 'BL'=>' Bạc Liêu',
            'BN'=>' Bắc Ninh','BT'=>' Bến Tre', 'BĐ'=>' Bình Định', 'BD'=>' Bình Dương', 'BP'=>' Bình Phước',
            'BThuan'=>' Bình Thuận', 'CM'=>' Cà Mau','CB'=>' Cao Bằng', 'ĐL'=>' Đắk Lắk', 'ĐN'=>' Đắk Nông',
            'ĐB'=>' Điện Biên', 'ĐNai'=>' Đồng Nai', 'ĐT'=>' Đồng Tháp', 'GL'=>' Gia Lai', 'HG'=>' Hà Giang',
            'HN'=>' Hà Nam', 'HT'=>' Hà Tĩnh', 'HD'=>' Hải Dương', 'HGiang'=>' Hậu Giang','HB'=>' Hòa Bình',
            'HY'=>' Hưng Yên', 'KH'=>' Khánh Hòa', 'KG'=>' Kiên Giang', 'KT'=>' Kon Tum', 'LC'=>' Lai Châu',
            'LĐ'=>' Lâm Đồng', 'LS'=>' Lạng Sơn', 'LCai'=>' Lào Cai', 'LA'=>' Long An', 'NĐ'=>' Nam Định',
            'NA'=>' Nghệ An', 'NB'=>' Ninh Bình', 'NT'=>' Ninh Thuận', 'PT'=>' Phú Thọ', 'QB'=>' Quảng Bình',
            'QN'=>' Quảng Nam', 'QNgai'=>' Quảng Ngãi', 'QNinh'=>' Quảng Ninh', 'QT'=>' Quảng Trị',
            'ST'=>' Sóc Trăng', 'SL'=>' Sơn La', 'TN'=>' Tây Ninh', 'TB'=>' Thái Bình', 'TNguyen'=>' Thái Nguyên',
            'TH'=>' Thanh Hóa', 'TTH'=>' Thừa Thiên Huế', 'TV'=>' Trà Vinh', 'TG'=>' Tiền Giang',
            'TQ'=>' Tuyên Quang', 'VL'=>' Vĩnh Long', 'VP'=>' Vĩnh Phúc', 'YB'=>' Yên Bái', 'PY'=>' Phú Yên',
            'CT'=>' Cần Thơ', 'ĐNang'=>' Đà Nẵng', 'HP'=>' Hải Phòng', 'HNoi'=>' Hà Nội', 'HCM'=>' TP Hồ Chí Minh'
        );
        return $cities;
    }
}