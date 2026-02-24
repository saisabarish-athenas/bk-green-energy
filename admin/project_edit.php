<?php
session_start();
require_once '../includes/db.php';
require_once '../includes/auth.php';
requireLogin();

$db = getDB();
$project = null;
$isEdit = false;

if (isset($_GET['id'])) {
    $stmt = $db->prepare("SELECT * FROM projects WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $project = $stmt->fetch();
    $isEdit = true;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $capacity_mw = $_POST['capacity_mw'];
    $location = trim($_POST['location']);
    $state = trim($_POST['state']);
    $client = trim($_POST['client']);
    $scope_tags = trim($_POST['scope_tags']);
    $year = $_POST['year'];
    $description = trim($_POST['description']);
    $status = $_POST['status'];
    
    if ($isEdit) {
        $stmt = $db->prepare("UPDATE projects SET title=?, capacity_mw=?, location=?, state=?, client=?, scope_tags=?, year=?, description=?, status=? WHERE id=?");
        $stmt->execute([$title, $capacity_mw, $location, $state, $client, $scope_tags, $year, $description, $status, $_GET['id']]);
    } else {
        $stmt = $db->prepare("INSERT INTO projects (title, capacity_mw, location, state, client, scope_tags, year, description, status) VALUES (?,?,?,?,?,?,?,?,?)");
        $stmt->execute([$title, $capacity_mw, $location, $state, $client, $scope_tags, $year, $description, $status]);
    }
    
    header('Location: projects.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $isEdit ? 'Edit' : 'Add' ?> Project - BK Green Energy Admin</title>
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
            <h2><?= $isEdit ? 'Edit' : 'Add New' ?> Project</h2>
            <form method="POST" class="mt-4">
                <div class="row">
                    <div class="col-md-8 mb-3">
                        <label class="form-label">Project Title</label>
                        <input type="text" name="title" class="form-control" value="<?= $project['title'] ?? '' ?>" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Capacity (MW)</label>
                        <input type="number" step="0.01" name="capacity_mw" class="form-control" value="<?= $project['capacity_mw'] ?? '' ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Location</label>
                        <input type="text" name="location" class="form-control" value="<?= $project['location'] ?? '' ?>">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">State</label>
                        <input type="text" name="state" class="form-control" value="<?= $project['state'] ?? '' ?>">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Year</label>
                        <input type="number" name="year" class="form-control" value="<?= $project['year'] ?? date('Y') ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Client</label>
                        <input type="text" name="client" class="form-control" value="<?= $project['client'] ?? '' ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Scope Tags (comma-separated)</label>
                        <input type="text" name="scope_tags" class="form-control" value="<?= $project['scope_tags'] ?? '' ?>" placeholder="Civil,MMS,DC Works,AC Works">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="4"><?= $project['description'] ?? '' ?></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control">
                        <option value="completed" <?= ($project['status'] ?? '') === 'completed' ? 'selected' : '' ?>>Completed</option>
                        <option value="ongoing" <?= ($project['status'] ?? '') === 'ongoing' ? 'selected' : '' ?>>Ongoing</option>
                        <option value="planned" <?= ($project['status'] ?? '') === 'planned' ? 'selected' : '' ?>>Planned</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Save Project</button>
                <a href="projects.php" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</body>
</html>
