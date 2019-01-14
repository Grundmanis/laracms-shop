<?php

namespace Grundmanis\Laracms\Modules\Shop\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{

    protected $fillable = ['user_id', 'text', 'mark'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function reviewable()
    {
        return $this->morphTo();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany(ReviewImage::class);
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
