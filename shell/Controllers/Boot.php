<?php


namespace Nanolo\Controllers;

use Nanolo\Models\Pages;
use Nanolo\Models\Queries;
use Nanolo\Service\Router;
use Nanolo\Service\Tools;

class Boot extends Router
{

    protected $ua;
    protected $options;

    public function __construct()
    {

        define('DS', DIRECTORY_SEPARATOR);
        define('CONFIG', realpath(PATH . DS . 'protected' . DS . 'config.php'));
        define('DB_PREFIX', (require_once CONFIG)['db']['prefix']);  // Надо что-то придумать, чтобы не подключать здесь CONFIG
        $this->ua = explode('/', trim($_SERVER['HTTP_REQUEST_URI'], '/'));

    }


    public function run()
    {

        $pages = new Queries();
        $all = $pages->pages();


        $parent = 0;
        $attr = [];
        $type = 0;



        foreach($this->ua as $item) {

            if(0 === $parent) {

                $item = (empty($item)) ? 'index' : $item;

            }

            $obj = $this->chain($item, $parent, $all);

            if(empty($obj)) {
                if(1 === $type) {
                    $obj = $prev;
                    $attr[] = $item;
                    break;
                } else {
                    //throw new  //Добавить исключение
                    die('Page Not Found!');
                }

            }

            $parent = (int) $obj->id;
            $type = (int) $obj->type;
            $prev = $obj;

        }


        $page = new Page();
        $page->current = $obj;
        $page->build();


    }



}