<?php

namespace App\Http\Controllers;

use App\Models\{Product, Category, Color, Size};
use App\Http\Requests\{CreateProductRequest, UpdateProductRequest};
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        //
        return view('admin.product.index',['view'=>'index']);
    }

    public function table()
    {
        return datatables()
            ->eloquent(Product::with('category')
                ->where('deleted_at',null)
                ->select('products.*'))
            ->addColumn('categoryName', function (Product $product) {
                return $product->category ? $product->category->name : '';
            })
            ->addColumn('actions','admin.product._actions')
            ->rawColumns(['actions'])
            ->toJson();
    }

    public function trashed()
    {
        return view('admin.product.index', [
            'view' => 'trash',
        ]);
    }

    public function trashedTable(){
        return datatables()
            ->eloquent(Product::onlyTrashed()->with('category')->select('products.*'))
            ->addColumn('categoryName', function (Product $product) {
                return $product->category ? $product->category->name : '';
            })
            ->addColumn('actions','admin.product._actions-trash')
            ->rawColumns(['actions'])
            ->toJson();
    }

    public function getProducts(){
        return response()->json(Product::orderBy("name")->get());
    }

    public function create()
    {
        //
        return $this->form('admin.product.create',new Product);
    }

    public function store(CreateProductRequest $request)
    {
        //
        $request->createProduct();

        return response()->json(201);
    }

    // public function show(Product $product)
    // {
    //     //
    //     return view('admin.product.show', compact('product'));
    // }

    public function edit(Product $product)
    {
        //
        return $this->form('admin.product.edit',$product);
    }

    protected function form($view, Product $product)
    {
        return view($view, [
            'categories' => Category::orderBy('name', 'ASC')->get(),
            'product' => $product,
        ]);
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        //
        $request->updateProduct($product);

        return response()->json(202);
    }

    public function trash(Product $product)
    {
        //
        $product->delete();
        return response()->json(204);
    }

    public function restore($id)
    {
        $product = Product::withTrashed()->where('id', '=', $id)->first();

        $product->restore();

        return \Redirect::route( "products.index" )->with("restored" , $id );
    }

    public function destroy($id)
    {
        $product = Product::onlyTrashed()->where('id', $id)->firstOrFail();

        $product->color_product()->delete();
        $product->product_size()->delete();
        $product->forceDelete();
        return json_encode(array("r"=>"OK"));
    }

    public function novelties()
    {
        //
        return view('admin.product.novelties');
    }
}
