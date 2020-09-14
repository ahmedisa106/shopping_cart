<?php

namespace Modules\ProductModule\Entities;

use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model
{
    protected $table  = 'category_translations';
    protected $fillable = ['title','description','slug'];

    public $timestamps = false ;

}
