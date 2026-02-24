# 🚀 QUICK START GUIDE

## Get Your Website Running in 30 Minutes

---

## Step 1: Database Setup (5 minutes)

### In Hostinger cPanel → phpMyAdmin:

1. **Create Database:**
   - Click "New" in left sidebar
   - Database name: `bk_green_energy`
   - Click "Create"

2. **Import Schema:**
   - Select your database
   - Click "Import" tab
   - Choose file: `database/schema.sql`
   - Click "Go"

3. **Import Sample Data (Optional):**
   - Click "Import" tab again
   - Choose file: `database/sample_data.sql`
   - Click "Go"

✅ **Done!** You now have 6 sample clients, 7 gallery images, and 6 projects.

---

## Step 2: Upload Files (10 minutes)

### Via Hostinger File Manager or FTP:

1. **Upload all files to:** `public_html/`
2. **Keep folder structure intact**
3. **Set permissions:**
   - Right-click `uploads` folder → Permissions → 755
   - Right-click `uploads/client_logos` → Permissions → 755
   - Right-click `uploads/gallery` → Permissions → 755
   - Right-click `uploads/projects` → Permissions → 755

---

## Step 3: Configure Database (2 minutes)

### Edit `includes/db.php`:

```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'your_database_name');     // Change this
define('DB_USER', 'your_database_username'); // Change this
define('DB_PASS', 'your_database_password'); // Change this
```

**Where to find credentials:**
- Hostinger cPanel → MySQL Databases
- Look for database name, username, and password

---

## Step 4: Test Your Website (5 minutes)

### Public Website:
1. Visit: `https://yourdomain.com`
2. Check all pages work
3. Test contact form
4. Click WhatsApp button

### Admin Panel:
1. Visit: `https://yourdomain.com/admin/`
2. Login:
   - Username: `admin`
   - Password: `admin123`
3. You should see dashboard with stats

---

## Step 5: Secure Admin (2 minutes)

### Change Admin Password:

1. In phpMyAdmin, select your database
2. Click `admins` table
3. Click "Edit" on admin row
4. In `password_hash` field, replace with new hash:

**Generate new password hash:**
```php
// Create a file: generate_password.php
<?php
echo password_hash('YOUR_NEW_PASSWORD', PASSWORD_DEFAULT);
?>
```

Upload this file, visit it in browser, copy the hash, paste in phpMyAdmin.

---

## Step 6: Add Your Content (10 minutes)

### Via Admin Panel:

1. **Add Clients:**
   - Admin → Clients → Add New Client
   - Upload logo, add name and note
   - Save

2. **Upload Gallery Images:**
   - Admin → Gallery
   - Select multiple images
   - Link to project (optional)
   - Upload

3. **Add Projects:**
   - Admin → Projects → Add New Project
   - Fill all details
   - Save

4. **Check Leads:**
   - Admin → Leads
   - View contact form submissions
   - Export to CSV

---

## 🎯 What You Get Immediately

### With Sample Data:
- ✅ 6 clients displayed on clients page
- ✅ 7 images in gallery
- ✅ 6 projects with filters working
- ✅ Fully functional admin panel
- ✅ Working contact form

### Without Sample Data:
- ✅ Empty but functional pages
- ✅ "No content yet" messages
- ✅ Ready to add your content

---

## 📱 Test Checklist

### Public Website:
- [ ] Homepage loads
- [ ] All navigation links work
- [ ] Projects page shows data
- [ ] Filters work on projects page
- [ ] Clients page shows data
- [ ] Gallery page shows images
- [ ] Contact form submits
- [ ] WhatsApp button works
- [ ] Mobile responsive

### Admin Panel:
- [ ] Can login
- [ ] Dashboard shows stats
- [ ] Can add project
- [ ] Can edit project
- [ ] Can delete project
- [ ] Can add client
- [ ] Can upload gallery images
- [ ] Can view leads
- [ ] Can export leads to CSV

---

## 🐛 Troubleshooting

### "Database connection error"
- Check `includes/db.php` credentials
- Verify database exists in phpMyAdmin
- Check database user has permissions

### "Permission denied" on upload
- Set folder permissions to 755
- Check `uploads/` folder exists

### Admin login not working
- Clear browser cache
- Check database has admin user
- Verify password hash in database

### Images not showing
- Check file paths in database
- Verify images uploaded to correct folder
- Check folder permissions

---

## 📞 Quick Reference

### Admin Login:
- URL: `yourdomain.com/admin/`
- Default: `admin` / `admin123`

### Database Tables:
- `projects` - Project data
- `clients` - Client data
- `gallery_images` - Gallery photos
- `leads` - Contact submissions
- `admins` - Admin users

### Upload Folders:
- `uploads/projects/` - Project images
- `uploads/client_logos/` - Client logos
- `uploads/gallery/` - Gallery images

### File Limits:
- Client logos: 2MB max
- Gallery images: 5MB max
- Allowed: JPG, PNG, GIF, WEBP

---

## ✅ You're Done!

Your website is now:
- ✅ Fully functional
- ✅ Dynamic (database-driven)
- ✅ Manageable via admin panel
- ✅ Secure
- ✅ Production-ready

**Next:** Add your real content and go live! 🎉

---

## 📚 More Help

- **Full details:** See `COMPLETE_IMPLEMENTATION.md`
- **Deployment:** See `HOSTINGER_DEPLOYMENT.md`
- **Database:** See `database/schema.sql`
