<?php

namespace Modules\ConfigModule\Helper;

use Modules\ConfigModule\Entities\Config;
use Modules\ConfigModule\Entities\ConfigCategory;

class ShareData
{

    public static function Config_categs()
    {

        return ConfigCategory::with('configs')->get();

    }

    public static function getConfig()
    {
        $configArr = [];
        $all = Config::all();
        foreach ($all as $item) {

            if ($item->is_static == 1) {
                $configArr[$item->var] = $item->static_value;
            } else {
                $configArr[$item->var] = $item->value;
            }
        }

        return $configArr;
    }
}
