<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class
Product extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'products';

    /**
     * @var array
     */
    protected $fillable = ['name', 'sku', 'price', 'image', 'description', 'content', 'status', 'category_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function images()
    {
        return $this->belongsToMany(Image::class, 'product_image')->withTimestamps();
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'product_details', 'product_id', 'size_id');
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class, 'product_details', 'product_id', 'color_id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function details()
    {
        return $this->hasMany(ProductDetail::class, 'product_id');
    }
}
