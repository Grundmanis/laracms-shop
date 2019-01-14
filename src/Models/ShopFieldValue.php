<?php

namespace Grundmanis\Laracms\Modules\Shop\Models;

use Illuminate\Database\Eloquent\Model;

class ShopFieldValue extends Model
{
    protected $fillable = ['not_editable', 'laracms_shop_field', 'shop_id', 'value'];
    protected $table = 'laracms_shop_field_values';

    public function shopField()
    {
        return $this->belongsTo(ShopField::class, 'laracms_shop_field');
    }
}
