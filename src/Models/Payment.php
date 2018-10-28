<?php

namespace Grundmanis\Laracms\Modules\Shop\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['paymentable_id', 'paymentable_type', 'payment'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function paymentable()
    {
        return $this->morphTo();
    }
}
