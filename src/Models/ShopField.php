<?php

namespace Grundmanis\Laracms\Modules\Shop\Models;

use Illuminate\Database\Eloquent\Model;

class ShopField extends Model
{
    use \Dimsav\Translatable\Translatable;

    public $translatedAttributes = ['name'];

    public $timestamps = false;

    protected $table = 'laracms_shop_fields';

    protected $fillable = ['not_editable'];
}
