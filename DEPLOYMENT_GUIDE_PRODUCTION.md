# 🚀 PRODUCTION DEPLOYMENT GUIDE
## BK Green Energy Website - Complete Setup Instructions

---

## 📋 REQUIREMENTS

### Minimum Server Requirements:
- **PHP Version:** 7.4 or higher (8.0+ recommended)
- **Web Server:** Apache 2.4+ or LiteSpeed
- **PHP Extensions:**
  - `mysqli` or `pdo_mysql` (if using database)
  - `mbstring`
  - `openssl`
  - `curl`
- **File Permissions:** Ability to set 644/755
- **Email:** SMTP access (Gmail, SendGrid, or hosting SMTP)

---

## 📁 FINAL FOLDER STRUCTURE

```
public_html/
├── index.php
├── about.php
├── careers.php
├── contact.php
├── projects.php
├── services.php
├── .htaccess
├── .env (create from .env.example)
├── config/
│   └── email.php
├── includes/
│   └── email-helper.php
├── vendor/              (if using PHPMailer via Composer)
│   └── phpmailer/
├── assets/
│   ├── images/
│   └── video/
├── css/
│   ├── style.css
│   ├── about.css
│   ├── careers.css
│   ├── contact.css
│   ├── projects.css
│   ├── services.css
│   ├── bootstrap.min.css
│   └── all.min.css
└── js/
    ├── script.js
    ├── about.js
    ├── careers.js
    ├── contact.js
    ├── footer.js
    ├── projects.js
    ├── services.js
    └── bootstrap.bundle.min.js
```

### Files NOT to Upload:
- `README.md` (optional - can keep for reference)
- `DEPLOYMENT_GUIDE.md` (this file - for local reference)
- `PRODUCTION_FIXES.md`
- `test-email.php`
- `contact-backup.php`
- `.env.example` (upload but rename to .env)
- `.vscode/` folder
- `.git/` folder

---

## 🔧 STEP-BY-STEP DEPLOYMENT

### **STEP 1: Prepare PHPMailer (Recommended Method)**

#### Option A: Using Composer (Recommended)
```bash
# On your local machine or via SSH on server
cd /path/to/BKGE
composer require phpmailer/phpmailer
```

#### Option B: Manual Installation
1. Download PHPMailer from: https://github.com/PHPMailer/PHPMailer/releases
2. Extract to `vendor/phpmailer/phpmailer/`
3. Ensure this structure:
   ```
   vendor/
   └── phpmailer/
       └── phpmailer/
           └── src/
               ├── PHPMailer.php
               ├── SMTP.php
               └── Exception.php
   ```

#### Option C: Use Native mail() (Fallback)
- The system will automatically use native `mail()` if PHPMailer is not found
- Less reliable but works on most shared hosting

---

### **STEP 2: Configure Email Settings**

1. **Copy .env.example to .env:**
   ```bash
   cp .env.example .env
   ```

2. **Edit config/email.php with your SMTP details:**

   **For Gmail:**
   ```php
   'smtp_host' => 'smtp.gmail.com',
   'smtp_port' => 587,
   'smtp_secure' => 'tls',
   'smtp_username' => 'your-email@gmail.com',
   'smtp_password' => 'your-app-password',  // Use App Password, not regular password
   ```

   **For cPanel/Hosting SMTP:**
   ```php
   'smtp_host' => 'mail.yourdomain.com',
   'smtp_port' => 587,
   'smtp_secure' => 'tls',
   'smtp_username' => 'noreply@yourdomain.com',
   'smtp_password' => 'your-email-password',
   ```

   **For SendGrid:**
   ```php
   'smtp_host' => 'smtp.sendgrid.net',
   'smtp_port' => 587,
   'smtp_secure' => 'tls',
   'smtp_username' => 'apikey',
   'smtp_password' => 'your-sendgrid-api-key',
   ```

3. **Gmail App Password Setup:**
   - Go to: https://myaccount.google.com/apppasswords
   - Select "Mail" and "Other (Custom name)"
   - Generate password
   - Use this 16-character password in config

---

### **STEP 3: Upload Files to cPanel**

#### Via cPanel File Manager:
1. Login to cPanel
2. Go to **File Manager**
3. Navigate to `public_html/`
4. Upload all files EXCEPT:
   - README.md
   - DEPLOYMENT_GUIDE.md
   - PRODUCTION_FIXES.md
   - test-email.php
   - .vscode/
   - .git/

#### Via FTP (FileZilla):
1. Connect to your hosting via FTP
2. Navigate to `public_html/` or `www/`
3. Upload all project files
4. Ensure folder structure is maintained

---

### **STEP 4: Set File Permissions**

**Via cPanel File Manager:**
1. Select all PHP files → Right-click → Change Permissions → Set to **644**
2. Select all folders → Right-click → Change Permissions → Set to **755**
3. Specifically check:
   - `.htaccess` → 644
   - `config/` folder → 755
   - `config/email.php` → 644 (or 600 for extra security)
   - `includes/` folder → 755
   - `vendor/` folder → 755

**Via SSH:**
```bash
cd /home/username/public_html
find . -type f -exec chmod 644 {} \;
find . -type d -exec chmod 755 {} \;
chmod 600 config/email.php  # Extra security
```

---

### **STEP 5: Configure .htaccess**

The `.htaccess` file is already configured. After SSL installation:

1. Edit `.htaccess`
2. Uncomment these lines (remove the `#`):
   ```apache
   RewriteCond %{HTTPS} off
   RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
   ```

---

### **STEP 6: Test the Website**

1. **Test Homepage:**
   - Visit: `https://yourdomain.com/`
   - Check if all images load
   - Check if navigation works

2. **Test Contact Form:**
   - Go to: `https://yourdomain.com/contact.php`
   - Fill out the form
   - Submit and check for success message
   - Check email inbox (and spam folder)

3. **Test All Pages:**
   - About: `https://yourdomain.com/about.php`
   - Services: `https://yourdomain.com/services.php`
   - Projects: `https://yourdomain.com/projects.php`
   - Careers: `https://yourdomain.com/careers.php`

---

### **STEP 7: Verify Security**

1. **Check .htaccess is working:**
   - Try accessing: `https://yourdomain.com/config/`
   - Should show "Forbidden" (403 error)

2. **Check sensitive files are protected:**
   - Try: `https://yourdomain.com/.env`
   - Try: `https://yourdomain.com/config/email.php`
   - Both should show "Forbidden"

3. **Check directory listing is disabled:**
   - Try: `https://yourdomain.com/assets/images/`
   - Should NOT show file list

---

## 🐛 TROUBLESHOOTING

### **Problem: Emails Not Sending**

**Solution 1: Check PHPMailer Installation**
```php
// Create test.php in root:
<?php
$phpmailerPath = __DIR__ . '/vendor/phpmailer/phpmailer/src/PHPMailer.php';
echo file_exists($phpmailerPath) ? 'PHPMailer Found' : 'PHPMailer NOT Found';
?>
```

**Solution 2: Check SMTP Credentials**
- Verify username/password in `config/email.php`
- For Gmail, ensure App Password is used
- Check if SMTP port is open (587 or 465)

**Solution 3: Check Error Logs**
```bash
# Via cPanel: Error Logs section
# Via SSH:
tail -f /home/username/public_html/error_log
```

**Solution 4: Test SMTP Connection**
```php
// Create smtp-test.php:
<?php
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';
require 'vendor/phpmailer/phpmailer/src/Exception.php';

$mail = new PHPMailer\PHPMailer\PHPMailer(true);
$mail->SMTPDebug = 2;  // Enable verbose debug output
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'your-email@gmail.com';
$mail->Password = 'your-app-password';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

try {
    $mail->smtpConnect();
    echo 'SMTP Connection Successful!';
} catch (Exception $e) {
    echo 'SMTP Connection Failed: ' . $e->getMessage();
}
?>
```

---

### **Problem: 500 Internal Server Error**

**Causes:**
1. Incorrect file permissions
2. Syntax error in .htaccess
3. PHP version incompatibility
4. Missing PHP extensions

**Solutions:**
1. Check error logs in cPanel
2. Temporarily rename `.htaccess` to `.htaccess.bak`
3. Verify PHP version in cPanel (should be 7.4+)
4. Check if `mbstring` extension is enabled

---

### **Problem: Images/CSS Not Loading**

**Solutions:**
1. Check file permissions (644 for files, 755 for folders)
2. Verify paths are relative (not absolute)
3. Clear browser cache
4. Check if files were uploaded correctly

---

### **Problem: Form Submits But No Success Message**

**Solutions:**
1. Check if session is started (already handled in code)
2. Verify email configuration
3. Check PHP error logs
4. Test with native mail() by temporarily removing PHPMailer

---

## 🔒 SECURITY CHECKLIST

- ✅ `.htaccess` configured and working
- ✅ Directory listing disabled
- ✅ Sensitive files protected (.env, config/)
- ✅ File permissions set correctly (644/755)
- ✅ HTTPS enabled and forced
- ✅ Security headers enabled
- ✅ Honeypot anti-spam in forms
- ✅ Rate limiting implemented
- ✅ Input validation and sanitization
- ✅ Output escaping (XSS protection)
- ✅ Email header injection prevented

---

## 📊 PERFORMANCE OPTIMIZATION

Already Implemented:
- ✅ Gzip compression enabled
- ✅ Browser caching configured
- ✅ CSS/JS minified (Bootstrap)
- ✅ Image lazy loading ready

Optional Improvements:
- Consider using CDN for assets
- Optimize images (compress JPG/PNG)
- Enable OPcache in PHP settings
- Use HTTP/2 if available

---

## 📞 SUPPORT & MAINTENANCE

### Regular Maintenance Tasks:
1. **Weekly:** Check error logs
2. **Monthly:** Update PHPMailer (if using Composer)
3. **Quarterly:** Review security settings
4. **Yearly:** Renew SSL certificate

### Backup Strategy:
1. **Files:** Backup via cPanel weekly
2. **Database:** N/A (no database used)
3. **Config:** Keep local copy of `config/email.php`

---

## 🎯 POST-DEPLOYMENT CHECKLIST

- [ ] All files uploaded to `public_html/`
- [ ] File permissions set (644/755)
- [ ] PHPMailer installed (Composer or manual)
- [ ] `config/email.php` configured with SMTP details
- [ ] `.env` file created (if using)
- [ ] SSL certificate installed
- [ ] HTTPS redirect enabled in `.htaccess`
- [ ] Homepage loads correctly
- [ ] All navigation links work
- [ ] Images and videos load
- [ ] CSS and JavaScript load
- [ ] Contact form submits successfully
- [ ] Email notifications received
- [ ] Tested on mobile devices
- [ ] Security checks passed
- [ ] Error logs reviewed
- [ ] Backup created

---

## 📧 CONTACT FORM FEATURES

### Implemented Security:
- ✅ Honeypot field (hidden spam trap)
- ✅ Rate limiting (10-second cooldown)
- ✅ Input validation (name, email, phone, message)
- ✅ Output escaping (XSS prevention)
- ✅ Email header injection prevention
- ✅ Session-based spam protection

### Email Delivery:
- ✅ PHPMailer SMTP (primary method)
- ✅ Native mail() fallback
- ✅ Error handling and logging
- ✅ Success/error messages
- ✅ Form field persistence on error

---

## 🌐 DOMAIN & SSL SETUP

### SSL Certificate Installation:
1. **Via cPanel (Let's Encrypt - Free):**
   - Go to: SSL/TLS Status
   - Click "Run AutoSSL"
   - Wait for completion

2. **Via cPanel (Manual):**
   - Go to: SSL/TLS
   - Upload certificate files
   - Install for domain

3. **After SSL Installation:**
   - Edit `.htaccess`
   - Uncomment HTTPS redirect lines
   - Test: `http://yourdomain.com` → should redirect to `https://`

---

## ✅ SUCCESS INDICATORS

Your deployment is successful when:
1. ✅ Website loads at `https://yourdomain.com`
2. ✅ All pages accessible and styled correctly
3. ✅ Contact form submits without errors
4. ✅ Email notifications arrive in inbox
5. ✅ No errors in browser console
6. ✅ No errors in server error logs
7. ✅ Mobile responsive design works
8. ✅ Security checks pass

---

## 📝 NOTES

- **Email Delivery Time:** SMTP emails typically arrive within 1-5 minutes
- **Spam Folder:** Check spam if emails don't arrive
- **Gmail Limits:** Max 500 emails/day for free Gmail accounts
- **Hosting Limits:** Check your hosting's email sending limits
- **PHP Version:** Ensure PHP 7.4+ for best compatibility
- **Composer:** Not required if PHPMailer is manually installed

---

**Deployment Guide Version:** 2.0  
**Last Updated:** 2025  
**Status:** Production Ready  

**For support, contact your hosting provider or refer to:**
- PHPMailer Documentation: https://github.com/PHPMailer/PHPMailer
- cPanel Documentation: https://docs.cpanel.net/
