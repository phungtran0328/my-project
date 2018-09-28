<?php

namespace App\Http\Controllers\Admin;

use App\Book;
use App\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $books = Book::all();
        return view('admin.book.create_image', compact('books'));
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
            'book'=>'required',
//            'images'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ],[
            'book.required'=>'Vui lòng chọn sách !',
//            'images.required'=>'Vui lòng chọn hình ảnh !',
//            'images.image'=>'Vui lòng chọn hình !',
//            'images.mines'=>'Định dạng không đúng !',
//            'images.max'=>'Dung lượng tối đa 2MB !'
        ]);
        $images = array();
//        dd($files);
        if ($files=$request->file('images')){
            foreach ($files as $file){
                // get name file upload
                $name=$file->getClientOriginalName();
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
                    'S_MA'=>$request->book,
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
        //$images = implode('|', $image); lưu mảng vào 1 trường duy nhất cách nhau dấu |
        //Image::insert($book_image); bị lỗi updated_at nên không xài được
        return redirect('admin/book')->with('messAddImage','Cập nhật hình ảnh thành công !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
}
