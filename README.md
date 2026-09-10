# Wedding Studio Website - Professional Wedding Photography & Videography Platform

## 📋 Project Overview

**Wedding Studio Website** is a complete, production-ready web application for a wedding photography and videography business. Built with **PHP + MySQL** backend and modern responsive frontend, it provides both user-facing e-commerce features and a powerful admin management panel.

### 🎯 Key Highlights

✅ **Full-Featured Admin Panel** - Complete CRUD operations for all content
✅ **User Authentication** - Secure registration, login, and dashboard
✅ **Beautiful Responsive Design** - Works perfectly on desktop, tablet, and mobile
✅ **Gallery Management** - Upload multiple images with batch operations
✅ **Inquiry System** - Track customer inquiries with status management
✅ **Package Management** - Create and manage wedding service packages
✅ **Modern Tech Stack** - Bootstrap 5, Font Awesome, Google Fonts
✅ **Production Ready** - Security best practices implemented

---

## 🚀 Quick Start

### System Requirements

- **PHP** 7.4 or higher
- **MySQL** 5.7 or higher
- **Apache** or **Nginx** web server
- **Modern Browser** for development

### Installation (5 minutes)

```bash
# 1. Clone repository
git clone https://github.com/thinh261548-coder/wedding-studio-web.git
cd wedding-studio-web

# 2. Create database
mysql -u root -p < database/schema.sql

# 3. Configure application
cp .env.example .env
# Edit .env with your database credentials

# 4. Create uploads directory
mkdir -p public/uploads
chmod 755 public/uploads

# 5. Access application
# User site: http://localhost/wedding-studio-web
# Admin panel: http://localhost/admin/
```

**Default Admin Credentials:**
- Email: `admin@weddingstudio.local`
- Password: `admin123`

⚠️ **Change default password immediately after first login!**

---

## 📚 Documentation

- **[Installation Guide](./INSTALL.md)** - Detailed setup instructions
- **[Usage Guide](./USAGE_GUIDE.md)** - User and admin features
- **[Changelog](./CHANGELOG.md)** - Version history and roadmap

---

## 🏗️ Architecture

### Frontend Features (User-Facing)

```
┌─────────────────────────────────────┐
│     PUBLIC WEBSITE (www.site.com)   │
├─────────────────────────────────────┤
│ • Homepage with Services & Gallery  │
│ • Package Showcase                  │
│ • Image Gallery with Lightbox       │
│ • Contact/Inquiry Form              │
│ • User Registration & Login         │
│ • User Dashboard                    │
│ • Responsive Mobile Design          │
└─────────────────────────────────────┘
```

### Backend Features (Admin Panel)

```
┌─────────────────────────────────────┐
│        ADMIN PANEL (/admin/)        │
├─────────────────────────────────────┤
│ • Dashboard with Statistics         │
│ • Package CRUD Management           │
│ • Gallery with Batch Upload         │
│ • Service Management                │
│ • Inquiry Tracking & Status         │
│ • User Management                   │
│ • System Settings                   │
└─────────────────────────────────────┘
```

### Database Schema

```
users
├─ id, full_name, email, password
├─ phone, role (admin/user), status
└─ created_at, updated_at

packages
├─ id, name, description, price
├─ duration, features, image
└─ status (active/inactive/deleted)

services
├─ id, name, description
├─ icon, price, status
└─ timestamps

galleries
├─ id, title, description
├─ category, status
└─ gallery_images (one-to-many)

inquiries
├─ id, user_id, full_name, email
├─ phone, service_type, event_date
├─ message, status (pending/contacted/completed)
└─ timestamps

+ blog_posts, settings tables
```

---

## 🎨 Technology Stack

### Backend
| Technology | Purpose | Version |
|---|---|---|
| **PHP** | Server-side logic | 7.4+ |
| **MySQL** | Database | 5.7+ |
| **Object-Oriented PHP** | Code structure | - |
| **Prepared Statements** | Security | - |

### Frontend
| Technology | Purpose | Version |
|---|---|---|
| **HTML5** | Markup | - |
| **CSS3** | Styling | - |
| **Bootstrap** | Responsive framework | 5.1.3 |
| **Font Awesome** | Icons | 6.0.0 |
| **Google Fonts** | Typography | - |
| **JavaScript** | Interactivity | Vanilla |

---

## 🎯 Core Features

### 👤 User Features

#### Authentication
- ✅ Secure user registration
- ✅ Login/logout system
- ✅ Password hashing with bcrypt
- ✅ Session management
- ✅ Email validation

#### Dashboard
- ✅ View personal profile
- ✅ Inquiry history and status tracking
- ✅ Service request management

#### Browsing
- ✅ View all packages with pagination
- ✅ View service details
- ✅ Browse photo galleries
- ✅ View lightbox with full-size images
- ✅ Responsive design for all devices

#### Inquiries
- ✅ Submit service inquiries
- ✅ Fill detailed contact forms
- ✅ Track inquiry status
- ✅ Real-time notifications

---

### 🔐 Admin Features

#### Dashboard
- ✅ Key statistics overview
- ✅ Recent inquiries widget
- ✅ Quick start guide
- ✅ System information

#### Package Management
- ✅ Create new packages
- ✅ Edit package details
- ✅ Upload package images
- ✅ Manage pricing
- ✅ Delete packages
- ✅ Pagination

#### Gallery Management
- ✅ Create photo collections
- ✅ Bulk image upload
- ✅ Organize by category
- ✅ Edit collection details
- ✅ Delete individual images
- ✅ Photo counter

#### Service Management
- ✅ Add services with icons
- ✅ Set service pricing
- ✅ Edit service descriptions
- ✅ Manage Font Awesome icons

#### Inquiry Management
- ✅ View all inquiries
- ✅ Track inquiry status
- ✅ Update status in real-time
- ✅ Contact customer via email
- ✅ Pagination with filtering

#### User Management
- ✅ View all registered users
- ✅ See user roles
- ✅ Track registration date
- ✅ Manage user status

#### Settings
- ✅ Website information
- ✅ Contact details
- ✅ System information
- ✅ Data backup

---

## 🔒 Security Features

### Implemented Security Measures

✅ **Authentication & Authorization**
- Bcrypt password hashing
- Session-based authentication
- Role-based access control (Admin/User)
- Login/logout management

✅ **Data Protection**
- Prepared statements (prevent SQL injection)
- Input validation and sanitization
- File type validation for uploads
- File size restrictions

✅ **Application Security**
- Error suppression in production
- Secure cookie handling
- HTTP headers security
- CSRF token support (can be added)

✅ **Database Security**
- UTF-8 encoding
- Foreign key constraints
- Data type validation
- Soft deletes for data recovery

### Security Checklist

- [ ] Change default admin password
- [ ] Update PHP to latest version
- [ ] Enable HTTPS/SSL
- [ ] Set proper file permissions (755 for dirs, 644 for files)
- [ ] Configure firewall rules
- [ ] Set up regular backups
- [ ] Monitor access logs
- [ ] Keep MySQL updated

---

## 📁 Directory Structure

```
wedding-studio-web/
├── app/
│   ├── config/
│   │   ├── config.php              # Main configuration
│   │   └── Database.php            # Database singleton class
│   ├── controllers/
│   │   ├── AuthController.php      # Authentication logic
│   │   ├── PackageController.php   # Package management
│   │   ├── GalleryController.php   # Gallery management
│   │   ├── ServiceController.php   # Service management
│   │   ├── InquiryController.php   # Inquiry handling
│   │   └── DashboardController.php # User dashboard
│   ├── models/
│   │   ├── User.php                # User model
│   │   ├── Package.php             # Package model
│   │   ├── Gallery.php             # Gallery model
│   │   ├── Service.php             # Service model
│   │   └── Inquiry.php             # Inquiry model
│   └── views/
│       ├── header.php              # Main header
│       ├── footer.php              # Main footer
│       ├── home.php                # Homepage
│       ├── auth/
│       │   ├── login.php
│       │   └── register.php
│       ├── packages/
│       │   ├── list.php
│       │   ├── admin_list.php
│       │   └── admin_form.php
│       ├── gallery/
│       │   ├── list.php
│       │   ├── detail.php
│       │   ├── admin_list.php
│       │   └── admin_form.php
│       ├── services/
│       │   ├── list.php
│       │   ├── admin_list.php
│       │   └── admin_form.php
│       ├── inquiry/
│       │   └── form.php
│       ├── dashboard/
│       │   └── index.php
│       ├── admin/
│       │   ├── header.php
│       │   ├── footer.php
│       │   ├── dashboard.php
│       │   ├── users/
│       │   ├── packages/
│       │   ├── gallery/
│       │   ├── services/
│       │   └── inquiries/
│       └── 404.php
├── public/
│   ├── index.php                   # Main entry point
│   ├── uploads/                    # User uploads
│   └── assets/
│       ├── css/
│       │   ├── style.css           # Main stylesheet
│       │   └── admin.css           # Admin panel styles
│       └── js/
│           ├── script.js           # Main JavaScript
│           └── admin.js            # Admin JavaScript
├── admin/
│   └── index.php                   # Admin panel entry point
├── database/
│   └── schema.sql                  # Database schema
├── .env.example                    # Environment template
├── .gitignore                      # Git ignore rules
├── README.md                       # This file
├── INSTALL.md                      # Installation guide
├── USAGE_GUIDE.md                  # Usage instructions
└── CHANGELOG.md                    # Version history
```

---

## 📊 File Upload Specifications

### Image Requirements

| Aspect | Recommendation | Requirement |
|--------|---|---|
| **Format** | JPG/PNG | JPG, PNG, GIF |
| **Dimensions** | 1200×800px | Any (will be resized) |
| **Aspect Ratio** | 3:2 (landscape) | Any |
| **File Size** | < 500KB | < 5MB (configurable) |
| **Color Space** | sRGB | Any |
| **DPI** | 72 (web) | Any |

### Upload Best Practices

1. **Optimize Images Before Upload**
   ```bash
   # Using ImageMagick
   convert original.jpg -resize 1200x800 -quality 85 optimized.jpg
   ```

2. **Naming Convention**
   - Use descriptive names: `wedding-ceremony-2024.jpg`
   - Avoid spaces: Use hyphens or underscores
   - Include date: `2024-09-10-event-name.jpg`

3. **Batch Upload**
   - Upload multiple images together
   - Keep related images in same collection
   - Maintain consistent image quality

---

## 🔧 Configuration Guide

### Environment Variables (.env)

```env
# Database
DB_HOST=localhost
DB_USER=root
DB_PASS=your_password
DB_NAME=wedding_studio
DB_PORT=3306

# Application
APP_URL=http://localhost
APP_ENV=production          # development or production
APP_DEBUG=false            # false in production

# Upload Settings
MAX_UPLOAD_SIZE=5242880    # 5MB in bytes
ALLOWED_EXTENSIONS=jpg,jpeg,png,gif
```

### PHP Configuration

Optimize `php.ini` for uploads:

```ini
upload_max_filesize = 5M
post_max_size = 5M
memory_limit = 128M
max_execution_time = 30
max_input_time = 60
```

### Web Server Configuration

**Apache (.htaccess)**
```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteBase /
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^(.*)$ public/index.php?$1 [L]
</IfModule>
```

**Nginx**
```nginx
location / {
    try_files $uri $uri/ /index.php?$query_string;
}
```

---

## 🐛 Troubleshooting

### Common Issues

**Database Connection Error**
```
Solution: Check .env file - verify host, user, password, database name
Test: mysql -u root -p wedding_studio -e "SELECT 1;"
```

**404 on Admin Panel**
```
Solution: Ensure mod_rewrite is enabled on Apache
Test: a2enmod rewrite && systemctl restart apache2
```

**File Upload Fails**
```
Solution: Check directory permissions
Fix: chmod 755 public/uploads
Also verify: upload_max_filesize in php.ini
```

**Database Schema Import Error**
```
Solution: Create database first
Fix: mysql -u root -p -e "CREATE DATABASE wedding_studio CHARACTER SET utf8mb4;"
Then: mysql -u root -p wedding_studio < database/schema.sql
```

---

## 🚀 Deployment

### Production Checklist

- [ ] Set `APP_ENV=production` in .env
- [ ] Set `APP_DEBUG=false` in .env
- [ ] Change default admin password
- [ ] Enable HTTPS/SSL certificate
- [ ] Set up automated backups
- [ ] Configure firewall rules
- [ ] Set proper file permissions (755 dirs, 644 files)
- [ ] Disable PHP error display (handled by APP_DEBUG)
- [ ] Set up log rotation
- [ ] Monitor server resources
- [ ] Set up uptime monitoring
- [ ] Test email notifications (if added)

### Performance Optimization

1. **Database Optimization**
   - Add indexes on frequently queried columns ✅ (Done)
   - Regular VACUUM/ANALYZE
   - Monitor slow queries

2. **Caching**
   - Implement browser caching
   - Consider Redis for session storage
   - Cache static assets (CSS, JS, images)

3. **Code Optimization**
   - Minify CSS and JavaScript
   - Optimize images
   - Use lazy loading for images
   - Enable gzip compression

---

## 📞 Support & Contact

### Get Help

- **Documentation**: See INSTALL.md and USAGE_GUIDE.md
- **Issues**: Create GitHub issue
- **Email**: thinh261548@gmail.com
- **GitHub**: @thinh261548-coder

### Report Bugs

When reporting bugs, please include:
1. PHP version
2. MySQL version
3. Browser used
4. Steps to reproduce
5. Expected vs actual behavior
6. Error messages/logs

---

## 📄 License & Disclaimer

This project is created for **educational purposes**. Use at your own risk.

**Disclaimer**: The author is not responsible for any misuse, data loss, or security breaches resulting from improper implementation or configuration.

---

## 🙏 Credits

### Libraries & Resources Used

- **Bootstrap 5** - Responsive framework
- **Font Awesome** - Icon library
- **Google Fonts** - Typography
- **PHP** - Server-side language
- **MySQL** - Database system

### Contributors

- **Thinh Coder** - Creator & Lead Developer

---

## 🎓 Learning Resources

### For Developers

**Backend (PHP)**
- Object-Oriented Programming (OOP)
- MVC Architecture
- Database Design
- Security Best Practices

**Frontend (HTML/CSS/JS)**
- Bootstrap 5 Framework
- Responsive Design
- Form Validation
- DOM Manipulation

**Database (MySQL)**
- Table Design
- Relationships
- Indexing
- Query Optimization

---

## 🎯 Next Steps

### After Installation

1. **Customize Content**
   - Update website title and description
   - Add your contact information
   - Upload your portfolio images

2. **Configure Packages**
   - Add your wedding packages
   - Set pricing
   - Upload package images

3. **Build Gallery**
   - Create collections
   - Upload sample photos
   - Organize by category

4. **Set Services**
   - List your services
   - Set pricing (optional)
   - Add descriptions

5. **Go Live**
   - Set up domain
   - Enable HTTPS
   - Configure email (if needed)
   - Set up backups

---

## 📈 Future Roadmap

### Version 1.1 (Planned)
- [ ] Email notifications
- [ ] Blog/News section
- [ ] SEO optimization
- [ ] Analytics integration

### Version 2.0 (Long-term)
- [ ] Payment gateway integration
- [ ] Client portal
- [ ] Appointment booking
- [ ] Video hosting
- [ ] Mobile app
- [ ] Multi-language support

---

## 📊 Project Statistics

```
Total Files:        40+
Lines of Code:      5000+
Database Tables:    9
Controllers:        6
Models:             5
Views:              25+
CSSStyles:          1000+ lines
JavaScript:         200+ lines
```

---

**Last Updated**: September 10, 2024
**Version**: 1.0.0
**Status**: ✅ Production Ready

**Happy coding! 🎉**
