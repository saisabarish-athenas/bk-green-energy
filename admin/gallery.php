<?php
session_start();
require_once '../includes/db.php';
require_once '../includes/auth.php';
requireLogin();

$db = getDB();

// Handle delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $stmt = $db->prepare("SELECT image_path FROM gallery_images WHERE id = ?");
    $stmt->execute([$id]);
    $image = $stmt->fetch();
    
    if ($image && file_exists('../' . $image['image_path'])) {
        unlink('../' . $image['image_path']);
    }
    
    $stmt = $db->prepare("DELETE FROM gallery_images WHERE id = ?");
    $stmt->execute([$id]);
    header('Location: gallery.php?msg=deleted');
    exit;
}

// Handle upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['images'])) {
    $project_id = !empty($_POST['project_id']) ? (int)$_POST['project_id'] : null;
    $caption = trim($_POST['caption']);
    $uploaded = 0;
    
    foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
        if ($_FILES['images']['error'][$key] === UPLOAD_ERR_OK) {
            $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            $filename = $_FILES['images']['name'][$key];
            $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            
            if (in_array($ext, $allowed) && $_FILES['images']['size'][$key] <= 5 * 1024 * 1024) {
                $new_filename = 'gallery_' . time() . '_' . uniqid() . '.' . $ext;
                $upload_path = '../uploads/gallery/' . $new_filename;
                
                if (move_uploaded_file($tmp_name, $upload_path)) {
                    $stmt = $db->prepare("INSERT INTO gallery_images (project_id, image_path, caption) VALUES (?, ?, ?)");
                    $stmt->execute([$project_id, 'uploads/gallery/' . $new_filename, $caption]);
                    $uploaded++;
                }
            }
        }
    }
    
    header('Location: gallery.php?msg=uploaded&count=' . $uploaded);
    exit;
}

$stmt = $db->query("SELECT g.*, p.title as project_title FROM gallery_images g LEFT JOIN projects p ON g.project_id = p.id ORDER BY g.created_at DESC");
$images = $stmt->fetchAll();

$projects = $db->query("SELECT id, title FROM projects ORDER BY title")->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Gallery - BK Green Energy Admin</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <style>
        .sidebar { background: #0f7c3a; min-height: 100vh; color: white; }
        .sidebar a { color: white; text-decoration: none; padding: 10px 20px; display: block; }
        .sidebar a:hover, .sidebar a.active { background: #19a84a; }
        .gallery-thumb { width: 150px; height: 100px; object-fit: cover; }
    </style>
</head>
<body>
    <div class="d-flex">
        <div class="sidebar p-3" style="width: 250px;">
            <h4 class="mb-4">BK Admin</h4>
            <a href="dashboard.php">Dashboard</a>
            <a href="projects.php">Projects</a>
            <a href="clients.php">Clients</a>
            <a href="gallery.php" class="active">Gallery</a>
            <a href="leads.php">Leads</a>
            <a href="logout.php">Logout</a>
        </div>
        <div class="flex-grow-1 p-4">
            <h2>Manage Gallery</h2>

            <?php if (isset($_GET['msg'])): ?>
                <div class="alert alert-success">
                    <?php if ($_GET['msg'] === 'uploaded'): ?>Successfully uploaded <?= (int)$_GET['count'] ?> image(s)!<?php endif; ?>
                    <?php if ($_GET['msg'] === 'deleted'): ?>Image deleted successfully!<?php endif; ?>
                </div>
            <?php endif; ?>

            <!-- Upload Form -->
            <div class="card mb-4">
                <div class="card-body">
                    <h5>Upload Images</h5>
                    <form method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Select Images *</label>
                                <input type="file" name="images[]" class="form-control" accept="image/*" multiple required>
                                <small class="text-muted">Max 5MB per image. Multiple selection allowed.</small>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Project (Optional)</label>
                                <select name="project_id" class="form-select">
                                    <option value="">-- No Project --</option>
                                    <?php foreach ($projects as $project): ?>
                                        <option value="<?= $project['id'] ?>"><?= htmlspecialchars($project['title']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Caption (Optional)</label>
                                <input type="text" name="caption" class="form-control" placeholder="Image caption">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">Upload Images</button>
                    </form>
                </div>
            </div>

            <!-- Gallery List -->
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Caption</th>
                            <th>Project</th>
                            <th>Uploaded</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($images)): ?>
                            <tr><td colspan="5" class="text-center">No images yet. Upload your first image!</td></tr>
                        <?php else: ?>
                            <?php foreach ($images as $image): ?>
                                <tr>
                                    <td><img src="../<?= htmlspecialchars($image['image_path']) ?>" class="gallery-thumb" alt="Gallery"></td>
                                    <td><?= htmlspecialchars($image['caption'] ?? 'No caption') ?></td>
                                    <td><?= htmlspecialchars($image['project_title'] ?? 'No project') ?></td>
                                    <td><?= date('M d, Y', strtotime($image['created_at'])) ?></td>
                                    <td>
                                        <a href="gallery.php?delete=<?= $image['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this image?')">Delete</a>
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
