<?php
require '../app/db.php';
session_start();

$stmt = $pdo->query("
    SELECT r.*, u.username,
        (SELECT 1 FROM featured_recipes f WHERE f.recipe_id = r.recipe_id LIMIT 1) AS is_featured
    FROM recipes r
    JOIN users u ON r.user_id = u.user_id
    ORDER BY r.created_at DESC;
");

echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
?>
