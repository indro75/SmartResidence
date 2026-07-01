<?php 
require '../config/database.php';
require '../includes/header.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $desc = trim($_POST['description']);
    $cat = $_POST['category'];
    $imagePath = null;

    // Handle file upload
    if (!empty($_FILES['image']['name'])) {
        $uploadDir = dirname(__DIR__) . '/uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $filename = 'img_' . time() . '_' . rand(1000,9999) . '.' . $ext;
        $targetPath = $uploadDir . $filename;
        
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
            $imagePath = 'uploads/' . $filename;
        }
    }

    // Insert complaint into database
    $stmt = $pdo->prepare("INSERT INTO complaints (tenant_id, title, description, category, image_path) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$_SESSION['user_id'], $title, $desc, $cat, $imagePath]);
    
    header("Location: complaints.php");
    exit();
}
?>

<h2>Submit New Complaint</h2>
<div class="card">
<form method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label>Title</label>
        <input type="text" name="title" required>
    </div>
    <div class="form-group">
        <label>Category</label>
        <select name="category" required>
            <option value="Plumbing">Plumbing</option>
            <option value="Electrical">Electrical</option>
            <option value="HVAC">HVAC</option>
            <option value="Pest Control">Pest Control</option>
            <option value="Other">Other</option>
        </select>
    </div>
    <div class="form-group">
        <label>Description</label>
        <textarea name="description" required></textarea>
    </div>
    <div class="form-group">
        <label>Upload Photo (optional)</label>
        <input type="file" name="image" accept="image/*">
    </div>
    <button type="submit" class="btn btn-success">Submit</button>
    <a href="dashboard.php" class="btn btn-primary">Cancel</a>
</form>
</div>

<?php require '../includes/footer.php'; ?>