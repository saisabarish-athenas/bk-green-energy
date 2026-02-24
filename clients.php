<?php
require_once 'includes/db.php';
$db = getDB();
$stmt = $db->query("SELECT * FROM clients ORDER BY created_at DESC");
$clients = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Clients - BK Green Energy</title>
    <link href="assets/images/Logo.png" rel="shortcut icon" type="image/x-icon">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/all.min.css">
    <style>
        .navbar { background: white; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .hero-section { background: linear-gradient(135deg, #0f7c3a 0%, #19a84a 100%); color: white; padding: 120px 0 80px; text-align: center; }
        .client-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 30px; padding: 60px 0; }
        .client-card { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 5px 20px rgba(0,0,0,0.1); text-align: center; transition: transform 0.3s; }
        .client-card:hover { transform: translateY(-10px); }
        .client-logo { height: 80px; object-fit: contain; margin-bottom: 20px; }
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
                    <li class="nav-item"><a class="nav-link" href="clients.php">Clients</a></li>
                    <li class="nav-item"><a class="nav-link" href="careers.php">Careers</a></li>
                    <li class="nav-item"><a class="nav-link btn-nav" href="contact.php">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="hero-section">
        <div class="container">
            <h1>Our Valued Clients</h1>
            <p>Trusted by leading organizations across industries</p>
        </div>
    </section>

    <section class="container">
        <div class="client-grid">
            <?php if (empty($clients)): ?>
                <div class="col-12 text-center py-5">
                    <p class="text-muted">No clients to display yet.</p>
                </div>
            <?php else: ?>
                <?php foreach ($clients as $client): ?>
                    <div class="client-card">
                        <?php if ($client['logo_path']): ?>
                            <img src="<?= htmlspecialchars($client['logo_path']) ?>" alt="<?= htmlspecialchars($client['name']) ?>" class="client-logo">
                        <?php endif; ?>
                        <h4><?= htmlspecialchars($client['name']) ?></h4>
                        <?php if ($client['short_note']): ?>
                            <p><?= htmlspecialchars($client['short_note']) ?></p>
                        <?php endif; ?>
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
