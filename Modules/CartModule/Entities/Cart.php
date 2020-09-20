<?php

namespace Modules\CartModule\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\ProductModule\Entities\Product;

class Cart extends Model
{
    protected $fillable = ['user_id', 'product_id'];

    public function product()
    {
        return $this->hasOne(Product::class, 'product_id');
    }
}
