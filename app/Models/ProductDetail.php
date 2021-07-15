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
    protected $fillable = ['product_id', 'size_id', 'brand', 'color_id', 'model', 'rating'];
    /**
     * @var array
     */
    protected $with = ['product', 'stock', 'size', 'color'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function stock(){
        return $this->hasOne(Stock::class);
    }


    public function orderItem()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class, 'size_id');
    }

    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }
}
