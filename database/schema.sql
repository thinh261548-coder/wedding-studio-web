-- Wedding Studio Database Schema
-- Create database
CREATE DATABASE IF NOT EXISTS wedding_studio CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE wedding_studio;

-- Users table
CREATE TABLE IF NOT EXISTS users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    full_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    phone VARCHAR(20),
    role ENUM('user', 'admin') DEFAULT 'user',
    status ENUM('active', 'inactive', 'blocked') DEFAULT 'active',
    avatar VARCHAR(255),
    address VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_email (email),
    INDEX idx_role (role),
    INDEX idx_status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Packages table
CREATE TABLE IF NOT EXISTS packages (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    description LONGTEXT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    duration VARCHAR(100),
    features LONGTEXT,
    image VARCHAR(255),
    status ENUM('active', 'inactive', 'deleted') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_status (status),
    INDEX idx_created_at (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Services table
CREATE TABLE IF NOT EXISTS services (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    description LONGTEXT NOT NULL,
    icon VARCHAR(255),
    price DECIMAL(10, 2),
    status ENUM('active', 'inactive', 'deleted') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_status (status),
    INDEX idx_created_at (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Galleries table
CREATE TABLE IF NOT EXISTS galleries (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    description LONGTEXT,
    category VARCHAR(100),
    status ENUM('active', 'inactive', 'deleted') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_status (status),
    INDEX idx_category (category),
    INDEX idx_created_at (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Gallery Images table
CREATE TABLE IF NOT EXISTS gallery_images (
    id INT PRIMARY KEY AUTO_INCREMENT,
    gallery_id INT NOT NULL,
    image_path VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (gallery_id) REFERENCES galleries(id) ON DELETE CASCADE,
    INDEX idx_gallery_id (gallery_id),
    INDEX idx_created_at (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Inquiries table
CREATE TABLE IF NOT EXISTS inquiries (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    full_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    service_type VARCHAR(100),
    event_date DATE,
    message LONGTEXT,
    status ENUM('pending', 'contacted', 'completed', 'rejected') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL,
    INDEX idx_user_id (user_id),
    INDEX idx_status (status),
    INDEX idx_email (email),
    INDEX idx_created_at (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Blog/News table
CREATE TABLE IF NOT EXISTS blog_posts (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) UNIQUE NOT NULL,
    content LONGTEXT NOT NULL,
    excerpt VARCHAR(500),
    featured_image VARCHAR(255),
    author_id INT,
    status ENUM('draft', 'published', 'deleted') DEFAULT 'draft',
    views INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (author_id) REFERENCES users(id) ON DELETE SET NULL,
    INDEX idx_status (status),
    INDEX idx_slug (slug),
    INDEX idx_created_at (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Settings table
CREATE TABLE IF NOT EXISTS settings (
    id INT PRIMARY KEY AUTO_INCREMENT,
    key_name VARCHAR(255) UNIQUE NOT NULL,
    value LONGTEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_key (key_name)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert sample admin user (password: admin123)
INSERT INTO users (full_name, email, password, phone, role, status) VALUES
('Admin User', 'admin@weddingstudio.local', '$2y$10$YIjlrPNoS0jBBW5H3r4COeIjZAgcUfkO9y8R9.K1A2J8R9K5jC5Wy', '0123456789', 'admin', 'active');

-- Insert sample packages
INSERT INTO packages (name, description, price, duration, features, status) VALUES
('Gói Cơ Bản', 'Gói chụp ảnh cơ bản với thời gian 4 giờ', 5000000, '4 giờ', 'Chụp ảnh toàn bộ lễ, Album cứng, 100 ảnh đẹp nhất', 'active'),
('Gói Tiêu Chuẩn', 'Gói chụp ảnh và quay phim với thời gian 8 giờ', 10000000, '8 giờ', 'Chụp ảnh toàn bộ lễ, Quay video 4K, Album cứng, Album số', 'active'),
('Gói Cao Cấp', 'Gói đầy đủ với drone + quay phim + chụp ảnh', 15000000, '12 giờ', 'Chụp ảnh toàn bộ lễ, Video 4K, Drone, Album VIP, Ảnh lớp', 'active');

-- Insert sample services
INSERT INTO services (name, description, icon, price, status) VALUES
('Chụp Ảnh', 'Dịch vụ chụp ảnh chuyên nghiệp cho lễ cưới', 'camera', 0, 'active'),
('Quay Phim', 'Dịch vụ quay phim 4K với công nghệ hiện đại', 'video', 0, 'active'),
('Trang Trí', 'Trang trí sân khấu và khu vực tiệc cườ', 'decoration', 0, 'active'),
('Drone', 'Chụp ảnh và quay phim bằng drone', 'drone', 0, 'active');

-- Insert sample gallery
INSERT INTO galleries (title, description, category, status) VALUES
('Đám Cưới Tràn Vàng', 'Bộ ảnh từ đám cưới tràn vàng lộng lẫy', 'wedding', 'active'),
('Tiệc Cưới Sang Trọng', 'Bộ ảnh từ tiệc cưới sang trọng tại khách sạn', 'reception', 'active');
