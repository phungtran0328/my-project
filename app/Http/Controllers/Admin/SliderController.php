<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 11/14/2018
 * Time: 8:44 AM
 */

namespace app\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class SliderController extends Controller
{
    public function index(){
        $sliders = Slider::paginate(10);
        return view('admin.manage.slider', compact('sliders'));
    }

    public function store(Request $request){
        $images = array();
//        dd($files);
        if ($files=$request->file('sliders')){
            foreach ($files as $file){
                // get name file upload
                $name = $file->getClientOriginalName();
                //save image to public_path
                $destinationPath = public_path('images/slider');
//                dd($destinationPath);
                $file->move($destinationPath,$name);
//                dd($file);
                $images[]=$name;
            }
        }
        $data = array();
        if (!empty($images)){
            for ($i=0;$i<count($images);$i++){
                // lưu tạm vào mảng book_image
                $data[$i]=[
                    'slider' => $images[$i],
                    'name' => $images[$i]
                ];
            }
        }
        Slider::insert($data);
        return redirect()->back()->with('add','Đã thêm slider !');
    }

    public function update(Request $request, $id){
        $slider = Slider::where('id', $id)->first();

        $name = $request->input('name_update');
        $file = $request->file('slider');

        if (isset($file)){
            $path = public_path('images/slider/'.$slider->slider);
            if (File::exists($path)){
                File::delete($path);
            }
            $slider_name = $file->getClientOriginalName();
            $destinationPath = public_path('images/slider');
            $file->move($destinationPath, $slider_name);
            $slider->slider = $slider_name;
        }

        $slider->name = $name;
        $slider->save();
        return redirect()->back()->with('update','Đã cập nhật slider !');
    }

    public function delete($id){
        $slider = Slider::where('id', $id)->first();
        $path = public_path('images/slider/'.$slider->slider);
        if (File::exists($path)){
            File::delete($path);
        }
        $slider->delete();

        return redirect()->back()->with('delete','Đã xóa slider !');
    }
}