-- Buat database
CREATE DATABASE IF NOT EXISTS crmdb;
USE crmdb;

-- Tabel Users
CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL,
  password VARCHAR(100) NOT NULL,
  nama_lengkap VARCHAR(100)
);

-- Data awal user admin (default password: admin123)
INSERT INTO users (username, password, nama_lengkap)
VALUES ('admin', 'admin123', 'Admin CRM');

-- Tabel Pelanggan
CREATE TABLE IF NOT EXISTS pelanggan (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100) NOT NULL,
  email VARCHAR(100),
  telepon VARCHAR(20),
  alamat TEXT
);

-- Data contoh pelanggan
INSERT INTO pelanggan (nama, email, telepon, alamat) VALUES
('Arkan', 'arkan@email.com', '081234567890', 'Jakarta'),
('Budi', 'budi@email.com', '081222334455', 'Bandung');

-- Tabel Transaksi
CREATE TABLE IF NOT EXISTS transaksi (
  id INT AUTO_INCREMENT PRIMARY KEY,
  pelanggan_id INT NOT NULL,
  tanggal DATE NOT NULL,
  produk VARCHAR(100),
  total INT,
  FOREIGN KEY (pelanggan_id) REFERENCES pelanggan(id) ON DELETE CASCADE
);

-- Data contoh transaksi
INSERT INTO transaksi (pelanggan_id, tanggal, produk, total) VALUES
(1, '2025-06-25', 'Kopi Arabika', 20000),
(2, '2025-06-24', 'Teh Hijau', 15000);
