<?php

namespace Nanolo\Service;

class Tools
{
    public static function printArray($array)
    {
        echo "<pre>" . print_r($array,true) . "</pre>";
    }
}