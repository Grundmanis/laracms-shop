<?php

namespace Grundmanis\Laracms\Modules\Shop\Models;

use Illuminate\Database\Eloquent\Model;
use Gloudemans\Shoppingcart\Facades\Cart;

/**
 * @property  $price
 * @property  $discount_price
 * @property string $link_name
 */
class Product extends Model
{
    const PER_PAGE = 12;

    protected $fillable = [
        'delivery_cost_riga',
        'delivery_latvija',
        'delivery_latvijas_pasts',
        'delivery_dpd_paku_bode',
        'delivery_pasta_stacija',
        'delivery_omniva',
        'delivery_circlek',
        'delivery_days_riga',
        'delivery_days_latvija',
        'used',
        'name',
        'link',
        'price',
        'image',
        'category',
        'category_full',
        'category_link',
        'manufacturer',
        'model',
        'guarantee_months',
        'credit',
        'with_gift',
        'is_top',
        'is_example',
        'is_bestseller',
        'in_stock',
        'discount_price',
        'shop_id',
        'id_from_shop',
        'description',
        'delete_product'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function parameters()
    {
        return $this->hasMany(ProductParameter::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categories()
    {
        return $this->hasMany(ProductCategory::class);
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
    public function seen()
    {
        return $this->hasMany(ProductUserSeen::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    /**
     * @return mixed
     */
    public function getLinkNameAttribute()
    {
        $name = str_replace('/','-', $this->name);

        return str_replace(' ','-', $name);
    }

    /**
     * @return string
     */
    public function getLink()
    {
        return route('product.show', [
                $this->shop->slug,
                $this->id,
                $this->linkName
            ]
        );
    }

    /**
     * @param $value
     * @return float
     */
    public function getPriceAttribute($value)
    {
        return number_format($value, 2);
    }

    /**
     * @param $value
     * @return float
     */
    public function getNoVatPriceAttribute($value)
    {
        return number_format(100 * $this->price / 121, 2);
    }

    /**
     * @param $value
     * @return float
     */
    public function getDiscountPriceAttribute($value)
    {
        if (intval($value)) {
            return number_format($value, 2);
        }

        return 0;
    }

    /**
     * @return mixed
     */
    public function isInFavorites()
    {
        $favorites = Cart::instance('wishlist');
        $find = $favorites->search(function ($cartItem, $rowId) {
            return $cartItem->id == $this->id;
        });
        return $find->count();
    }

}
