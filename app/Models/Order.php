<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['state','accepted_at','delivered_at','rejected_at'];
    use HasFactory;

    public function destination(){
        return $this->belongsTo(Destination::class);
    }

    public function items(){
        return $this->belongsToMany(Product::class,'order_product')
            ->withPivot('quantity','saleprice');
    }
}
