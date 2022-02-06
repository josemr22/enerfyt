<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductSize;
use Illuminate\Http\Request;

class ProductSizeController extends Controller
{
    public function index(Product $product)
    {
        //
        return view('admin.product.product-size',compact('product'));
    }

    public function update(Request $request)
    {
        //
        $column = $request->input('column');
        $id = $request->input('id');
        $description = $request->input('description');
        $productSize=ProductSize::find($id);
        if($column=='width'){
            $productSize->update(['width'=>$description]);
            return json_encode(['new'=>$productSize->width]);
        }
        if($column=='for_pants'){
            $productSize->update(['for_pants'=>$description]);
            return json_encode(['new'=>$productSize->for_pants]);
        }
    }
}
