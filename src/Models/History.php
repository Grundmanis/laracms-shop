<?php

namespace Grundmanis\Laracms\Modules\Shop\Models;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $table = 'history';

    protected $fillable = ['query', 'user_id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
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
