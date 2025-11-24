<?php
require '../app/db.php';
session_start();

// Must be logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(["error" => "not_logged_in"]);
    exit;
}

$uid = $_SESSION['user_id'];
$score = $_POST['score'] ?? null;
$rid = $_POST['recipe_id'] ?? null;

// Validation
if (!$score || !$rid) {
    echo json_encode(["error" => "invalid_data"]);
    exit;
}

// Check if the recipe exists AND get the owner ID
$stmt = $pdo->prepare("SELECT user_id FROM recipes WHERE recipe_id = ?");
$stmt->execute([$rid]);
$recipe = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$recipe) {
    echo json_encode(["error" => "recipe_not_found"]);
    exit;
}

// Prevent owner from rating own recipe
if ($recipe['user_id'] == $uid) {
    echo json_encode(["error" => "cannot_rate_own_recipe"]);
    exit;
}

// Insert or update rating
$stmt = $pdo->prepare("
    INSERT INTO rating (score, user_id, recipe_id)
    VALUES (?, ?, ?)
    ON DUPLICATE KEY UPDATE score = ?
");
$stmt->execute([$score, $uid, $rid, $score]);

echo json_encode(["status" => "success"]);
?>
