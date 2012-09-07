<?php
/**
 * This class provides some handy wrapper functions for accessing databases.
 * All functions are injection-proof and use prepared statements where possible.
 */
define(CONFIG, './config/');

class DB {
    static function last_error() {
        return 'ERROR CODE: ' . self::$last_error[0];
    }

    static function insert($string, $params, $id_name = '') {
        try {
            self::connect();
            $prep = self::$dbh->prepare($string);
            if ($prep->execute($params)) {
                $id = self::$dbh->lastInsertId($id_name);
                self::disconnect();
                return $id;
            } else {
                self::$last_error = self::$dbh->errorInfo();
                self::disconnect();
                return false;
            }
        } catch (PDOException $exc) {
            self::$last_error = $exc;
            return false;
        }
    }

    static function insert_all($db_obj_arr) {
        self::connect();
        $success = true;
        $total = 0;
        foreach ($db_obj_arr as $db_obj) {
            $success = true;
            try {
                $map = $db_obj->fields();
                $table = $db_obj->table();
                $fields = implode(', ', array_keys($map));
                $names_arr = array();
                foreach (array_keys($map) as $field) {
                    $names_arr []= '?';
                }
                $names = implode(', ', $values_arr);
                $sql = 'INSERT INTO ' . $table . ' (' . $fields . ') VALUES (' .
                    $names . ')';
                $values = array();
                foreach (array_keys($map) as $field) {
                    $values []= $map[$field];
                }
                $stm = self::$dbh->prepare($sql);
                self::$dbh->execute($stm, $values);
            } catch (PDOException $exc) {
                $success = false;
            }
            $total += $success ? 1 : 0;
        }
        self::disconnect();
        return $total;
    }

    static function query($string, $params) {
        self::connect();
        $prep = self::$dbh->prepare($string);
        $result = array();
        if ($prep->execute($params)) {
            while ($row = $prep->fetch(PDO::FETCH_ASSOC)) {
                $result []= $row;
            }
        } else {
            self::$last_error = self::$dbh->errorInfo();
            return false;
        }
        self::disconnect();
        return $result;
    }

    static function delete($string, $params) {
        self::connect();
        $prep = self::$dbh->prepare($string);
        if ($prep->execute($params)) {
            self::disconnect();
            return $prep->rowCount();
        } else {
            self::$last_error = $self::$dbh->errorInfo();
            self::disconnect();
            return false;
        }
    }

    static function update($string, $params) {
        self::connect();
        $prep = self::$dbh->prepare($string);
        if ($prep->execute($params)) {
            self::disconnect();
            return $prep->rowCount();
        } else {
            self::$last_error = $self::$dbh->errorInfo();
            self::disconnect();
            return false;
        }
    }

    private static function connect() {
        $xml = simplexml_load_file(CONFIG . 'conf.xml');
        $db_node = $xml->databases->database;
        $host = (string)$db_node->host;
        $db_name = (string)$db_node->database;
        $user = (string)$db_node->user;
        $pass = (string)$db_node->password;
        try {
            self::$dbh = new PDO('mysql:host=' . $host . ';dbname=' .
                $db_name, $user, $pass);
        } catch (PDOException $e) {
            echo $e;
        }
    }

    private static function disconnect() {
        self::$dbh = null;
    }

    private static $dbh;
    private static $last_error;
}
