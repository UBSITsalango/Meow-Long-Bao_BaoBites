<?php
session_start();
require '../app/db.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    echo json_encode(['error' => 'Missing recipe ID']);
    exit;
}

// Load recipe
$recipe = $pdo->prepare("
    SELECT r.*, u.username 
    FROM recipes r 
    JOIN users u ON r.user_id = u.user_id 
    WHERE recipe_id = ?
");
$recipe->execute([$id]);
$recipeData = $recipe->fetch(PDO::FETCH_ASSOC);

// No recipe found
if (!$recipeData) {
    echo json_encode(['error' => 'Recipe not found']);
    exit;
}

// Load comments
$comments = $pdo->prepare("
    SELECT c.*, u.username 
    FROM comment c 
    JOIN users u ON c.user_id = u.user_id 
    WHERE recipe_id = ? 
    ORDER BY c.created_at DESC
");
$comments->execute([$id]);
$comData = $comments->fetchAll(PDO::FETCH_ASSOC);

// Load rating
$rating = $pdo->prepare("SELECT ROUND(AVG(score),1) AS avg FROM rating WHERE recipe_id=?");
$rating->execute([$id]);
$avg = $rating->fetch(PDO::FETCH_ASSOC);

// Load favorite
$fav = false;
if (isset($_SESSION['user_id'])) {
    $favQ = $pdo->prepare("SELECT 1 FROM favorite WHERE user_id=? AND recipe_id=?");
    $favQ->execute([$_SESSION['user_id'], $id]);
    $fav = $favQ->fetchColumn() ? true : false;
}

echo json_encode([
    'recipe'   => $recipeData,
    'comments' => $comData,
    'rating'   => $avg['avg'] ?? 0,
    'favorite' => $fav
]);
?>
