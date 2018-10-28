<?php

namespace Grundmanis\Laracms\Modules\Shop\Models;

use Illuminate\Database\Eloquent\Model;

class ShopFieldTranslation extends Model
{
    public $timestamps = false;

    protected $table = 'laracms_shop_field_translations';

    protected $fillable = ['name', 'locale'];
}
