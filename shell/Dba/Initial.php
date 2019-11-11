<?php


namespace Nanolo\Dba;


class Initial
{
    public $what;


    public function __construct()
    {
        //$this->what =

    }

    public function what($data = [])
    {
        $res = (!empty($data)) ? implode(',', $data) : ' * ';

        return $res;
    }

    public function where($data = [])
    {
        return ($data) ? ' WHERE ' . $data : ''; // РАЗВЕРНУТЬ!!!!!!!!
    }



}