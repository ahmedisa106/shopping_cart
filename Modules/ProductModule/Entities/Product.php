<?php

namespace Modules\ProductModule\Entities;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    use Translatable;

    protected $table = 'products';
    protected $fillable = ['photo', 'sell_price', 'price_before_discount', 'current_quantity', 'active'];
    protected $translatedAttributes = ['title', 'description', 'slug'];

    public $translationModel = ProductTranslations::class;


    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_category', 'product_id', 'category_id');

    }

    public function photos()
    {
        return $this->hasMany(ProductPhoto::class, 'product_id');
    }

}
