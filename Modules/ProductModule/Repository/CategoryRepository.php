<?php

namespace Modules\ProductModule\Repository;

use File;
use Modules\ProductModule\Entities\Category;
use Modules\ProductModule\shareData\Helper;

class CategoryRepository
{

    public static function save($data)
    {
        $category = Category::create($data);
        return $category;
    }

    public function update($id, $data, $data_trans)
    {

        $cat = Category::where('id', $id)->first();
        $cat->update($data);
        foreach (Helper::getLang() as $lang) {
            $cat->translate('' . $lang->display_lang)->title = $data_trans[$lang->display_lang]['title'];
            $cat->translate('' . $lang->display_lang)->slug = $data_trans[$lang->display_lang]['slug'];
            $cat->translate('' . $lang->display_lang)->description = $data_trans[$lang->display_lang]['description'];

            $cat->save();

        }
        return $cat;

    }

    public function findByID($id)
    {
        return Category::where('id', $id)->first();
    }

    public function getAll()
    {
        return Category::with(['translations', 'parent', 'child', 'parent.translations'])->get();
    }

    public function getAllParent()
    {
        return Category::with(['translations', 'parent', 'child', 'parent.translations'])->where('parent_id', null)->get();
    }

    public function getAllChildren()
    {
        return Category::with(['translations', 'child', 'parent.translations'])->where('parent_id', '!=', null)->get();
    }

    public function delete($id)
    {
        $cat = $this->findByID($id);
        Category::destroy($id);

    }

    public function deleteOldPhoto($id, $path, $thumb)
    {
        $cat = $this->findByID($id);
        File::delete($path, $thumb);
    }
}
