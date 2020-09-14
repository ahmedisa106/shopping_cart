<?php

namespace Modules\ProductModule\Repository;

use Modules\CommonModule\Helper\BaseHelper;

class ProductPhotoRepository
{
    use BaseHelper;

    public function save($product, $product_photos)
    {
        $product_photos_Many = $this->prepareData($product_photos, 'photos');
        $product->photos()->createMany($product_photos_Many);

    }

}
