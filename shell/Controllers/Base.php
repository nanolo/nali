<?php


namespace Nanolo\Controllers;


abstract class Base
{
    protected function access() :bool
    {
        return true;
}

    public function __invoke()
    {
        if($this->access()) {
            $this->build();
        } else {
            die('Access Denied!');
        }
    }

    abstract protected function build();

}