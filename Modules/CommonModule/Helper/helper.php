<?php


if (!function_exists('ValueOf')) {

    function ValueOf($object, $lang, $variable)
    {
            $value = $object->translate($lang->display_lang)->$variable;
            return $value;
    }

}
