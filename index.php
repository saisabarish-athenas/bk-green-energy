<?php
require_once 'includes/db.php';

// Form submission handler
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $message = trim($_POST['message'] ?? '');

    $errors = [];

    // Validate name
    if (empty($name) || !preg_match("/^[A-Za-z ]{2,50}$/", $name)) {
        $errors[] = "Invalid name";
    }

    // Validate email
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email";
    }

    // Validate message
    if (empty($message) || strlen($message) < 5 || strlen($message) > 1000) {
        $errors[] = "Message must be between 5-1000 characters";
    }

    // Save to database and send email if no errors
    if (empty($errors)) {
        try {
            $db = getDB();
            $stmt = $db->prepare("INSERT INTO leads (name, phone, email, message, source_page) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$name, $phone, $email, $message, 'home']);
            
            $to = "info@bkgreenenergy.com";
            $subject = "New Consultation Request from " . htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
            
            $body = "Name: " . htmlspecialchars($name, ENT_QUOTES, 'UTF-8') . "\n";
            $body .= "Phone: " . htmlspecialchars($phone, ENT_QUOTES, 'UTF-8') . "\n";
            $body .= "Email: " . htmlspecialchars($email, ENT_QUOTES, 'UTF-8') . "\n";
            $body .= "Message:\n" . htmlspecialchars($message, ENT_QUOTES, 'UTF-8');
            
            $headers = "From: noreply@bkgreenenergy.com\r\n";
            $headers .= "Reply-To: " . filter_var($email, FILTER_SANITIZE_EMAIL) . "\r\n";
            $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
            $headers .= "X-Mailer: PHP/" . phpversion();

            @mail($to, $subject, $body, $headers);
            $success = true;
        } catch (Exception $e) {
            $errors[] = "Failed to save. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="BK Green Energy - Smart renewable energy solutions for homes and businesses. Solar power, energy consultancy, and sustainable solutions.">
    <meta name="keywords"
        content="renewable energy, solar power, green energy, solar panels, energy solutions, Madurai">
    <meta name="author" content="BK Green Energy">
    <title>BK Green Energy - Smart Renewable Energy Solutions</title>
    <link href="assets/images/Logo.png" rel="shortcut icon" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top navbar-light custom-navbar">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand" href="index.php">
                <img src="assets/images/Logo.png" alt="BK Green Energy" height="50">
            </a>

            <!-- Mobile Toggle -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            </button>

            <!-- Links -->
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
    <section class="hero">
        <!-- Background Image Slider -->
        <div class="hero-slider">
            <img src="assets/images/Home page-1.jpg" class="slide active">
            <img src="assets/images/Home page-2.jpg" class="slide">
            <img src="assets/images/Home page-3.jpg" class="slide">
        </div>
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1>Smart Renewable Energy Solutions</h1>
            <p>Empowering homes and businesses with innovative solar and green energy solutions that deliver
                performance, savings, and long-term sustainability.</p>
            <div class="hero-buttons">
                <a href="#consultation" class="btn btn-primary">Get a Free Consultation</a>
                <a href="services.php" class="btn btn-primary">Explore Our Services</a>
                <a href="about.php" class="btn btn-primary">Start Your Green Journey</a>
            </div>
        </div>
    </section>

    <!-- ABOUT SECTION -->
    <section class="about" id="about">
        <div class="container">
            <div class="about-content">
                <div class="about-text fade-up">
                    <h2>Innovation Inspired by Sustainability</h2>
                    <p>BK Green Energy is a forward-thinking renewable energy company committed to delivering
                        sustainable and efficient power solutions. Our goal is to reduce carbon footprints while helping
                        our clients achieve long-term energy savings.</p>
                    <p>From consultation and system design to installation and maintenance, we provide complete
                        renewable energy solutions tailored to your needs.</p>
                </div>
                <div class="about-image fade-up">
                    <svg viewBox="0 0 400 300" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <linearGradient id="solarGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" style="stop-color:#0f7c3a;stop-opacity:1" />
                                <stop offset="100%" style="stop-color:#19a84a;stop-opacity:1" />
                            </linearGradient>
                        </defs>
                        <circle cx="200" cy="80" r="40" fill="#FFD700" class="sun-pulse" />
                        <rect x="80" y="140" width="60" height="80" fill="url(#solarGrad)" rx="5" />
                        <rect x="150" y="140" width="60" height="80" fill="url(#solarGrad)" rx="5" />
                        <rect x="220" y="140" width="60" height="80" fill="url(#solarGrad)" rx="5" />
                        <rect x="290" y="140" width="60" height="80" fill="url(#solarGrad)" rx="5" />
                        <line x1="110" y1="160" x2="130" y2="180" stroke="#fff" stroke-width="2" />
                        <line x1="180" y1="160" x2="200" y2="180" stroke="#fff" stroke-width="2" />
                        <line x1="250" y1="160" x2="270" y2="180" stroke="#fff" stroke-width="2" />
                        <line x1="320" y1="160" x2="340" y2="180" stroke="#fff" stroke-width="2" />
                        <rect x="50" y="220" width="300" height="10" fill="#333" />
                        <path d="M 50 230 L 20 280 L 380 280 L 350 230 Z" fill="#0f7c3a" opacity="0.3" />
                    </svg>
                </div>
            </div>
        </div>
    </section>

    <!-- SERVICES SECTION -->
    <section class="services" id="services">
        <div class="container services-container">
            <div class="services-heading">
                <h2>Our Solutions</h2>
            </div>
            <div class="services-cards">
                <div class="service-card fade-left">
                    <div class="service-icon">
                        <video autoplay muted loop playsinline>
                            <source src="assets/video/Solar Power Solutions.mp4" type="video/mp4">
                        </video>
                    </div>
                    <h3>Solar Power Solutions</h3>
                    <p>We design and install high-performance solar systems for residential, commercial, and industrial
                        applications.</p>
                </div>
                <div class="service-card fade-left">
                    <div class="service-icon">
                        <video autoplay muted loop playsinline>
                            <source src="assets/video/Customized Energy Projects.mp4" type="video/mp4">
                        </video>
                    </div>
                    <h3>Customized Energy Projects</h3>
                    <p>Tailor-made energy systems designed to maximize savings and efficiency based on your specific
                        requirements.</p>
                </div>
                <div class="service-card fade-left">
                    <div class="service-icon">
                        <video autoplay muted loop playsinline>
                            <source src="assets/video/Installation & Maintenance.mp4" type="video/mp4">
                        </video>
                    </div>
                    <h3>Installation & Maintenance</h3>
                    <p>Professional installation and ongoing maintenance services to ensure optimal system performance.
                    </p>
                </div>
                <div class="service-card fade-left">
                    <div class="service-icon">
                        <video autoplay muted loop playsinline>
                            <source src="assets/video/Energy Consultancy.mp4" type="video/mp4">
                        </video>
                    </div>
                    <h3>Energy Consultancy</h3>
                    <p>Expert guidance on planning, feasibility, cost analysis, and energy optimization strategies.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CONSULTATION FORM -->
    <section class="consultation" id="consultation">
        <div class="container">
            <div class="consultation-content fade-up">
                <h2>Get a Free Consultation</h2>
                <p>Tell us about your energy needs, and our experts will provide a customized solution designed to
                    maximize savings and efficiency.</p>
                <p>Fill out the form below, and we'll get back to you shortly.</p>

                <?php if (isset($success)): ?>
                    <div class="success-message">Thank you! We'll contact you soon.</div>
                <?php endif; ?>

                <form method="POST" action="#consultation" class="consultation-form">
                    <input type="text" name="name" placeholder="Your Name" required pattern="[A-Za-z ]{2,50}"
                        title="Name should contain only letters and spaces (2-50 characters)">
                    <input type="tel" name="phone" placeholder="Your Phone" maxlength="20">
                    <input type="email" name="email" placeholder="Your Email" required maxlength="100"
                        autocomplete="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8') : ''; ?>">

                    <textarea name="message" placeholder="Tell us about your energy needs..." rows="5"
                        required maxlength="1000"><?php echo isset($_POST['message']) ? htmlspecialchars($_POST['message'], ENT_QUOTES, 'UTF-8') : ''; ?></textarea>
                    <button type="submit" class="btn btn-primary">Submit Request</button>
                </form>
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

    <!-- WhatsApp Floating Button -->
    <a href="https://wa.me/917539944358?text=Hi%20BK%20Green%20Energy,%20I%20need%20information%20about%20solar%20solutions" 
       class="whatsapp-float" target="_blank" title="Chat on WhatsApp">
        <img src="assets/images/WhatsApp.png" alt="WhatsApp" style="width: 60px; height: 60px;">
    </a>
    <style>
        .whatsapp-float { position: fixed; bottom: 30px; right: 30px; z-index: 1000; transition: transform 0.3s; }
        .whatsapp-float:hover { transform: scale(1.1); }
    </style>

    <script src="js/script.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.min.css">


    <!-- Bootstrap JS -->
    <script src="js/bootstrap.bundle.min.js"></script>


</body>

</html>