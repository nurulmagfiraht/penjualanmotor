-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Agu 2023 pada 16.05
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_gula_aren`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bukti_transfer`
--

CREATE TABLE `bukti_transfer` (
  `id_bukti_tf` int(11) NOT NULL,
  `id_pesanan` int(20) NOT NULL,
  `id_user` int(20) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int(11) NOT NULL,
  `nama_panggilan` varchar(50) NOT NULL,
  `nama_lenggkap` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `nama_panggilan`, `nama_lenggkap`, `alamat`, `email`, `password`, `level`) VALUES
(1, 'admin', 'admin', 'perintis kemerdekaan 7', 'admin@gmail.com', 'admin321', 'admin'),
(2, 'pimpinan', 'pimpinan', 'makassar', 'pimpinan@gmail.com', 'pimpinan', 'pimpinan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_gula`
--

CREATE TABLE `tb_gula` (
  `id_gula` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `harga` int(50) NOT NULL,
  `stock` int(50) NOT NULL,
  `jenis_gula` varchar(100) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `tanggal` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_gula`
--

INSERT INTO `tb_gula` (`id_gula`, `nama`, `harga`, `stock`, `jenis_gula`, `gambar`, `tanggal`) VALUES
(10, 'Motor', 23000000, 1, 'Kawasaki', 'produk1691670894.jpg', '2023-08-10'),
(11, 'Motor Kawasaki KLX 150', 24000000, 10, 'Kawasaki', 'produk1691671037.jpg', '2023-08-10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pesanan`
--

CREATE TABLE `tb_pesanan` (
  `id_pesanan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_gula` int(11) NOT NULL,
  `tanggal_pesanan` varchar(50) NOT NULL,
  `jumlah_pesan` int(20) NOT NULL,
  `no_handphone` int(25) NOT NULL,
  `total_harga` int(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `keterangan` varchar(35) NOT NULL,
  `alamat_lengkap` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_pesanan`
--

INSERT INTO `tb_pesanan` (`id_pesanan`, `id_user`, `id_gula`, `tanggal_pesanan`, `jumlah_pesan`, `no_handphone`, `total_harga`, `status`, `keterangan`, `alamat_lengkap`) VALUES
(8, 3, 11, '2023-08-10', 4, 2147483647, 96000000, '1', '0', 'adad');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `nama_panggilan` varchar(50) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `verifikasi_code` varchar(80) NOT NULL,
  `is_verif` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama_panggilan`, `nama_lengkap`, `alamat`, `email`, `password`, `verifikasi_code`, `is_verif`) VALUES
(3, 'sambayang', 'Sambayang', 'Makassar', 'alverisamba@gmail.com', 'sambayang123', 'a5aee6a4964b696644bbf2da4ba4d4b6', 1),
(5, 'Yuni', 'Yunita Barambang', 'Jl. Dirgantara 6', 'barambangyunita@gmail.com', 'Yuni123', '89c97e2826d053f8e3d7f9532a7c7d99', 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bukti_transfer`
--
ALTER TABLE `bukti_transfer`
  ADD PRIMARY KEY (`id_bukti_tf`),
  ADD KEY `id_pesanan` (`id_pesanan`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `tb_gula`
--
ALTER TABLE `tb_gula`
  ADD PRIMARY KEY (`id_gula`);

--
-- Indeks untuk tabel `tb_pesanan`
--
ALTER TABLE `tb_pesanan`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_gula` (`id_gula`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bukti_transfer`
--
ALTER TABLE `bukti_transfer`
  MODIFY `id_bukti_tf` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_gula`
--
ALTER TABLE `tb_gula`
  MODIFY `id_gula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `tb_pesanan`
--
ALTER TABLE `tb_pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `bukti_transfer`
--
ALTER TABLE `bukti_transfer`
  ADD CONSTRAINT `bukti_transfer_ibfk_1` FOREIGN KEY (`id_pesanan`) REFERENCES `tb_pesanan` (`id_pesanan`),
  ADD CONSTRAINT `bukti_transfer_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `tb_pesanan`
--
ALTER TABLE `tb_pesanan`
  ADD CONSTRAINT `tb_pesanan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`),
  ADD CONSTRAINT `tb_pesanan_ibfk_2` FOREIGN KEY (`id_gula`) REFERENCES `tb_gula` (`id_gula`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
