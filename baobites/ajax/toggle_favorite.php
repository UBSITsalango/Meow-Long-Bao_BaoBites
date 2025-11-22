<?php
require '../app/db.php';
session_start();

$rid = $_POST['recipe_id'];
$uid = $_SESSION['user_id'];

$check = $pdo->prepare("SELECT * FROM favorite WHERE user_id=? AND recipe_id=?");
$check->execute([$uid, $rid]);

if ($check->rowCount() > 0) {
    $del = $pdo->prepare("DELETE FROM favorite WHERE user_id=? AND recipe_id=?");
    $del->execute([$uid, $rid]);
    echo json_encode(['status' => 'removed']);
} else {
    $add = $pdo->prepare("INSERT INTO favorite (user_id, recipe_id) VALUES (?, ?)");
    $add->execute([$uid, $rid]);
    echo json_encode(['status' => 'added']);
}
?>