<?php


namespace Nanolo\Service;



use Nanolo\Models\Pages;

abstract class Router
{

    public function chain($uri, $parent, $all)
    {

        $obj = null;

        foreach($all as $item) {
            if(($item->uri == $uri) && ($item->parent == $parent)) {
                $obj = $item;
            }
        }

        return $obj;

    }


    abstract protected function run();

}