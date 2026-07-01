<?php
require '../includes/auth_check.php';
requireRole('admin');
require '../config/database.php';
$stmt = $pdo->prepare("DELETE FROM complaints WHERE id=?");
$stmt->execute([(int)$_POST['id']]);
header("Location: complaints.php");
exit();
?>