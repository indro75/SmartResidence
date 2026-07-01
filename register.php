<?php
require 'config/database.php';
$error = $success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $full_name = trim($_POST['full_name']);
    $apt = trim($_POST['apartment_number']);
    $phone = trim($_POST['phone']);

    $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->execute([$username]);
    if ($stmt->fetch()) {
        $error = "Username already taken.";
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO users (username, password, role, full_name, apartment_number, phone) VALUES (?, ?, 'tenant', ?, ?, ?)");
        $stmt->execute([$username, $hash, $full_name, $apt, $phone]);
        $success = "Registration successful! You can now login.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<div class="auth-box">
    <h2>📝 Tenant Registration</h2>
    <?php if ($error): ?><div class="alert alert-error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
    <?php if ($success): ?><div class="alert alert-success"><?= htmlspecialchars($success) ?></div><?php endif; ?>
    <form method="POST">
        <div class="form-group"><label>Full Name</label><input type="text" name="full_name" required></div>
        <div class="form-group"><label>Username</label><input type="text" name="username" required></div>
        <div class="form-group"><label>Password</label><input type="password" name="password" minlength="6" required></div>
        <div class="form-group"><label>Apartment Number</label><input type="text" name="apartment_number" required></div>
        <div class="form-group"><label>Phone</label><input type="text" name="phone" required></div>
        <button type="submit" class="btn btn-success" style="width:100%">Register</button>
    </form>
    <p style="text-align:center; margin-top:15px;">
        Already have an account? <a href="index.php">Login</a>
    </p>
</div>
</body>
</html>