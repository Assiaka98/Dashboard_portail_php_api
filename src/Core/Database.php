<?php
namespace App\Core;

use PDO;

class Database {
    private static $instance = null;

    public static function getInstance() {
        if (self::$instance === null) {
            require __DIR__ . '/../../config/config.php';
            $config = $GLOBALS['DB_CONFIG'];
            $dsn = "mysql:host={$config['db_host']};dbname={$config['db_name']};charset={$config['db_charset']}";
            self::$instance = new PDO($dsn, $config['db_user'], $config['db_pass'], [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        }
        return self::$instance;
    }
}