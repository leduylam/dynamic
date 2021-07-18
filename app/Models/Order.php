<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const STATUS_1 = 'WAITING';
    const STATUS_2 = 'BEFORE_SEND';
    const STATUS_3 = 'SEND';

    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'sku',
        'user_id',
        'order_date',
        'status_code',
        'total_amount',
        'shipping_start_date',
        'memo',
        'customer',
        'address',
        'email',
    ];

    protected $with = [
        'user',
        'orderItems',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
