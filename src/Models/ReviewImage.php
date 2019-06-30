<?php

namespace Grundmanis\Laracms\Modules\Shop\Models;

use Illuminate\Database\Eloquent\Model;

class ReviewImage extends Model
{
    protected $table = 'review_images';

    protected $fillable = ['url', 'thumbnail', 'review_id'];
}
