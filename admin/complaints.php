<?php 
require '../config/database.php';
require '../includes/header.php'; 
?>
<h2>All Complaints</h2>
<div class="card">
<table>
    <tr><th>Tenant</th><th>Apt</th><th>Title</th><th>Category</th><th>Status</th><th>Photo</th><th>Actions</th></tr>
    <?php
    $stmt = $pdo->query("SELECT c.*, u.full_name, u.apartment_number FROM complaints c JOIN users u ON c.tenant_id=u.id ORDER BY c.created_at DESC");
    foreach ($stmt as $c):
        $statusClass = 'status-' . str_replace(' ', '', $c['status']);
    ?>
    <tr>
        <td><?= htmlspecialchars($c['full_name']) ?></td>
        <td><?= htmlspecialchars($c['apartment_number']) ?></td>
        <td><?= htmlspecialchars($c['title']) ?><br><small><?= htmlspecialchars($c['description']) ?></small></td>
        <td><?= $c['category'] ?></td>
        <td><span class="status <?= $statusClass ?>"><?= $c['status'] ?></span></td>
        <td><?php if ($c['image_path']): ?><a href="/apartment_portal/<?= $c['image_path'] ?>" target="_blank">View</a><?php else: ?>—<?php endif; ?></td>
        <td>
            <form method="POST" action="update_status.php" style="display:inline">
                <input type="hidden" name="id" value="<?= $c['id'] ?>">
                <select name="status" onchange="this.form.submit()">
                    <option <?= $c['status']==='Pending'?'selected':'' ?>>Pending</option>
                    <option <?= $c['status']==='In Progress'?'selected':'' ?>>In Progress</option>
                    <option <?= $c['status']==='Resolved'?'selected':'' ?>>Resolved</option>
                </select>
            </form>
            <form method="POST" action="delete_complaint.php" onsubmit="return confirm('Delete permanently?')" style="display:inline">
                <input type="hidden" name="id" value="<?= $c['id'] ?>">
                <button class="btn btn-danger">Delete</button>
            </form>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
</div>
<a href="dashboard.php" class="btn btn-primary">← Back</a>
<?php require '../includes/footer.php'; ?>