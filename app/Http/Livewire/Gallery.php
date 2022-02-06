<?php

namespace App\Http\Livewire;
use App\Models\Gallery as GalleryModel;

use Livewire\Component;
use Intervention\Image\Facades\Image;
use Livewire\WithFileUploads;

class Gallery extends Component
{
    use WithFileUploads;

    public $file;

    protected $rules = ['file'=>'required'];
    protected $messages = ['file.required'=>'Cargue una imagen'];

    public function render()
    {
        $items = GalleryModel::orderByDesc('created_at')->get();
        return view('livewire.gallery',compact('items'));
    }

    public function store(){
        $this->validate();
        $fileName=time().$this->file->getClientOriginalName();
        Image::make($this->file)->resize(1200, 950)->save(public_path().'/img/gallery/'.$fileName);
        GalleryModel::create([
            'image'=>$fileName,
        ]);
        $this->file=null;
    }

    public function remove($id){
        $gallery=GalleryModel::findOrFail($id);
        $fileName=$gallery->image;
        $gallery->delete();
        $path = public_path().'/img/gallery';
        try {
            unlink($path.'/'.$fileName);
        }catch (\Exception $e){

        }
    }
}
