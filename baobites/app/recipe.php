<?php
require_once __DIR__ . '/db.php';

function getRecipe($id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT r.*, u.username FROM recipes r JOIN users u ON r.user_id = u.user_id WHERE recipe_id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getUserRecipes($uid) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM recipes WHERE user_id=? ORDER BY created_at DESC");
    $stmt->execute([$uid]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>