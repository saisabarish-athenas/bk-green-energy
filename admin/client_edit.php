<?php
session_start();
require_once '../includes/db.php';
require_once '../includes/auth.php';
requireLogin();

$db = getDB();
$client = null;
$errors = [];

// Edit mode
if (isset($_GET['id'])) {
    $stmt = $db->prepare("SELECT * FROM clients WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $client = $stmt->fetch();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $short_note = trim($_POST['short_note']);
    $logo_path = $client['logo_path'] ?? '';

    if (empty($name)) $errors[] = "Client name is required";

    // Handle logo upload
    if (isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $filename = $_FILES['logo']['name'];
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        
        if (!in_array($ext, $allowed)) {
            $errors[] = "Invalid file type. Only JPG, PNG, GIF, WEBP allowed.";
        } elseif ($_FILES['logo']['size'] > 2 * 1024 * 1024) {
            $errors[] = "File too large. Max 2MB.";
        } else {
            $new_filename = 'client_' . time() . '_' . uniqid() . '.' . $ext;
            $upload_path = '../uploads/client_logos/' . $new_filename;
            
            if (move_uploaded_file($_FILES['logo']['tmp_name'], $upload_path)) {
                // Delete old logo
                if ($logo_path && file_exists('../' . $logo_path)) {
                    unlink('../' . $logo_path);
                }
                $logo_path = 'uploads/client_logos/' . $new_filename;
            } else {
                $errors[] = "Failed to upload logo.";
            }
        }
    }

    if (empty($errors)) {
        if ($client) {
            // Update
            $stmt = $db->prepare("UPDATE clients SET name = ?, logo_path = ?, short_note = ? WHERE id = ?");
            $stmt->execute([$name, $logo_path, $short_note, $client['id']]);
        } else {
            // Insert
            $stmt = $db->prepare("INSERT INTO clients (name, logo_path, short_note) VALUES (?, ?, ?)");
            $stmt->execute([$name, $logo_path, $short_note]);
        }
        header('Location: clients.php?msg=saved');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $client ? 'Edit' : 'Add' ?> Client - BK Green Energy Admin</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <style>
        .sidebar { background: #0f7c3a; min-height: 100vh; color: white; }
        .sidebar a { color: white; text-decoration: none; padding: 10px 20px; display: block; }
        .sidebar a:hover { background: #19a84a; }
        .preview-img { max-width: 200px; margin-top: 10px; }
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
            <h2><?= $client ? 'Edit' : 'Add New' ?> Client</h2>

            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php foreach ($errors as $error): ?>
                            <li><?= htmlspecialchars($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form method="POST" enctype="multipart/form-data" class="mt-4">
                <div class="mb-3">
                    <label class="form-label">Client Name *</label>
                    <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($client['name'] ?? '') ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Logo</label>
                    <input type="file" name="logo" class="form-control" accept="image/*">
                    <?php if ($client && $client['logo_path']): ?>
                        <img src="../<?= htmlspecialchars($client['logo_path']) ?>" class="preview-img" alt="Current logo">
                    <?php endif; ?>
                    <small class="text-muted">Max 2MB. JPG, PNG, GIF, WEBP</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Short Note</label>
                    <textarea name="short_note" class="form-control" rows="3"><?= htmlspecialchars($client['short_note'] ?? '') ?></textarea>
                    <small class="text-muted">Brief description of work done for this client</small>
                </div>

                <button type="submit" class="btn btn-success">Save Client</button>
                <a href="clients.php" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</body>
</html>
