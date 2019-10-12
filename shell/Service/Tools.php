<?php

namespace Nanolo\Service\Tools;

class Tools
{
    public function printArray($array)
    {
        echo "<pre>" . print_r($array,true) . "</pre>";
    }
}