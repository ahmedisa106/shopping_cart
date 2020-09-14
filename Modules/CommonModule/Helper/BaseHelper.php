<?php

namespace Modules\CommonModule\Helper;

trait BaseHelper
{
    public function prepareData($arrayOfData, $column)
    {
        $newArray = [];
        foreach ($arrayOfData as $value) {
            $newArray[][$column] = $value;
        }
        return $newArray;
    }




}
