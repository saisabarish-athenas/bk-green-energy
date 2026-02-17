<?php
/**
 * Email Helper for BK Green Energy
 * Supports both PHPMailer (recommended) and native mail()
 */

function sendEmail($name, $email, $message, $phone = null) {
    // Load configuration
    $config = require __DIR__ . '/../config/email.php';
    
    // Sanitize inputs
    $name = htmlspecialchars(trim($name), ENT_QUOTES, 'UTF-8');
    $email = filter_var(trim($email), FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars(trim($message), ENT_QUOTES, 'UTF-8');
    $phone = $phone ? htmlspecialchars(trim($phone), ENT_QUOTES, 'UTF-8') : null;
    
    // Check if PHPMailer is available
    $phpmailerPath = __DIR__ . '/../vendor/phpmailer/phpmailer/src/PHPMailer.php';
    
    if (file_exists($phpmailerPath)) {
        return sendWithPHPMailer($config, $name, $email, $message, $phone);
    } else {
        return sendWithNativeMail($config, $name, $email, $message, $phone);
    }
}

function sendWithPHPMailer($config, $name, $email, $message, $phone) {
    require_once __DIR__ . '/../vendor/phpmailer/phpmailer/src/Exception.php';
    require_once __DIR__ . '/../vendor/phpmailer/phpmailer/src/PHPMailer.php';
    require_once __DIR__ . '/../vendor/phpmailer/phpmailer/src/SMTP.php';
    
    $mail = new \PHPMailer\PHPMailer\PHPMailer(true);
    
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = $config['smtp_host'];
        $mail->SMTPAuth = true;
        $mail->Username = $config['smtp_username'];
        $mail->Password = $config['smtp_password'];
        $mail->SMTPSecure = $config['smtp_secure'];
        $mail->Port = $config['smtp_port'];
        $mail->CharSet = 'UTF-8';
        
        // Recipients
        $mail->setFrom($config['from_email'], $config['from_name']);
        $mail->addAddress($config['to_email'], $config['to_name']);
        $mail->addReplyTo($email, $name);
        
        // Content
        $mail->isHTML(false);
        $mail->Subject = 'New Contact Request from ' . $name;
        
        $body = "Name: $name\n";
        $body .= "Email: $email\n";
        if ($phone) {
            $body .= "Phone: $phone\n";
        }
        $body .= "\nMessage:\n$message";
        
        $mail->Body = $body;
        
        $mail->send();
        return ['success' => true, 'message' => 'Email sent successfully'];
    } catch (\Exception $e) {
        error_log('PHPMailer Error: ' . $mail->ErrorInfo);
        return ['success' => false, 'message' => 'Failed to send email. Please try again later.'];
    }
}

function sendWithNativeMail($config, $name, $email, $message, $phone) {
    $to = $config['to_email'];
    $subject = 'New Contact Request from ' . $name;
    
    $body = "Name: $name\n";
    $body .= "Email: $email\n";
    if ($phone) {
        $body .= "Phone: $phone\n";
    }
    $body .= "\nMessage:\n$message";
    
    $headers = "From: {$config['from_email']}\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();
    
    if (@mail($to, $subject, $body, $headers)) {
        return ['success' => true, 'message' => 'Email sent successfully'];
    } else {
        error_log('Native mail() failed');
        return ['success' => false, 'message' => 'Failed to send email. Please try again later.'];
    }
}
