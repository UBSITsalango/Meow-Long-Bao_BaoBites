<?php
require '../app/db.php';
session_start();

if ($_SESSION['role'] !== 'admin') {
    echo json_encode(['status' => 'error', 'msg' => 'Unauthorized']);
    exit;
}

$user_id = $_POST['user_id'] ?? null;

if (!$user_id) {
    echo json_encode(['status' => 'error', 'msg' => 'Missing user id']);
    exit;
}

// prevent admin from deleting themselves
if ($user_id == $_SESSION['user_id']) {
    echo json_encode(['status' => 'error', 'msg' => 'You cannot delete your own account.']);
    exit;
}

// delete user and all dependent data
$stmt = $pdo->prepare("DELETE FROM users WHERE user_id = ?");
$stmt->execute([$user_id]);

echo json_encode(['status' => 'success']);
