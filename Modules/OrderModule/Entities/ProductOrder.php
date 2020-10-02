<?php

namespace Modules\OrderModule\Entities;

use Illuminate\Database\Eloquent\Model;

class ProductOrder extends Model
{
    protected $fillable = ['product_id', 'order_id', 'quantity', 'total_price'];
    protected $table = 'product_order';

}
