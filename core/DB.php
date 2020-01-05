<?php

class DB
{
    private static $_instance = null;
    private $_pdo, $_query, $_error = false, $_results, $_count = 0, $_last_inserted_id = null;

    public function __construct()
    {
        try {
            $this->_pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
            $this->_pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public static function getInstance()
    {
        if (!isset(self::$_instance))
            self::$_instance = new DB();

        return self::$_instance;
    }

    public function query($sql, $params = [])
    {
        $this->_error = false;
        if ($this->_query = $this->_pdo->prepare($sql)) {
            $x = 1;

            if (sizeof($params)) {
                foreach ($params as $param) {
                    $this->_query->bindValue($x, $param);
                    $x++;
                }
            }

            if ($this->_query->execute()) {
                $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
                $this->_count = $this->_query->rowCount();
                $this->_last_inserted_id = $this->_pdo->lastInsertId();
            } else {
                $this->_error = true;
                throw new Exception($this->_query->errorInfo());
            }
        }

        return $this;
    }

    public function insert($table, $datas)
    {
        $field_str = '';
        $value_str = '';
        $values = [];

        foreach ($datas as $col => $value) {
            $field_str .= '`' . $col . '`,';
            $value_str .= '?,';

            array_push($values, $value);
        }

        $field_str = rtrim($field_str, ',');
        $value_str = rtrim($value_str, ',');

        $sql = "INSERT INTO {$table} ({$field_str}) VALUES({$value_str})";

        if (!$this->query($sql, $values)->error()) return true;

        return false;
    }

    public function update($table, $id, $datas)
    {
        $field_str = '';
        $values = [];
        foreach ($datas as $col => $value) {

            $field_str .=  '`' . $col . '`=?,';

            array_push($values, $value);
        }

        $field_str = rtrim($field_str, ',');

        $sql = "UPDATE {$table} SET {$field_str} WHERE id = {$id}";

        if (!$this->query($sql, $values)->error()) return true;

        return false;
    }


    public function delete($table, $id)
    {
        $sql = "DELETE FROM {$table} WHERE id = {$id}";

        if (!$this->query($sql)->error()) return true;

        return false;
    }

    public function first()
    {
        return $this->_results[0];
    }

    public function results()
    {
        return $this->_results;
    }

    public function get_columns($table)
    {
        return $this->query("SHOW COLUMNS FROM {$table}")->results();
    }

    public function error()
    {
        return $this->_error;
    }
}
