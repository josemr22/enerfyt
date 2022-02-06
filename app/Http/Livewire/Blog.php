<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\CategoryPost;
use App\Models\Post;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Blog extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $category='';
    public $search='';

    protected $queryString=[
        'search' => ['except' => ''],
        'category' => ['except' => ''],
    ];

    public function render()
    {
        $posts=Post::query()->when($this->category, function ($query, $category){
            $query->where('category_id',$category);
                //->orWhere('code','like',"%{$search}%")
            })
            ->where('title','LIKE','%'.$this->search.'%')
            ->paginate(3);
        $categoryPosts=CategoryPost::all();
        $products=Product::orderBy('created_at')
            ->where('featured',true)
            ->limit(3)
            ->get();
        return view('livewire.blog',compact('posts','categoryPosts','products'));
    }

    public function filter($id){
        $this->resetPage();
        $this->category=$id;
    }

    public function updating()
    {
        $this->resetPage();
    }
}
