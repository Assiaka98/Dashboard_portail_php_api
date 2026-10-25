<?php
$GLOBALS['DB_CONFIG'] = [
    'db_host' => '127.0.0.1',
    'db_name' => 'gestion_utilisateurs',
    'db_user' => 'root',
    'db_pass' => 'root',
    'db_charset' => 'utf8mb4',
    'db_options' => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::ATTR_PERSISTENT => false,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci"
    ]
];

if (!function_exists('getDB')) {
    function getDB() {
        static $pdo = null;
        if ($pdo === null) {
            $c = $GLOBALS['DB_CONFIG'];
            $dsn = "mysql:host={$c['db_host']};dbname={$c['db_name']};charset={$c['db_charset']}";
            $pdo = new PDO($dsn, $c['db_user'], $c['db_pass'], $c['db_options']);
        }
        return $pdo;
    }
}
