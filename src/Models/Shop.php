<?php

namespace Grundmanis\Laracms\Modules\Shop\Models;

use App\User;
use Cviebrock\EloquentSluggable\Sluggable;
use Gloudemans\Shoppingcart\Facades\Cart;
use Grundmanis\Laracms\Modules\Shop\Models\ShopFieldValue;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use Sluggable;

    protected $fillable = [
        'user_id',
        'logo',
        'name',
        'sandbox',
        'reg_number',
        'email',
        'second_email',
        'phone',
        'second_phone',
        'address',
        'xml',
        'xml_updated_at',
        'manager_phone'
    ];

    protected $dates = ['xml_update_at'];


    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function deliveries()
    {
        return $this->morphMany(Delivery::class, 'deliveryable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function payments()
    {
        return $this->morphMany(Payment::class, 'paymentable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function worktime()
    {
        return $this->hasOne(ShopWorktime::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function conversations()
    {
        return $this->hasMany(Conversation::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function blocked()
    {
        return $this->morphOne(Blocked::class, 'blockedable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fieldValues()
    {
        return $this->hasMany(ShopFieldValue::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function orderItems()
    {
        return $this->hasManyThrough(OrderItem::class, Product::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * @return mixed
     */
    public function isInFavorites()
    {
        $favorites = Cart::instance('favorites');
        $find = $favorites->search(function ($cartItem, $rowId) {
            return $cartItem->id == $this->id;
        });

        return $find->count();
    }

    /**
     * @return string
     */
    public function getLink()
    {
        return route('shop', $this->slug);
    }

    /**
     * @return float|int
     */
    public function getMark()
    {
        $marks = $this
            ->reviews()
            ->where('mark', '!=', 0)
            ->get();

        $sum = $marks->sum('mark');

        return count($marks) ? round($sum / count($marks)) : 0;
    }
}
