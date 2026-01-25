-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 03, 2025 at 04:15 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `profile_sekolah`
--

-- --------------------------------------------------------

--
-- Table structure for table `artikels`
--

CREATE TABLE `artikels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `konten` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `artikels`
--

INSERT INTO `artikels` (`id`, `judul`, `slug`, `konten`, `gambar`, `user_id`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Peringatan Hari Kartini di Sekolah', 'peringatan-hari-kartini-di-sekolah', '<p>Sekolah mengadakan peringatan Hari Kartini dengan berbagai kegiatan menarik.</p>', NULL, 1, 'published', '2025-06-29 00:54:06', '2025-06-29 00:54:06', NULL),
(2, 'Prestasi Siswa dalam Lomba Matematika', 'prestasi-siswa-dalam-lomba-matematika', '<p>Siswa kami berhasil meraih juara dalam lomba matematika tingkat kota.</p>', NULL, 1, 'published', '2025-06-29 00:54:06', '2025-06-29 00:54:06', NULL),
(3, 'Ekstrakurikuler Baru: Bulutangkis', 'ekstrakurikuler-baru-bulutangkis', '<p>Sekolah membuka ekstrakurikuler Bulutangkis untuk mengembangkan potensi bulutangkis siswa.</p>', 'articles/aedn2yV2mgKEDPg4R8LR8WOINMW78U3uS4F96dDi.jpg', 1, 'published', '2025-06-29 00:54:06', '2025-06-29 02:28:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ekstrakurikulers`
--

CREATE TABLE `ekstrakurikulers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ekstrakurikulers`
--

INSERT INTO `ekstrakurikulers` (`id`, `nama`, `deskripsi`, `foto`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'HIMA', 'Himpunan Mahasiswa', 'ekstrakurikuler/zLWL7Zm3T3rfT7wTcSbivpAdvrZqvDgGblG3riaR.jpg', 1, '2025-07-11 06:40:31', '2025-07-11 07:03:32'),
(2, 'Bulutangkis', 'Bulutangkis', 'ekstrakurikuler/QKk88Yr4R8P8GQvLfBDAIVILAIXd8WRKLqsSVTaS.jpg', 1, '2025-07-18 06:22:42', '2025-07-18 06:33:23');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `galeri`
--

CREATE TABLE `galeri` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipe` enum('foto','video') COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `galeri`
--

INSERT INTO `galeri` (`id`, `judul`, `deskripsi`, `tipe`, `file`, `is_active`, `created_at`, `updated_at`) VALUES
(2, 'Upacara 17 Agustus', 'DWdwwdawdaw', 'foto', '1752591650_danila.jpeg', 1, '2025-07-15 06:52:22', '2025-07-15 07:00:50');

-- --------------------------------------------------------

--
-- Table structure for table `kotak_saran`
--

CREATE TABLE `kotak_saran` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kotak_saran`
--

INSERT INTO `kotak_saran` (`id`, `nama`, `message`, `created_at`, `updated_at`) VALUES
(1, 'Terry Indra', 'Halo ges', '2025-07-18 06:23:53', '2025-07-18 06:23:53'),
(2, 'Tiara Andini', 'Dwadwdwtrghsdfgr', '2025-07-18 06:26:47', '2025-07-18 06:26:47');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
(5, '2025_06_11_075043_create_articles_table', 1),
(6, '2025_06_11_075057_create_settings_table', 1),
(7, '2025_06_12_081608_create_artikel_table', 1),
(8, '2025_06_12_081608_create_artikels_table', 1),
(9, '2025_06_12_081711_create_pengumuman_table', 1),
(10, '2025_06_12_081711_create_pengumumans_table', 1),
(11, '2025_06_12_081740_create_pendaftaran_table', 1),
(12, '2025_06_12_081740_create_pendaftarans_table', 1),
(13, '2025_06_12_081806_create_struktur_organisasi_table', 1),
(14, '2025_06_12_081806_create_struktur_organisasis_table', 1),
(15, '2025_06_29_000000_create_registrations_table', 1),
(16, '2025_06_29_000001_create_questions_table', 1),
(17, '2025_06_29_000002_create_registration_answers_table', 1),
(18, '2025_06_29_000004_create_registration_points_table', 1),
(19, '2025_06_29_000001_add_avatar_to_users_table', 2),
(20, '2025_07_05_000000_create_sambutans_table', 3),
(21, '2025_07_08_ekstrakurikuler_table', 4),
(22, '2025_07_08_000001_add_status_lolos_to_registration_points_table', 5),
(23, '2025_07_13_000000_create_posters_table', 6),
(24, '2025_07_15_000001_add_jadwal_abk_to_registrations_table', 7),
(25, '2025_07_15_000002_create_galeri_table', 8),
(26, '2025_07_15_120000_add_is_active_to_galeri_table', 9),
(27, '2025_07_15_130000_add_status_lolos_to_registrations_table', 10),
(28, '2025_07_16_000001_drop_email_no_telp_from_registrations_table', 11),
(29, '2025_07_16_100000_add_penghasilan_statuspip_filekk_fileakta_to_registrations_table', 12),
(31, '2025_07_16_200000_create_kotak_saran_table', 13),
(32, '2025_07_18_150000_add_status_to_registrations_table', 14),
(33, '2025_07_18_160000_add_wali_ortu_fields_to_registrations_table', 15),
(34, '2025_07_28_000001_add_tes_fields_to_registrations_table', 16);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi_pengumuman` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `file_lampiran` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posters`
--

CREATE TABLE `posters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('draft','published') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posters`
--

INSERT INTO `posters` (`id`, `gambar`, `status`, `created_at`, `updated_at`) VALUES
(1, 'posters/ToU9wii8gwIpEN4trXmi2ZETlt0hffJxzQxEHAv1.jpg', 'draft', '2025-07-12 21:24:27', '2025-07-18 06:30:30');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `option_a` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `option_b` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `option_c` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `option_d` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `correct_answer` enum('A','B','C','D') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question`, `option_a`, `option_b`, `option_c`, `option_d`, `correct_answer`, `created_at`, `updated_at`) VALUES
(1, 'Jika kamu tidak tahu cara mengerjakan sesuatu, apa yang kamu lakukan?', 'Bertanya pada orang lain', 'Marah dan meninggalkan tugas', 'Menangis atau diam saja', 'Melempar atau merusak benda di sekitar', 'A', '2025-07-01 05:14:42', '2025-07-01 05:14:42'),
(2, 'Saat kamu bermain dengan teman dan temanmu mengambil mainanmu, apa yang kamu lakukan?', 'Mengatakan dengan sopan agar dia mengembalikan', 'Menarik mainannya kembali dengan paksa', 'Menangis dan lari dari situ', 'Mendorong atau memukul teman itu', 'A', '2025-07-01 05:14:42', '2025-07-01 05:14:42'),
(3, 'Jika guru menyuruh duduk dan diam, kamu biasanya...', 'Duduk dan mendengarkan', 'Duduk sebentar lalu mulai bicara sendiri', 'Tidak bisa diam, selalu bergerak', 'Berjalan-jalan dan tidak memperhatikan', 'A', '2025-07-01 05:14:42', '2025-07-01 05:14:42'),
(4, 'Apakah kamu suka suara keras seperti bel, petir, atau mesin?', 'Biasa saja', 'Kadang takut', 'Sering menutup telinga', 'Sangat takut dan menangis setiap kali mendengar', 'A', '2025-07-01 05:14:42', '2025-07-01 05:14:42'),
(5, 'Saat melihat orang lain sedih, kamu biasanya merasa:', 'Ikut sedih dan ingin membantu', 'Tidak tahu harus bagaimana', 'Bingung lalu pergi', 'Tidak peduli sama sekali', 'A', '2025-07-01 05:14:42', '2025-07-01 05:14:42'),
(6, 'Apakah kamu suka memutar benda, melompat terus-menerus, atau mengulang kata yang sama?', 'Tidak pernah', 'Kadang', 'Sering', 'Hampir setiap hari', 'A', '2025-07-01 05:14:42', '2025-07-01 05:14:42'),
(7, 'Ketika orang tua atau guru memanggilmu, kamu biasanya...', 'Langsung menjawab', 'Kadang mendengar, kadang tidak', 'Sering tidak menjawab meski dekat', 'Tidak peduli dan tetap melakukan kegiatan sendiri', 'A', '2025-07-01 05:14:42', '2025-07-01 05:14:42'),
(8, 'Jika kamu tidak tahu cara mengerjakan sesuatu, apa yang kamu lakukan?', 'Bertanya pada orang lain', 'Marah dan meninggalkan tugas', 'Menangis atau diam saja', 'Melempar atau merusak benda di sekitar', 'A', '2025-07-01 05:23:13', '2025-07-01 05:23:13'),
(9, 'Saat kamu bermain dengan teman dan temanmu mengambil mainanmu, apa yang kamu lakukan?', 'Mengatakan dengan sopan agar dia mengembalikan', 'Menarik mainannya kembali dengan paksa', 'Menangis dan lari dari situ', 'Mendorong atau memukul teman itu', 'A', '2025-07-01 05:23:13', '2025-07-01 05:23:13'),
(10, 'Jika guru menyuruh duduk dan diam, kamu biasanya...', 'Duduk dan mendengarkan', 'Duduk sebentar lalu mulai bicara sendiri', 'Tidak bisa diam, selalu bergerak', 'Berjalan-jalan dan tidak memperhatikan', 'A', '2025-07-01 05:23:13', '2025-07-01 05:23:13'),
(11, 'Apakah kamu suka suara keras seperti bel, petir, atau mesin?', 'Biasa saja', 'Kadang takut', 'Sering menutup telinga', 'Sangat takut dan menangis setiap kali mendengar', 'A', '2025-07-01 05:23:13', '2025-07-01 05:23:13'),
(12, 'Saat melihat orang lain sedih, kamu biasanya merasa:', 'Ikut sedih dan ingin membantu', 'Tidak tahu harus bagaimana', 'Bingung lalu pergi', 'Tidak peduli sama sekali', 'A', '2025-07-01 05:23:13', '2025-07-01 05:23:13'),
(13, 'Apakah kamu suka memutar benda, melompat terus-menerus, atau mengulang kata yang sama?', 'Tidak pernah', 'Kadang', 'Sering', 'Hampir setiap hari', 'A', '2025-07-01 05:23:13', '2025-07-01 05:23:13'),
(14, 'Ketika orang tua atau guru memanggilmu, kamu biasanya...', 'Langsung menjawab', 'Kadang mendengar, kadang tidak', 'Sering tidak menjawab meski dekat', 'Tidak peduli dan tetap melakukan kegiatan sendiri', 'A', '2025-07-01 05:23:13', '2025-07-01 05:23:13');

-- --------------------------------------------------------

--
-- Table structure for table `registrations`
--

CREATE TABLE `registrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` enum('L','P') COLLATE utf8mb4_unicode_ci NOT NULL,
  `agama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_ayah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_ibu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon_ortu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pekerjaan_ayah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penghasilan_ayah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pekerjaan_ibu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penghasilan_ibu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_pip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_kk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_akta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_wali` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_wali` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_telp_wali` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pekerjaan_wali` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `jadwal_abk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_lolos` tinyint(1) NOT NULL DEFAULT 0,
  `tes_warna` int(11) NOT NULL DEFAULT 0,
  `interaksi` int(11) NOT NULL DEFAULT 0,
  `tes_baca_tulis` int(11) NOT NULL DEFAULT 0,
  `abk` int(11) NOT NULL DEFAULT 0,
  `total_poin` int(11) NOT NULL DEFAULT 0,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `registrations`
--

INSERT INTO `registrations` (`id`, `nama`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `agama`, `nama_ayah`, `nama_ibu`, `telepon_ortu`, `pekerjaan_ayah`, `penghasilan_ayah`, `pekerjaan_ibu`, `penghasilan_ibu`, `status_pip`, `file_kk`, `file_akta`, `nama_wali`, `alamat_wali`, `no_telp_wali`, `pekerjaan_wali`, `alamat`, `jadwal_abk`, `status_lolos`, `tes_warna`, `interaksi`, `tes_baca_tulis`, `abk`, `total_poin`, `status`, `created_at`, `updated_at`) VALUES
(19, 'Achmad Syahreza', 'Solo', '2019-05-06', 'L', 'Islam', 'Arlin Sulistyo', 'Riska', '085513437888', 'PNS/TNI/POLRI', '2.000.000-4.999.999', 'Karyawan Swasta', '2.000.000-4.999.999', 'N', 'kk_687a54d87012c.jpeg', 'akta_687a54d89544c.png', NULL, NULL, NULL, NULL, 'Jl. Wonosari No 68, Surakarta', 'Jumat, 18 Jul 2025 | 07.00 - 12.00 WIB', 1, 15, 10, 24, 11, 60, 'final', '2025-07-18 06:06:16', '2025-07-28 04:43:39'),
(20, 'Terry Indra', 'Jember', '2019-05-13', 'L', 'Katolik', 'Danang', 'Rinni', '0891928182821', 'Karyawan Swasta', '2.000.000-4.999.999', 'Wiraswasta', '1.000.000-1.999.999', 'N', 'kk_6887717855916.jpg', 'akta_688771785788d.jpeg', NULL, NULL, NULL, NULL, 'Jl. Bukit sion', 'Selasa, 29 Jul 2025 | 07.00 - 12.00 WIB', 0, 23, 21, 11, 11, 66, 'final', '2025-07-28 04:47:52', '2025-07-28 04:53:09'),
(21, 'Aurell Wienanda', 'Bekasi', '2019-07-16', 'P', 'Islam', 'Joseph Henry', 'Riska', '0891928182892', 'PNS/TNI/POLRI', '2.000.000-4.999.999', 'Wiraswasta', '1.000.000-1.999.999', 'N', 'kk_688772a45eb1a.jpeg', 'akta_688772a46032e.jpeg', NULL, NULL, NULL, NULL, 'Jl. Malioboro', 'Kamis, 31 Jul 2025 | 07.00 - 12.00 WIB', 0, 21, 19, 45, 35, 120, 'final', '2025-07-28 04:52:52', '2025-07-28 04:57:51'),
(22, 'Muchammad Apriangga', 'Balikpapan', '2018-05-16', 'L', 'Islam', 'Eli Saipudin', 'Putri Maharani', '0891928182892', 'PNS/TNI/POLRI', '1.000.000-1.999.999', 'Ibu Rumah Tangga', '<1.000.000', 'Y', 'kk_688773397090e.png', 'akta_6887733972037.jpg', NULL, NULL, NULL, NULL, 'Jl. Forever', 'Senin, 28 Jul 2025 | 07.00 - 12.00 WIB', 0, 65, 75, 85, 88, 313, 'final', '2025-07-28 04:55:21', '2025-07-28 04:58:23'),
(23, 'Rigel Donovan', 'Surabaya', '2018-06-20', 'L', 'Islam', 'Eli Saipudin', 'Shofa Risalah Indah', '08919281828264', 'PNS/TNI/POLRI', '1.000.000-1.999.999', 'Ibu Rumah Tangga', '<1.000.000', 'Y', 'kk_6889f8de1d452.jpg', 'akta_6889f8de203cc.jpg', NULL, NULL, NULL, NULL, 'Jl jwdaidmwioad', NULL, 0, 0, 0, 0, 0, 0, 'draft', '2025-07-30 02:50:06', '2025-07-30 02:50:06'),
(24, 'Rafi', 'Surabaya', '2019-05-06', 'L', 'Islam', 'Danang', 'Rinni', '085513437888', 'Wiraswasta', '>=5.000.000', 'Ibu Rumah Tangga', '1.000.000-1.999.999', 'N', 'kk_6889fb660a68d.png', 'akta_6889fb660d3a9.png', NULL, NULL, NULL, NULL, 'EDawdadwad', NULL, 0, 0, 0, 0, 0, 0, 'draft', '2025-07-30 03:00:54', '2025-07-30 03:00:54');

-- --------------------------------------------------------

--
-- Table structure for table `registration_answers`
--

CREATE TABLE `registration_answers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `registration_id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `answer` enum('A','B','C','D') COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_correct` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `registration_points`
--

CREATE TABLE `registration_points` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `registration_id` bigint(20) UNSIGNED NOT NULL,
  `exam_score` int(11) NOT NULL DEFAULT 0,
  `donation_amount` int(11) NOT NULL DEFAULT 0,
  `donation_points` int(11) NOT NULL DEFAULT 0,
  `total_points` int(11) NOT NULL DEFAULT 0,
  `status_lolos` tinyint(1) NOT NULL DEFAULT 0,
  `answers` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`answers`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sambutans`
--

CREATE TABLE `sambutans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kepala` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('published','draft') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sambutans`
--

INSERT INTO `sambutans` (`id`, `nama_kepala`, `jabatan`, `foto`, `isi`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Dr. Tirta, S.Pd, M.Pd', 'Kepala Sekolah', 'sambutan/QZadM5KkEgn2l2awzBbo29Ljfe2y2khdSU9tRUSv.jpg', 'Selamat datang di SD Premium! Sebagai lembaga pendidikan yang berkomitmen pada keunggulan, kami senantiasa berupaya memberikan pendidikan terbaik bagi putra-putri bangsa.\r\n\r\nKami percaya bahwa setiap anak memiliki potensi unik yang perlu dikembangkan melalui pendekatan pembelajaran yang inovatif dan pembimbingan karakter yang intensif.\r\n\r\nDi SD Premium, kami tidak hanya fokus pada prestasi akademik, tetapi juga pembentukan karakter dan pengembangan keterampilan abad 21. Dengan didukung oleh tenaga pendidik yang profesional dan fasilitas pembelajaran modern, kami berkomitmen untuk menciptakan lingkungan belajar yang inspiratif dan menyenangkan.\r\n\r\nMari bergabung dengan keluarga besar SD Premium untuk bersama-sama mempersiapkan generasi penerus bangsa yang cerdas, berkarakter, dan siap menghadapi tantangan global.', 'published', '2025-07-05 06:21:09', '2025-07-05 06:21:09');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `struktur_organisasi`
--

CREATE TABLE `struktur_organisasi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `urutan` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `periode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pendidikan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `struktur_organisasis`
--

CREATE TABLE `struktur_organisasis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `avatar`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@admin.com', '/storage/avatars/VjzGltNO2Ai14wjs8ABUDVbdmnPmhmOgDT0e901M.png', NULL, '$2y$12$AOBz2FcU.loeCr5/jq/GKuk8PEkkhgX9I7q5cFAn/qHuv5088us8S', NULL, '2025-06-29 00:54:05', '2025-07-23 06:30:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artikels`
--
ALTER TABLE `artikels`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `artikels_slug_unique` (`slug`),
  ADD KEY `artikels_user_id_foreign` (`user_id`);

--
-- Indexes for table `ekstrakurikulers`
--
ALTER TABLE `ekstrakurikulers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `galeri`
--
ALTER TABLE `galeri`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kotak_saran`
--
ALTER TABLE `kotak_saran`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pengumuman_slug_unique` (`slug`),
  ADD KEY `pengumuman_user_id_foreign` (`user_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `posters`
--
ALTER TABLE `posters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registrations`
--
ALTER TABLE `registrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registration_answers`
--
ALTER TABLE `registration_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `registration_answers_registration_id_foreign` (`registration_id`),
  ADD KEY `registration_answers_question_id_foreign` (`question_id`);

--
-- Indexes for table `registration_points`
--
ALTER TABLE `registration_points`
  ADD PRIMARY KEY (`id`),
  ADD KEY `registration_points_registration_id_foreign` (`registration_id`);

--
-- Indexes for table `sambutans`
--
ALTER TABLE `sambutans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `struktur_organisasi`
--
ALTER TABLE `struktur_organisasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `struktur_organisasis`
--
ALTER TABLE `struktur_organisasis`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `artikels`
--
ALTER TABLE `artikels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ekstrakurikulers`
--
ALTER TABLE `ekstrakurikulers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `galeri`
--
ALTER TABLE `galeri`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kotak_saran`
--
ALTER TABLE `kotak_saran`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posters`
--
ALTER TABLE `posters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `registrations`
--
ALTER TABLE `registrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `registration_answers`
--
ALTER TABLE `registration_answers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `registration_points`
--
ALTER TABLE `registration_points`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `sambutans`
--
ALTER TABLE `sambutans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `struktur_organisasi`
--
ALTER TABLE `struktur_organisasi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `struktur_organisasis`
--
ALTER TABLE `struktur_organisasis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `artikels`
--
ALTER TABLE `artikels`
  ADD CONSTRAINT `artikels_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD CONSTRAINT `pengumuman_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `registration_answers`
--
ALTER TABLE `registration_answers`
  ADD CONSTRAINT `registration_answers_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `registration_answers_registration_id_foreign` FOREIGN KEY (`registration_id`) REFERENCES `registrations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `registration_points`
--
ALTER TABLE `registration_points`
  ADD CONSTRAINT `registration_points_registration_id_foreign` FOREIGN KEY (`registration_id`) REFERENCES `registrations` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
