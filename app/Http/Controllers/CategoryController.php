<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories=Category::orderByDesc('created_at')->paginate();
        return view('admin.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $category=new Category;
        return view('admin.category.create', compact('category'));
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
        $data = $request->validate([
            'name' => ['required', 'unique:categories,name']
        ],[
            'name.required' => 'Debe ingresar un nombre para la categoría',
            'name.unique' => 'Ya existe una categoría con el mismo nombre',
        ]);
        $path = public_path().'/img/categories';
        if($file = $request->file('file')){
            $fileName = time().$file->getClientOriginalName();
            $file->move($path, $fileName);
            Category::create([
                'name'=>$data['name'],
                'slug' => Str::slug($data['name']),
                'image'=>$fileName]);
        }
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
        $oldFileName=$category->image;
        $data = $request->validate([
            'name' => ['required', Rule::unique('categories')->ignore($category)]
        ],[
            'name.required' => 'Debe ingresar un nombre para la categoría',
            'name.unique' => 'Ya existe una categoría con el mismo nombre',
        ]);
        $path = public_path().'/img/categories';
        $fileName=null;
        if($file = $request->file('file')){
            $fileName = time().$file->getClientOriginalName();
            $file->move($path, $fileName);
        }
        $category->fill([
            'name' => $data['name'],
            'slug' => Str::slug($data['name']),
        ]);
        if($fileName!=null){
            $category->image=$fileName;
            try {
                unlink($path.'/'.$oldFileName);
            }catch (\Exception $e){

            }
        }
        $category->save();
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
        $category->delete();

        return redirect()->route('categories.index');
    }
}
