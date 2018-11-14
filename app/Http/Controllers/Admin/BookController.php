<?php

namespace App\Http\Controllers\Admin;

use App\Author;
use App\Book;
use App\CoverType;
use App\Image;
use App\InvoiceDetails;
use App\InvoiceInDetails;
use App\KindOfBook;
use App\OrderDetails;
use App\Promotion;
use App\Publisher;
use App\Translator;
use App\WriteBook;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search=$request->input('search');
        if (isset($search)){
            $books=Book::where('S_TEN','like','%'.$search.'%')
                ->orderBy('S_MA','desc')->paginate(10);
        }
        else{
            $books=Book::orderBy('S_MA','desc')->paginate(10);
        }
        //sắp xếp S_MA giảm dần lấy 10 record trên 1 trang
        return view('admin.book.book', compact('books','search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $publishers = Publisher::all();
        $promotions = Promotion::all();
        $coverTypes = CoverType::all();
        $kindOfBooks = KindOfBook::all();
        $authors = Author::all();
//        $publisher_name=$publishers->pluck('NXB_TEN')->all();
//        $publisher_id=$publishers->pluck('NXB_MA')->all();
        //dd($publisher_id);
        return view('admin.book.create_book', compact('publishers','promotions','coverTypes','kindOfBooks','authors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'publish_date'=>'required',
            'publisher'=>'required',
            'coverType'=>'required',
            'kindOfBook'=>'required',
            'author'=>'required',

        ],
            [
                'name.required'=>'Vui lòng nhập tên sách !',
                'publish_date.required'=>'Vui lòng nhập ngày xuất bản !',
                'publisher.required'=>'Vui lòng chọn nhà xuất bản !',
                'coverType.required'=>'Vui lòng chọn loại bìa !',
                'kindOfBook.required'=>'Vui lòng chọn loại sách !',
                'author.required'=>'Vui lòng chọn tác giả !',
            ]);
        $avatar = $request->file('avatar'); //Lấy file avatar
        $avatar_name = $avatar->getClientOriginalName(); //lấy name
        $avatar_path = public_path('images\avatar'); //lấy đường dẫn lưu images\avatar
        $avatar->move($avatar_path, $avatar_name); //di chuyển file avatar vào thư mục images

        $book = new Book();
        $book->KM_MA = $request->input('promotion');
        $book->NXB_MA = $request->input('publisher');
        $book->LS_MA = $request->input('kindOfBook');
        $book->LB_MA = $request->input('coverType');
        $book->S_TEN = $request->input('name');
        $book->S_SLTON = 0;
        $book->S_KICHTHUOC = $request->input('size');
        $book->S_SOTRANG = $request->input('page_num');
        $book->S_NGAYXB = $request->input('publish_date');
        $book->S_LUOTXEM = 0;
        $book->S_TAIBAN = $request->input('republish');
        $book->S_GIOITHIEU = $request->input('description');
        $book->S_GIA = 0;
        $book->S_AVATAR = $avatar_name;
        $book->save();

        $data = array();
        $authors = $request->input('author'); //lưu mảng giá trị chọn author
        $translator = $request->input('translator');
        if (!is_null($translator)){
            for ($i=0;$i<count($authors);$i++){
                $data[] = [
                    'S_MA'=>$book->S_MA,
                    'TG_MA'=>$authors[$i],
                    'DICHGIA'=>$translator
                ];
            }
            Translator::insert($data);
        }else{
            for ($i=0;$i<count($authors);$i++){
                $data[]=[
                    'S_MA'=>$book->S_MA,
                    'TG_MA'=>$authors[$i]
                ];
            }
            WriteBook::insert($data);
        }

        $images = array();
//        dd($files);
        if ($files=$request->file('images')){
            foreach ($files as $file){
                // get name file upload
                $name = $file->getClientOriginalName();
//                dd($name);
                //save image to public_path
                $destinationPath = public_path('images');
//                dd($destinationPath);
                $file->move($destinationPath,$name);
//                dd($file);
                $images[]=$name;
            }
        }
        //
        $book_image = array();
        if (!empty($images)){
            for ($i=0;$i<count($images);$i++){
                // lưu tạm vào mảng book_image
                $book_image[]=[
                    'S_MA'=>$book->S_MA,
                    'HA_URL'=>$images[$i],
                ];
            }
        }
        for ($i=0;$i<count($book_image);$i++){
            //lưu từng phần tử của book_image vào database
            $image_add=new Image();
            $image_add->S_MA=$book_image[$i]['S_MA'];
            $image_add->HA_URL=$book_image[$i]['HA_URL'];
            $image_add->save();
        }

        return redirect('/admin/book')->with('messAddBook','Thêm sách thành công !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::where('S_MA',$id)->first();

        return view('admin.book.update_book',compact('book','avatar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name'=>'required',
            'publisher'=>'required',
            'kindOfBook'=>'required',
            'coverType'=>'required',
            'publish_date'=>'before:today',
        ],[
            'name.required'=>'Vui lòng nhập tên sách !',
            'publisher.required'=>'Vui lòng chọn nhà xuất bản !',
            'kindOfBook.required'=>'Vui lòng chọn loại sách !',
            'coverType.required'=>'Vui lòng chọn loại bìa !',
            'publish_date.before'=>'Ngày xuất bản không lớn hơn hôm nay !',
        ]);
        $book=Book::where('S_MA',$id)->first();
        $avatar = $request->file('avatar'); //Lấy file avatar

        if (isset($avatar)){
            $path = public_path('images/avatar/'.$book->S_AVATAR);
            if (File::exists($path)){
                File::delete($path);
            }
            $avatar_name = $avatar->getClientOriginalName(); //lấy name
            $avatar_path = public_path('images/avatar'); //lấy đường dẫn lưu images\avatar
            $avatar->move($avatar_path, $avatar_name); //di chuyển file avatar vào thư mục images
            $book->S_AVATAR = $avatar_name;
        }

        $book->S_TEN=$request->name;
        $book->NXB_MA=$request->publisher;
        $book->LS_MA=$request->kindOfBook;
        $book->LB_MA=$request->coverType;
        $book->KM_MA=$request->promotion;
        $book->S_NGAYXB=$request->publish_date;
        $book->S_TAIBAN=$request->republish;
        $book->S_KICHTHUOC=$request->size;
        $book->S_SOTRANG=$request->page_num;
        $book->S_GIOITHIEU=$request->description;

        if ($book->save()){
            return redirect('admin/book')->with('messUpdateBook','Đã cập nhật sách: "'.$book->S_TEN.'" !');
        }
        else {
            return redirect()->back()->with('messUpdateBookError','Cập nhật không thành công !');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function delete($id){
        $books=Book::where('S_MA',$id)->first();
        $authors=$books->author()->get();
        $trans=$books->translator()->get();
        $image=$books->image()->get();
        $order = $books->order()->first();
        $invoice_in = $books->invoice_in()->first();

        if (isset($order) or (isset($invoice_in))){
            return redirect()->back()->with('messDeleteError','Không thể xóa, vì tồn tại sách trong đơn hàng và phiếu nhập !');
        }
        if (isset($authors)){
            WriteBook::where('S_MA',$id)->delete();
        }
        if (isset($trans)){
            Translator::where('S_MA',$id)->delete();
        }
        if (isset($image)){
            foreach ($image as $item){
                $path = public_path('images/'.$item->HA_URL); //Xóa hình ảnh trong thư mục public/images
                File::delete($path);
            }
            Image::where('S_MA',$id)->delete(); //Xóa dữ liệu hình ảnh trong database
        }

        $avatar_path = public_path('images/avatar/'.$books->S_AVATAR);
        if (File::exists($avatar_path)){
            File::delete($avatar_path);
        }

        $books->delete();
        return redirect()->back()->with('messDelete','Đã xóa sách với ID: '.$id.' !');
    }

}
