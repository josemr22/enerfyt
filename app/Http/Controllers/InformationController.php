<?php

namespace App\Http\Controllers;

use App\Models\Information;
use Illuminate\Http\Request;

class InformationController extends Controller
{
    //
    public function index(){
        return view('admin.additional.about',['row'=>Information::firstOrFail()]);
    }

    public function update(Request $request, Information $information){
        $oldFileName=$information->about_image;
        $data = $request->validate([
            'about' => ['required'],
            'mision' => ['required'],
            'vision' => ['required'],
        ]);
        $path = public_path().'/img/gallery';
        $fileName=null;
        if($file = $request->file('about_image')){
            $fileName = time().$file->getClientOriginalName();
            $image = \Image::make($file);
            $image->fit(600, 600)->save($path.'/'.$fileName);
        }
        $information->fill([
            'about' => $data['about'],
            'mision' => $data['mision'],
            'vision' => $data['vision'],
        ]);
        if($fileName!=null){
            $information->about_image=$fileName;
            // try {
            //     unlink($path.'/'.$oldFileName);
            // }catch (\Exception $e){

            // }
        }
        $information->save();
        return back();
    }
}
