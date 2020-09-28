<?php

namespace Modules\CommonModule\Helper;

use Intervention\Image\Facades\Image;

trait UploaderHelper
{

    public function upload($request_photo, $file, $resize = false)
    {

        $photo = time() . '.' . $request_photo->getClientOriginalName();
        $location = public_path('images/' . $file . '/' . $photo);

        if (!file_exists(public_path('images/' . $file))) {
            mkdir(public_path('images/' . $file), true, 0777);
            if ($resize == true) {
                mkdir(public_path('images/' . $file . '/thumb'), true, 0777);

            }
        }
        $image = Image::make($request_photo);
        $image->save($location, 100);

        if ($resize == true) {
            $image->resize(100, 70);
            $path = public_path('images/' . $file . '/thumb/' . $photo);
            $image->save($path, 40);

        }

        return $photo;


    }

    public function uploadAlbum($request_photos, $folder)
    {
        foreach ($request_photos as $photo) {
            $imageName = $this->upload($photo, $folder, true);
            $product_photos[] = $imageName;

        }
        return $product_photos;


    }


}

;
