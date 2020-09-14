<?php

namespace Modules\ProductModule\Entities;

use Illuminate\Database\Eloquent\Model;

class ProductTranslations extends Model
{
    protected $table = 'product_translations';
    protected $fillable = ['title', 'description', 'slug'];
    public $timestamps = false;
}
