<?php

namespace Grundmanis\Laracms\Modules\Shop\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'amount'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * @param $value
     * @return false|string
     */
    public function getCreatedAtAttribute($value)
    {
        return date('H:i:s d-m-Y', strtotime($value));
    }
}
