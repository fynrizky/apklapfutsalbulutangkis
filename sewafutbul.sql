-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Jul 2020 pada 13.30
-- Versi server: 10.4.8-MariaDB
-- Versi PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sewafutbul`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal_sewa`
--

CREATE TABLE `jadwal_sewa` (
  `id_jadwal_sewa` int(11) NOT NULL,
  `jam_sewa` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jadwal_sewa`
--

INSERT INTO `jadwal_sewa` (`id_jadwal_sewa`, `jam_sewa`) VALUES
(1, '09:00 - 10:00'),
(2, '10:00 - 11:00'),
(3, '11:00 - 12:00'),
(4, '12:00 - 13:00'),
(5, '13:00 - 14:00'),
(6, '14:00 - 15:00'),
(7, '15:00 - 16:00'),
(8, '16:00 - 17:00'),
(9, '17:00 - 18:00'),
(10, '18:00 - 19:00'),
(11, '19:00 - 20:00'),
(12, '20:00 - 21:00'),
(13, '21:00 - 22:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lapangan`
--

CREATE TABLE `lapangan` (
  `id_lapangan` int(11) NOT NULL,
  `nama_lapangan` varchar(30) NOT NULL,
  `harga_sewa` int(15) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `lapangan`
--

INSERT INTO `lapangan` (`id_lapangan`, `nama_lapangan`, `harga_sewa`, `gambar`) VALUES
(1, 'Lapangan A', 110000, 'gbr-1586419359.jfif'),
(2, 'Lapangan B', 110000, 'gbr-1586420360.jpg'),
(3, 'Lapangan Badm A', 55000, 'gbr-1586419702.jfif'),
(4, 'Lapangan Badm B', 55000, 'gbr-1586419652.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `email_pelanggan` varchar(50) NOT NULL,
  `nama_pelanggan` varchar(30) NOT NULL,
  `password_pelanggan` varchar(255) NOT NULL,
  `notelp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `email_pelanggan`, `nama_pelanggan`, `password_pelanggan`, `notelp`) VALUES
(1, 'fiyannur@gmail.com', 'fiyannur', 'fiyannur', '087772980325'),
(2, 'yakup@gmail.com', 'yakup', 'yakup', '087228282899'),
(4, 'fahmi@gmail.com', 'fahmi', 'fahmi', '087872827277'),
(5, 'rujak99@gmail.com', 'rujak99', 'hafis', '087773737372'),
(6, 'rendy@gmail.com', 'rendy', 'rendy', '089888282828'),
(7, 'wawan@gmail.com', 'wawan', 'ilham', '087772345777'),
(8, 'noval@gmail.com', 'noval', 'noval', '087772828329');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penyewaan`
--

CREATE TABLE `penyewaan` (
  `id_penyewaan` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_lapangan` int(11) NOT NULL,
  `id_jadwal_sewa` int(11) NOT NULL,
  `dp` int(11) NOT NULL,
  `dibayar` int(15) NOT NULL,
  `selisih_jam` int(11) NOT NULL,
  `tgl_penyewaan` date NOT NULL,
  `status` varchar(25) NOT NULL,
  `batas_waktu_dp` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `penyewaan`
--

INSERT INTO `penyewaan` (`id_penyewaan`, `id_pelanggan`, `id_lapangan`, `id_jadwal_sewa`, `dp`, `dibayar`, `selisih_jam`, `tgl_penyewaan`, `status`, `batas_waktu_dp`) VALUES
(77, 2, 2, 1, 0, 110000, 1, '2020-08-10', 'Lunas', 'jika lewat dari jam yang telah ditentukan maka DP hilang'),
(78, 2, 2, 2, 0, 110000, 1, '2020-08-10', 'Lunas', 'jika lewat dari jam yang telah ditentukan maka DP hilang'),
(79, 2, 2, 3, 0, 110000, 1, '2020-08-10', 'Lunas', 'jika lewat dari jam yang telah ditentukan maka DP hilang'),
(80, 4, 2, 4, 0, 110000, 1, '2020-08-10', 'Lunas', 'jika lewat dari jam yang telah ditentukan maka DP hilang'),
(81, 4, 2, 5, 0, 110000, 1, '2020-08-10', 'Lunas', 'jika lewat dari jam yang telah ditentukan maka DP hilang'),
(82, 5, 4, 1, 27500, 0, 1, '2020-08-11', 'Pembayaran DP', 'jika lewat dari jam yang telah ditentukan maka DP hilang'),
(83, 5, 4, 2, 27500, 0, 1, '2020-08-11', 'Pembayaran DP', 'jika lewat dari jam yang telah ditentukan maka DP hilang'),
(84, 5, 4, 3, 27500, 0, 1, '2020-08-11', 'Pembayaran DP', 'jika lewat dari jam yang telah ditentukan maka DP hilang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `perubahan_jadwal`
--

CREATE TABLE `perubahan_jadwal` (
  `id_perubahan` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_lapangan` int(11) NOT NULL,
  `jam_berubah` varchar(30) NOT NULL,
  `tanggal_penyewaan` date NOT NULL,
  `status_berubah` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `perubahan_jadwal`
--

INSERT INTO `perubahan_jadwal` (`id_perubahan`, `id_pelanggan`, `id_lapangan`, `jam_berubah`, `tanggal_penyewaan`, `status_berubah`) VALUES
(4, 4, 2, '09:00 - 11:00', '2020-08-10', 'Jadwal Berubah');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `nama_user`, `username`, `password`, `level`) VALUES
(1, 'admin', 'admin', '$2y$10$EqoNl/gKmCOp2EseRaOIXe5w6JwLfL8Pivlc2ON2EBM1bWsz4nPXK', 1),
(2, 'pimpinan', 'pimpinan', '$2y$10$SBPF39BHtCEFRcoY5Be3mOgfBx7QAdvRfJaGOruIFTp6Sh.fDFYqq', 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `jadwal_sewa`
--
ALTER TABLE `jadwal_sewa`
  ADD PRIMARY KEY (`id_jadwal_sewa`);

--
-- Indeks untuk tabel `lapangan`
--
ALTER TABLE `lapangan`
  ADD PRIMARY KEY (`id_lapangan`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indeks untuk tabel `penyewaan`
--
ALTER TABLE `penyewaan`
  ADD PRIMARY KEY (`id_penyewaan`);

--
-- Indeks untuk tabel `perubahan_jadwal`
--
ALTER TABLE `perubahan_jadwal`
  ADD PRIMARY KEY (`id_perubahan`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `jadwal_sewa`
--
ALTER TABLE `jadwal_sewa`
  MODIFY `id_jadwal_sewa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `lapangan`
--
ALTER TABLE `lapangan`
  MODIFY `id_lapangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `penyewaan`
--
ALTER TABLE `penyewaan`
  MODIFY `id_penyewaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT untuk tabel `perubahan_jadwal`
--
ALTER TABLE `perubahan_jadwal`
  MODIFY `id_perubahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
