<?php

namespace Grundmanis\Laracms\Modules\Shop\Models;

use Illuminate\Database\Eloquent\Model;

class ProductParameter extends Model
{
    protected $fillable = ['product_id', 'name', 'value'];
}
