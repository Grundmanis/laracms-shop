<?php

namespace Grundmanis\Laracms\Modules\Shop\Models;

use Illuminate\Database\Eloquent\Model;

class Blocked extends Model
{
    protected $table = 'blocked';

    protected $fillable = ['reason'];

    public function blockedable()
    {
        return $this->morphTo();
    }
}
