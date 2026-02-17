<?php
/**
 * Email Configuration for BK Green Energy
 * Configure SMTP settings here for production
 */

return [
    'smtp_host' => 'smtp.gmail.com',  // Change to your SMTP host
    'smtp_port' => 587,
    'smtp_secure' => 'tls',  // 'tls' or 'ssl'
    'smtp_username' => 'your-email@gmail.com',  // Your SMTP username
    'smtp_password' => 'your-app-password',  // Your SMTP password or app password
    'from_email' => 'noreply@bkgreenenergy.com',
    'from_name' => 'BK Green Energy',
    'to_email' => 'info@bkgreenenergy.com',
    'to_name' => 'BK Green Energy',
];
