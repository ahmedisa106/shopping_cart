<?php

namespace Modules\ProductModule\Entities;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Translatable;

    protected $table = 'categories';

    protected $fillable = ['photo', 'parent_id', 'status'];
    protected $translatedAttributes = ['title', 'description', 'slug'];

    public $translationModel = CategoryTranslation::class;

    public function child()
    {

        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function parent()
    {

        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_category', 'product_id', 'category_id');

    }


}
