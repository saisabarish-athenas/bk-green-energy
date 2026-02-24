<?php
session_start();
require_once '../includes/db.php';
require_once '../includes/auth.php';
requireLogin();

$db = getDB();
$stats = [
    'projects' => $db->query("SELECT COUNT(*) FROM projects")->fetchColumn(),
    'clients' => $db->query("SELECT COUNT(*) FROM clients")->fetchColumn(),
    'leads' => $db->query("SELECT COUNT(*) FROM leads WHERE status='new'")->fetchColumn(),
    'gallery' => $db->query("SELECT COUNT(*) FROM gallery_images")->fetchColumn(),
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - BK Green Energy Admin</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <style>
        .sidebar { background: #0f7c3a; min-height: 100vh; color: white; }
        .sidebar a { color: white; text-decoration: none; padding: 10px 20px; display: block; }
        .sidebar a:hover { background: #19a84a; }
        .stat-card { background: linear-gradient(135deg, #0f7c3a, #19a84a); color: white; padding: 30px; border-radius: 10px; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="d-flex">
        <div class="sidebar p-3" style="width: 250px;">
            <h4 class="mb-4">BK Admin</h4>
            <a href="dashboard.php">Dashboard</a>
            <a href="projects.php">Projects</a>
            <a href="clients.php">Clients</a>
            <a href="gallery.php">Gallery</a>
            <a href="leads.php">Leads</a>
            <a href="logout.php">Logout</a>
        </div>
        <div class="flex-grow-1 p-4">
            <h2>Dashboard</h2>
            <div class="row mt-4">
                <div class="col-md-3">
                    <div class="stat-card">
                        <h3><?= $stats['projects'] ?></h3>
                        <p>Total Projects</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <h3><?= $stats['clients'] ?></h3>
                        <p>Clients</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <h3><?= $stats['leads'] ?></h3>
                        <p>New Leads</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <h3><?= $stats['gallery'] ?></h3>
                        <p>Gallery Images</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
