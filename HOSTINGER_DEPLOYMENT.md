# BK Green Energy - Complete Deployment Guide for Hostinger

## 📋 Pre-Deployment Checklist

### What You Need:
1. ✅ Hostinger account with PHP + MySQL hosting
2. ✅ Domain name (or use temporary Hostinger domain)
3. ✅ FTP credentials (from Hostinger hPanel)
4. ✅ Database credentials (create in hPanel)
5. ✅ Email: info@bkgreenenergy.com configured
6. ✅ WhatsApp number: +91-75399 44358

---

## 🚀 Step-by-Step Deployment

### PHASE 1: Database Setup (10 minutes)

#### 1.1 Create Database in Hostinger
1. Login to **Hostinger hPanel**
2. Go to **Databases** → **MySQL Databases**
3. Click **Create New Database**
4. Database name: `u123456789_bk_green` (Hostinger adds prefix)
5. Username: `u123456789_bkadmin`
6. Password: Generate strong password
7. **SAVE THESE CREDENTIALS**

#### 1.2 Import Database Schema
1. In hPanel, click **phpMyAdmin** next to your database
2. Select your database from left sidebar
3. Click **Import** tab
4. Choose file: `database/schema.sql`
5. Click **Go**
6. ✅ Verify tables created: projects, clients, gallery_images, leads, admins

---

### PHASE 2: Upload Files (15 minutes)

#### 2.1 Using File Manager (Easiest)
1. In hPanel → **File Manager**
2. Navigate to `public_html/`
3. **Delete** default index.html if exists
4. Click **Upload** → Select all project files
5. Upload structure:
```
public_html/
├── index.php
├── about.php
├── services.php
├── projects.php
├── clients.php
├── gallery.php
├── downloads.php
├── contact.php
├── careers.php
├── admin/
├── assets/
├── css/
├── js/
├── includes/
├── uploads/
└── PHPMailer/
```

#### 2.2 Using FTP (Alternative)
1. Download **FileZilla** (free FTP client)
2. Connect using Hostinger FTP credentials
3. Upload all files to `public_html/`

---

### PHASE 3: Configuration (10 minutes)

#### 3.1 Update Database Connection
Edit `includes/db.php`:
```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'u123456789_bk_green');  // Your actual DB name
define('DB_USER', 'u123456789_bkadmin');   // Your actual DB user
define('DB_PASS', 'YOUR_DB_PASSWORD');     // Your actual password
```

#### 3.2 Set Folder Permissions
In File Manager, right-click these folders → **Permissions** → Set to **755**:
- `uploads/`
- `uploads/gallery/`
- `uploads/client_logos/`
- `uploads/projects/`

---

### PHASE 4: SSL & Domain Setup (5 minutes)

#### 4.1 Enable SSL (Free)
1. In hPanel → **SSL**
2. Select your domain
3. Click **Install SSL** (Hostinger provides free Let's Encrypt)
4. Wait 5-10 minutes for activation

#### 4.2 Force HTTPS
Create/edit `.htaccess` in `public_html/`:
```apache
RewriteEngine On
RewriteCond %{HTTPS} off
RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
```

---

### PHASE 5: Email Configuration (10 minutes)

#### 5.1 Create Email Account
1. In hPanel → **Email Accounts**
2. Create: `info@bkgreenenergy.com`
3. Set strong password

#### 5.2 Update Email Settings
Edit `config/email.php`:
```php
'smtp_host' => 'smtp.hostinger.com',
'smtp_port' => 587,
'smtp_username' => 'info@bkgreenenergy.com',
'smtp_password' => 'YOUR_EMAIL_PASSWORD',
```

---

### PHASE 6: Testing (15 minutes)

#### 6.1 Test Public Pages
Visit and verify:
- ✅ https://yourdomain.com (Home)
- ✅ https://yourdomain.com/about.php
- ✅ https://yourdomain.com/services.php
- ✅ https://yourdomain.com/projects.php
- ✅ https://yourdomain.com/clients.php
- ✅ https://yourdomain.com/gallery.php
- ✅ https://yourdomain.com/downloads.php
- ✅ https://yourdomain.com/contact.php

#### 6.2 Test Contact Form
1. Fill form on homepage
2. Submit
3. Check:
   - ✅ Email received at info@bkgreenenergy.com
   - ✅ Lead saved in database (check phpMyAdmin → leads table)

#### 6.3 Test Admin Panel
1. Visit: https://yourdomain.com/admin/login.php
2. Login:
   - Username: `admin`
   - Password: `admin123`
3. ✅ Dashboard loads
4. ✅ Can view leads
5. ✅ Can add/edit projects
6. **IMPORTANT:** Change admin password immediately!

#### 6.4 Test WhatsApp Button
- ✅ Click floating WhatsApp button
- ✅ Opens WhatsApp with pre-filled message

---

## 🔒 Security Hardening (CRITICAL)

### 1. Change Admin Password
```sql
-- In phpMyAdmin, run:
UPDATE admins SET password_hash = '$2y$10$NEW_HASH_HERE' WHERE username = 'admin';
```
Or use admin panel to create new admin and delete default.

### 2. Protect Admin Directory
Create `admin/.htaccess`:
```apache
# Block access except from specific IPs (optional)
# order deny,allow
# deny from all
# allow from YOUR_IP_ADDRESS
```

### 3. Hide Database Credentials
Move `includes/db.php` outside `public_html/` if possible.

### 4. Enable Error Logging
Create `php.ini` in `public_html/`:
```ini
display_errors = Off
log_errors = On
error_log = /home/username/error_log
```

---

## 📊 Post-Launch Checklist

### Content Updates Needed:
- [ ] Add real project data in admin panel
- [ ] Upload project images to gallery
- [ ] Add client logos
- [ ] Upload company profile PDF to `assets/downloads/`
- [ ] Update About page with team info
- [ ] Add more service details

### SEO Setup:
- [ ] Submit sitemap to Google Search Console
- [ ] Add Google Analytics tracking code
- [ ] Verify meta descriptions on all pages
- [ ] Test mobile responsiveness

### Marketing:
- [ ] Update social media links
- [ ] Add WhatsApp Business API (optional)
- [ ] Create Google My Business listing
- [ ] Set up email autoresponder

---

## 🆘 Troubleshooting

### Database Connection Error
- Verify credentials in `includes/db.php`
- Check database exists in phpMyAdmin
- Ensure user has all privileges

### Contact Form Not Working
- Check email credentials in `config/email.php`
- Verify SMTP settings with Hostinger support
- Check spam folder for test emails

### Admin Login Not Working
- Clear browser cache
- Verify database has admin user
- Check session settings in PHP

### Images Not Uploading
- Check folder permissions (755 or 775)
- Verify upload_max_filesize in PHP settings
- Check disk space in Hostinger

---

## 📞 Support Contacts

**Hostinger Support:** 24/7 live chat in hPanel
**Database Issues:** Check phpMyAdmin error logs
**Email Issues:** Hostinger Email support

---

## 🎯 Next Steps (Phase 2 Features)

After successful deployment, consider adding:
1. **Project filtering** by state, MW, year
2. **Client testimonials** section
3. **Blog/News** section for SEO
4. **Multi-step quote form**
5. **Live chat** integration
6. **Performance monitoring** (Google Analytics)

---

## ✅ Deployment Complete!

Your website is now live at: **https://yourdomain.com**

Admin panel: **https://yourdomain.com/admin/**

**Default Login:** admin / admin123 (CHANGE IMMEDIATELY!)

---

**Need Help?** Contact your developer or Hostinger support.
