<?php
session_start();
require_once '../includes/db.php';
require_once '../includes/auth.php';
requireLogin();

$db = getDB();

// Handle delete
if (isset($_GET['delete'])) {
    $stmt = $db->prepare("DELETE FROM projects WHERE id = ?");
    $stmt->execute([$_GET['delete']]);
    header('Location: projects.php');
    exit;
}

$projects = $db->query("SELECT * FROM projects ORDER BY created_at DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Projects - BK Green Energy Admin</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <style>
        .sidebar { background: #0f7c3a; min-height: 100vh; color: white; }
        .sidebar a { color: white; text-decoration: none; padding: 10px 20px; display: block; }
        .sidebar a:hover { background: #19a84a; }
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
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Manage Projects</h2>
                <a href="project_edit.php" class="btn btn-success">Add New Project</a>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Capacity (MW)</th>
                        <th>Location</th>
                        <th>Client</th>
                        <th>Year</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($projects as $p): ?>
                    <tr>
                        <td><?= htmlspecialchars($p['title']) ?></td>
                        <td><?= $p['capacity_mw'] ?></td>
                        <td><?= htmlspecialchars($p['location']) ?></td>
                        <td><?= htmlspecialchars($p['client']) ?></td>
                        <td><?= $p['year'] ?></td>
                        <td><span class="badge bg-success"><?= $p['status'] ?></span></td>
                        <td>
                            <a href="project_edit.php?id=<?= $p['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                            <a href="?delete=<?= $p['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this project?')">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
