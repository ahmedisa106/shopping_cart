<?php

use Modules\ProductModule\Entities\Product;

if (!function_exists('ValueOf')) {

    function ValueOf($object, $lang, $variable)
    {
        $value = $object->translate($lang->display_lang)->$variable;
        return $value;
    }

}

if (!function_exists('getProductImage')) {

    function getProductImage($id)
    {
        $product = Product::where('id', $id)->first();
        return asset('/images/products/' . $product->photo);

    }

}

if (!function_exists('getProductQuantity')) {

    function getProductQuantity($id)
    {
        $product = Product::find($id);
        return $product->current_quantity;
    }
}
