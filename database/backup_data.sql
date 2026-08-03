CREATE DATABASE IF NOT EXISTS db_falak;
USE db_falak;

-- Tabel Admin
CREATE TABLE admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR (50) NOT NULL,
    password VARCHAR(255) NOT NULL
);

-- Tabel Berita Terkini
CREATE TABLE news (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) UNIQUE NOT NULL,
    content TEXT NOT NULL,
    image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabel Produk (Stok & Harga)
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    description TEXT,
    price DECIMAL(12,2) NOT NULL,
    stock INT NOT NULL DEFAULT 0,
    image VARCHAR(255),
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabel Daftar Sertifikat Customer
CREATE TABLE certificates (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(150) NOT NULL,
    product_name VARCHAR(150) NOT NULL,
    certificate_code VARCHAR(100) UNIQUE NOT NULL,
    issue_date DATE NOT NULL,
    file_path VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO news (title, slug, content, image) VALUES 
('Falak TV Resmi Diluncurkan untuk Masjid se-Indonesia', 'falak-tv-resmi-diluncurkan', 'Setelah melalui proses pengembangan dan validasi selama 2 tahun, Falak TV kini siap menemani masjid-masjid di seluruh Indonesia.', 'assets/img/berita-1.jpg');