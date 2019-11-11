<?php


namespace Nanolo\Controllers;


use Nanolo\Exceptions\Errors;
use Nanolo\Models\Queries;
use Nanolo\Service\Tools;

class Content
{

    protected $modules;

    public function __construct()
    {




    }

    public function handle($current)
    {

        $query = new Queries();
        $this->modules = $query->templates($current->id);

        //Tools::printArray($this->modules);

        foreach($this->modules as $item) {

            switch($item->type) {
                case 0:
                    try {
                        $item->content = $query->content($item->place, $item->what, $item->wcondition, $item->sort, $item->direction, $item->quantity);
                    } catch(Errors $error) {
                        Error::page($error->getMessage());
                    }
                    break;
//                case 1:
//                    try {
//                        $item->content = $query->content($item->place, $item->what, $item->wcondition, $item->sort, $item->direction, $item->quantity);
//                    } catch(Errors $error) {
//                        Error::page($error->getMessage());
//                    }
                default:
                    echo 'Nothing';

            }



        }

        return $this->modules;
    }



}