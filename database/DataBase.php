<?php

namespace Database;

use PDO;
use PDOException;

class DataBase
{

    protected $connection;

    function __construct()
    {
        if (!isset($connection)) {
            global $dbHost, $dbUsername, $dbName, $dbPassword;
            $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');

            try {
                $this->connection = new PDO("mysql:host=" . $dbHost . ";dbname=" . $dbName, $dbUsername, $dbPassword, $options);
                // echo 'ok';
            } catch (PDOException $e) {
                echo $e->getMessage();
                exit;
            }
        }
    }



    public function select($sql, $values = null)
    {
        try {
            $stmt = $this->connection->prepare($sql);
            if ($values == null) {
                $stmt->execute();
            } else {
                $stmt->execute($values);
            }
            $result = $stmt;
            return $result;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    // insert('users', ['username', 'password'], ['alik2', 12345]);
    public function insert($tableName, $fields, $values)
    {

        try {
            $sqlFields = implode(', ', $fields);
            $sqlValues = implode(', :', $fields);
            $sql = "INSERT INTO $tableName ($sqlFields,created_at) VALUES (:$sqlValues,now())";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute(array_combine($fields, $values)); //باید آرایه باشد
            // return true;

            $id = $this->connection->lastInsertId();
            return $id;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }


    // update('users', 2, ['username', 'password'], ['alik2', 12345]);
    public function update($tableName, $id, $fields, $values)
    {


        $sql = "UPDATE $tableName SET";
        foreach (array_combine($fields, $values) as $field => $value) {
            if ($value) {
                $sql .= " `" . $field . "` = ? ,";
            } else {
                $sql .= " `" . $field . "` = NULL ,";
            }
        }

        $sql .= " updated_at = now() WHERE id = ?";
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute(array_merge(array_filter(array_values($values)), [$id]));
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    // delete('users', 2);
    public function delete($tableName, $id)
    {
        try {
            $sql = "DELETE FROM $tableName WHERE id=? ;";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$id]);
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }


    public function closeConnection()
    {
        $this->connection = null;;
    }
}
