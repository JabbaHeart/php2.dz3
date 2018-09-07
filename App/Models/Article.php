<?php

namespace App\Models;

use App\Model;

/**
 * Class Article
 * @package App\Models
 * @property \App\Models\Article $author
 */

class Article extends Model
{
    protected static $table = 'news';

    protected $header;
    protected $message;
    protected $author_id;

    public function __get($property)
    {
        if ($property == 'author') {
            return $this->getAuthor();
        }
    }

    public function __isset($property)
    {
        if (!empty($this->author_id) && ($property == 'author')) {
                return true;
            }
    }

    public function getHeader()
    {
        return $this->header;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function getLink($action = null)
    {
        if (empty($action)) {
            return '/php2.dz3/article.php?id=' . $this->id;
        }
        else {
            return '/php2.dz3/article.php?action=' . $action . '&id=' . $this->id;
        }
    }

    public function getAuthor()
    {
        if (empty($this->author_id)) {
            return null;
        } else {
            $id = $this->author_id;
            return \App\Models\Author::findById($id);
        }
    }
}