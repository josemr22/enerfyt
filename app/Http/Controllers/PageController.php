<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Service;
use App\Models\CategoryPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\{Category, Destination, Gallery, Information, Product, Slider};

class PageController extends Controller
{
    public function services()
    {
        //
        $categories=Category::all();
        $services = Service::orderBy('title')->get();
        return view('page.services',compact('categories','services'));
    }
    
    //
    public function index()
    {
        //
        $destacated=Product::orderBy('created_at')->where('featured',true)->limit(8)->get();
        $categories=Category::all();
        $sliders = Slider::orderByDesc('created_at')->limit(3)->get();
        $galleries = Gallery::orderByDesc('created_at')->get();
        $services = Service::orderBy('title')->get();
        $typeMessage = 'appointment';
        return view('page.index',compact('destacated','categories','sliders','galleries','services','typeMessage'));
    }

    public function showdetail(Product $product)
    {
        //
        $category=$product->category->id;
        $relatedProducts=Product::orderByDesc('created_at')->where('category_id', '=', $category)->where('id','!=',$product->id)->limit(8)->get();
        $categories=Category::all();
        return view('page.product-detail',compact('product','relatedProducts','categories'));
    }

    public function catalog(Category $category)
    {
        //
        $products = Product::where('category_id',$category->id)->orderBy('name')->paginate(16);
        $title=$category->name;
        $categories=Category::all();
        return view('page.catalog',compact('products','title','categories'));
    }

    public function allCatalog()
    {
        //
        $categories=Category::all();
        return view('page.all-catalog',compact('categories'));
    }

    public function about()
    {
        //
        $categories=Category::all();
        $about=Information::firstOrFail();
        return view('page.about',['categories'=>$categories,'about'=>$about]);
    }

    public function contact()
    {
        //
        $categories=Category::all();
        $typeMessage='message';
        return view('page.contact',compact('categories','typeMessage'));
    }

    public function blog(){
        $categories=Category::all();
        return view('page.blog',compact('categories'));
    }

    public function blogSingle(Post $post){
        $category=null;
        $categories=Category::all();
        $categoryPosts=CategoryPost::all();
        $products=Product::orderBy('created_at')
            ->where('featured',true)
            ->limit(3)
            ->get();
        return view('page.blog-single',compact('post','categories','categoryPosts','category','products'));
    }

    public function destinations()
    {
        $destinations = Destination::orderBy("name")->get();
        return response()->json($destinations);
    }

    public function myCart(){
        $categories=Category::all();
        $destinations=Destination::all();
        return view('page.finalize',compact('categories','destinations'));
    }
}
