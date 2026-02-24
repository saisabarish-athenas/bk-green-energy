<?php
session_start();
require_once '../includes/db.php';
require_once '../includes/auth.php';

if (isLoggedIn()) {
    header('Location: dashboard.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    
    if (login($username, $password)) {
        header('Location: dashboard.php');
        exit;
    } else {
        $error = 'Invalid username or password';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - BK Green Energy</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #0f7c3a 0%, #19a84a 100%); min-height: 100vh; display: flex; align-items: center; }
        .login-card { max-width: 400px; margin: auto; background: white; padding: 40px; border-radius: 10px; box-shadow: 0 10px 40px rgba(0,0,0,0.2); }
        .login-card h2 { color: #0f7c3a; margin-bottom: 30px; }
        .btn-login { background: #0f7c3a; color: white; width: 100%; }
        .btn-login:hover { background: #19a84a; color: white; }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-card">
            <h2 class="text-center">Admin Login</h2>
            <?php if ($error): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-login">Login</button>
            </form>
            <div class="text-center mt-3">
                <small class="text-muted">Default: admin / admin123</small>
            </div>
        </div>
    </div>
</body>
</html>
