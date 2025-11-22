<?php
require '../app/db.php';
session_start();

$content = $_POST['content'];
$rid = $_POST['recipe_id'];
$uid = $_SESSION['user_id'];

$stmt = $pdo->prepare("INSERT INTO comment (content, user_id, recipe_id) VALUES (?, ?, ?)");
$stmt->execute([$content, $uid, $rid]);

echo json_encode(['status' => 'success']);
?>