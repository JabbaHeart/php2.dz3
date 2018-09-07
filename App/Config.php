<?php

namespace App;

class Config
{
    public $data;
    private static $instance;

    protected function __construct()
    {
       $this->data = include __DIR__ . '/configdata.php';
    }

    public static function getInstance() {
        if ( empty(self::$instance) ) {
            self::$instance = new Config();
        }
        return self::$instance;
    }
}
