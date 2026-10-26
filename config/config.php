<?php
$dbHost = getenv('DB_HOST') ?: '127.0.0.1';
$dbPort = getenv('DB_PORT') ?: '33053';
$dbName = getenv('DB_NAME') ?: 'gestion_utilisateurs';
$dbUser = getenv('DB_USER') ?: 'gestion_utilisateurs_u';
$dbPass = getenv('DB_PASS') ?: 'e49cRAIBU4ywFHNIYv48QD5G';

$GLOBALS['DB_CONFIG'] = [
    'db_host' => $dbHost,
    'db_port' => $dbPort,
    'db_name' => $dbName,
    'db_user' => $dbUser,
    'db_pass' => $dbPass,
    'db_charset' => 'utf8mb4',
    'db_options' => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::ATTR_PERSISTENT => false,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci"
    ]
];