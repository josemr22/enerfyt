<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Service;
use Livewire\Component;

class Novelties extends Component
{
    public $search;

    public function render()
    {
        $products=Product::query()
        ->where("featured",false)
        ->when($this->search, function ($query, $search){
            $query->where('name','LIKE','%'.$this->search.'%');
        })
        ->take('10')
        ->get();
       
        $novelties = Product::where('featured',true)->get();
        return view('livewire.novelties',compact('products','novelties'));
    }

    public function up($id){
        $product=Product::findOrFail($id);
        $product->update(['featured'=>true]);
    }

    public function down($id){
            $product=Product::findOrFail($id);
            $product->update(['featured'=>false]);
    }
}
