<?php

namespace Modules\ServiceModule\Entities;

use Illuminate\Database\Eloquent\Model;

class CategoryServiceTranslations extends Model
{
    protected $fillable = ['title', 'description'];

    protected $table = 'category_service_translations';

}
