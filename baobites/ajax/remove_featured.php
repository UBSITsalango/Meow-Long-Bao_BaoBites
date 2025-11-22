<?php
require '../app/db.php';
session_start();

if ($_SESSION['role'] !== 'admin') {
    echo json_encode(['status' => 'error']);
    exit;
}

$rid = $_POST['recipe_id'] ?? null;

if (!$rid) {
    echo json_encode(['status' => 'error']);
    exit;
}

$stmt = $pdo->prepare("DELETE FROM featured_recipes WHERE recipe_id=?");
$stmt->execute([$rid]);

echo json_encode(['status' => 'success']);
