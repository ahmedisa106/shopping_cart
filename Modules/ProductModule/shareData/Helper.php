<?php

namespace Modules\ProductModule\shareData;

use Modules\CommonModule\Entities\Language;

trait Helper{


    public static function getLang(){
        $langs = Language::where('active',1)->get();

        return $langs;

    }
}

