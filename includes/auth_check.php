<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: /apartment_portal/index.php");
    exit();
}

function requireRole($role) {
    if ($_SESSION['role'] !== $role) {
        die("⛔ Access Denied: You do not have permission to view this page.");
    }
}
?>