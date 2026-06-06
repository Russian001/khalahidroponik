-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2026 at 09:25 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hidroponik_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `ip_address` varchar(45) NOT NULL,
  `attempt_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `youtube_url` varchar(255) DEFAULT NULL,
  `published_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `content`, `image`, `youtube_url`, `published_at`, `created_at`, `updated_at`) VALUES
(1, 'tanaman sawi hidroponik', 'Menanam sawi hidroponik adalah metode budidaya efisien, terutama di lahan sempit, menggunakan larutan nutrisi (AB Mix) dan media tanam seperti rockwool. Sawi dapat dipanen dalam 30-40 hari dengan sistem seperti sumbu (wick), DFT, atau NFT. Kunci suksesnya adalah penyemaian benih, menjaga PPM nutrisi (\r\n\r\n PPM), dan paparan sinar matahari yang cukup. \r\nUniversitas Muhammadiyah Sidoarjo\r\nUniversitas Muhammadiyah Sidoarjo\r\n +4\r\nBerikut adalah panduan budidaya sawi hidroponik:\r\nPenyemaian Benih: Gunakan rockwool yang dipotong dadu (\r\n\r\n\r\n\r\n\r\n\r\n cm), basahi, dan masukkan 1 benih per lubang. Tempatkan di tempat gelap hingga berkecambah, lalu kenalkan ke sinar matahari.\r\nPindah Tanam: Bibit dipindahkan ke sistem hidroponik (netpot) setelah memiliki 3-4 daun sejati, sekitar 10-14 hari setelah semai.\r\nNutrisi dan Perawatan: Gunakan nutrisi AB Mix untuk sayuran daun. Dosis awal saat pindah tanam sekitar 600 PPM, dinaikkan bertahap hingga mencapai 1200-1400 PPM. Pastikan nutrisi mengalir atau tersedia, dan pH air terjaga.\r\nPanen: Sawi siap dipanen dengan cara mencabut seluruh akar atau memotong pangkal batang saat berusia sekitar 30-40 hari. \r\nYouTube\r\nYouTube\r\n +4\r\nSistem yang paling umum untuk pemula adalah sistem sumbu (wick) karena lebih sederhana, sedangkan sistem NFT (Nutrient Film Technique) cocok untuk hasil yang lebih optimal dengan aliran nutrisi tipis.', '6a2189bde53ac.jpeg', 'https://youtu.be/vwQUUYGQL4c?si=F8RwrZCupTDTsYZU', '2021-01-30 22:20:00', '2026-04-17 04:59:29', '2026-06-04 14:27:10'),
(4, 'ssf', 'sfsdfsd', NULL, NULL, NULL, '2026-06-04 14:21:17', '2026-06-04 14:21:17');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `price_per_unit` decimal(10,2) NOT NULL,
  `bulk_price` decimal(10,2) NOT NULL,
  `bulk_min_qty` int(11) NOT NULL DEFAULT 10,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `image`, `price_per_unit`, `bulk_price`, `bulk_min_qty`, `created_at`, `updated_at`) VALUES
(1, 'Sawi pakcoy', 'tanaman Sawinpokcoy hidroponik dengan kualitas baik dan bersih.\r\nGratis pengantaran dengan minimala pembelian 10 pcs', '6a1ecd9f00e05.jpeg', 10000.00, 10000.00, 10, '2026-05-16 16:03:42', '2026-06-02 12:33:35'),
(2, 'Selada Keriting Hidroponik', 'Selada segar bebas pestisida, kaya serat.\r\ngratis pengantaran dengan minimal pembelian 10 pcs', '6a1ecd4dde3a8.jpeg', 8000.00, 7000.00, 10, '2026-05-17 07:22:15', '2026-06-02 12:32:14'),
(3, 'Kangkung', 'Kangkung segar Hidroponik.\r\nGratis pengantaran dengan minimala pembelian 10 pcs', '6a1ecc1dd4af6.jpeg', 5000.00, 5000.00, 10, '2026-06-02 12:27:10', '2026-06-02 12:34:15'),
(4, 'Seledri', 'Seledri Segar Hidroponik.\r\nGratis pengantaran dengan minimala pembelian 10 pcs', '6a1ecc49d75b8.jpeg', 5000.00, 5000.00, 10, '2026-06-02 12:27:54', '2026-06-02 12:35:31'),
(5, 'Selada Merah', 'Selada Merah Segar Hidroponik\r\nGratis pengantaran dengan minimala pembelian 10 pcs', '6a1ecc773b17c.jpeg', 8000.00, 7000.00, 10, '2026-06-02 12:28:40', '2026-06-02 12:28:40'),
(6, 'Bayam', 'Bayam Segar Hidroponik\r\nGratis pengantaran dengan minimala pembelian 10 pcs', '6a1ecf0168f9b.jpeg', 5000.00, 5000.00, 10, '2026-06-02 12:39:30', '2026-06-02 12:39:30'),
(7, 'sawi Pagoda', 'Sawi Pagoda Hidroponik\r\nGratis pengantaran dengan minimala pembelian 10 pcs', '6a1ed61e50a99.jpeg', 5000.00, 5000.00, 10, '2026-06-02 13:09:51', '2026-06-04 15:13:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2026-04-17 03:09:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`ip_address`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
