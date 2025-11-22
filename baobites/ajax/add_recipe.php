<?php
require '../app/db.php';
session_start();

$title = $_POST['title'];
$ing = $_POST['ingredients'];
$ins = $_POST['instructions'];
$cat = $_POST['category'];
$uid = $_SESSION['user_id'];

$stmt = $pdo->prepare("INSERT INTO recipes (title, ingredients, instructions, category, user_id) VALUES (?, ?, ?, ?, ?)");
$stmt->execute([$title, $ing, $ins, $cat, $uid]);

echo json_encode(['status' => 'success']);
?>