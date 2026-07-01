<?php 
require '../config/database.php';
require '../includes/header.php'; 
?>

<div class="page-header">
    <h2>Welcome, <?= htmlspecialchars($_SESSION['name']) ?></h2>
    <p>Apartment #<?= htmlspecialchars($_SESSION['apartment_number'] ?? 'N/A') ?></p>
</div>

<?php
$uid = $_SESSION['user_id'];
$total = $pdo->query("SELECT COUNT(*) FROM complaints WHERE tenant_id=$uid")->fetchColumn();
$active = $pdo->query("SELECT COUNT(*) FROM complaints WHERE tenant_id=$uid AND status!='Resolved'")->fetchColumn();
?>

<div class="stats">
    <div class="stat-card">
        <h3>Total Requests</h3>
        <div class="num"><?= $total ?></div>
    </div>
    <div class="stat-card">
        <h3>Active Issues</h3>
        <div class="num"><?= $active ?></div>
    </div>
</div>

<div class="card">
    <h3>📢 Community Announcements</h3>
    <?php
    $stmt = $pdo->query("SELECT * FROM announcements ORDER BY created_at DESC LIMIT 5");
    $announcements = $stmt->fetchAll();
    
    if (count($announcements) > 0):
        foreach ($announcements as $a): ?>
            <div class="announcement">
                <h4><?= htmlspecialchars($a['title']) ?></h4>
                <small><?= date('M d, Y', strtotime($a['created_at'])) ?></small>
                <p><?= nl2br(htmlspecialchars($a['message'])) ?></p>
            </div>
        <?php endforeach;
    else: ?>
        <p class="text-muted">No announcements at this time.</p>
    <?php endif; ?>
</div>

<div class="card">
    <h3>Quick Actions</h3>
    <div class="btn-group">
        <a href="new_complaint.php" class="btn btn-success">Submit Maintenance Request</a>
        <a href="complaints.php" class="btn btn-primary">View My Requests</a>
    </div>
</div>

<?php require '../includes/footer.php'; ?>