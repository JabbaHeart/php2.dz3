<?php

namespace App;

use App\Models\SetGetIssetTrait;

class View implements \Countable, \Iterator
{
    protected $data = [];

    use SetGetIssetTrait;

    public function display($template)
    {
        foreach ($this->data as $name => $value) {
            $$name = $value;
        }
        include $template;
    }

    public function count()
    {
        return count($this->data);
    }

    public function current()
    {
        return current($this->data);
    }

    public function next()
    {
        next($this->data);
    }

    public function key()
    {
        return key($this->data);
    }

    public function valid()
    {
        return null !== key($this->data);
    }

    public function rewind()
    {
        reset($this->data);
    }
}