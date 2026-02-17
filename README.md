# BK Green Energy - Homepage

Production-ready homepage for BK Green Energy renewable energy company.

## 📁 Folder Structure

```
/
├── index.php           # Main PHP file with form handling
├── css/
│   └── style.css      # External stylesheet
├── js/
│   └── script.js      # Minimal JavaScript for animations
└── assets/
    ├── images/        # Place custom images here
    └── video/         # Place custom videos here
```

## 🚀 Features

- ✅ Single PHP file (shared hosting compatible)
- ✅ Separate CSS and JS files
- ✅ Fully responsive design
- ✅ SEO optimized with meta tags
- ✅ Smooth CSS animations
- ✅ IntersectionObserver scroll animations
- ✅ Contact form with PHP mail handler
- ✅ Video background hero section
- ✅ Semantic HTML5 structure
- ✅ Lightweight and fast loading
- ✅ No frameworks required

## 🎨 Design Elements

- **Primary Color**: #0f7c3a (Green)
- **Secondary Color**: #19a84a (Light Green)
- **Animations**: Fade-in, slide-up, scale on hover
- **Typography**: Segoe UI system font
- **Shadows**: Soft shadows with green accent

## 📋 Sections

1. **Hero Section** - Full-screen video background with CTA buttons
2. **About Section** - Company introduction with animated SVG
3. **Services Section** - 4 service cards with icons
4. **Consultation Form** - Contact form with PHP handler
5. **Location Section** - Registered office address
6. **Footer** - Logo and contact email

## ⚙️ Setup Instructions

1. Upload all files to your shared hosting
2. Ensure folder structure is maintained
3. Update email in index.php (line 7) if needed
4. Uncomment mail() function (line 13) to enable email
5. Optional: Replace video URL with custom video in assets/video/

## 📧 Form Configuration

The contact form sends to: `info@bkgreenenergy.com`

To enable email sending:
- Uncomment line 13 in index.php
- Ensure your hosting supports PHP mail() function
- Configure SMTP if needed

## 🎥 Video Background

Current video: Free stock video from Coverr.co
To use custom video:
1. Place video in `assets/video/`
2. Update video source in index.php (line 30)
3. Recommended format: MP4, max 10MB for fast loading

## 📱 Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Mobile browsers (iOS Safari, Chrome Mobile)

## 🔧 Customization

### Colors
Edit CSS variables in `css/style.css` (lines 6-12)

### Content
Edit text directly in `index.php`

### Animations
Modify animation timing in `css/style.css` (animations section)

## 📊 Performance

- Minimal CSS (~8KB)
- Minimal JS (~1KB)
- Optimized animations (CSS-based)
- Lazy loading ready
- Mobile-first responsive design

## 📞 Contact

BK Green Energy
Email: info@bkgreenenergy.com
Location: Madurai, Tamil Nadu

---

Built with ❤️ for sustainable energy solutions
