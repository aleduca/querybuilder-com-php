<?php

namespace Database\Query;

use PDO;
use PDOException;

class Connection
{
    private static $pdo = null;

    public static function open()
    {
        if (!static::$pdo) {
            try {
                static::$pdo = new PDO('mysql:host=localhost;dbname=books', 'root', '', [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
                ]);

                return static::$pdo;
            } catch (PDOException $e) {
                var_dump($e->getMessage());
            }
        }
    }

    public static function close()
    {
        static::$pdo = null;
    }
}
