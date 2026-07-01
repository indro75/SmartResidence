<?php
require '../includes/auth_check.php';
requireRole('admin');
require '../config/database.php';
$stmt = $pdo->prepare("UPDATE complaints SET status=? WHERE id=?");
$stmt->execute([$_POST['status'], (int)$_POST['id']]);
header("Location: complaints.php");
exit();
?>