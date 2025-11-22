<?php
require '../app/db.php';

$first = $_POST['first_name'];
$last  = $_POST['last_name'];
$user  = $_POST['username'];
$email = $_POST['email'];
$pass  = password_hash($_POST['password'], PASSWORD_DEFAULT);

$stmt = $pdo->prepare("
    INSERT INTO users (first_name, last_name, username, email, password)
    VALUES (?, ?, ?, ?, ?)
");

try {
    $stmt->execute([$first, $last, $user, $email, $pass]);
    echo json_encode(["status" => "success"]);
    exit;
} catch (PDOException $e) {
    echo json_encode(["status" => "error", "msg" => "Username or email already exists"]);
    exit;
}
