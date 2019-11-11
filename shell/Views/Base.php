<?php


namespace Nanolo\Views;


class Base
{

    use Magic;

    public function render($template)
    {
        ob_start();
        include $template;
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

    public function display($template)
    {
        return $this->render($template);
    }

}