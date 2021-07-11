<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'order_items';
    protected $fillable = ['order_id', 'product_detail_id','category_id', 'quantity', 'price', 'discount','product_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function productDetail()
    {
        return $this->belongsTo(ProductDetail::class,'product_detail_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
