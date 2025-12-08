-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 08, 2025 at 04:43 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_panti`
--

-- --------------------------------------------------------

--
-- Table structure for table `anak_asuh`
--

CREATE TABLE `anak_asuh` (
  `id` int NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `jenis_kelamin` varchar(20) DEFAULT NULL,
  `pendidikan_jenjang` varchar(20) DEFAULT NULL,
  `nama_sekolah` varchar(100) DEFAULT NULL,
  `kelas` varchar(20) DEFAULT NULL,
  `status_kesehatan` varchar(100) DEFAULT NULL,
  `hobi` varchar(100) DEFAULT NULL,
  `catatan_perkembangan` text,
  `foto` varchar(255) DEFAULT NULL,
  `tanggal_masuk` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `anak_asuh`
--

INSERT INTO `anak_asuh` (`id`, `nama`, `tgl_lahir`, `jenis_kelamin`, `pendidikan_jenjang`, `nama_sekolah`, `kelas`, `status_kesehatan`, `hobi`, `catatan_perkembangan`, `foto`, `tanggal_masuk`) VALUES
(1, 'Budi Santoso', '2015-05-20', 'Laki-laki', 'SD', 'SDN 01 Pagi', NULL, 'Sehat', NULL, 'Sangat aktif di olahraga bola, nilai matematika meningkat.', 'https://randomuser.me/api/portraits/boys/10.jpg', '2020-01-01'),
(2, 'percobaan', '2024-02-03', 'Laki-laki', 'SD', 'sd negri', '5 sd', 'sehat', 'main bola', 'sangat bahagia', 'uploads/1764775247_iPhone 16 - 4.png', '2025-12-03');

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `id` int NOT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `isi` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`id`, `judul`, `tanggal`, `gambar`, `isi`) VALUES
(1, 'anak anak bermain', '2025-12-04', 'uploads/1764814388_Gallery.png', 'banyakkk');

-- --------------------------------------------------------

--
-- Table structure for table `donasi`
--

CREATE TABLE `donasi` (
  `id` int NOT NULL,
  `nama_donatur` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `nominal` int DEFAULT NULL,
  `bank` varchar(50) DEFAULT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `donasi`
--

INSERT INTO `donasi` (`id`, `nama_donatur`, `email`, `nominal`, `bank`, `tanggal`) VALUES
(1, 'Hamba Allah', NULL, 100000, 'BCA', '2024-12-01'),
(2, 'Budi Santoso', NULL, 500000, 'BRI', '2024-12-02'),
(3, 'Siti Aminah', NULL, 250000, 'MANDIRI', '2024-12-02'),
(4, 'Rudi Hartono', NULL, 1000000, 'BCA', '2024-12-03'),
(5, 'Anonim', NULL, 50000, 'BRI', '2024-12-03'),
(6, 'zada', 'satriafazaputra@gmail.com', 2000000, 'BCA', '2025-12-03'),
(7, 'zada', 'chalziel04@gmail.com', 8000000, 'BCA', '2025-12-04');

-- --------------------------------------------------------

--
-- Table structure for table `galeri`
--

CREATE TABLE `galeri` (
  `id` int NOT NULL,
  `judul` varchar(100) DEFAULT NULL,
  `link_gambar` varchar(255) DEFAULT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `galeri`
--

INSERT INTO `galeri` (`id`, `judul`, `link_gambar`, `tanggal`) VALUES
(1, 'Kegiatan Belajar', 'https://loremflickr.com/600/400/study,children', '2024-12-01'),
(3, 'Renovasi Atap', 'https://loremflickr.com/600/400/building,work', '2024-12-03');

-- --------------------------------------------------------

--
-- Table structure for table `relawan`
--

CREATE TABLE `relawan` (
  `id` int NOT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `peran` varchar(50) DEFAULT NULL,
  `tanggal_daftar` date DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `relawan`
--

INSERT INTO `relawan` (`id`, `nama_lengkap`, `email`, `no_hp`, `peran`, `tanggal_daftar`, `status`) VALUES
(1, 'Sarah Wijaya', 'sarah@gmail.com', '08123456789', 'Pengajar', '2024-12-01', 'Diterima'),
(2, 'Budi Santoso', 'budi@gmail.com', '08567891234', 'Logistik', '2024-12-02', 'Diterima'),
(3, 'dr. Rina', 'rina@gmail.com', '08129876543', 'Medis', '2024-12-03', 'Diterima'),
(4, 'adnan dio', 'user@gmail.com', '909939393', 'Pengajar', '2025-12-03', 'Diterima');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anak_asuh`
--
ALTER TABLE `anak_asuh`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donasi`
--
ALTER TABLE `donasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galeri`
--
ALTER TABLE `galeri`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `relawan`
--
ALTER TABLE `relawan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anak_asuh`
--
ALTER TABLE `anak_asuh`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `donasi`
--
ALTER TABLE `donasi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `galeri`
--
ALTER TABLE `galeri`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `relawan`
--
ALTER TABLE `relawan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
