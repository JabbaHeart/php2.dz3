<?php

namespace App\Models;

use App\Model;

class Author extends Model
{

    protected static $table = 'authors';

    protected $fullname;

    public function getFullname()
    {
        return $this->fullname;
    }

}