<?php
// Authentication Helper

function isLoggedIn() {
    return isset($_SESSION['admin_id']) && isset($_SESSION['admin_username']);
}

function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: login.php');
        exit;
    }
}

function login($username, $password) {
    $db = getDB();
    $stmt = $db->prepare("SELECT id, username, password_hash, role FROM admins WHERE username = ?");
    $stmt->execute([$username]);
    $admin = $stmt->fetch();
    
    if ($admin && password_verify($password, $admin['password_hash'])) {
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_username'] = $admin['username'];
        $_SESSION['admin_role'] = $admin['role'];
        
        $stmt = $db->prepare("UPDATE admins SET last_login = NOW() WHERE id = ?");
        $stmt->execute([$admin['id']]);
        
        return true;
    }
    
    return false;
}

function logout() {
    session_destroy();
    header('Location: login.php');
    exit;
}
