<?php
require_once 'includes/db.php';
$db = getDB();

// Get filter parameters
$state = $_GET['state'] ?? '';
$year = $_GET['year'] ?? '';
$status = $_GET['status'] ?? '';

// Build query
$sql = "SELECT * FROM projects WHERE 1=1";
$params = [];

if ($state) {
    $sql .= " AND state = ?";
    $params[] = $state;
}
if ($year) {
    $sql .= " AND year = ?";
    $params[] = $year;
}
if ($status) {
    $sql .= " AND status = ?";
    $params[] = $status;
}

$sql .= " ORDER BY year DESC, created_at DESC";
$stmt = $db->prepare($sql);
$stmt->execute($params);
$projects = $stmt->fetchAll();

// Get unique states and years for filters
$states = $db->query("SELECT DISTINCT state FROM projects WHERE state IS NOT NULL ORDER BY state")->fetchAll(PDO::FETCH_COLUMN);
$years = $db->query("SELECT DISTINCT year FROM projects WHERE year IS NOT NULL ORDER BY year DESC")->fetchAll(PDO::FETCH_COLUMN);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="BK Green Energy Services - Comprehensive renewable energy solutions including solar power, customized projects, installation, and energy consultancy.">
    <meta name="keywords"
        content="solar services, renewable energy services, solar installation, energy consultancy, solar maintenance, Madurai">
    <meta name="author" content="BK Green Energy">
    <title>Our Projects - BK Green Energy</title>
    <link href="assets/images/Logo.png" rel="shortcut icon" type="image/x-icon">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/projects.css">

</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top custom-navbar">
        <div class="container">

            <!-- Logo -->
            <a class="navbar-brand" href="index.php">
                <img src="assets/images/Logo.png" alt="BK Green Energy" height="50">
            </a>

            <!-- Mobile Toggle -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            </button>

            <!-- Nav Links -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="services.php">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="projects.php">Projects</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="careers.php">Careers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn-nav" href="contact.php">Contact</a>
                    </li>
                </ul>
            </div>

        </div>
    </nav>

    <!-- HERO SECTION -->
    <section class="hero-section">
        <div class="hero-bg"></div>
        <div class="hero-overlay"></div>
        <div class="container">
            <div class="hero-content fade-in-up">
                <h1>Our Projects</h1>
                <p>Innovative Renewable Solutions Across Homes, Industries and Communities.</p>
            </div>
            <div class="scroll-indicator">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 4L12 20M12 20L6 14M12 20L18 14" stroke="white" stroke-width="2" fill="none" />
                </svg>
            </div>
        </div>
    </section>

    <!-- INTERACTIVE SERVICE SHOWCASE -->
    <section class="service-showcase">
        <div class="container">
            <div class="showcase-layout">
                <div class="service-tabs fade-left">
                    <div class="tab-item active" data-service="solar">
                        <div class="tab-icon">
                            <svg viewBox="0 0 50 50" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="25" cy="15" r="8" fill="#0f7c3a" />
                                <rect x="10" y="25" width="30" height="20" fill="#0f7c3a" rx="2" />
                                <line x1="15" y1="30" x2="20" y2="35" stroke="#fff" stroke-width="2" />
                                <line x1="30" y1="30" x2="35" y2="35" stroke="#fff" stroke-width="2" />
                            </svg>
                        </div>
                        <span>Solar Power Solutions</span>
                    </div>

                    <div class="tab-item" data-service="customized">
                        <div class="tab-icon">
                            <svg viewBox="0 0 50 50" xmlns="http://www.w3.org/2000/svg">
                                <rect x="10" y="15" width="30" height="25" fill="none" stroke="#0f7c3a" stroke-width="2"
                                    rx="2" />
                                <path d="M 25 20 L 30 28 L 20 28 Z" fill="#0f7c3a" />
                                <line x1="15" y1="33" x2="35" y2="33" stroke="#0f7c3a" stroke-width="2" />
                            </svg>
                        </div>
                        <span>Customized Energy Projects</span>
                    </div>

                    <div class="tab-item" data-service="installation">
                        <div class="tab-icon">
                            <svg viewBox="0 0 50 50" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M 25 10 L 30 20 L 40 20 L 32 27 L 35 37 L 25 30 L 15 37 L 18 27 L 10 20 L 20 20 Z"
                                    fill="#0f7c3a" />
                                <circle cx="25" cy="25" r="15" fill="none" stroke="#0f7c3a" stroke-width="2" />
                            </svg>
                        </div>
                        <span>Installation & Maintenance</span>
                    </div>

                    <div class="tab-item" data-service="consultancy">
                        <div class="tab-icon">
                            <svg viewBox="0 0 50 50" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="25" cy="25" r="15" fill="none" stroke="#0f7c3a" stroke-width="2" />
                                <path d="M 25 15 L 25 25 L 32 32" stroke="#0f7c3a" stroke-width="2" fill="none" />
                                <circle cx="25" cy="25" r="2" fill="#0f7c3a" />
                            </svg>
                        </div>
                        <span>Energy Consultancy</span>
                    </div>
                </div>

                <div class="service-content fade-right">
                    <div class="content-panel active" data-content="solar">
                        <div class="content-image">
                            <img src="assets/images/WhatsApp Image 2026-02-13 at 11.20.37 AM(1).jpg"
                                alt="Solar Power Solutions" height="400">
                        </div>
                        <h2>Solar Power Solutions</h2>
                        <p>We design and install high-performance solar systems for residential, commercial, and
                            industrial applications.</p>
                    </div>

                    <div class="content-panel" data-content="customized">
                        <div class="content-image">
                            <img src="assets/images/WhatsApp Image 2026-02-13 at 11.20.43 AM(1).jpg"
                                alt="Solar Power Solutions" height="350">
                        </div>
                        <h2>Customized Energy Projects</h2>
                        <p>Tailor-made energy systems designed to maximize savings and efficiency based on your specific
                            requirements.</p>
                    </div>

                    <div class="content-panel" data-content="installation">
                        <div class="content-image">
                            <img src="assets/images/WhatsApp Image 2026-02-13 at 11.20.42 AM.jpeg"
                                alt="Solar Power Solutions" height="350">
                        </div>
                        <h2>Installation & Maintenance</h2>
                        <p>Professional installation and ongoing maintenance services to ensure optimal system
                            performance.</p>
                    </div>

                    <div class="content-panel" data-content="consultancy">
                        <div class="content-image">
                            <img src="assets/images/WhatsApp Image 2026-02-13 at 11.20.40 AM.jpg"
                                alt="Solar Power Solutions" height="350">
                        </div>
                        <h2>Energy Consultancy</h2>
                        <p>Expert guidance on planning, feasibility, cost analysis, and energy optimization strategies.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- PROJECTS LISTING -->
    <section class="featured-section">
        <div class="container">
            <h2 class="fade-up">Our Projects</h2>
            
            <!-- Filters -->
            <div class="mb-4">
                <form method="GET" class="row g-3">
                    <div class="col-md-3">
                        <select name="state" class="form-select" onchange="this.form.submit()">
                            <option value="">All States</option>
                            <?php foreach ($states as $s): ?>
                                <option value="<?= htmlspecialchars($s) ?>" <?= $state === $s ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($s) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="year" class="form-select" onchange="this.form.submit()">
                            <option value="">All Years</option>
                            <?php foreach ($years as $y): ?>
                                <option value="<?= $y ?>" <?= $year == $y ? 'selected' : '' ?>>
                                    <?= $y ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="status" class="form-select" onchange="this.form.submit()">
                            <option value="">All Status</option>
                            <option value="completed" <?= $status === 'completed' ? 'selected' : '' ?>>Completed</option>
                            <option value="ongoing" <?= $status === 'ongoing' ? 'selected' : '' ?>>Ongoing</option>
                            <option value="planned" <?= $status === 'planned' ? 'selected' : '' ?>>Planned</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <a href="projects.php" class="btn btn-secondary w-100">Clear Filters</a>
                    </div>
                </form>
            </div>

            <!-- Projects Grid -->
            <div class="row g-4">
                <?php if (empty($projects)): ?>
                    <div class="col-12 text-center py-5">
                        <p class="text-muted">No projects found. Check back soon!</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($projects as $project): ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100 shadow-sm">
                                <?php if ($project['image_path']): ?>
                                    <img src="<?= htmlspecialchars($project['image_path']) ?>" class="card-img-top" alt="<?= htmlspecialchars($project['title']) ?>" style="height: 200px; object-fit: cover;">
                                <?php else: ?>
                                    <div style="height: 200px; background: linear-gradient(135deg, #0f7c3a, #19a84a); display: flex; align-items: center; justify-content: center; color: white;">
                                        <i class="fas fa-solar-panel fa-3x"></i>
                                    </div>
                                <?php endif; ?>
                                <div class="card-body">
                                    <h5 class="card-title"><?= htmlspecialchars($project['title']) ?></h5>
                                    <p class="card-text"><?= htmlspecialchars(substr($project['description'], 0, 100)) ?>...</p>
                                    <ul class="list-unstyled small">
                                        <?php if ($project['capacity_mw']): ?>
                                            <li><strong>Capacity:</strong> <?= htmlspecialchars($project['capacity_mw']) ?> MW</li>
                                        <?php endif; ?>
                                        <?php if ($project['location']): ?>
                                            <li><strong>Location:</strong> <?= htmlspecialchars($project['location']) ?>, <?= htmlspecialchars($project['state']) ?></li>
                                        <?php endif; ?>
                                        <?php if ($project['client']): ?>
                                            <li><strong>Client:</strong> <?= htmlspecialchars($project['client']) ?></li>
                                        <?php endif; ?>
                                        <?php if ($project['year']): ?>
                                            <li><strong>Year:</strong> <?= htmlspecialchars($project['year']) ?></li>
                                        <?php endif; ?>
                                    </ul>
                                    <span class="badge bg-<?= $project['status'] === 'completed' ? 'success' : ($project['status'] === 'ongoing' ? 'warning' : 'info') ?>">
                                        <?= ucfirst(htmlspecialchars($project['status'])) ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- PROCESS FLOW -->
    <section class="process-section">
        <div class="container">
            <h2 class="fade-up">How We Deliver Excellence</h2>
            <div class="process-timeline">
                <div class="process-step fade-up">
                    <div class="step-number">1</div>
                    <h3>Consultation</h3>
                    <p>Understanding your energy needs and goals</p>
                </div>

                <div class="process-line"></div>

                <div class="process-step fade-up">
                    <div class="step-number">2</div>
                    <h3>Design & Planning</h3>
                    <p>Creating customized solar solutions</p>
                </div>

                <div class="process-line"></div>

                <div class="process-step fade-up">
                    <div class="step-number">3</div>
                    <h3>Installation</h3>
                    <p>Professional setup and commissioning</p>
                </div>

                <div class="process-line"></div>

                <div class="process-step fade-up">
                    <div class="step-number">4</div>
                    <h3>Ongoing Support</h3>
                    <p>Maintenance and performance monitoring</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CALL TO ACTION -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-content fade-up">
                <h2>Start Your Solar Project Today</h2>
                <p>Tell us about your energy goals, and we'll create a tailored solar solution for you.</p>
                <a href="contact.php" class="cta-btn">Get a Free Project Quote</a>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="footer">

        <div class="footer-container">

            <!-- Row 1 : Logo -->
            <div class="footer-top">
                <div class="footer-logo">
                    <img src="assets/images/Logo.png" alt="BK Green Energy">
                </div>
                <div class="footer-contact">
                    <a href="tel:+91XXXXXXXXXX">📞 +91-75399 44358</a>
                    </br><a href="mailto:info@bkgreenenergy.com">✉ info@bkgreenenergy.com</a>
                </div>
            </div>


            <!-- Row 2 : Main Columns -->
            <div class="footer-columns">

                <!-- Visit Links -->
                <div class="footer-col">
                    <h4 class="footer-title">Visit</h4>
                    <a href="about.php" class="footer-link">About Us</a>
                    <a href="services.php" class="footer-link">Our Services</a>
                    <a href="careers.php" class="footer-link">Careers</a>
                    <a href="projects.php" class="footer-link">Projects</a>
                    <a href="contact.php" class="footer-link">Contact Us</a>
                </div>

                <!-- Address -->
                <div class="footer-col">
                    <h4 class="footer-title">Registered Office:</h4>

                    <div class="address-text">
                        <a href="https://maps.app.goo.gl/r9zpaGCaA95TfrEv6" target="_blank">
                            Plot No: 81, Poriyalar Nagar 4th Street,<br>
                            Pillar No: 146 & 147, Natham Flyover,<br>
                            Thiruppalai, Madurai, Tamil Nadu – 625014
                        </a>
                    </div>
                </div>

            </div>



            <!-- Divider -->
            <div class="footer-divider"></div>

            <!-- Bottom -->
            <div class="footer-bottom">

                <p class="copyright">
                    Copyright © 2025 BK Green Energy. All rights reserved.
                </p>

                <div class="footer-social">

                    <a href="https://www.instagram.com/bkgreenenergy/" target="_blank">
                        <img src="assets/images/Instagram.png" alt="Instagram">
                    </a>

                    <a href="https://www.linkedin.com/in/bk-green-energy-ba51793b1/" target="_blank">
                        <img src="assets/images/LinkedIN.png" alt="LinkedIn">
                    </a>

                    <a href="https://wa.me/917539944358" target="_blank">
                        <img src="assets/images/WhatsApp.png" alt="WhatsApp">
                    </a>

                </div>


            </div>


        </div>


    </footer>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/projects.js"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    


</body>

</html>