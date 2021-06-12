<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    use HasFactory;
    /**
     * @var string
     */
    protected $table = 'product_details';
    /**
     * @var array
     */
    protected $fillable = ['product_id', 'size', 'brand', 'color', 'model', 'rating'];
    /**
     * @var array
     */
    protected $with = ['product'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }
}
