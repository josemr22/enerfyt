<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    //
    public function index()
    {
        //
        $sliders = Slider::orderByDesc('created_at')->get();
        return view('admin.slider.index',['sliders'=>$sliders]);
    }

    public function create(){
        $slider = new Slider();
        return view('admin.slider.create',compact('slider'));
    }

    public function edit(Slider $slider){
        return view('admin.slider.edit',compact('slider'));
    }

    public function store(Request $request){
        $slider = new Slider();
        $slider->header=$request->get('header');
        $slider->title=$request->get('title');
        $slider->button_title=$request->get('button_title');
        $slider->button_url=$request->get('button_url');
        $oldFileName=$slider->image;
        if($request->image!=null){
            $fileName=time().$request->image->getClientOriginalName();
            \Image::make($request->file('image'))->resize(1920, 930)->save(public_path().'/img/sliders/'.$fileName);
            try {
                unlink(public_path().'/img/sliders/'.$oldFileName);
            }catch (\Exception $e){

            }
            $slider->image=$fileName;
        }
        $slider->save();
        return back()->with('success','Acción Realizada Correctamente');
    }

    public function update(Slider $slider, Request $request){
        $slider->header=$request->get('header');
        $slider->title=$request->get('title');
        $slider->button_title=$request->get('button_title');
        $slider->button_url=$request->get('button_url');
        $oldFileName=$slider->image;
        if($request->image!=null){
            $fileName=time().$request->image->getClientOriginalName();
            \Image::make($request->file('image'))->resize(1920, 930)->save(public_path().'/img/sliders/'.$fileName);
            try {
                unlink(public_path().'/img/sliders/'.$oldFileName);
            }catch (\Exception $e){

            }
            $slider->image=$fileName;
        }
        $slider->save();
        return back()->with('success','Acción Realizada Correctamente');
    }

    public function destroy(Slider $slider){
        $slider->delete();
        return back()->with('success','Acción Realizada Correctamente');
    }
}
