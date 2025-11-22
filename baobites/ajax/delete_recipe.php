<?php
require '../app/db.php';
session_start();

if (!isset($_POST['recipe_id'])) {
    echo json_encode(["status" => "error", "msg" => "Missing recipe ID"]);
    exit;
}

$recipe_id = intval($_POST['recipe_id']);
$user_id = $_SESSION['user_id'] ?? null;
$role = $_SESSION['role'] ?? 'user';

if (!$user_id) {
    echo json_encode(["status" => "error", "msg" => "Not logged in"]);
    exit;
}

// USER DELETE OWN RECIPE
$stmt = $pdo->prepare("DELETE FROM recipes WHERE recipe_id = ? AND user_id = ?");
$stmt->execute([$recipe_id, $user_id]);

if ($stmt->rowCount() > 0) {
    echo json_encode(["status" => "success"]);
    exit;
}

// ADMIN DELETE ANY RECIPE
if ($role === "admin") {
    $adminStmt = $pdo->prepare("DELETE FROM recipes WHERE recipe_id = ?");
    $adminStmt->execute([$recipe_id]);

    if ($adminStmt->rowCount() > 0) {
        echo json_encode(["status" => "success"]);
        exit;
    }
}

echo json_encode(["status" => "error", "msg" => "Recipe not found"]);
exit;
