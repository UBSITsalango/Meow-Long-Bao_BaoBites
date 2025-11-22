<?php
session_start();
require '../app/db.php';

$user = $_POST['username'];
$pass = $_POST['password'];

$stmt = $pdo->prepare("SELECT * FROM users WHERE username=? LIMIT 1");
$stmt->execute([$user]);
$u = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$u) {
    echo json_encode(["status" => "error", "msg" => "User not found"]);
    exit;
}

if (!password_verify($pass, $u['password'])) {
    echo json_encode(["status" => "error", "msg" => "Incorrect password"]);
    exit;
}

$_SESSION['user_id'] = $u['user_id'];
$_SESSION['role'] = $u['role'];
$_SESSION['name'] = $u['first_name'];

echo json_encode([
    "status" => "success",
    "role" => $u['role']
]);

