-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2024 at 07:03 AM
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
  `nama` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`id`, `nidn`, `nama`, `user_id`, `gambar`) VALUES
(5, '0427128202', 'Justinus Lhaksana', 35, '66846bdbed178.jpg');

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

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`id`, `nama_jadwal`, `created_at`, `updated_at`, `status`) VALUES
(3, 'Proyek 2 Semester Genap 2024', 1719714822, 1719760346, 'published');

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan`
--

CREATE TABLE `kegiatan` (
  `id` int(11) NOT NULL,
  `jadwal_id` int(11) NOT NULL,
  `tgl_awal` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `nama_kegiatan` varchar(150) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kegiatan`
--

INSERT INTO `kegiatan` (`id`, `jadwal_id`, `tgl_awal`, `tgl_selesai`, `nama_kegiatan`, `deskripsi`) VALUES
(1, 3, '2024-06-30', '2024-07-01', 'Pembekalan dan Pengarahan', '&lt;p&gt;&lt;strong&gt;Proses pembekalan dan pengarahan&lt;/strong&gt; mahasiswa yang mengikuti dan terlibat di Mata Kuliah Proyek 2&lt;/p&gt;\r\n&lt;ol&gt;\r\n&lt;li style=&quot;font-style: italic;&quot;&gt;&lt;em&gt;Penyampaian pembekalan&lt;/em&gt;&lt;/li&gt;\r\n&lt;li&gt;&lt;span style=&quot;text-decoration: underline;&quot;&gt;Pengisian absensi&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;font-weight: bold; font-style: italic;&quot;&gt;&lt;em&gt;&lt;strong&gt;Pengumuman jadwal kegiatan&lt;/strong&gt;&lt;/em&gt;&lt;/li&gt;\r\n&lt;/ol&gt;'),
(7, 3, '2024-07-02', '2024-07-06', 'Pengajuan judul dan pengumpulan proposal proyek 2', '&lt;div&gt;\r\n&lt;p&gt;&lt;strong&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus, eos.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;ol&gt;\r\n&lt;li&gt;&lt;span style=&quot;text-decoration: underline;&quot;&gt;&lt;em&gt;lorem ipsum&lt;/em&gt;&lt;/span&gt;&lt;/li&gt;\r\n&lt;li&gt;&lt;span style=&quot;text-decoration: underline;&quot;&gt;&lt;em&gt;dolor sit amet&lt;/em&gt;&lt;/span&gt;&lt;/li&gt;\r\n&lt;/ol&gt;\r\n&lt;/div&gt;');

-- --------------------------------------------------------

--
-- Table structure for table `koordinator`
--

CREATE TABLE `koordinator` (
  `id` int(11) NOT NULL,
  `nidn` char(10) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `koordinator`
--

INSERT INTO `koordinator` (`id`, `nidn`, `nama`, `user_id`, `gambar`) VALUES
(2, '0427128204', 'Ridwan Gosling', 31, '6684bf5e48b14.png');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `npm` char(9) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `prodi_id` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `user_id`, `npm`, `nama`, `prodi_id`, `semester`, `gambar`) VALUES
(18, 33, '623220024', 'Muhamad Ridwan', 1, 4, '668451bfabf04.jpg'),
(19, 34, '623220031', 'Hana Meysha Berliana', 1, 4, '6684555aa238e.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `plotting_pembimbing`
--

CREATE TABLE `plotting_pembimbing` (
  `id` int(11) NOT NULL,
  `koordinator_id` int(11) NOT NULL,
  `dosen_pembimbing_id` int(11) NOT NULL,
  `mahasiswa_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

INSERT INTO `user` (`id`, `username`, `password`, `role_id`, `is_active`, `created_at`, `updated_at`) VALUES
(30, 'admin01', '$2y$10$dynzhhWgLAtdwqlOCCJQt.xWN2b/tSpc.TU2vGqbF5jlrd6aDE5fG', 1, 1, 1719943563, 1719943563),
(31, 'ridwan@koordinator', '$2y$10$M8JL3NQCcfsURmVkT1.21u.SlxtWsCux5VPVClfXwdPFDb3Ds2L5O', 2, 1, 1719945444, 1719982561),
(33, '623220024', '$2y$10$KomAnkuazIN7/mzg1L8J4e429ZwHI0PIsdHFDC.sHl9BdqRizspAO', 4, 1, 1719946047, 1719946047),
(34, '623220031', '$2y$10$Gqs3qK1r99PjSGatCSnEvepyTSycGuj2VnYd33BN94iOOOc1sHv4y', 4, 1, 1719948010, 1719948010),
(35, '0427128202', '$2y$10$dU9kfEZJ6w9c/mT7nAX31.1tW4UrbxxDlHV5gq4b68xLoAc3zK4/O', 3, 1, 1719953728, 1719953728);

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
-- Indexes for table `koordinator`
--
ALTER TABLE `koordinator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plotting_pembimbing`
--
ALTER TABLE `plotting_pembimbing`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `koordinator`
--
ALTER TABLE `koordinator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `plotting_pembimbing`
--
ALTER TABLE `plotting_pembimbing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
