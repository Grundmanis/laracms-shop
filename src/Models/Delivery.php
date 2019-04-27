<?php

namespace Grundmanis\Laracms\Modules\Shop\Models;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    protected $fillable = ['deliveryable_type', 'deliveryable_id', 'delivery', 'price', 'enabled'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function deliveryable()
    {
        return $this->morphTo();
    }
}
