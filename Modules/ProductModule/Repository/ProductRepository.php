<?php

namespace Modules\ProductModule\Repository;

use File;
use Modules\ProductModule\Entities\Product;
use Modules\ProductModule\shareData\Helper;

class ProductRepository
{
    public $productPhotoRepo;

    public function __construct(ProductPhotoRepository $photoRepository)
    {
        $this->productPhotoRepo = $photoRepository;

    }

    public function getById($id)
    {
        return Product::where('id', $id)->with('photos', 'categories')->first();
    }

    public function getAll()
    {
        return Product::with('categories', 'photos')->get();
    }

    public function save($productData, $product_photos, $product_cats)
    {

        $product = Product::create($productData);
        $this->productPhotoRepo->save($product, $product_photos);
        $product->categories()->sync($product_cats);


    }

    public function findAllActive($stats)
    {

        $products = Product::with('translations')->where('active', $stats)->get();
        return $products;
    }

    public function updateData($id, $productData, $locales, $product_cats)
    {

        $product = $this->getById($id);
        $product->update($productData);
        $product->categories()->sync($product_cats);

        foreach (Helper::getLang() as $lang) {
            $product->translate($lang->display_lang)->title = $locales[$lang->display_lang]['title'];
            $product->translate($lang->display_lang)->slug = $locales[$lang->display_lang]['slug'];
            $product->translate($lang->display_lang)->description = $locales[$lang->display_lang]['description'];
            $product->save();

        }
        return $product;

    }

    public function deleteOldPhoto($id, $folder)
    {

        $product = $this->getById($id);
        $oldPath = public_path('/images/' . $folder . '/' . $product->photo);
        $oldThumbPath = public_path('/images/' . $folder . '/thumb/' . $product->photo);
        File::delete($oldPath, $oldThumbPath);
    }

    public function deleteOldAlbum($id, $product)
    {
        foreach ($product->photos as $photo) {
            $oldAlbumPath = public_path('/images/product_photos/' . $photo->photos);
            $oldAlbumPathThumb = public_path('/images/product_photos/thumb/' . $photo->photos);

            File::delete([$oldAlbumPath, $oldAlbumPathThumb]);
        }

    }

    public function pro_type($type)
    {

        return Product::with('categories', 'photos')->where('type', $type)->get();

    }

    public function updateActive($id, $active)
    {
        return Product::where('id', $id)->update(['active' => $active]);
    }
}
