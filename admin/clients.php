<?php
session_start();
require_once '../includes/db.php';
require_once '../includes/auth.php';
requireLogin();

$db = getDB();

// Handle delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $stmt = $db->prepare("SELECT logo_path FROM clients WHERE id = ?");
    $stmt->execute([$id]);
    $client = $stmt->fetch();
    
    if ($client && $client['logo_path'] && file_exists('../' . $client['logo_path'])) {
        unlink('../' . $client['logo_path']);
    }
    
    $stmt = $db->prepare("DELETE FROM clients WHERE id = ?");
    $stmt->execute([$id]);
    header('Location: clients.php?msg=deleted');
    exit;
}

$stmt = $db->query("SELECT * FROM clients ORDER BY created_at DESC");
$clients = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Clients - BK Green Energy Admin</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <style>
        .sidebar { background: #0f7c3a; min-height: 100vh; color: white; }
        .sidebar a { color: white; text-decoration: none; padding: 10px 20px; display: block; }
        .sidebar a:hover, .sidebar a.active { background: #19a84a; }
        .client-logo { width: 80px; height: 80px; object-fit: contain; }
    </style>
</head>
<body>
    <div class="d-flex">
        <div class="sidebar p-3" style="width: 250px;">
            <h4 class="mb-4">BK Admin</h4>
            <a href="dashboard.php">Dashboard</a>
            <a href="projects.php">Projects</a>
            <a href="clients.php" class="active">Clients</a>
            <a href="gallery.php">Gallery</a>
            <a href="leads.php">Leads</a>
            <a href="logout.php">Logout</a>
        </div>
        <div class="flex-grow-1 p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Manage Clients</h2>
                <a href="client_edit.php" class="btn btn-success">Add New Client</a>
            </div>

            <?php if (isset($_GET['msg'])): ?>
                <div class="alert alert-success">
                    <?php if ($_GET['msg'] === 'saved'): ?>Client saved successfully!<?php endif; ?>
                    <?php if ($_GET['msg'] === 'deleted'): ?>Client deleted successfully!<?php endif; ?>
                </div>
            <?php endif; ?>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Logo</th>
                            <th>Name</th>
                            <th>Note</th>
                            <th>Added</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($clients)): ?>
                            <tr><td colspan="5" class="text-center">No clients yet. Add your first client!</td></tr>
                        <?php else: ?>
                            <?php foreach ($clients as $client): ?>
                                <tr>
                                    <td>
                                        <?php if ($client['logo_path']): ?>
                                            <img src="../<?= htmlspecialchars($client['logo_path']) ?>" class="client-logo" alt="Logo">
                                        <?php else: ?>
                                            <span class="text-muted">No logo</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= htmlspecialchars($client['name']) ?></td>
                                    <td><?= htmlspecialchars(substr($client['short_note'] ?? '', 0, 50)) ?><?= strlen($client['short_note'] ?? '') > 50 ? '...' : '' ?></td>
                                    <td><?= date('M d, Y', strtotime($client['created_at'])) ?></td>
                                    <td>
                                        <a href="client_edit.php?id=<?= $client['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                                        <a href="clients.php?delete=<?= $client['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this client?')">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
