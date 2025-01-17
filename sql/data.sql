
-- Tabel untuk menyimpan data pengguna (admin dan user)
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    no_hp VARCHAR(15),
    tanggal_lahir DATE,
    domisili TEXT,
    foto_profil VARCHAR(255) DEFAULT NULL,
    role ENUM('admin', 'user') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE produk (
    product_id INT AUTO_INCREMENT PRIMARY KEY, -- ID produk, auto increment
    nama_polis VARCHAR(100) NOT NULL, -- Nama polis sesuai source code
    price DECIMAL(10, 2) NOT NULL, -- Harga produk per premi
    jumlah_asuransi INT NOT NULL CHECK (jumlah_asuransi >= 1), -- Minimal 1
    premi ENUM('bulanan', '3bulan', '6bulan', '1tahun') NOT NULL, -- Periode premi
    total_premi DECIMAL(10, 2) GENERATED ALWAYS AS (jumlah_asuransi * price) STORED, -- Perhitungan total premi
    metode_pembayaran ENUM('cash', 'transferbank', 'ovo', 'gopay', 'kartu kredit') NOT NULL, -- Metode pembayaran
    alamat_nasabah TEXT NOT NULL, -- Alamat lengkap nasabah
    nomor_telepon VARCHAR(15) NOT NULL, -- Nomor telepon nasabah
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP -- Waktu pembuatan
);


-- Tabel untuk mencatat klaim asuransi
CREATE TABLE klaim (
    id INT AUTO_INCREMENT PRIMARY KEY, -- ID unik untuk setiap klaim
    produk_id INT, -- Referensi ke tabel produk
    user_id INT, -- Referensi ke tabel users
    nama_polis VARCHAR(100), -- Nama polis
    nomor_polis VARCHAR(50), -- Nomor polis
    dokumen_bukti VARCHAR(255), -- Bukti dokumen klaim
    status ENUM('pending', 'diterima', 'ditolak') DEFAULT 'pending', -- Status klaim
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Waktu pembuatan klaim
    FOREIGN KEY (user_id) REFERENCES users(id), -- Relasi ke tabel users
    FOREIGN KEY (produk_id) REFERENCES produk(product_id) -- Relasi ke tabel produk
);

