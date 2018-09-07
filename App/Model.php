<?php

namespace App;


abstract class Model
{
    protected static $table = null;

    public $id;

    public static function findAll()
    {
        $db = new Db();
        $sql = 'SELECT * FROM ' . static::$table;
        return $db->query($sql, static::class);
    }

    public static function findLastRecords($number)
    {
        $db = new Db();
        $sql = 'SELECT * FROM '. static::$table . ' ORDER BY id DESC LIMIT ' . $number;
        return $db->query($sql, static::class);

    }

    public static function findById($id)
    {
        $db = new Db();
        $sql = 'SELECT * FROM ' . static::$table . ' WHERE Id=:id';

        $arr =  $db->query($sql, static::class, [':id'=>$id]);

        if (!empty($arr)) {
            return $arr[0];
        } else {
            return false;
        }

    }

    public function isNew()
    {
        return null === $this->id;
    }

    public function insert()
    {
        if (!$this->isNew()) {
            return false;
        }

        $properties = get_object_vars($this);

        $cols = [];
        $binds = [];
        $data = [];
        foreach ($properties as $name => $value) {
            if ('id' == $name) {
                continue;
            }
            $cols[] = $name;
            $binds[] = ':' . $name;
            $data[':' . $name] = $value;
        }

        $sql = 'INSERT INTO ' . static::$table . ' (' . implode(', ', $cols). ') VALUES (' . implode(', ', $binds). ')';
        $db = new Db();
        $db->execute($sql, $data);

        $this->id = $db->getId();

    }

    public function update()
    {
        $properties = get_object_vars($this);

        $binds = [];
        $data = [];

        foreach ($properties as $name => $value) {
            $data[':' . $name] = $value;
            if ('id' == $name) {
                continue;
            }
            $binds[] = ($name . ' = :' . $name);


    }
        $sql = 'UPDATE ' . static::$table . ' SET ' . implode (', ',  $binds) . ' WHERE id = :id';
        $db = new Db();
        return $db->execute($sql, $data);
    }

    public function save()
    {
        if (!$this->isNew()) {
            $this->update();
        } else {
            $this->insert();
        }
    }

    public function delete()
    {
        $sql = 'DELETE FROM ' . static::$table . ' WHERE id = :id';
        $db = new Db();
        return $db->execute($sql, ['id' => $this->id]);

    }

    public function saveFromPost()
    {
        $properties = get_object_vars($this);

        foreach (array_keys($properties) as $name) {

            if (!isset ($_POST[$name])) {
                continue;
            }

            $this->$name = $_POST[$name];

        }

    }



}