<?php

namespace Modules\ServiceModule\Entities;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use Translatable;

    protected $fillable = ['photo', 'cover', 'service_cat_id'];

    protected $table = 'service';
    public $translatedAttributes = ['title', 'description'];
    public $translationModel = ServiceTranslations::class;

    public function category()
    {

        return $this->belongsTo(CategoryService::class, 'service_cat_id');
    }
}
