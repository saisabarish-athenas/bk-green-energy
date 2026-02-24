<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Downloads - BK Green Energy</title>
    <link href="assets/images/Logo.png" rel="shortcut icon" type="image/x-icon">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/all.min.css">
    <style>
        .navbar { background: white; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .hero-section { background: linear-gradient(135deg, #0f7c3a 0%, #19a84a 100%); color: white; padding: 120px 0 80px; text-align: center; }
        .download-card { background: white; padding: 40px; border-radius: 10px; box-shadow: 0 5px 20px rgba(0,0,0,0.1); margin: 30px 0; text-align: center; }
        .download-icon { font-size: 60px; color: #0f7c3a; margin-bottom: 20px; }
        .btn-download { background: #0f7c3a; color: white; padding: 15px 40px; border-radius: 5px; text-decoration: none; display: inline-block; margin-top: 20px; }
        .btn-download:hover { background: #19a84a; color: white; }
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
                    <li class="nav-item"><a class="nav-link" href="downloads.php">Downloads</a></li>
                    <li class="nav-item"><a class="nav-link" href="careers.php">Careers</a></li>
                    <li class="nav-item"><a class="nav-link btn-nav" href="contact.php">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="hero-section">
        <div class="container">
            <h1>Downloads</h1>
            <p>Company profile, brochures, and capability statements</p>
        </div>
    </section>

    <section class="container" style="padding: 60px 0;">
        <div class="row">
            <div class="col-md-6">
                <div class="download-card">
                    <div class="download-icon">📄</div>
                    <h3>Company Profile</h3>
                    <p>Complete overview of BK Green Energy services, projects, and capabilities</p>
                    <a href="assets/downloads/BK-Green-Energy-Profile.pdf" class="btn-download" download>
                        <i class="fas fa-download"></i> Download PDF
                    </a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="download-card">
                    <div class="download-icon">📊</div>
                    <h3>Capability Statement</h3>
                    <p>Technical capabilities and EPC execution expertise</p>
                    <a href="assets/downloads/BK-Capability-Statement.pdf" class="btn-download" download>
                        <i class="fas fa-download"></i> Download PDF
                    </a>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="download-card">
                    <div class="download-icon">🔧</div>
                    <h3>Services Brochure</h3>
                    <p>Detailed information about our solar EPC services</p>
                    <a href="assets/downloads/BK-Services-Brochure.pdf" class="btn-download" download>
                        <i class="fas fa-download"></i> Download PDF
                    </a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="download-card">
                    <div class="download-icon">✅</div>
                    <h3>Safety & Quality Policy</h3>
                    <p>HSE standards and quality assurance procedures</p>
                    <a href="assets/downloads/BK-Safety-Quality-Policy.pdf" class="btn-download" download>
                        <i class="fas fa-download"></i> Download PDF
                    </a>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer" style="background: #0f7c3a; color: white; padding: 40px 0;">
        <div class="container text-center">
            <p>© 2025 BK Green Energy. All rights reserved.</p>
        </div>
    </footer>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
