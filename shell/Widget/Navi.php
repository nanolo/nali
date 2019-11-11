<?php


namespace Nanolo\Widget;


use Nanolo\Controllers\Error;
use Nanolo\Exceptions\Errors;
use Nanolo\Models\Queries;

class Navi
{

    //public $route;
    protected $navi;
    protected $all;
    protected $pages;

    public function __construct($route)
    {

        $query = new Queries();

        try {
            $this->navi = $query->navi($route);
        } catch (Errors $error) {
            Error::page($error->getMessage());
        }


        try {
            $this->pages = $query->pages();
        } catch (Errors $error) {
            Error::page($error->getMessage());
        }


    }

    public function tree()
    {
        $links = [];

        foreach($this->navi as $key => $item) {

            $links[$key]['path'] = $item->uri;
            $links[$key]['name'] = $item->name;
            $links[$key]['parent'] = $this->recur($item);

        }

        return $links;

    }

    public function recur($data)
    {

        $res = [];

        foreach($this->pages as $item) {

            if((int)$data->parent === (int)$item->id) {

                $res['path'] = $item->uri;

                if(0 !== (int)$item->parent) {
                    $res['parent'] = self::recur($item);
                }
            }

        }

        return $res;
    }

    public function uri()
    {

        $links = [];

        foreach($this->tree() as $key => $item) {

            $links[$key]['uri'] = SITEURI . DS . $this->build($item,null);
            $links[$key]['name'] = $item['name'];

        }

        return $links;
    }

    public function build($data, $uri = null)
    {

        $uri = $data['path'] . DS . $uri;

        if($data['parent'] && !empty($data['parent'])) {
            return $this->build($data['parent'], $uri);
        } else {
            return $uri;
        }

    }

}