-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 03, 2023 at 09:22 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `data_prakerin`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `tampilkan_data_innerjoin_instansi` ()   BEGIN
    SELECT
        instansi.id,
        instansi.nama_instansi,
        instansi.email,
        instansi.no_telp,
        siswa.nis,
        siswa.nama,
        siswa.jurusan,
        pembimbing.nik,
        pembimbing.nama_pembimbing,
        pembimbing.email AS email_pembimbing,
        prakerin.tanggal_awal,
        prakerin.tanggal_akhir
    FROM
        instansi
    INNER JOIN siswa AS siswa_instansi ON instansi.id = siswa_instansi.id_instansi
    INNER JOIN siswa AS siswa_pembimbing ON pembimbing.id = siswa_pembimbing.id_pembimbing
    INNER JOIN prakerin ON siswa_instansi.id = prakerin.id_siswa;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tampilkan_data_innerjoin_pembimbing` ()   BEGIN
    SELECT
        pembimbing.id,
        pembimbing.nik,
        pembimbing.nama_pembimbing,
        siswa.nis,
        siswa.nama,
        siswa.jurusan,
        instansi.nama_instansi
    FROM
        pembimbing
    INNER JOIN siswa ON pembimbing.id = siswa.id_pembimbing
    INNER JOIN instansi ON siswa.id_instansi = instansi.id
    ORDER BY pembimbing.id DESC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tampilkan_data_innerjoin_penilaian_pembimbing` (IN `pembimbing_id` INT)   BEGIN
    SELECT
    	pembimbing.id,
        siswa.id as id_siswa,
        siswa.nis,
        siswa.nama,
        siswa.kelas,
        siswa.jurusan,
        prakerin.tanggal_awal,
        prakerin.tanggal_akhir,
        instansi.nama_instansi
    FROM
        pembimbing
    INNER JOIN siswa ON siswa.id_pembimbing = pembimbing.id
    INNER JOIN prakerin ON siswa.id = prakerin.id_siswa
    INNER JOIN instansi ON siswa.id_instansi = instansi.id
    WHERE pembimbing.id = pembimbing_id
    ORDER BY pembimbing.id DESC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tampilkan_data_innerjoin_prakerin` ()   BEGIN
    SELECT
        prakerin.id,
        siswa.id,
        prakerin.tanggal_awal,
        prakerin.tanggal_akhir,
        siswa.nis,
        siswa.nama,
        siswa.kelas,
        siswa.jurusan
    FROM
        prakerin
    INNER JOIN siswa ON prakerin.id_siswa = siswa.id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tampilkan_data_innerjoin_prakerinn` ()   BEGIN
    SELECT
        prakerin.tanggal_awal,
        prakerin.tanggal_akhir,
        siswa.nis,
        siswa.nama,
        siswa.kelas,
        siswa.jurusan,
        instansi.nama_instansi,
        pembimbing.nama_pembimbing
    FROM
        siswa 
    INNER JOIN pembimbing ON siswa.id_pembimbing = pembimbing.id
INNER JOIN instansi ON siswa.id_instansi = instansi.id
INNER JOIN prakerin ON siswa.id = prakerin.id_siswa
    ORDER BY siswa.id DESC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tampilkan_data_innerjoin_siswa` ()   BEGIN
    SELECT
        siswa.id,
        siswa.nis, 
        siswa.nama,
        siswa.email,
        siswa.kelas, 
        siswa.jurusan, 
        pembimbing.nik, 
        pembimbing.nama_pembimbing, 
        instansi.nama_instansi
    FROM
        siswa 
    INNER JOIN pembimbing ON siswa.id_pembimbing = pembimbing.id
    INNER JOIN instansi ON siswa.id_instansi = instansi.id
    ORDER BY siswa.id DESC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tampilkan_data_instansi` ()   BEGIN
    SELECT * FROM instansi;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tampilkan_data_pembimbing` ()   BEGIN
    SELECT * FROM pembimbing;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tampilkan_data_pembimbing_dan_siswa_instansi` ()   BEGIN
    SELECT
        pembimbing.id,
        pembimbing.nik,
        pembimbing.nama_pembimbing,
        siswa_instansi.nis,
        siswa_instansi.nama,
        siswa_instansi.jurusan,
        instansi.nama_instansi
    FROM
        pembimbing
    INNER JOIN siswa AS siswa_instansi ON pembimbing.id = siswa_instansi.id_pembimbing
    INNER JOIN instansi ON siswa_instansi.id_instansi = instansi.id
    ORDER BY pembimbing.id DESC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tampilkan_laporan_data_penilaian` ()   BEGIN
    SELECT
        penilaian.id,
        penilaian.id_siswa,
        siswa.nama AS nama_siswa,
        penilaian.id_pembimbing,
        pembimbing.nama_pembimbing,
        penilaian.ketepatan_waktu,
        penilaian.sikap_kerja,
        penilaian.tanggung_jawab,
        penilaian.kehadiran,
        penilaian.kemampuan_kerja,
        penilaian.keterampilan_kerja,
        penilaian.kualitas_kerja,
        penilaian.berkomunikasi,
        penilaian.kerjasama,
        penilaian.kerajinan,
        penilaian.rasa_pd,
        penilaian.mematuhi_aturan,
        penilaian.penampilan,
        penilaian.ttl_nilai
    FROM
        penilaian
        INNER JOIN siswa ON penilaian.id_siswa = siswa.id
        INNER JOIN pembimbing ON penilaian.id_pembimbing = 			pembimbing.id
        ORDER BY penilaian.id DESC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tampil_penilaian_persiswa` (IN `id_siswa` INT)   BEGIN
    SELECT
        siswa.nama AS 'nama_siswa',
        pembimbing.nama_pembimbing AS 'nama_pembimbing',
        penilaian.ketepatan_waktu,
        penilaian.sikap_kerja,
        penilaian.tanggung_jawab,
        penilaian.kehadiran,
        penilaian.kemampuan_kerja,
        penilaian.keterampilan_kerja,
        penilaian.kualitas_kerja,
        penilaian.berkomunikasi,
        penilaian.kerjasama,
        penilaian.kerajinan,
        penilaian.rasa_pd,
        penilaian.mematuhi_aturan,
        penilaian.penampilan,
        penilaian.ttl_nilai
    FROM
        penilaian
    INNER JOIN siswa ON penilaian.id_siswa = siswa.id
    INNER JOIN pembimbing ON penilaian.id_pembimbing = pembimbing.id
    WHERE siswa.id = id_siswa;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(100) NOT NULL,
  `no_telp` int(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(155) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nama`, `no_telp`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'adam', 8192123, 'Adam@gamil.coom', '$2y$10$IqEKn1TJmn28N8N9rzORe.3J3W4ff7zxnGSM5PwiZCTue0SMeCSQO', '2023-10-05 00:23:24', '2023-10-05 00:23:24'),
(2, 'Endang Saripuloh', 82993812, 'endangsarip1@gmail.com', '$2y$10$CdeDlkyPZDx7LMfa4YPntugoBR9hKHyXwPu2u0kYAO.O2RkFlqQoC', '2023-10-19 20:01:05', '2023-10-19 20:01:05'),
(3, 'Kanjeng Raden Jaya Diningrat', 98827381, 'radenjaya@gmail.com', '$2y$10$h0McLaQi3JWj3L7NBG4ZZO9kfCUqWACDQrsLTfCeUT5VG5Ntevdpe', '2023-10-19 20:10:56', '2023-10-19 20:10:56'),
(4, 'Fathoni Adam', 98829182, 'fathoniadam933@gmail.com', '$2y$10$Q7Fx2P.E.Day.0FYXzw4YeRX.ISwkMSf4WPiux69/zJ3EFl5Hci3a', '2023-11-02 00:50:00', '2023-11-02 00:50:00');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `instansi`
--

CREATE TABLE `instansi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_instansi` varchar(100) NOT NULL,
  `no_telp` int(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `instansi`
--

INSERT INTO `instansi` (`id`, `nama_instansi`, `no_telp`, `email`, `created_at`, `updated_at`) VALUES
(1, 'PT. Kucing', 8912112, 'kucing@gmail.com', '2023-10-03 21:22:53', '2023-10-03 21:22:53'),
(2, 'PT.DewanStudio', 2122123433, 'dewanstudio12@gmail.com', '2023-10-04 17:09:33', '2023-10-04 17:09:33'),
(3, 'PT. Mozaik Bintang Persada', 821299172, 'bintang@gmail.com', '2023-10-04 17:10:19', '2023-10-04 17:10:19'),
(4, 'PT. Darussalam', 877281772, 'darrusallam@gmail.com', '2023-10-04 17:11:06', '2023-10-04 17:11:06'),
(6, 'PT. Melati', 822912203, 'melati9128@gmail.com', '2023-10-15 18:30:05', '2023-10-15 18:30:05'),
(7, 'PT. Chung Myung', 8829311, 'myungchung@gmail.com', '2023-10-17 21:35:27', '2023-10-17 21:35:27'),
(8, 'pt.010101001', 2147483647, 'jajang@gmail.com', '2023-10-17 22:00:24', '2023-10-17 22:00:24'),
(9, 'RS Buah Hati', 2147483647, 'rsbuahati@gmail.com', '2023-10-26 19:35:45', '2023-10-26 19:35:55');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_09_18_030742_create_admin_table', 1),
(6, '2023_09_21_010920_create_instansi_table', 1),
(7, '2023_09_21_010934_create_pembimbing_table', 1),
(8, '2023_09_21_011024_create_prakerin_table', 1),
(9, '2023_09_21_011034_create_siswa_table', 1),
(10, '2023_09_21_043049_add_id_siswa_column_to_prakerin_table', 1),
(11, '2023_09_21_070152_add_id_instansi_column_to_siswa_table', 1),
(12, '2023_09_21_070538_add_id_pembimbing_column_to_siswa_table', 1),
(13, '2023_10_04_041255_add_jurusan_column_to_siswa_table', 1),
(16, '2023_10_23_021528_add_password_column_to_pembimbing_table', 2),
(17, '2023_10_26_011605_create_penilaian_table', 3),
(18, '2023_10_26_013338_add_id_siswa_column_to_penilaian_table', 4),
(19, '2023_10_26_132646_add_id_pembimbing_column_to_penilaian_table', 5),
(22, '2023_10_30_031807_add_ttl_nilai_column_to_penilaian_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pembimbing`
--

CREATE TABLE `pembimbing` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nik` int(11) NOT NULL,
  `nama_pembimbing` varchar(100) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(155) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pembimbing`
--

INSERT INTO `pembimbing` (`id`, `nik`, `nama_pembimbing`, `no_telp`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 19231, 'Majid Rohim S.pd', '098829182', 'majheed32@gmail.com', '$2y$10$.jOUW3w8/CY5oGjTJm4BdehyEbJMqsHinYN3K5Ft5RCuDoLAz1ism', '2023-10-24 00:34:24', '2023-10-24 00:34:24'),
(2, 10219312, 'adam', '1210230321', 'Adam@gamil.coom', '$2y$10$QIaWtUc1G/aEAOC5y3NO6uwEQ0himCHEDNosavo6vZHL03AI130k.', '2023-10-24 00:53:35', '2023-10-24 00:53:35'),
(6, 11029930, 'Iman Saripuloh', '0829188211', 'imam@gamil.com', '$2y$10$fgK3rNJCtlXF7om1Bkipfe9ogjRb3lcSFZM05e1jH1HYBryVRIUWm', '2023-11-02 00:27:53', '2023-11-02 00:27:53'),
(7, 99201923, 'Rizki Ardhana', '08219228192', 'rizki@gmail.com', '$2y$10$08uOoNQAzGMY7kNiDmYRS.vAJYMk8Y6ELX/dD9L4Sai.RAxRELE6C', '2023-11-02 18:52:54', '2023-11-02 18:52:54');

-- --------------------------------------------------------

--
-- Table structure for table `penilaian`
--

CREATE TABLE `penilaian` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_siswa` bigint(20) UNSIGNED NOT NULL,
  `id_pembimbing` bigint(20) UNSIGNED NOT NULL,
  `ketepatan_waktu` int(11) NOT NULL,
  `sikap_kerja` int(11) NOT NULL,
  `tanggung_jawab` int(11) NOT NULL,
  `kehadiran` int(11) NOT NULL,
  `kemampuan_kerja` int(11) NOT NULL,
  `keterampilan_kerja` int(11) NOT NULL,
  `kualitas_kerja` int(11) NOT NULL,
  `berkomunikasi` int(11) NOT NULL,
  `kerjasama` int(11) NOT NULL,
  `kerajinan` int(11) NOT NULL,
  `rasa_pd` int(11) NOT NULL,
  `mematuhi_aturan` int(11) NOT NULL,
  `penampilan` int(11) NOT NULL,
  `ttl_nilai` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penilaian`
--

INSERT INTO `penilaian` (`id`, `id_siswa`, `id_pembimbing`, `ketepatan_waktu`, `sikap_kerja`, `tanggung_jawab`, `kehadiran`, `kemampuan_kerja`, `keterampilan_kerja`, `kualitas_kerja`, `berkomunikasi`, `kerjasama`, `kerajinan`, `rasa_pd`, `mematuhi_aturan`, `penampilan`, `ttl_nilai`, `created_at`, `updated_at`) VALUES
(1, 6, 1, 90, 90, 90, 90, 90, 90, 90, 90, 90, 90, 90, 90, 90, '0.00', '2023-11-02 00:28:37', '2023-11-02 00:28:37'),
(2, 1, 1, 90, 90, 90, 90, 90, 90, 90, 90, 90, 90, 90, 90, 90, '0.00', '2023-11-02 21:31:03', '2023-11-02 21:31:03');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prakerin`
--

CREATE TABLE `prakerin` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tanggal_awal` date NOT NULL,
  `tanggal_akhir` date NOT NULL,
  `id_siswa` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prakerin`
--

INSERT INTO `prakerin` (`id`, `tanggal_awal`, `tanggal_akhir`, `id_siswa`, `created_at`, `updated_at`) VALUES
(1, '2024-02-01', '2024-03-31', 1, '2023-10-24 00:36:02', '2023-10-24 00:36:02'),
(2, '2023-10-25', '2023-11-01', 2, '2023-10-24 23:06:32', '2023-10-24 23:06:32'),
(3, '2023-10-27', '2023-11-03', 3, '2023-10-26 17:59:19', '2023-10-26 17:59:19'),
(4, '2023-10-27', '2023-11-10', 4, '2023-10-26 19:36:11', '2023-10-26 19:36:11'),
(5, '2023-11-01', '2023-11-01', 6, '2023-11-01 05:03:27', '2023-11-01 05:03:27'),
(6, '2023-11-03', '2023-11-04', 8, '2023-11-02 21:38:22', '2023-11-02 21:38:22');

--
-- Triggers `prakerin`
--
DELIMITER $$
CREATE TRIGGER `hapus_siswa_otomatis` AFTER INSERT ON `prakerin` FOR EACH ROW BEGIN
    DECLARE akhir_prakerin DATE;
    SET akhir_prakerin = (SELECT tanggal_akhir FROM prakerin WHERE id_siswa = NEW.id_siswa);
    IF akhir_prakerin < CURDATE() THEN
        DELETE FROM prakerin WHERE id_siswa = NEW.id_siswa;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nis` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `no_telp` int(20) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `jurusan` varchar(70) NOT NULL,
  `angkatan` varchar(4) NOT NULL,
  `email` varchar(30) NOT NULL,
  `id_instansi` bigint(20) UNSIGNED NOT NULL,
  `id_pembimbing` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id`, `nis`, `nama`, `no_telp`, `kelas`, `jurusan`, `angkatan`, `email`, `id_instansi`, `id_pembimbing`, `created_at`, `updated_at`) VALUES
(1, 21001065, 'Fathoni Adam Ilyasa', 2147483647, '11', 'Rekayasa Perangkat Lunak', '2021', 'fathoniadam933@gmail.com', 2, 1, '2023-10-24 00:35:24', '2023-10-24 00:35:24'),
(2, 2100193, 'Idris Nur Cahaya', 821299381, '11', 'Multimedia', '2021', 'idrisss21@gmail.com', 4, 1, '2023-10-24 23:06:00', '2023-10-25 21:24:20'),
(3, 2122121, 'Annas Adam Bintang', 2001992019, '11', 'Rekayasa Perangkat Lunak', '2022', 'gabung@gmail.com', 6, 2, '2023-10-26 17:59:01', '2023-10-26 17:59:01'),
(4, 21109201, 'Jalut Samarudin', 2147483647, '12', 'Multimedia', '2022', 'jalutimut@gmail.com', 2, 2, '2023-10-26 19:33:16', '2023-10-26 19:33:26'),
(6, 21002391, 'Khidir Karawit', 8219928, '11', 'Multimedia', '2022', 'khidir334@gmail.com', 4, 1, '2023-11-01 05:02:19', '2023-11-01 06:25:15'),
(7, 2100065, 'adam', 992810028, '11', 'Multimedia', '2020', 'indra@gmail.com', 1, 1, '2023-11-02 00:17:00', '2023-11-02 00:17:00'),
(8, 21002993, 'ROPIK', 288193923, '11', 'Multimedia', '2022', 'ropik@gmail.com', 6, 1, '2023-11-02 21:37:38', '2023-11-02 21:37:38');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_email_unique` (`email`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `instansi`
--
ALTER TABLE `instansi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `instansi_email_unique` (`email`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pembimbing`
--
ALTER TABLE `pembimbing`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pembimbing_nik_unique` (`nik`),
  ADD UNIQUE KEY `pembimbing_email_unique` (`email`);

--
-- Indexes for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penilaian_id_siswa_foreign` (`id_siswa`),
  ADD KEY `penilaian_id_pembimbing_foreign` (`id_pembimbing`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `prakerin`
--
ALTER TABLE `prakerin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prakerin_id_siswa_foreign` (`id_siswa`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `siswa_nis_unique` (`nis`),
  ADD UNIQUE KEY `siswa_email_unique` (`email`),
  ADD KEY `siswa_id_instansi_foreign` (`id_instansi`),
  ADD KEY `siswa_id_pembimbing_foreign` (`id_pembimbing`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `instansi`
--
ALTER TABLE `instansi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `pembimbing`
--
ALTER TABLE `pembimbing`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prakerin`
--
ALTER TABLE `prakerin`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD CONSTRAINT `penilaian_id_pembimbing_foreign` FOREIGN KEY (`id_pembimbing`) REFERENCES `pembimbing` (`id`),
  ADD CONSTRAINT `penilaian_id_siswa_foreign` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id`);

--
-- Constraints for table `prakerin`
--
ALTER TABLE `prakerin`
  ADD CONSTRAINT `prakerin_id_siswa_foreign` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id`);

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_id_instansi_foreign` FOREIGN KEY (`id_instansi`) REFERENCES `instansi` (`id`),
  ADD CONSTRAINT `siswa_id_pembimbing_foreign` FOREIGN KEY (`id_pembimbing`) REFERENCES `pembimbing` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
