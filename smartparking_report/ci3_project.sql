-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Bulan Mei 2026 pada 04.08
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci3_project`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `article` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `posts`
--

INSERT INTO `posts` (`id`, `title`, `author`, `article`, `image`, `created_at`, `updated_at`) VALUES
(7, 'aaaa', 'aaaaa', 'aaaaa99', 'post_1771137884_69916b5c0178f.png', '2026-02-15 06:44:44', '2026-02-15 06:44:44'),
(9, 'bbbbb', 'aaaaa', 'aaaaa99', 'post_1771138185_69916c89173fa.png', '2026-02-15 06:49:45', '2026-02-15 06:49:45'),
(11, '4444444444445', 'aaaaa', 'aaaaa99', 'posts/1771138945_8__Dapus.png', '2026-02-15 06:58:36', '2026-02-15 07:02:25'),
(12, '4444444444445', 'aaaaa', 'aaaaa99', 'post_1771138830_69916f0eab030.png', '2026-02-15 07:00:30', '2026-02-15 07:00:30'),
(13, '4444444444445', 'aaaaa', 'aaaaa99', 'post_1771139076_69917004b9c93.png', '2026-02-15 07:04:36', '2026-02-15 07:04:36'),
(14, '4444444444445', 'aaaaa', 'aaaaa99', 'post_1771139156_699170545f383.png', '2026-02-15 07:05:56', '2026-02-15 07:05:56'),
(15, '4444444444445', 'aaaaa', 'aaaaa99', 'post_1771139541_699171d5e813a.png', '2026-02-15 07:12:21', '2026-02-15 07:12:21'),
(16, '4444444444445', 'aaaaa', 'aaaaa99', 'post_1771139558_699171e6426ac.png', '2026-02-15 07:12:38', '2026-02-15 07:12:38'),
(18, 'sadsad', 'qweqw', '23rdsafsaf', 'posts/1777444477_2__Latar_belakang_.png', '2026-04-29 06:34:37', '2026-04-29 06:34:37'),
(20, 'sadsad', 'safsa', 'asdsadsadsdsd', NULL, '2026-04-29 08:16:14', '2026-04-29 08:16:21'),
(22, '111111111111111111', 'wqeqweqw', 'eqwreeeeeeeeeee', NULL, '2026-04-29 10:46:36', '2026-04-29 10:46:47'),
(27, 'anuurrrrrrrrrrrrrrrrrrr', 'anu2', 'anuanuanu', 'post_1777540283_69f31cbb178b4.png', '2026-04-30 09:11:23', '2026-04-30 09:11:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ujicoba`
--

CREATE TABLE `ujicoba` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama` varchar(100) NOT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `ujicoba`
--

INSERT INTO `ujicoba` (`id`, `nama`, `keterangan`) VALUES
(1, 'Data sudah diubah', 'Keterangan sudah diubah dari Postman'),
(3, 'sdxxx', 'xcxcxc'),
(4, 'Data dari Postman', 'Ini keterangan dari Postman'),
(6, 'sdsd', '1111111111'),
(8, 'Data sudah diubah', 'Keterangan sudah diubah dari Postman'),
(9, '22222222', 'sdsadsadsa'),
(11, 'Data sudah diubah', 'Keterangan sudah diubah dari Postman'),
(12, 'xcxz', '7777777777777777');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Admin User', 'admin@example.com', '$2y$10$ZZZZZZZZZZZZZZZZZZZZZ.ZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZ', '2026-02-15 13:18:32', '2026-02-15 13:18:32'),
(5, 'John Doe', 'john@example.com', '$2y$10$dr/ri34LP0oCdGF3uwzOs.GexfPmj2XPizpVbkjatxrnBWulq77fK', '2026-02-15 13:28:34', '2026-02-15 13:28:34'),
(6, 'Mohammad As&#039;ad Rosyadi', 'mohammadasadrosyadi@telkomuniversity.ac.id', '$2y$10$ukuqtgoNifx2OMh.9PCg6.AQ78f7u3qvBdoBGh4rmSJVrltklAMHW', '2026-02-15 14:25:19', '2026-02-15 14:25:19');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ujicoba`
--
ALTER TABLE `ujicoba`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `ujicoba`
--
ALTER TABLE `ujicoba`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
