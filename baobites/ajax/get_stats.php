<?php
require '../app/db.php';

$out = [];

// users
$out['users'] = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();

// recipes
$out['recipes'] = $pdo->query("SELECT COUNT(*) FROM recipes")->fetchColumn();

// favorites
$out['favorites'] = $pdo->query("SELECT COUNT(*) FROM favorite")->fetchColumn();

echo json_encode($out);
