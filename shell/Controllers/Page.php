<?php


namespace Nanolo\Controllers;


use Nanolo\Exceptions\Errors;
use Nanolo\Lib\Tree;
use Nanolo\Models\Queries;
use Nanolo\Models\Templates;
use Nanolo\Service\Tools;
use Nanolo\Views\Template;
use Nanolo\Widget\Navi;

class Page extends Base
{

    //protected $templates;
    //public $route;

    public function __construct()
    {

    }

    public function build()
    {

        /*
         *
         * У Объекта $navi есть два основных метода:
         * tree() - рекурсивно выводит дерево полного пути до страницы
         * uri() - выводит массив, который содержит имя меню и URL страницы
         *
         */

        Tools::printArray($this);


        $navi = new Navi($this->current->route);

        $content = new Content();
        $content = $content->handle($this->current);


        /*
         *
         *
         * Попробобать сделать именованные модули для того, чтобы их можно было вставлять в любую часть страницы
         * либо
         * Сделать формирование страницы в Contents и вставлять и вставлять непосредственно в страницу
         *
         * Подключить типы страниц
         * [0] - Страница общего назначения, где может быть всё что угодно
         * [1] - Страница для редактирования одной секции (материала), uri при этом /foo/bar/567/
         * [2] - Страница для редактирования одной секции (материала), uri при этом /foo/bar/general/ - Пока не ввожу (предположительно для настроек или для ЧПУ)
         *
         *
         *
         *
         * Подключить типы модулей
         * [0] - Тип страниц списков или добавления нового материала (Страница общего назначения с корректным uri)
         * [1] - Тип одного материала, где параметр цифра и является id (Конкретная тематическая страница)
         *
         * 2. Тип списка материалов
         * 3. Тип одного материала, где параметр add и является новым материалом
         *
         *
         */

        //Tools::printArray($content);





//        $t = new Queries();
//        $content->tpl = $t->templates($this->id);








        /*
         *
         * Метод page(), объекта $build строит страницу
         * На вход подаются различные ее части
         *
         */


        $build = new Template($this->current->route);

        $build->page($navi->uri(),$content);


    }

}