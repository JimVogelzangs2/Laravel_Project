<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'price', 'description'];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order');
    }

    // Keep the old image_path accessor for backward compatibility
    public function getImagePathAttribute()
    {
        $firstImage = $this->images()->first();
        return $firstImage ? $firstImage->image_path : null;
    }
}
