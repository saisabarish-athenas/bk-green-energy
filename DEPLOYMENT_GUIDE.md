# 🚀 PRODUCTION DEPLOYMENT GUIDE
## BK Green Energy Website

---

## ✅ FIXES APPLIED

### 1️⃣ **File Paths**
- ✅ All paths are relative (assets/, css/, js/)
- ✅ Works correctly when uploaded to public_html/

### 2️⃣ **PHP Form Handling**
**index.php:**
- ✅ Added proper `trim()` on all inputs
- ✅ Added validation for name, email, message
- ✅ Added maxlength validation (message: 1000 chars)
- ✅ Secure email headers with UTF-8 charset
- ✅ Changed From header to noreply@bkgreenenergy.com
- ✅ Added error handling with @mail() suppression
- ✅ Form field persistence on error

**contact.php:**
- ✅ Added proper `trim()` on all inputs
- ✅ Added phone validation (Indian format: 10 digits starting with 6-9)
- ✅ Added maxlength restrictions (name: 50, email: 100, phone: 10, message: 1000)
- ✅ Secure email headers with UTF-8 charset
- ✅ Changed From header to noreply@bkgreenenergy.com
- ✅ Added error handling with @mail() suppression
- ✅ Form field persistence on error

### 3️⃣ **Security Hardening**
- ✅ All outputs escaped with `htmlspecialchars($var, ENT_QUOTES, 'UTF-8')`
- ✅ Email sanitized with `filter_var($email, FILTER_SANITIZE_EMAIL)`
- ✅ Prevented email header injection
- ✅ Added pattern validation for name and phone
- ✅ Added .htaccess with security headers

### 4️⃣ **Navigation Links**
- ✅ Fixed all footer links from `/about-us` to `about.php`
- ✅ Fixed all footer links from `/services` to `services.php`
- ✅ Fixed all footer links from `/careers` to `careers.php`
- ✅ Fixed all footer links from `/projects` to `projects.php`
- ✅ Fixed all footer links from `/contact-us` to `contact.php`

### 5️⃣ **Email Configuration**
- ✅ Proper headers: From, Reply-To, Content-Type, X-Mailer
- ✅ UTF-8 charset support
- ✅ Error handling if mail() fails
- ✅ Using noreply@bkgreenenergy.com as sender

### 6️⃣ **Server Compatibility**
- ✅ Created .htaccess with:
  - Directory listing disabled
  - UTF-8 charset
  - Gzip compression
  - Browser caching
  - Security headers
  - HTTPS redirect (commented, enable after SSL)

---

## 📦 DEPLOYMENT STEPS

### **Step 1: Upload Files**
Upload all files to your hosting via FTP/cPanel File Manager:
```
public_html/
├── index.php
├── about.php
├── careers.php
├── contact.php
├── projects.php
├── services.php
├── .htaccess
├── css/
├── js/
└── assets/
    ├── images/
    └── video/
```

### **Step 2: Set File Permissions**
```
Files (.php, .css, .js, .html): 644
Folders (css/, js/, assets/): 755
.htaccess: 644
```

### **Step 3: Configure Email**
The mail() function is now ENABLED in both forms.

**If emails don't send:**
1. Check if your hosting supports PHP mail()
2. Configure SMTP (use PHPMailer if needed)
3. Check spam folder
4. Verify email address: info@bkgreenenergy.com

**To disable email temporarily:**
Comment out line in index.php and contact.php:
```php
// if (@mail($to, $subject, $body, $headers)) {
```

### **Step 4: Enable HTTPS (After SSL Installation)**
Edit .htaccess and uncomment:
```apache
RewriteCond %{HTTPS} off
RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
```

### **Step 5: Test Everything**
- ✅ Homepage loads: `https://yourdomain.com/`
- ✅ All navigation links work
- ✅ Images and videos load
- ✅ CSS and JS load correctly
- ✅ Forms submit successfully
- ✅ Email notifications received

---

## 🔧 OPTIONAL CONFIGURATIONS

### **Clean URLs (Optional)**
Add to .htaccess:
```apache
RewriteRule ^about$ about.php [L]
RewriteRule ^services$ services.php [L]
RewriteRule ^projects$ projects.php [L]
RewriteRule ^careers$ careers.php [L]
RewriteRule ^contact$ contact.php [L]
```

### **Custom Error Pages**
Create 404.html and 500.html, then uncomment in .htaccess:
```apache
ErrorDocument 404 /404.html
ErrorDocument 500 /500.html
```

### **PHP Settings**
If you need to adjust PHP settings, edit .htaccess:
```apache
php_value upload_max_filesize 20M
php_value post_max_size 20M
php_value max_execution_time 60
```

---

## 📧 EMAIL TROUBLESHOOTING

### **If emails don't arrive:**

1. **Check hosting mail() support:**
   - Most shared hosting supports mail()
   - Some require SMTP configuration

2. **Check spam folder:**
   - Emails from mail() often go to spam
   - Add SPF/DKIM records to domain

3. **Use SMTP (Recommended for production):**
   - Install PHPMailer
   - Configure with Gmail/SendGrid/AWS SES

4. **Test mail() function:**
   Create test.php:
   ```php
   <?php
   $result = mail('your@email.com', 'Test', 'Test message');
   echo $result ? 'Mail sent!' : 'Mail failed!';
   ?>
   ```

---

## 🔒 SECURITY CHECKLIST

- ✅ All user inputs sanitized
- ✅ All outputs escaped
- ✅ Email headers secured
- ✅ Directory listing disabled
- ✅ Sensitive files protected
- ✅ Security headers enabled
- ✅ XSS protection enabled
- ✅ MIME sniffing prevented
- ✅ Clickjacking protection enabled

---

## 📊 PERFORMANCE OPTIMIZATION

- ✅ Gzip compression enabled
- ✅ Browser caching configured
- ✅ Images optimized (check if needed)
- ✅ CSS/JS minified (bootstrap already minified)

---

## 🐛 COMMON ISSUES & FIXES

### **Issue: Forms submit but no email**
**Fix:** Check hosting mail() support, configure SMTP

### **Issue: "Headers already sent" error**
**Fix:** Ensure no output before PHP opening tag, check for BOM

### **Issue: Images/CSS not loading**
**Fix:** Check file permissions (644 for files, 755 for folders)

### **Issue: 500 Internal Server Error**
**Fix:** Check .htaccess syntax, check PHP error logs

### **Issue: Form shows old values after submit**
**Fix:** Already fixed with form field persistence

---

## 📞 SUPPORT

For deployment issues:
- Check cPanel error logs
- Contact hosting support
- Verify PHP version (7.4+ recommended)

---

## ✨ WHAT'S PRODUCTION-READY

✅ All PHP files secured and optimized
✅ Forms work with proper validation
✅ Email sending configured
✅ Navigation links fixed
✅ .htaccess configured
✅ Security headers enabled
✅ Performance optimized
✅ Error handling implemented

**Your website is now ready for production deployment!**

---

**Last Updated:** 2025
**Version:** 1.0 Production
