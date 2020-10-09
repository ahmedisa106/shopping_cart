<?php

namespace Modules\ServiceModule\Repository;

use Modules\ProductModule\shareData\Helper;
use Modules\ServiceModule\Entities\CategoryService;

class CategoryRepository
{
    public function getAll()
    {

        return CategoryService::with('translations')->get();
    }

    public function getAllActive()
    {
        return CategoryService::where('status', 1)->with('translations')->get();

    }

    public function findById($id)
    {

        return CategoryService::find($id);

    }

    public function updateData($id, $data, $dataTranslation)
    {
        $cat = CategoryService::where('id', $id)->first();
        $cat->update($data);

        foreach (Helper::getLang() as $lang) {
            $cat->translate($lang->display_lang)->title = $dataTranslation[$lang->display_lang]['title'];
            $cat->translate($lang->display_lang)->description = $dataTranslation[$lang->display_lang]['description'];
            $cat->save();

        }
        return $cat;

    }


}
