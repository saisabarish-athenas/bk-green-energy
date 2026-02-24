<?php
require_once 'includes/db.php';
$db = getDB();
$stmt = $db->query("SELECT g.*, p.title as project_title FROM gallery_images g LEFT JOIN projects p ON g.project_id = p.id ORDER BY g.created_at DESC");
$images = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery - BK Green Energy</title>
    <link href="assets/images/Logo.png" rel="shortcut icon" type="image/x-icon">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/all.min.css">
    <style>
        .navbar { background: white; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .hero-section { background: linear-gradient(135deg, #0f7c3a 0%, #19a84a 100%); color: white; padding: 120px 0 80px; text-align: center; }
        .gallery-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; padding: 60px 0; }
        .gallery-item { position: relative; overflow: hidden; border-radius: 10px; cursor: pointer; }
        .gallery-item img { width: 100%; height: 250px; object-fit: cover; transition: transform 0.3s; }
        .gallery-item:hover img { transform: scale(1.1); }
        .gallery-caption { position: absolute; bottom: 0; left: 0; right: 0; background: rgba(15, 124, 58, 0.9); color: white; padding: 15px; transform: translateY(100%); transition: transform 0.3s; }
        .gallery-item:hover .gallery-caption { transform: translateY(0); }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg fixed-top navbar-light">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="assets/images/Logo.png" alt="BK Green Energy" height="50">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"></button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="services.php">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="projects.php">Projects</a></li>
                    <li class="nav-item"><a class="nav-link" href="gallery.php">Gallery</a></li>
                    <li class="nav-item"><a class="nav-link" href="careers.php">Careers</a></li>
                    <li class="nav-item"><a class="nav-link btn-nav" href="contact.php">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="hero-section">
        <div class="container">
            <h1>Project Gallery</h1>
            <p>Explore our completed solar installations</p>
        </div>
    </section>

    <section class="container">
        <div class="gallery-grid">
            <?php if (empty($images)): ?>
                <div class="col-12 text-center py-5">
                    <p class="text-muted">No gallery images yet.</p>
                </div>
            <?php else: ?>
                <?php foreach ($images as $image): ?>
                    <div class="gallery-item">
                        <img src="<?= htmlspecialchars($image['image_path']) ?>" alt="<?= htmlspecialchars($image['caption'] ?? 'Gallery Image') ?>">
                        <div class="gallery-caption">
                            <?php if ($image['caption']): ?>
                                <h5><?= htmlspecialchars($image['caption']) ?></h5>
                            <?php endif; ?>
                            <?php if ($image['project_title']): ?>
                                <p><?= htmlspecialchars($image['project_title']) ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>

    <footer class="footer" style="background: #0f7c3a; color: white; padding: 40px 0; margin-top: 60px;">
        <div class="container text-center">
            <p>© 2025 BK Green Energy. All rights reserved.</p>
        </div>
    </footer>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
