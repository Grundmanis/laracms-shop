<?php

namespace Grundmanis\Laracms\Modules\Shop\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\App;

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
        'thumbnail',
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
        'delete_product',
        'description_ru',
        'name_ru',
        'manufacturer_code',
        'manufacturer_link',
        'link_ru',
        'category_full_ru',
        'return_term',
        'insurance_term',
        'insurance_cost',
        'additional_warranty_term',
        'additional_warranty_cost',
        'gift_link',
        'credit_free',
        'credit_free_term',
        'credit_pay_3',
        'credit_pay_6',
        'credit_pay_12',
        'credit_pay_24',
        'credit_pay_36',
        'credit_pay_x',
        'credit_pay_x_term',
        'delivery_office',
        'delivery_days_office',
        'delivery_days_latvijas_pasts',
        'delivery_pakomats',
        'delivery_days_pakomats',
        'new'
    ];

    // scopeWhereDeleted != 0

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('available', function (Builder $builder) {
            $builder->where('delete_product', '=', 0);
            $builder->whereHas('shop', function ($query) {
                $query->where('sandbox', 0);
                $query->doesntHave('blocked');
            });
        });
    }

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
    public function videos()
    {
        return $this->hasMany(ProductVideo::class);
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
        return number_format($value, 2, '.', '');
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
     * @param $name
     * @return float
     */
    public function getNameAttribute($name)
    {
        $name = App::getLocale() == 'ru' && $this->name_ru != '' ? $this->name_ru : $name;
        return html_entity_decode($name);
    }

    /**
     * @param $link
     * @return float
     */
    public function getLinkAttribute($link)
    {
        $link = App::getLocale() == 'ru' && $this->link_ru != '' ? $this->link_ru : $link;
        return $link;
    }

    /**
     * @param $category_full
     * @return float
     */
    public function getCategoryFullAttribute($category_full)
    {
        $category_full = App::getLocale() == 'ru' && $this->category_full_ru != '' ? $this->category_full_ru : $category_full;
        return $category_full;
    }

    /**
     * @param $description
     * @return float
     */
    public function getDescriptionAttribute($description)
    {
        $description = App::getLocale() == 'ru' && $this->description_ru != '' ? $this->description_ru : $description;
        return $description;
    }

    /**
     * @param $url
     * @return float
     */
    public function getImageAttribute($url)
    {
//        return asset('images/no-image.png');
        $image = @getimagesize($url) ? $url : asset('images/no-image.png');
        return $image;
    }
    /**
     * @param $url
     * @return float
     */
    public function getThumbnailAttribute($url)
    {
        $image = $url ? $url : $this->image;
        return $image;
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
