<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 12/02/2018
 * Time: 9:20 AM
 */

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function indexRequest(){
        return view('page.contact.request');
    }

    public function storeRequest(Request $request){
        $email = $request->input('email');
        $title = $request->input('title');
        $content = $request->input('content');
        $order_id = $request->input('order_id');
        $contact = new Contact();
        $contact->email = $email;
        $contact->title = $title;
        $contact->content = $content;
        $contact->order_id = $order_id;
        $contact->time = date('Y-m-d H:i:s');
        $contact->save();
        return redirect()->back()->with('success','Đã gửi yêu cầu !');
    }
}