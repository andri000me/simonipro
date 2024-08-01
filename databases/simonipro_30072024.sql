-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2024 at 06:18 AM
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
-- Table structure for table `absensi_bimbingan`
--

CREATE TABLE `absensi_bimbingan` (
  `id` int(11) NOT NULL,
  `kelompok_id` int(11) NOT NULL,
  `mahasiswa_id` int(11) NOT NULL,
  `tgl_bimbingan` date NOT NULL,
  `waktu` time DEFAULT NULL,
  `topik` varchar(255) NOT NULL,
  `status` enum('hadir','rekomendasi') DEFAULT NULL,
  `is_confirmed` enum('pending','confirmed','rejected') NOT NULL DEFAULT 'pending',
  `is_submitted` int(11) NOT NULL,
  `catatan_penolakan` varchar(255) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `absensi_bimbingan`
--

INSERT INTO `absensi_bimbingan` (`id`, `kelompok_id`, `mahasiswa_id`, `tgl_bimbingan`, `waktu`, `topik`, `status`, `is_confirmed`, `is_submitted`, `catatan_penolakan`, `created_at`, `updated_at`) VALUES
(21, 4, 20, '2024-07-16', '10:40:00', 'Pengajuan judul proposal', 'rekomendasi', 'confirmed', 1, NULL, 1721094124, 1721094800),
(22, 4, 20, '2024-07-17', '10:45:00', 'Pembahasan BAB 1', 'rekomendasi', 'confirmed', 1, NULL, 1721094197, 1721094817),
(23, 4, 20, '2024-07-20', '10:45:00', 'Pembahasan BAB 2: Landasan Teori', 'rekomendasi', 'confirmed', 1, NULL, 1721094262, 1721094853),
(24, 4, 20, '2024-07-22', '12:50:00', 'Pembahasan BAB 2: Landasan Teori', 'rekomendasi', 'confirmed', 1, NULL, 1721094442, 1721094866),
(25, 4, 20, '2024-07-24', '13:50:00', 'Pembahasan BAB 3: Struktur Organisasi', 'rekomendasi', 'confirmed', 1, NULL, 1721094526, 1721094883),
(26, 4, 20, '2024-07-30', '15:00:00', 'Pembahasan BAB 3: Perancangan UML', 'rekomendasi', 'confirmed', 1, NULL, 1721094574, 1721094903),
(27, 4, 20, '2024-08-02', '13:50:00', 'Pembahasan BAB 3 : Perancangan UML', 'rekomendasi', 'confirmed', 1, NULL, 1721094646, 1721094915),
(28, 4, 20, '2024-08-09', '14:00:00', 'Pembahasan BAB 4: Kesimpulan', 'rekomendasi', 'confirmed', 1, NULL, 1721094696, 1721094936),
(29, 4, 24, '2024-07-16', '15:30:00', 'Pengajuan Judul proposal', 'hadir', 'confirmed', 1, NULL, 1721104087, 1721104268),
(30, 5, 22, '2024-07-19', '17:31:00', 'lorem ipsum', 'hadir', 'confirmed', 1, NULL, 1721381525, 1721381659),
(31, 6, 23, '2024-07-20', '10:50:00', 'Pembahasan judul laporan', NULL, 'pending', 1, NULL, 1721415095, 1721415142),
(32, 6, 26, '2024-07-20', '13:15:00', 'Pengajuan judul laporan proyek 2', 'hadir', 'confirmed', 1, NULL, 1721415303, 1722131718),
(33, 6, 26, '2024-07-21', '11:00:00', 'Hello World!', NULL, 'pending', 1, NULL, 1721581077, 1721581089),
(34, 6, 26, '2024-07-23', '06:03:00', 'asdasdasd', NULL, 'pending', 0, NULL, 1721581399, 1721581399),
(35, 5, 22, '2024-07-22', '12:40:00', 'hello world!', NULL, 'pending', 0, NULL, 1721662640, 1721662640),
(36, 4, 21, '2024-07-24', '11:40:00', 'Pengajuan judul proyek 2', 'rekomendasi', 'confirmed', 1, NULL, 1721796006, 1721796852),
(37, 4, 21, '2024-07-25', '15:40:00', 'Pembahasan proposal proyek 2', 'rekomendasi', 'confirmed', 1, NULL, 1721796052, 1721796865),
(38, 4, 21, '2024-07-26', '15:45:00', 'Pembahasan BAB 1', 'rekomendasi', 'confirmed', 1, NULL, 1721796094, 1721796874),
(39, 4, 21, '2024-07-28', '12:41:00', 'Landasan Teori BAB 2', 'rekomendasi', 'confirmed', 1, NULL, 1721796138, 1721796889),
(40, 4, 21, '2024-07-29', '14:45:00', 'Pembahasan BAB 3', 'rekomendasi', 'confirmed', 1, NULL, 1721796175, 1721796898),
(41, 4, 21, '2024-07-31', '15:15:00', 'Perancangan BPMN BAB 3', 'rekomendasi', 'confirmed', 1, NULL, 1721796216, 1721796907),
(42, 4, 21, '2024-08-01', '11:50:00', 'Perancangan UML BAB 3', 'rekomendasi', 'confirmed', 1, NULL, 1721796255, 1721797053),
(43, 4, 21, '2024-08-07', '17:25:00', 'Pembahasan BAB 4 : Kesimpulan', 'rekomendasi', 'confirmed', 1, NULL, 1721796288, 1721797072),
(44, 4, 21, '2024-10-19', '17:05:00', 'Pembahasan BAB 4 : Kesimpulan', 'rekomendasi', 'confirmed', 1, NULL, 1721797463, 1721798479);

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
(8, '0428797909', 'Dr. Tyler Durden S.H.,M.IPA.', 45, 'default.jpeg'),
(9, '0988766090', 'Salim Bahanan S.Pd.,M.BKM.', 46, 'default.jpeg'),
(10, '0240259407', 'Muzammil Hasballah S.I.,M.TQ.', 47, 'default.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `draft_sidang`
--

CREATE TABLE `draft_sidang` (
  `id` int(11) NOT NULL,
  `mahasiswa_id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `kelompok_id` int(11) NOT NULL,
  `file_laporan` varchar(255) NOT NULL,
  `file_dpl` varchar(255) NOT NULL,
  `is_submitted` int(11) NOT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `catatan_penolakan` text DEFAULT NULL,
  `submitted_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `draft_sidang`
--

INSERT INTO `draft_sidang` (`id`, `mahasiswa_id`, `judul`, `kelompok_id`, `file_laporan`, `file_dpl`, `is_submitted`, `status`, `catatan_penolakan`, `submitted_at`) VALUES
(22, 20, 'Simonipro', 4, '66a0aeaa5dbd5.pdf', '66a0aeaa5dbd51.pdf', 1, 'approved', NULL, 1721806506),
(23, 21, 'Simonipro', 4, '66a0af87b3820.pdf', '66a0af87b38201.pdf', 1, 'approved', NULL, 1721806727);

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
(3, 'Proyek 2 Semester Genap 2024', 1719714822, 1720344730, 'published'),
(6, 'Proyek 2', 1720683931, 1720683931, 'draft');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_sidang`
--

CREATE TABLE `jadwal_sidang` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `plotting_id` int(11) NOT NULL,
  `no_ruangan` int(11) NOT NULL,
  `nama_ruangan` varchar(150) NOT NULL,
  `tgl_sidang` date NOT NULL,
  `waktu_sidang` time NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jadwal_sidang`
--

INSERT INTO `jadwal_sidang` (`id`, `project_id`, `plotting_id`, `no_ruangan`, `nama_ruangan`, `tgl_sidang`, `waktu_sidang`, `created_at`, `updated_at`) VALUES
(2, 1, 11, 106, 'Gandaria', '2024-07-25', '11:00:00', 1721793561, NULL),
(3, 1, 12, 202, 'Gosling', '2024-07-24', '17:40:00', 1721806852, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jenis_plotting`
--

CREATE TABLE `jenis_plotting` (
  `id` int(11) NOT NULL,
  `nama` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jenis_plotting`
--

INSERT INTO `jenis_plotting` (`id`, `nama`) VALUES
(1, 'pembimbing'),
(2, 'penguji');

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
(7, 3, '2024-07-02', '2024-07-06', 'Pengajuan judul dan pengumpulan proposal proyek 2', '&lt;div&gt;\r\n&lt;p&gt;&lt;strong&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus, eos.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;ol&gt;\r\n&lt;li&gt;&lt;span style=&quot;text-decoration: underline;&quot;&gt;&lt;em&gt;lorem ipsum&lt;/em&gt;&lt;/span&gt;&lt;/li&gt;\r\n&lt;li&gt;&lt;span style=&quot;text-decoration: underline;&quot;&gt;&lt;em&gt;dolor sit amet&lt;/em&gt;&lt;/span&gt;&lt;/li&gt;\r\n&lt;/ol&gt;\r\n&lt;/div&gt;'),
(9, 3, '2024-07-07', '2024-07-14', 'Rancangan BPMN dan Business User', '&lt;div&gt;\r\n&lt;div&gt;Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores, &lt;em&gt;&lt;strong&gt;ex&lt;/strong&gt;&lt;/em&gt; voluptate! &lt;span style=&quot;text-decoration: underline;&quot;&gt;&lt;em&gt;Voluptates, voluptatum quo! Voluptas sequi voluptatibus laboriosam molestias asperiores.&lt;/em&gt;&lt;/span&gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp;&lt;/div&gt;\r\n&lt;div&gt;\r\n&lt;ol&gt;\r\n&lt;li&gt;&lt;span style=&quot;text-decoration: underline;&quot;&gt;hello world!&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;font-weight: bold;&quot;&gt;&lt;strong&gt;lorem ipsum dolor sit amet&lt;/strong&gt;&lt;/li&gt;\r\n&lt;li style=&quot;font-style: italic;&quot;&gt;&lt;em&gt;kameha meha&lt;/em&gt;&lt;/li&gt;\r\n&lt;/ol&gt;\r\n&lt;/div&gt;\r\n&lt;/div&gt;'),
(11, 3, '2024-07-15', '2024-07-19', 'Perancangan BPMN dan Business Process', '&lt;div&gt;\r\n&lt;div&gt;Lorem ipsum dolor, sit amet consectetur adipisicing elit. Minus atque optio sed.&lt;/div&gt;\r\n&lt;/div&gt;'),
(12, 3, '2024-07-28', '2024-07-31', 'Pembahasan BAB 2', '&lt;p&gt;lorem ipsum &lt;em&gt;&lt;strong&gt;dolor sit&lt;/strong&gt;&lt;/em&gt; &lt;em&gt;amet&lt;/em&gt; &lt;span style=&quot;text-decoration: underline;&quot;&gt;apendicture&lt;/span&gt;&lt;/p&gt;'),
(13, 3, '2024-08-01', '2024-08-05', 'Hello world!', '&lt;div&gt;\r\n&lt;div&gt;&lt;span style=&quot;text-decoration: underline;&quot;&gt;&lt;strong&gt;Lorem ipsum dolor sit amet&lt;/strong&gt;&lt;/span&gt;&lt;/div&gt;\r\n&lt;div&gt;&lt;em&gt;consectetur adipisicing elit. &lt;/em&gt;&lt;/div&gt;\r\n&lt;div&gt;&lt;strong&gt;Eius magni saepe odio veritatis voluptas quis dolore neque, tempore nobis vitae.&lt;/strong&gt;&lt;/div&gt;\r\n&lt;/div&gt;'),
(14, 3, '2024-08-06', '2024-08-09', 'Lorem ipsum', '&lt;p&gt;13DEB9 lorem ipsum color sit amet&lt;/p&gt;');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` int(11) NOT NULL,
  `nama_kelas` char(2) NOT NULL,
  `prodi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `nama_kelas`, `prodi_id`) VALUES
(1, '1A', 1),
(2, '2A', 1),
(3, '3A', 1);

-- --------------------------------------------------------

--
-- Table structure for table `kelompok`
--

CREATE TABLE `kelompok` (
  `id` int(11) NOT NULL,
  `dosen_pembimbing_id` int(11) NOT NULL,
  `semester` varchar(20) NOT NULL,
  `tahun_ajaran` varchar(20) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `kode_kelompok` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelompok`
--

INSERT INTO `kelompok` (`id`, `dosen_pembimbing_id`, `semester`, `tahun_ajaran`, `kelas_id`, `kode_kelompok`) VALUES
(4, 8, '4', '2023/2024', 2, '10'),
(5, 9, '4', '2023/2024', 2, '11'),
(6, 10, '4', '2023/2024', 2, '12');

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
(2, '0427128204', 'Ridwan Gosling S.T.,M.T.', 31, '6684bf5e48b14.png'),
(3, '1401202409', 'Supono Syafiq S.T.,M.T.', 39, '6687dc7a93b23.png'),
(4, '0428041420', 'Supono S.T.,M.T.', 44, 'default.jpeg');

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
  `kelas_id` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `tahun_angkatan` year(4) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `ipk` decimal(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `user_id`, `npm`, `nama`, `prodi_id`, `kelas_id`, `semester`, `tahun_angkatan`, `gambar`, `ipk`) VALUES
(20, 42, '623220001', 'Hana Meysha Berliana', 1, 2, 4, '2022', '6688e722d3d51.png', 3.69),
(21, 43, '623220002', 'May Hanny Khoirunnisa', 1, 2, 4, '2022', 'default.jpeg', 3.71),
(22, 48, '623220003', 'Neneng Qokom Komalasari', 1, 2, 4, '2022', 'default.jpeg', 3.80),
(23, 49, '623220004', 'Asep Supriyadi', 1, 2, 4, '2022', 'default.jpeg', 3.27),
(24, 51, '623220005', 'Sarah Harianja', 1, 2, 4, '2022', 'default.jpeg', 3.59),
(25, 52, '623220006', 'Zulfan Hamka', 1, 2, 4, '2022', 'default.jpeg', 3.12),
(26, 53, '623220007', 'Arini Putri Pramesti', 1, 2, 8, '2022', '669127316ce77.jpg', 3.70);

-- --------------------------------------------------------

--
-- Table structure for table `penilaian`
--

CREATE TABLE `penilaian` (
  `id` int(11) NOT NULL,
  `plotting_id` int(11) NOT NULL,
  `nilai_penguji_1` decimal(4,2) NOT NULL,
  `nilai_penguji_2` decimal(4,2) NOT NULL,
  `grade` char(2) DEFAULT NULL,
  `status_kelulusan` varchar(20) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penilaian`
--

INSERT INTO `penilaian` (`id`, `plotting_id`, `nilai_penguji_1`, `nilai_penguji_2`, `grade`, `status_kelulusan`, `created_at`, `updated_at`) VALUES
(1, 11, 87.00, 87.00, 'A', 'Lulus', 1722310075, 1722310075);

-- --------------------------------------------------------

--
-- Table structure for table `plotting`
--

CREATE TABLE `plotting` (
  `id` int(11) NOT NULL,
  `koordinator_id` int(11) NOT NULL,
  `kelompok_id` int(11) NOT NULL,
  `dosen_penguji_1_id` int(11) DEFAULT NULL,
  `dosen_penguji_2_id` int(11) DEFAULT NULL,
  `mahasiswa_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `jenis_plotting_id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plotting`
--

INSERT INTO `plotting` (`id`, `koordinator_id`, `kelompok_id`, `dosen_penguji_1_id`, `dosen_penguji_2_id`, `mahasiswa_id`, `project_id`, `jenis_plotting_id`, `created_at`, `updated_at`) VALUES
(11, 4, 4, 9, 8, 20, 1, 2, 1720890100, 1721758108),
(12, 4, 4, 9, 8, 21, 1, 2, 1720890151, 1721806809),
(13, 4, 5, NULL, NULL, 22, 1, 1, 1720890175, 1720890175),
(14, 4, 6, NULL, NULL, 23, 1, 1, 1720890200, 1720890200),
(15, 4, 4, NULL, NULL, 24, 1, 1, 1720890216, 1720890216),
(16, 4, 5, NULL, NULL, 25, 1, 1, 1720890233, 1720890233),
(17, 4, 6, NULL, NULL, 26, 1, 1, 1720890245, 1720894355);

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
(1, 'Proyek 2', 'Mata kuliah proyek 2 adalah mata kuliah wajib diikuti oleh semua mahasiswa D3 Manajemen Majestica', '2024-06-28', '2024-09-24', 1);

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
  `nama` varchar(150) NOT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `is_active` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `role_id`, `nama`, `no_telp`, `is_active`, `created_at`, `updated_at`) VALUES
(41, 'admin01', '$2y$10$q2JsSVVj0VONUtUoavpSZu9LkcoPqIXygYuiYLKxZDGla/oPfAPy6', 1, 'Muhamad Ridwan', '081579729332', 1, 1720237549, 1720237549),
(42, '623220001', '$2y$10$vNTNFdrQoNssXGlckNhQw.QcL5FlUsdH1IvP/KX/aAUf.hrqdpbOe', 4, 'Hana Meysha Berliana', '087879729338', 1, 1720238255, 1720951842),
(43, '623220002', '$2y$10$5xm1tz5LZ.P04/b5yTMdA.aYgPAvpfz1/mZrx3XWYI9OucXUUD2NK', 4, 'May Hanny Khoirunnisa', '087879707977', 1, 1720238832, 1721059866),
(44, 'supono@koordinator', '$2y$10$cTGv.4KWO3qeNyv8eeXVHOuv4.XwrnYOQN9ud5tI1Kz3PQFGVBbkS', 2, 'Supono S.T.,M.T.', '', 1, 1720240940, 1720240940),
(45, 'dosen01', '$2y$10$VMNDVzJvqrou8rsFyu6A8.nZ5IoMSoDi3TOfhfkt/c0iVdMh043Pq', 3, 'Dr. Tyler Durden S.H.,M.IPA.', '', 1, 1720244273, 1721014808),
(46, 'dosen02', '$2y$10$rASiaLzRnZ3ozvkorVvcweQ26qhU7gjbKA9.DUPBsRL1xi9HTMJFa', 3, 'Salim Bahanan S.Pd.,M.BKM.', '', 1, 1720245699, 1721023219),
(47, 'dosen03', '$2y$10$QB6uY3ic4NFOVv1DNVXlMOZ62ZYEFd0cEoPRG4cz7NzEURVh00UAa', 3, 'Muzammil Hasballah S.I.,M.TQ.', '', 1, 1720245864, 1720245864),
(48, '623220003', '$2y$10$hpv9Pi7yoXJAHQ3o4eQEJOGg2ZkCkDlCXUMTg18ptbBDWhgxOXrOK', 4, 'Neneng Qokom Komalasari', '', 1, 1720332526, 1720332526),
(49, '623220004', '$2y$10$6ewcAaR.IsLYlE6cXZQYcu02mmj/teGZ/en40GEB6plNdpnefwde6', 4, 'Asep Supriyadi', '', 1, 1720355091, 1720355091),
(50, 'kaprodi01', '$2y$10$2nQGR4uUIEiBwuTEAoAFi.SEV9LKTLlifxXFjLTSwReoXSLAIueMS', 5, 'Mubassiran S.T.,M.T.', '085163837291', 1, 1720422972, 1720422972),
(51, '623220005', '$2y$10$7vfOIpDePsaqiIN2Jr/nbOnYKr7pl6eN3yVlSKbi254qkOOxQeFcq', 4, 'Sarah Harianja', '', 1, 1720423209, 1721104049),
(52, '623220006', '$2y$10$NJjSHErHs2XSFpd4EndqduwM/Noi9KnBLxXC7hI928HI4ChhVfBPG', 4, 'Zulfan Hamka', '', 1, 1720423427, 1720423427),
(53, '623220007', '$2y$10$AFqRgK7Z7ozWotO/utA8n.C/xtN6KOTuRCKSZljWvm9yteRT8jpc.', 4, 'Arini Putri Pramesti', '', 1, 1720591202, 1720951045);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi_bimbingan`
--
ALTER TABLE `absensi_bimbingan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `draft_sidang`
--
ALTER TABLE `draft_sidang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jadwal_sidang`
--
ALTER TABLE `jadwal_sidang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_plotting`
--
ALTER TABLE `jenis_plotting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelompok`
--
ALTER TABLE `kelompok`
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
-- Indexes for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plotting`
--
ALTER TABLE `plotting`
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
-- AUTO_INCREMENT for table `absensi_bimbingan`
--
ALTER TABLE `absensi_bimbingan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `draft_sidang`
--
ALTER TABLE `draft_sidang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `jadwal_sidang`
--
ALTER TABLE `jadwal_sidang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jenis_plotting`
--
ALTER TABLE `jenis_plotting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kelompok`
--
ALTER TABLE `kelompok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `koordinator`
--
ALTER TABLE `koordinator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `plotting`
--
ALTER TABLE `plotting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `prodi`
--
ALTER TABLE `prodi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
