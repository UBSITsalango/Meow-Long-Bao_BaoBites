<?php
require '../app/db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'msg' => 'Not logged in']);
    exit;
}

$id = $_POST['recipe_id'] ?? null;
$title = $_POST['title'];
$ing = $_POST['ingredients'];
$ins = $_POST['instructions'];
$cat = $_POST['category'];
$uid = $_SESSION['user_id'];

$stmt = $pdo->prepare("UPDATE recipes 
    SET title=?, ingredients=?, instructions=?, category=?, updated_at=NOW()
    WHERE recipe_id=? AND user_id=?");

$ok = $stmt->execute([$title, $ing, $ins, $cat, $id, $uid]);

echo json_encode(['status' => $ok ? 'success' : 'error']);
exit;
?>
