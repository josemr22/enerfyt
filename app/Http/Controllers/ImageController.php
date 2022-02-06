<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function create(Product $product)
    {
        return view('admin.product.images-create',compact('product'));
    }

    public function store(Request $request, Product $product)
    {
        $path = public_path().'/img/products';
        $file = $request->file('file');
        $fileName = time().$file->getClientOriginalName();
        $image = \Image::make($file);
        $image->fit(1200, 1486)->save($path.'/'.$fileName);
        $id=$product->id;
        Image::create(['name'=>$fileName,'product_id'=>$id]);
        $imagenes = $product->images;
        return json_encode($imagenes);
    }

    public function delete(Request $request)
    {

        $path = public_path().'/img/products';
        $id = $request->input('id');
        $image = Image::findOrFail($id);
        $fileName = $image->name;
        $image->delete();
        try {
            unlink($path.'/'.$fileName);
        }catch (\Exception $e){

        }
        return json_encode(['msg'=>'ok']);
    }

    public function galery(){
        return view('admin');
    }
}
