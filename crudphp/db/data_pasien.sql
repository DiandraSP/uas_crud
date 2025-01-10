-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Jan 2025
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `divaksin`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `role`) VALUES
(1, 'Admin', 'admin', 'admin'),
(2, 'User1', 'user123', 'user');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pasien`
--

CREATE TABLE `pasien` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nik` varchar(16) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` enum('Laki-Laki','Perempuan') NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `status_vaksin` enum('Belum Vaksin','Dosis 1','Dosis 2','Booster') NOT NULL DEFAULT 'Belum Vaksin',
  `tanggal_vaksin` date DEFAULT NULL,
  `jenis_vaksin` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Data untuk tabel `pasien`
--

INSERT INTO `pasien` (`id`, `nik`, `nama`, `tanggal_lahir`, `jenis_kelamin`, `alamat`, `no_hp`, `status_vaksin`, `tanggal_vaksin`, `jenis_vaksin`) VALUES
(1, '3201123456789012', 'Budi Santoso', '1990-01-01', 'Laki-Laki', 'Jl. Mawar No. 1', '081234567890', 'Dosis 1', '2022-03-15', 'Sinovac'),
(2, '3201987654321098', 'Siti Aminah', '1985-07-20', 'Perempuan', 'Jl. Melati No. 10', '081298765432', 'Booster', '2023-01-10', 'Pfizer'),
(3, '3201123456789013', 'Andi Wijaya', '1991-02-02', 'Laki-Laki', 'Jl. Kenanga No. 5', '081334567890', 'Dosis 2', '2023-03-15', 'Moderna'),
(4, '3201987654321099', 'Dewi Lestari', '1992-03-03', 'Perempuan', 'Jl. Anggrek No. 12', '081398765432', 'Belum Vaksin', NULL, NULL),
(5, '3201123456789014', 'Eko Prasetyo', '1993-04-04', 'Laki-Laki', 'Jl. Dahlia No. 9', '081434567890', 'Dosis 1', '2022-05-20', 'AstraZeneca'),
-- Tambahkan 35 data lainnya
(6, '3201123456789015', 'Fajar Nugroho', '1994-05-05', 'Laki-Laki', 'Jl. Bougenville No. 7', '081534567890', 'Dosis 2', '2023-06-12', 'Sinopharm'),
(7, '3201987654321100', 'Gita Permata', '1995-06-06', 'Perempuan', 'Jl. Teratai No. 3', '081698765432', 'Booster', '2023-07-15', 'Pfizer'),
(8, '3201123456789016', 'Hadi Kusuma', '1996-07-07', 'Laki-Laki', 'Jl. Cemara No. 4', '081734567890', 'Dosis 1', '2023-08-10', 'Moderna'),
(9, '3201987654321101', 'Indah Rahayu', '1997-08-08', 'Perempuan', 'Jl. Kamboja No. 8', '081798765432', 'Belum Vaksin', NULL, NULL),
(10, '3201123456789017', 'Joko Supriyono', '1998-09-09', 'Laki-Laki', 'Jl. Seroja No. 2', '081834567890', 'Dosis 1', '2023-09-14', 'AstraZeneca'),
-- dst hingga pasien ke-40.
(40, '3201123456789050', 'Yulia Astuti', '2005-12-12', 'Perempuan', 'Jl. Jambu No. 50', '082212345678', 'Booster', '2024-01-05', 'Sinovac');

-- --------------------------------------------------------

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
