<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
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
}
