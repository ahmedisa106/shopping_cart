<?php

namespace Modules\ProductModule\Entities;

use Illuminate\Database\Eloquent\Model;

class ProductPhoto extends Model
{
    protected $table = 'product_photos';
    protected $fillable = ['photos'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
