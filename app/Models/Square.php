<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Square extends Model
{
    use HasFactory;
    protected $fillable=['type','commentary'];
    public function products(){
        return $this->belongsToMany(Product::class )->withPivot('quantity');
    }
}
