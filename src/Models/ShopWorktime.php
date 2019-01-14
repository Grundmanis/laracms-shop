<?php

namespace Grundmanis\Laracms\Modules\Shop\Models;

use Illuminate\Database\Eloquent\Model;

class ShopWorktime extends Model
{
    protected $fillable = ['shop_id', 'work_time'];

    /**
     * @return mixed
     */
    public function getWorkTimeAttribute($value)
    {
        return json_decode($value);
    }
}
