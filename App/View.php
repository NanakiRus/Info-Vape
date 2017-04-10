<?php

namespace App;

class View
{
    use MagicTrait;

    public function assign($name, $value)
    {
        $this->data[$name] = $value;
    }

    public function display($template)
    {
        foreach ($this->data as $key => $value) {
            $$key = $value;
        }
        include $template;
    }

    public function render($template)
    {
        ob_start();
        include $template;
        $res = ob_get_contents();
        ob_end_clean();
        return $res;
    }
}