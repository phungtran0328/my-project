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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $images = array();
        if ($files=$request->file('images')){
            foreach ($files as $file){
                // get name file upload
                $name=$file->getClientOriginalName();
                //save image to public_path
                $destinationPath = public_path('images');
//                dd($destinationPath);
                $file->move($destinationPath,$name);
                $images[]=$name;
            }
        }

        $book_image = array();
        if (!empty($images)){
            for ($i=0;$i<count($images);$i++){
                // lưu tạm vào mảng book_image
                $book_image[]=[
                    'S_MA'=>$request->id,
                    'HA_URL'=>$images[$i]
                ];
            }
        }
//        dd($book_image);

        if (!empty($book_image)){
            //lấy collect image của 1 sách
            $image= Image::where('S_MA',$id)->get();
//            dd(count($image));
//            dd(count($book_image)==count($image) ? 'abc' : 'cbadadada');
            //Nếu tổng số collect image của 1 sách trong csdl bằng với tổng số image khi cập nhật
            //thì update
            if (count($image)==count($book_image)){
                for ($i=0;$i<count($image);$i++){
                    //update không cần hàm save()
                    //find bắt buộc phải thêm fillable trong model
                    //update phần tử thứ i
                    $image[$i]->update(['HA_URL'=>$book_image[$i]['HA_URL']]);
                }
            }
            //Ngược lại nếu không bằng thì xóa image của sách trước đó
            //Rồi thêm mới lại
            else{
                for ($i=0;$i<count($image);$i++){
                    //xóa hết record với điều kiện mã bằng $book_image[0]['S_MA']
                    Image::where('S_MA',$id)->delete();
                }
                //đã xóa $image nên phải count($book_image)
                for ($i=0;$i<count($book_image);$i++){
                    //lưu từng phần tử của book_image vào database
                    $image_add=new Image();
                    $image_add->S_MA=$book_image[$i]['S_MA'];
                    $image_add->HA_URL=$book_image[$i]['HA_URL'];
                    $image_add->save();
                }
            }
        }
        //$images = implode('|', $images); lưu mảng vào 1 trường duy nhất cách nhau dấu |
        //implode('separated',array)

        return redirect()->back()->with('messUpdateImage','Cập nhật hình ảnh thành công !');
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
