<?php
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Origin: *");
$config = require __DIR__ . '/../config/config.php';
try {
  $pdo = new PDO("mysql:host={$config['db_host']};dbname={$config['db_name']};charset=utf8mb4", $config['db_user'], $config['db_pass'], [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC]);
  $total = $pdo->query("SELECT COUNT(*) as total FROM users")->fetch();
  $today = $pdo->query("SELECT COUNT(*) as today FROM users WHERE DATE(date_creation) = CURDATE()")->fetch();
  echo json_encode(['status'=>'success','total_users'=>(int)$total['total'],'today'=>(int)$today['today']]);
} catch (Throwable $e) {
  http_response_code(500);
  echo json_encode(['status'=>'error','message'=>$e->getMessage()]);
}
