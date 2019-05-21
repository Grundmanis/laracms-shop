<?php

namespace Grundmanis\Laracms\Modules\Shop\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class ProductParameter extends Model
{
    protected $fillable = ['product_id', 'name', 'value', 'name_ru', 'value_ru'];

    /**
     * @param $name
     * @return string
     */
    public function getNameAttribute($name)
    {
        $name = App::getLocale() == 'ru' && $this->name_ru != '' ? $this->name_ru : $name;
        return html_entity_decode($name);
    }

    /**
     * @param $value
     * @return string
     */
    public function getValueAttribute($value)
    {
        $value = App::getLocale() == 'ru' && $this->value_ru != '' ? $this->value_ru : $value;
        return $value;
    }
}
