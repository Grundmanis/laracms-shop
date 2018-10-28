<?php

namespace Grundmanis\Laracms\Modules\Shop\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use \Dimsav\Translatable\Translatable;

    public $translatedAttributes = ['name'];

    public $timestamps = false;

    protected $fillable = ['parent_category_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parentCategory()
    {
        return $this->belongsTo(Category::class, 'parent_category_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function childCategories()
    {
        return $this->hasMany(Category::class, 'parent_category_id');
    }

    /**
     * @param string $search
     * @return mixed
     */
    public function searchProducts(string $search)
    {
        $searches = explode(' ', $search);

        return Product::where(function($query) use ($searches) {
                foreach ($searches as $search) {
                    $search = '%' . $search . '%';
                    $query
                        ->orWhere('name', 'LIKE', $search)
                        ->orWhere('category', 'LIKE', $search)
                        ->orWhere('manufacturer', 'LIKE', $search)
                        ->orWhere('model', 'LIKE', $search);
                }
            });
    }
}
