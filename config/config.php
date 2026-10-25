<?php
$GLOBALS['DB_CONFIG'] = [
    'db_host' => getenv('DB_HOST') ?: 'gestion-utilisateurs',
    'db_name' => getenv('DB_DATABASE') ?: 'gestion_utilisateurs',
    'db_user' => getenv('DB_USER') ?: 'root',
    'db_pass' => getenv('DB_PASS') ?: 'root',
    'db_charset' => 'utf8mb4',
    'db_options' => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::ATTR_PERSISTENT => false,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci"
    ]
];