<?php
require '../app/db.php';

$stmt = $pdo->query("
    SELECT r.*, u.username
    FROM featured_recipes f
    JOIN recipes r ON f.recipe_id = r.recipe_id
    JOIN users u ON r.user_id = u.user_id
    ORDER BY f.id DESC
    LIMIT 3
");

echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
