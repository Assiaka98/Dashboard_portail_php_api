<?php
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Origin: *");
require __DIR__ . '/../config/config.php';
$start = microtime(true);
try {
    $pdo = getDB();
    $count = $pdo->query("SELECT COUNT(*) as c FROM users")->fetch()['c'];
    $time = round((microtime(true)-$start)*1000, 2);
    echo json_encode(['status'=>'success','message'=>'Connexion BD fluide','db'=>'gestion_utilisateurs','users'=>(int)$count,'latency_ms'=>$time], JSON_UNESCAPED_UNICODE);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['status'=>'error','message'=>$e->getMessage()]);
}
