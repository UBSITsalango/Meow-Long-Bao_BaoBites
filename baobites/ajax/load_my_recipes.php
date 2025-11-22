<?php
require '../app/db.php';
session_start();

$uid = $_SESSION['user_id'];

$stmt = $pdo->prepare("
    SELECT *
    FROM recipes
    WHERE user_id = ?
    ORDER BY created_at DESC
");

$stmt->execute([$uid]);

echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
?>
