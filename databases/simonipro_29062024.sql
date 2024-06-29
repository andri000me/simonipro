-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2024 at 08:04 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simonipro`
--

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `id` int(11) NOT NULL,
  `nidn` char(10) NOT NULL,
  `user_id` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`id`, `nidn`, `user_id`, `gambar`) VALUES
(1, '0419096101', 10, '6675387ba6143.jpg'),
(2, '0427076701', 17, '667538e7630a6.jpeg'),
(3, '0418077101', 18, '6675390727380.jpeg'),
(4, '0410101954', 19, '66767033843a4.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id` int(11) NOT NULL,
  `nama_jadwal` varchar(150) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `status` enum('draft','published') NOT NULL DEFAULT 'draft'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan`
--

CREATE TABLE `kegiatan` (
  `id` int(11) NOT NULL,
  `jadwal_id` int(11) NOT NULL,
  `tgl_awal` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `deskripsi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `npm` char(9) NOT NULL,
  `prodi_id` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `user_id`, `npm`, `prodi_id`, `semester`, `gambar`) VALUES
(13, 5, '623220012', 1, 4, '667e53febb934.png'),
(14, 6, '623220024', 1, 4, '667e5446d070b.png'),
(15, 8, '623220028', 1, 4, '667f8b5f1422f.jpg'),
(16, 26, '624220027', 1, 4, '667f8c22e96f4.png');

-- --------------------------------------------------------

--
-- Table structure for table `prodi`
--

CREATE TABLE `prodi` (
  `id` int(11) NOT NULL,
  `kode_prodi` char(5) NOT NULL,
  `nama_prodi` varchar(255) NOT NULL,
  `jenjang` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prodi`
--

INSERT INTO `prodi` (`id`, `kode_prodi`, `nama_prodi`, `jenjang`) VALUES
(1, '57401', 'Manajemen Informatika', 'D3');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `id` int(11) NOT NULL,
  `nama_project` varchar(50) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `prodi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `nama_project`, `deskripsi`, `tgl_mulai`, `tgl_selesai`, `prodi_id`) VALUES
(1, 'Proyek 2', 'Mata kuliah proyek 2 adalah mata kuliah wajib yang harus diikuti oleh semua mahasiswa D3 Manajemen Majestica', '2024-06-28', '2024-09-24', 1);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `nama_role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `nama_role`) VALUES
(1, 'staff'),
(2, 'koordinator'),
(3, 'dosen'),
(4, 'mahasiswa'),
(5, 'kaprodi');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `username` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `password`, `role_id`, `is_active`, `created_at`, `updated_at`) VALUES
(3, 'Muhamad Ridwan', 'admin01', '$2y$10$3sNwqkGnVVxdR8YvGC/.BOu7Yo4oYQqxrHDuaADhN9Hg1mrg8aqSm', 1, 1, 1718448579, 1718448579),
(4, 'Sandhika Galih', 'admin02', '$2y$10$NysJkNnIjEspTxm9ZoGH4OskKDjO75IHGdF/Z2nYLnV8zNX3HH3Xy', 1, 1, 1718455115, 1718455115),
(5, 'Harry Pittsburg', '623220012', '123456', 4, 1, NULL, NULL),
(6, 'Toji Fushiguro', '623220024', '$2y$10$.THqjaDglHjJXJ7IGzwW3uFgVvfLH1SuZjYEDfWTuFanYGMrapSQm', 4, 1, 1718557216, 1718588974),
(8, 'Muhamad Rafie', '623220028', '$2y$10$fp11lrQ9MX4S1c9mzVO9I.2JKiSVrH7.cGGg23y8BH0voUB8eo166', 4, 1, 1718589128, 1718589128),
(9, 'Michael B Jordan', '623220031', '$2y$10$e2i2llkdZnNtejl11yTE4usvMhcArwgHT2GHsz7vrzrNNppFQKhGq', 4, 0, 1718589932, 1718589949),
(10, 'Supono S.T.,M.T.', 'supono@koordinator', '$2y$10$5F4NFvg5CWBapDBOH28AUOCO2/CgrlGM5HruKMj21ae/L64Dzl.ri', 2, 1, 1718590966, 1719640444),
(11, 'Ricky Setiawan Nugraha Palestinia', '623220017', '$2y$10$LVdqWOxDpXK21dr0U4fike.x4usQxAdczaPe9xpEfhs0m66pDM2aG', 4, 1, 1718627970, 1718627970),
(12, 'Rian Rachman Nur Hidayatullah', '623220029', '$2y$10$yGgLqum1oLpyB6qMDSsuLuVMSPO4flPQ2ttLWJVcnP0nsbwiM/AcC', 4, 1, 1718628204, 1718628239),
(13, 'John Doe', 'admin03', '$2y$10$Y608M/5cOcF8UkI4pSs60OnqEKDDZbsU.lzrZOS/ulXrjl1JypbR2', 1, 1, 1718628670, 1718628670),
(14, 'Megumi Fushiguro', 'admin04', '$2y$10$cd4DC8xb5DqtkIO52Gxda.8YinOkcnfAuhl.i2p522IBb8JftgPS.', 1, 1, 1718628704, 1718628704),
(15, 'Mubassiran', 'kaprodi001', '$2y$10$VmmQ1QY4LQcMUNgywJeOWusn1yyqhhLzS6Ot6qQVsQYEtXUCC.eCG', 5, 1, 1718628793, 1718628793),
(16, 'Pirman Syahpitra', '623240001', '$2y$10$Xz0zkOpFpJqZEL9cMmDu2e1HCnAcYJq/HjLQxIOBnQU7a4PBZd9xG', 4, 1, 1718856723, 1718954963),
(17, 'Dr. Maniah, S.Kom., M.T.', 'dosen02', '$2y$10$zfxhNHQw07B.9frfz/TzK.BRyJbNl2KtFEUbE44TFaSbNgrphTqi6', 3, 1, 1718956794, 1718956794),
(18, 'Dr. M. Ibnu Choldun R., S.T.,M.T.', 'dosen03', '$2y$10$ovtiDv8hqp.NEALJVHL4Fel2T34WmGtIhTEUe.ER1HbR0KPNNolrS', 3, 1, 1718956869, 1718956869),
(19, 'Dr. Mahershala Ali S.T.,M.V.P.', 'dosen04', '$2y$10$.Iwl1lYSlNTmtyqYJXZU5.BOZb0jSMnbZsS3ZGxSeCEM93YY/m7rK', 3, 1, 1719037276, 1719037276),
(20, 'yosel tamba', 'admin05', '$2y$10$KIR.T7L/RfTzhMv0QARZ6eMciu6w/yfARLYfvNGdCoD5hlWxwDg1G', 1, 1, 1719040795, 1719040795),
(21, 'ika', 'ikaaja', '$2y$10$v8eaK4wDPOvq87T7KJ0TluJXhpbZkJc5Vt0nVrMB0cHSI7uZCL2YO', 1, 1, 1719193421, 1719193421),
(22, 'ikoh', 'ikasukaarab', '$2y$10$Js/OYklRRWTekeEdTtlivuRNOLB.4NWnGt4U5N3FRdztA4JrrufCC', 4, 1, 1719193569, 1719207170),
(23, 'user nonaktif', 'user_nonaktif', '$2y$10$RUeLpfN.2X0fAYm4MEgbau525BIbsR4qqs12/Uz/aNsPZ9/OfMgaO', 1, 0, 1719340203, 1719340214),
(25, 'dsafds', 'bfdshdzxdg', '$2y$10$7vTt2xo5VZIn25z3/dDHcOvbKi/K.JJIA7eWsoLflUeuB0dyrfTaa', 3, 1, 1719396252, 1719396252),
(26, 'Kayla Nayara', '624220027', '$2y$10$wkC2DrBSwOoF08aPrr.NaurlKJPKmBXxeGZL4ZOK98rUkMUz4affu', 4, 1, 1719634953, 1719634953),
(27, 'Tuan Ambatukam', 'admin06', '$2y$10$y/0XaIscmo967Otu4bTMbuewkXQRCmKqd0t3TYy95vT/WfVI65VOi', 1, 1, 1719635448, 1719635509),
(28, 'ads', 'asd', '$2y$10$X0sgEvRsnB7LwERWX06LHeSV3X5GSOxLZuz95nDETMvqFSvH7DjAm', 1, 1, 1719635736, 1719635736),
(29, 'admin biasa', 'admin_biasa', '$2y$10$/Qh2ssWHxjmC7bbEjgeEyepQ9R.5rFxxT0SVpYZX5ZOvqbF8ltLm2', 1, 1, 1719635789, 1719635789);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `prodi`
--
ALTER TABLE `prodi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
