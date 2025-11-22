<?php
require '../app/db.php';
session_start();

$stmt = $pdo->query("
    SELECT user_id, username, email, joined_at AS created_at, role
    FROM users
    ORDER BY joined_at DESC
");

echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
?>
