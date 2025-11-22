<?php
require_once __DIR__ . '/db.php';

function getAverageRating($recipe_id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT ROUND(AVG(score),1) AS avg FROM rating WHERE recipe_id=?");
    $stmt->execute([$recipe_id]);
    $r = $stmt->fetch(PDO::FETCH_ASSOC);
    return $r['avg'] ?? 0;
}
?>