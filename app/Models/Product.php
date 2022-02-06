<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Gloudemans\Shoppingcart\Contracts\Buyable;

class Product extends Model implements Buyable
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];
    //

    public function category()
    {
        return $this->belongsTo(Category::class)->withDefault();
    }

    // public function colors()
    // {
    //     return $this->belongsToMany(Color::class, 'color_product');
    // }

    // public function scolors()
    // {
    //     return $this->belongsToMany(Color::class, 'stocks')->withPivot('size_id','quantity');
    // }

    // public function color_product()
    // {
    //     return $this->hasMany(ColorProduct::class);
    // }

    // public function sizes()
    // {
    //     return $this->belongsToMany(Size::class, 'product_size')->withPivot('width','for_pants','id');
    // }

    // public function ssizes()
    // {
    //     return $this->belongsToMany(Size::class, 'stocks')->withPivot('color_id','quantity');
    // }

    // public function product_size()
    // {
    //     return $this->hasMany(ProductSize::class);
    // }

    // public function stock()
    // {
    //     return $this->hasMany(Stock::class);
    // }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function getBuyableIdentifier($options = null)
    {
        // TODO: Implement getBuyableIdentifier() method.
        return $this->id;
    }

    public function getBuyableDescription($options = null)
    {
        // TODO: Implement getBuyableDescription() method.
        return $this->name;
    }

    public function getBuyablePrice($options = null)
    {
        // TODO: Implement getBuyablePrice() method.
        return $this->price;
    }

    public function getBuyableWeight($options = null)
    {
        // TODO: Implement getBuyableWeight() method.
        return 0;
    }
}
