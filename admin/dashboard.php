<?php 
require '../config/database.php';
require '../includes/header.php'; 
?>

<div class="page-header">
    <h2>Dashboard</h2>
    <p>Overview of maintenance requests and system status</p>
</div>

<?php
$pending = $pdo->query("SELECT COUNT(*) FROM complaints WHERE status='Pending'")->fetchColumn();
$progress = $pdo->query("SELECT COUNT(*) FROM complaints WHERE status='In Progress'")->fetchColumn();
$resolved = $pdo->query("SELECT COUNT(*) FROM complaints WHERE status='Resolved'")->fetchColumn();
?>

<div class="stats">
    <div class="stat-card pending">
        <h3>Pending Requests</h3>
        <div class="num"><?= $pending ?></div>
    </div>
    <div class="stat-card progress">
        <h3>In Progress</h3>
        <div class="num"><?= $progress ?></div>
    </div>
    <div class="stat-card resolved">
        <h3>Resolved</h3>
        <div class="num"><?= $resolved ?></div>
    </div>
</div>

<div class="card">
    <h3>Quick Actions</h3>
    <div class="btn-group">
        <a href="complaints.php" class="btn btn-primary">View All Complaints</a>
        <a href="announcements.php" class="btn btn-success">Manage Announcements</a>
    </div>
</div>

<?php require '../includes/footer.php'; ?>