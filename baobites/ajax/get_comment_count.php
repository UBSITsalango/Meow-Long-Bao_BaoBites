<?php
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/../app/db.php';
require_once __DIR__ . '/../app/auth.php';
requireAdmin();

try {
    $stmt = $pdo->query("SELECT COUNT(*) as cnt FROM comment");
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode(['count' => intval($row['cnt'])]);
} catch (Exception $e) {
    echo json_encode(['count' => 0, 'error' => $e->getMessage()]);
}
