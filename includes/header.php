<?php require_once __DIR__ . '/auth_check.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="/apartment_portal/assets/style.css">
    <style>
        /* Navbar Layout */
        .navbar {
            background: #2C3E50 !important; /* Dark Slate */
            display: flex;
            justify-content: space-between; /* Pushes logo left, user right */
            align-items: center;
            padding: 0 40px;
            height: 64px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        /* Left Side: Smart Residence */
        .nav-brand {
            color: white !important;
            font-size: 22px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        /* Right Side: User Info */
        .nav-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        
        .user-info {
            color: white !important;
            font-weight: 500;
            font-size: 15px;
        }
        
        .badge {
            background: #FF8C00; /* Orange */
            color: white;
            padding: 4px 10px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 600;
            margin-left: 8px;
        }
        
        /* Logout Button */
        .btn-logout {
            background: transparent;
            color: white !important;
            border: 1px solid rgba(255,255,255,0.5);
            padding: 6px 16px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: 0.2s;
        }
        
        .btn-logout:hover {
            background: white;
            color: #2C3E50 !important;
            border-color: white;
        }
    </style>
</head>
<body>

<nav class="navbar">
    <!-- Left Side -->
    <div class="nav-brand">Smart Residence</div>
    
    <!-- Right Side -->
    <div class="nav-right">
        <span class="user-info">
            <span><?= htmlspecialchars($_SESSION['name']) ?></span>
            <span class="badge"><?= ucfirst($_SESSION['role']) ?></span>
        </span>
        <a href="/apartment_portal/logout.php" class="btn-logout">Logout</a>
    </div>
</nav>

<div class="container">