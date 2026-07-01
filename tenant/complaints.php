<?php 
require '../config/database.php';
require '../includes/header.php'; 
?>
<h2>My Complaints</h2>
<div class="card">
<table>
    <tr><th>Date</th><th>Title</th><th>Category</th><th>Status</th><th>Actions</th></tr>
    <?php
    $stmt = $pdo->prepare("SELECT * FROM complaints WHERE tenant_id = ? ORDER BY created_at DESC");
    $stmt->execute([$_SESSION['user_id']]);
    foreach ($stmt as $c):
        $statusClass = 'status-' . str_replace(' ', '', $c['status']);
    ?>
    <tr>
        <td><?= $c['created_at'] ?></td>
        <td><?= htmlspecialchars($c['title']) ?></td>
        <td><?= $c['category'] ?></td>
        <td><span class="status <?= $statusClass ?>"><?= $c['status'] ?></span></td>
        <td class="actions">
            <?php if ($c['status'] === 'Pending'): ?>
                <a href="edit_complaint.php?id=<?= $c['id'] ?>" class="btn btn-warning">Edit</a>
                <form method="POST" action="delete_complaint.php" onsubmit="return confirm('Delete this?')">
                    <input type="hidden" name="id" value="<?= $c['id'] ?>">
                    <button class="btn btn-danger">Delete</button>
                </form>
            <?php else: ?>—<?php endif; ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
</div>
<a href="dashboard.php" class="btn btn-primary">← Back</a>
<?php require '../includes/footer.php'; ?>