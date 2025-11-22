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

$stmt = $pdo->prepare("INSERT INTO featured_recipes (recipe_id) VALUES (?)");
$stmt->execute([$rid]);

echo json_encode(['status' => 'success']);
