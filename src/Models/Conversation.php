<?php

namespace Grundmanis\Laracms\Modules\Shop\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $fillable = [
        'receiver_id',
        'sender_id',
        'shop_id',
        'message',
        'subject'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shop_id');
    }
}
