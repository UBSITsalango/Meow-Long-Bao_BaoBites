<?php
require_once __DIR__ . '/db.php';

function getFavorites($uid) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT r.* FROM favorite f JOIN recipes r ON f.recipe_id=r.recipe_id WHERE f.user_id=?");
    $stmt->execute([$uid]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>