<?php
require '../app/db.php';
session_start();

if ($_SESSION['role'] !== 'admin') {
    echo json_encode(['status' => 'error', 'msg' => 'Unauthorized']);
    exit;
}

$id = $_POST['user_id'];
$username = $_POST['username'];
$email = $_POST['email'];
$role = $_POST['role'];

$stmt = $pdo->prepare("
    UPDATE users SET username=?, email=?, role=? WHERE user_id=?
");
$ok = $stmt->execute([$username, $email, $role, $id]);

echo json_encode(['status' => $ok ? 'success' : 'error']);
