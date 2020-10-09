<?php

namespace Modules\ServiceModule\Entities;

use Illuminate\Database\Eloquent\Model;

class ServiceTranslations extends Model
{
    protected $fillable = ['title', 'description'];

    protected $table = 'service_translations';

    public $timestamps = false;
}
