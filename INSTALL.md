# Hướng Dẫn Cài Đặt Wedding Studio Website

## 📋 Yêu Cầu Hệ Thống

- **PHP**: 7.4 trở lên
- **MySQL**: 5.7 trở lên hoặc MariaDB 10.3+
- **Web Server**: Apache hoặc Nginx
- **Trình duyệt**: Chrome, Firefox, Safari (phiên bản mới)

## 🚀 Cài Đặt

### 1. Clone Repository

```bash
git clone https://github.com/thinh261548-coder/wedding-studio-web.git
cd wedding-studio-web
```

### 2. Cấu Hình Database

#### Bước 1: Tạo Database

```sql
CREATE DATABASE IF NOT EXISTS wedding_studio CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

#### Bước 2: Import Schema

Mở MySQL client và chạy:

```bash
mysql -u root -p wedding_studio < database/schema.sql
```

Hoặc sử dụng phpMyAdmin:
- Tạo database mới: `wedding_studio`
- Import file `database/schema.sql`

### 3. Cấu Hình Ứng Dụng

```bash
# Copy file cấu hình mẫu
cp .env.example .env
```

Chỉnh sửa file `.env`:

```env
# Database Configuration
DB_HOST=localhost
DB_USER=root
DB_PASS=password_cua_ban
DB_NAME=wedding_studio
DB_PORT=3306

# Application
APP_URL=http://localhost
APP_ENV=development
APP_DEBUG=true

# Upload Settings
MAX_UPLOAD_SIZE=5242880
ALLOWED_EXTENSIONS=jpg,jpeg,png,gif
```

### 4. Tạo Thư Mục Upload

```bash
mkdir -p public/uploads
chmod 755 public/uploads
```

### 5. Cấu Hình Web Server

#### Cấu Hình Apache

Tạo file `.htaccess` trong thư mục gốc:

```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteBase /
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^(.*)$ public/index.php?$1 [L]
</IfModule>
```

#### Cấu Hình Nginx

```nginx
server {
    listen 80;
    server_name your-domain.com;
    root /path/to/wedding-studio-web/public;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php7.4-fpm.sock;
        fastcgi_index index.php;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    }
}
```

### 6. Kiểm Tra Cài Đặt

Mở trình duyệt và truy cập:

```
http://localhost/wedding-studio-web
```

## 👤 Thông Tin Đăng Nhập Mặc Định

**Tài Khoản Admin:**
- Email: `admin@weddingstudio.local`
- Mật khẩu: `admin123`

⚠️ **Lưu ý:** Thay đổi mật khẩu mặc định ngay sau khi đăng nhập

## 📁 Cấu Trúc Thư Mục

```
wedding-studio-web/
├── app/
│   ├── config/           # File cấu hình
│   ├── controllers/       # Các controller
│   ├── models/           # Các model
│   └── views/            # Các view
├── public/
│   ├── index.php        # Entry point
│   ├── uploads/         # Thư mục tải lên
│   └── assets/          # CSS, JS, hình ảnh
├── admin/
│   └── index.php        # Admin panel entry point
├── database/
│   └── schema.sql       # Database schema
└── .env                 # File cấu hình môi trường
```

## 🎯 Các Tính Năng Chính

### Frontend (Người Dùng)

✅ **Trang Chủ**
- Giới thiệu dịch vụ
- Hiển thị gói cưới nổi bật
- Bộ sưu tập ảnh gần đây
- Đánh giá từ khách hàng

✅ **Gói Cưới**
- Danh sách đầy đủ các gói
- Thông tin chi tiết về từng gói
- Phân trang
- Tìm kiếm

✅ **Thư Viện Ảnh**
- Hiển thị các bộ sưu tập
- Xem chi tiết từng bộ sưu tập
- Lightbox để xem hình ảnh lớn
- Phân trang

✅ **Dịch Vụ**
- Danh sách các dịch vụ
- Mô tả và giá cả

✅ **Yêu Cầu Dịch Vụ**
- Form liên hệ
- Validation dữ liệu
- Thông báo qua email (tùy chọn)

✅ **Tài Khoản Người Dùng**
- Đăng nhập/Đăng xuất
- Đăng ký tài khoản
- Dashboard cá nhân
- Xem lịch sử yêu cầu

### Backend (Admin Panel)

✅ **Quản Lý Gói Cưới**
- Thêm, chỉnh sửa, xóa gói
- Upload hình ảnh
- Quản lý thông tin chi tiết

✅ **Quản Lý Thư Viện Ảnh**
- Tạo bộ sưu tập
- Upload nhiều hình ảnh
- Quản lý danh mục

✅ **Quản Lý Dịch Vụ**
- Thêm/chỉnh sửa/xóa dịch vụ
- Quản lý giá cả

✅ **Quản Lý Yêu Cầu**
- Xem tất cả yêu cầu
- Cập nhật trạng thái
- Liên hệ khách hàng

✅ **Quản Lý Người Dùng**
- Xem danh sách người dùng
- Quản lý quyền hạn
- Kích hoạt/vô hiệu hóa

✅ **Bảng Điều Khiển**
- Thống kê tổng quan
- Yêu cầu gần đây
- Hướng dẫn nhanh

## 🔐 Bảo Mật

### Các Biện Pháp Bảo Mật Được Áp Dụng

- ✅ Mã hóa mật khẩu với bcrypt
- ✅ Kiểm tra phiên làm việc (Session)
- ✅ Validate dữ liệu đầu vào
- ✅ Prepared statements để ngăn SQL injection
- ✅ CORS headers
- ✅ Kiểm tra quyền hạn

### Khuyến Nghị Bảo Mật

1. **Thay Đổi Mật Khẩu Mặc Định**
   - Đăng nhập vào admin panel
   - Thay đổi mật khẩu tài khoản admin

2. **Cập Nhật PHP**
   - Sử dụng phiên bản PHP mới nhất
   - Kích hoạt các tính năng bảo mật

3. **HTTPS**
   - Cấu hình SSL/TLS trên máy chủ
   - Sử dụng HTTPS cho tất cả kết nối

4. **Sao Lưu Dữ Liệu**
   - Sao lưu định kỳ database
   - Sao lưu thư mục uploads

## 🛠️ Phát Triển

### Chỉnh Sửa CSS

File CSS chính: `public/assets/css/style.css`

```css
/* Thêm CSS tùy chỉnh */
:root {
    --primary-color: #dc3545;
    --secondary-color: #6c757d;
}
```

### Thêm Tính Năng Mới

1. Tạo Model mới trong `app/models/`
2. Tạo Controller mới trong `app/controllers/`
3. Tạo View mới trong `app/views/`
4. Cập nhật routing trong `public/index.php`

## 📚 Hỗ Trợ

Gặp vấn đề? Hãy:

1. Kiểm tra file `.env` đã cấu hình đúng
2. Kiểm tra quyền truy cập thư mục `uploads`
3. Kiểm tra kết nối database
4. Xem log lỗi PHP
5. Tạo issue trên GitHub

## 📝 License

Project này được phát triển cho mục đích học tập.

## 👨‍💻 Author

Thinh Coder - thinh261548@gmail.com

---

**Cảm ơn bạn đã sử dụng Wedding Studio Website!** ❤️
