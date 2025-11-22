<?php
require_once __DIR__ . '/db.php';

function getComments($recipe_id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT c.*, u.username FROM comment c JOIN users u ON c.user_id=u.user_id WHERE recipe_id=? ORDER BY created_at DESC");
    $stmt->execute([$recipe_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>