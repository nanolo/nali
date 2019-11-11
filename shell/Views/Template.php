<?php


namespace Nanolo\Views;


use Nanolo\Service\Tools;

class Template
{

    protected $route;

    public function __construct($route)
    {
        $this->route = $route;
    }

    public function page($navi,$c)
    {
        $this->view = new Base();
        $this->view->navi = $navi;
        //$this->view->data =

        //Tools::printArray($c);

        switch($this->route) {
            case 1:
                $menu = $this->view->display(PATH . '/templates/admin/navi.php');

                foreach($c as $item) {
                    $this->view->content = $item->content;
                    $content .= $this->view->display(PATH . '/templates/' . $item->path);
                }

                $fwidget = 'Подвальный виджет';
                $template = PATH . '/templates/admin/shell.php';
                break;
            case 2:
                $template = '';
                break;
            default:
                $template = PATH . '/templates/shell.php';

        }

        require_once $template;
    }

}