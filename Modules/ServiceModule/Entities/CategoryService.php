<?php

namespace Modules\ServiceModule\Entities;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class CategoryService extends Model
{
    use Translatable;

    protected $fillable = ['photo', 'status'];
    protected $table = "category_service";

    public $translatedAttributes = ['title', 'description'];

    public $translationModel = CategoryServiceTranslations::class;

    public function services()
    {
        return $this->hasMany(Service::class, 'service_cat_id');
    }


}
