<?php

namespace Grundmanis\Laracms\Modules\Shop\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = ['order_id', 'product_id', 'qty', 'price', 'info'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * @param $value
     * @return array|mixed
     */
    public function getInfoAttribute($value)
    {
        return $value ? json_decode($value) : null;
    }
}
