<?php

namespace Modules\ServiceModule\Repository;

use Modules\ProductModule\shareData\Helper;
use Modules\ServiceModule\Entities\Service;

class ServiceRepository
{

    public function getAll()
    {
        return Service::with('translations', 'category')->get();
    }


    public function updateData($id, $data, $translatedData)
    {
        $service = Service::where('id', $id)->first();
        $service->update($data);

        foreach (Helper::getLang() as $lang) {
            $service->translate($lang->display_lang)->title = $translatedData[$lang->display_lang]['title'];
            $service->translate($lang->display_lang)->description = $translatedData[$lang->display_lang]['description'];

            $service->save();

        }

        return $service;

    }

    public function changeActive($id, $active_number)
    {
        return Service::where('id', $id)->update(['status' => $active_number]);

    }

}
