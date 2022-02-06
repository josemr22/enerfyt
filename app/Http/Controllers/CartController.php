<?php

namespace App\Http\Controllers;

use App\Models\{Product,Color,Size,Category};
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    //
    public function index()
    {
        $cart = Cart::content();
        return response()->json($cart);
    }

    public function store(Request $request)
    {
        $productId = $request->input('id');
        $quantity = $request->input('quantity');
        $product=Product::findOrFail($productId);
        $accumulatedProductQuantity = $quantity;
       
        foreach (Cart::content() as $value) {
            if($value->id==$product->id){
                $accumulatedProductQuantity+=intval($value->qty);
                continue;
            }
        }
        if($accumulatedProductQuantity>$product->stock){
            return response()->json(["status"=>"error", "msg"=>"Stock insuficiente"]);
        }

        $image = count($product->images)>0 ? $product->images[0]->name : 'without-image.jpg';
        Cart::add($product,$quantity,['code'=>$product->code,'image'=>$image]);
        $cart = Cart::content();
        return response()->json(["status"=>"Ok", "msg"=>$cart]);
    }


    public function delete(Request $request){
        $rowId = $request->input('rowId');
        Cart::remove($rowId);
        $cart = Cart::content();
        return response()->json($cart);
    }
}
