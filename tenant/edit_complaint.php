<?php 
require '../config/database.php';
require '../includes/header.php'; 
?>
<?php
$id = (int)$_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM complaints WHERE id=? AND tenant_id=? AND status='Pending'");
$stmt->execute([$id, $_SESSION['user_id']]);
$c = $stmt->fetch();
if (!$c) die("Not found or cannot be edited.");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("UPDATE complaints SET title=?, description=?, category=? WHERE id=? AND tenant_id=?");
    $stmt->execute([trim($_POST['title']), trim($_POST['description']), $_POST['category'], $id, $_SESSION['user_id']]);
    header("Location: complaints.php");
    exit();
}
?>
<h2>Edit Complaint</h2>
<div class="card">
<form method="POST">
    <div class="form-group"><label>Title</label><input type="text" name="title" value="<?= htmlspecialchars($c['title']) ?>" required></div>
    <div class="form-group"><label>Category</label>
        <select name="category" required>
            <?php foreach (['Plumbing','Electrical','HVAC','Pest Control','Other'] as $cat): ?>
                <option value="<?= $cat ?>" <?= $c['category']===$cat?'selected':'' ?>><?= $cat ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group"><label>Description</label><textarea name="description" required><?= htmlspecialchars($c['description']) ?></textarea></div>
    <button type="submit" class="btn btn-success">Update</button>
    <a href="complaints.php" class="btn btn-primary">Cancel</a>
</form>
</div>
<?php require '../includes/footer.php'; ?>