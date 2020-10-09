<?php

namespace Modules\OrderModule\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\ProductModule\Entities\Product;
use Modules\UserModule\Entities\User;

class Order extends Model
{
    protected $fillable = ['user_id', 'address', 'phone', 'total'];
    protected $table = 'orders';

    public function products()
    {

        return $this->belongsToMany(Product::class, 'product_order', 'product_id', 'order_id');
    }

    function orderProducts()
    {
        return $this->hasMany(ProductOrder::class, 'order_id')->where('quantity', '>', 0);
    }

    public function user()
    {

        return $this->belongsTo(User::class, 'user_id');
    }
}
