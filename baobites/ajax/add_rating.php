<?php
require '../app/db.php';
session_start();

$score = $_POST['score'];
$rid = $_POST['recipe_id'];
$uid = $_SESSION['user_id'];

$stmt = $pdo->prepare("INSERT INTO rating (score, user_id, recipe_id) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE score=?");
$stmt->execute([$score, $uid, $rid, $score]);

echo json_encode(['status' => 'success']);
?>