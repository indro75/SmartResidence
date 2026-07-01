<?php
require '../includes/auth_check.php';
require '../config/database.php';
$id = (int)$_POST['id'];
$stmt = $pdo->prepare("DELETE FROM complaints WHERE id=? AND tenant_id=? AND status='Pending'");
$stmt->execute([$id, $_SESSION['user_id']]);
header("Location: complaints.php");
exit();
?>