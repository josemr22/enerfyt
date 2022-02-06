<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable=['title','slug','category_id','body','image'];

    public function category()
    {
        return $this->belongsTo(CategoryPost::class)->withDefault();
    }
}
