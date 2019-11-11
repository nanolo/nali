<?php


namespace Nanolo\Models;


use Nanolo\Exceptions\Errors;
use Nanolo\Lib\Db\Prepare;

class Queries extends Base
{

    public function pages()
    {
        $ini = [
            'what' => '*',
            'where' => '',
            'table' => 'pages',
            'order' => '',
            'limit' => '',
            'query' => []
        ];
        if($this->select($ini)) {
            return $this->select($ini);
        } else {
            //throw new Errors();
            throw new Errors('Unable to get answer from pages table');
        }

    }



    public function templates($pid)
    {
        $ini = [
            'what' => '*',
            'where' => 'pt.pid = :pid',
            'table' => 'templates t',
            'join' => 'pages_templates pt',
            'condition' => 'pt.tid = t.id',
            'order' => 'pt.position',
            'limit' => '',
            'query' => [
                ':pid' => $pid
            ]
        ];


        return $this->leftjoin($ini);
    }

    public function template()
    {
        $ini = [
            'what' => '*',
            'where' => '',
            'table' => 'pages',
            'order' => '',
            'limit' => ''
        ];
        return $this->one($ini);
    }

    public function navi($route = null)
    {
        $ini = [
            'what' => '*',
            'where' => 'navi = :navi AND route = :route',
            'table' => 'pages',
            'sort' => 'position',
            'limit' => '',
            'query' => [
                ':navi' => 1,
                ':route' => $route
            ]
        ];
        if($this->select($ini)) {
            return $this->select($ini);
        } else {
            throw new Errors('Unable to get answer from navi table');
        }

    }

    public function content($table = null, $what = '*', $where = null, $sort = null, $direction = 'ASC', $limit = null)
    {


        $query = Prepare::arr($where);
        $where = Prepare::condition($query);


        $ini = [
            'what' => $what,
            'where' => $where,
            'table' => $table,
            'sort' => $sort,
            'limit' => $limit,
            'direction' => $direction,
            'query' => $query
        ];

        if($this->select($ini)) {
            return $this->select($ini);
        } else {
            throw new Errors('Unable to get answer from ' . $table . ' table');
        }
    }



}