<?php
require_once 'config.php';

function e($str) { return htmlspecialchars($str, ENT_QUOTES, 'UTF-8'); }

function flash($key, $msg=null) {
    if ($msg === null) {
        if (isset($_SESSION['flash'][$key])) {
            $m = $_SESSION['flash'][$key];
            unset($_SESSION['flash'][$key]);
            return $m;
        }
        return null;
    }
    $_SESSION['flash'][$key] = $msg;
}

function is_logged_in() { return !empty($_SESSION['user']); }

function current_user() { return $_SESSION['user'] ?? null; }

function require_login() {
    if (!is_logged_in()) {
        header('Location: login.php');
        exit;
    }
}

function require_role($roles = []) {
    require_login();
    $user = current_user();
    if (!in_array($user['role'],$roles)) {
        http_response_code(403);
        echo "<h3>403 — Forbidden</h3><p>You don't have permission to access this page.</p>";
        exit;
    }
}
