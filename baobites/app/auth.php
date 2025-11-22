<?php
session_start();

function requireLogin() {
    if (empty($_SESSION['user_id'])) {
        if (strpos($_SERVER['REQUEST_URI'], '/ajax/') !== false) {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'msg' => 'Not logged in']);
            exit;
        }
        header('Location: /public/login.php');
        exit;
    }
}

function requireAdmin() {
    requireLogin();
    if (empty($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
        if (strpos($_SERVER['REQUEST_URI'], '/ajax/') !== false) {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'msg' => 'Admin only']);
            exit;
        }
        http_response_code(403);
        echo "Access denied. Admins only.";
        exit;
    }
}
