<?php


namespace Nanolo\Models;


use Nanolo\Dba\Db;
use Nanolo\Exceptions\Errors;
use Nanolo\Service\Tools;

abstract class Base
{

    //protected $dbo;

    //public const TABLE = '';
    //protected $table;
    //protected $what;
    //protected $ini;


    public function __construct()
    {

//        $this->dbo = (require OPTIONS)['db'];

    }


    public function one($date) {

        $db = new DB();

        $sql = 'SELECT ' . $data['what'];
        $sql .= ' FROM ' . DB_PREFIX . $data['table'];
        $sql .= ($data['where']) ? ' WHERE ' . $data['where'] : '';


    }


    public function select($data = []) // ДОБАВИТЬ ИСКЛЮЧЕНИЯ ПРИ ПОСТРОЕНИИ ЗАПРОСА И ВЫБОРКИ ИЗ БАЗЫ ДАННЫХ!!!
    {


        if($data['table'] && $data['what']) {
            $sql = 'SELECT ' . $data['what'] . ' FROM ' . DB_PREFIX . $data['table'];
            $sql .= ($data['where']) ? ' WHERE ' . $data['where'] : '';
            $sql .= ($data['sort']) ? ' ORDER BY ' . $data['sort'] : '';
            $sql .= ($data['sort'] && $data['direction']) ? ' ' . $data['direction'] : '';
            $sql .= ($data['limit']) ? ' LIMIT ' . $data['limit'] : '';


        } else {
            throw new Errors('Table Field Is Empty!');
        }






        //echo $sql;

        $db = new Db();

        return $db->query($sql, $data['query'], static::class); // Без this не работает, не понятно почему, надо читать

    }

    public function leftjoin($data = []) // ДОБАВИТЬ ИСКЛЮЧЕНИЯ ПРИ ПОСТРОЕНИИ ЗАПРОСА И ВЫБОРКИ ИЗ БАЗЫ ДАННЫХ!!!
    {

        $db = new Db();

        $sql = 'SELECT ' . $data['what'];
        $sql .= ' FROM ' . DB_PREFIX . $data['table'];
        $sql .= ' LEFT JOIN ' . DB_PREFIX . $data['join'];
        $sql .= ' ON ' . $data['condition'];
        $sql .= ' WHERE ' . $data['where'];
        $sql .= ' ORDER BY '. $data['order'];

        //echo $sql;

        return $db->query($sql, $data['query'], static::class);

    }

}