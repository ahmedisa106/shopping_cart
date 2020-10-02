<?php

namespace Modules\ProductModule\Entities;

use Astrotomic\Translatable\Translatable;
use ChristianKuri\LaravelFavorite\Traits\Favoriteable;
use Illuminate\Database\Eloquent\Model;
use Modules\OrderModule\Entities\Order;

class Product extends Model
{
    use Favoriteable;

    use Translatable;

    protected $table = 'products';
    protected $fillable = ['photo', 'sell_price', 'price_before_discount', 'current_quantity', 'active', 'type'];
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

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'product_order', 'product_id', 'order_id');
    }

}
