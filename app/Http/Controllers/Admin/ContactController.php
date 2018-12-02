<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 12/02/2018
 * Time: 10:40 AM
 */

namespace app\Http\Controllers\Admin;

use App\Contact;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function index(){
        $contacts = Contact::orderBy('id','desc')->paginate(10);
        return view('admin.manage.contact.contact', compact('contacts'));
    }

    public function delete($id){
        Contact::where('id',$id)->delete();
        return redirect()->back()->with('remove','Đã xóa yêu cầu !');
    }
}