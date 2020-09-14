<?php

namespace Modules\ConfigModule\Entities;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    use Translatable;

    protected $fillable = ['is_static', 'static_value','type','cat_id'];
    public $translatedAttributes = ['display_name', 'value'];

    public $translatedModel = ConfigTranslation::class;

    public function category()
    {
        return $this->belongsTo(ConfigCategory::class, 'cat_id');
    }
}
