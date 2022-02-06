<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryPost;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    //
    public function index()
    {
        //
        $posts = Post::orderByDesc('created_at')->get();
        return view('admin.blog.index', compact('posts'));
    }

    public function create()
    {
        //
        return view('admin.blog.create', [
            'post' => new Post(),
            'categories' => CategoryPost::all(),
        ]);
    }

    public function store(Request $request)
    {
        //
        $data = $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'body' => 'required',
            'image' => 'required',
        ], [
            'title.required' => 'El campo Título es obligatorio',
            'body.required' => 'El campo Contenido es obligatorio',
            'image.required' => 'El campo Imagen es obligatorio',
        ]);
        $path = public_path() . '/img/posts';
        if ($file = $request->file('image')) {
            $fileName = time() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            Post::create([
                'title' => $data['title'],
                'slug' => Str::slug($data['title']),
                'category_id' => $data['category_id'],
                'body' => $data['body'],
                'image' => $fileName]);
        }
        return redirect()->route('posts.index')->with('success', 'Registro Exitoso');
    }

    public function edit(Post $post)
    {
        //
        return view('admin.blog.edit', [
            'post' => $post,
            'categories' => CategoryPost::all(),
        ]);
    }

    public function update(Request $request, Post $post)
    {
        //
        $oldFileName = $post->image;
        $data = $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'body' => 'required',
        ], [
            'title.required' => 'El campo Título es obligatorio',
            'body.required' => 'El campo Contenido es obligatorio',
        ]);
        $path = public_path() . '/images/posts';
        $fileName = null;
        if ($file = $request->file('image')) {
            $fileName = time() . $file->getClientOriginalName();
            $file->move($path, $fileName);
        }
        $post->fill([
            'title' => $data['title'],
            'slug' => Str::slug($data['title']),
            'category_id' => $data['category_id'],
            'body' => $data['body'],
        ]);
        if ($fileName != null) {
            $post->image = $fileName;
            try {
                unlink($path . '/' . $oldFileName);
            } catch (\Exception $e) {

            }
        }
        $post->save();
        return redirect()->route('posts.index')->with('success', 'Registro Actualizado');
    }

    public function destroy(Post $post)
    {
        //
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Registro Eliminado');
    }
}
