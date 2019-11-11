<?php


namespace Nanolo\Lib\Db;


class Prepare
{

    public static function condition($data)
    {
        $r = array_keys($data);
        $d = [];

        foreach($r as $j) {
            $d[] = $j . ' = :' . $j;
        }

        return implode(' AND ', $d);
    }

    public static function arr($data)
    {
        return (array)json_decode($data);
    }

}