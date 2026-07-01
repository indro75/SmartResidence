<?php 
require '../config/database.php';
require '../includes/header.php'; 
?>
<h2>Community Announcements</h2>

<div class="card">
    <h3>📢 Post New Announcement</h3>
    <form method="POST">
        <div class="form-group"><label>Title</label><input type="text" name="title" required></div>
        <div class="form-group"><label>Message</label><textarea name="message" required></textarea></div>
        <button type="submit" class="btn btn-success">Publish</button>
    </form>
</div>

<div class="card">
    <h3>Existing Announcements</h3>
    <table>
        <tr><th>Date</th><th>Title</th><th>Message</th><th>Action</th></tr>
        <?php
        $stmt = $pdo->query("SELECT * FROM announcements ORDER BY created_at DESC");
        foreach ($stmt as $a): ?>
        <tr>
            <td><?= $a['created_at'] ?></td>
            <td><?= htmlspecialchars($a['title']) ?></td>
            <td><?= nl2br(htmlspecialchars($a['message'])) ?></td>
            <td>
                <form method="POST" action="delete_announcement.php" onsubmit="return confirm('Delete?')">
                    <input type="hidden" name="id" value="<?= $a['id'] ?>">
                    <button class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("INSERT INTO announcements (admin_id, title, message) VALUES (?, ?, ?)");
    $stmt->execute([$_SESSION['user_id'], trim($_POST['title']), trim($_POST['message'])]);
    header("Location: announcements.php");
    exit();
}
require '../includes/footer.php';
?>