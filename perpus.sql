-- phpMyAdmin SQL Dump
-- version 4.5.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 09 Mei 2017 pada 07.59
-- Versi Server: 5.7.17-0ubuntu0.16.04.2
-- PHP Version: 7.0.18-1+deb.sury.org~xenial+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpus`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_m_buku`
--

CREATE TABLE `tb_m_buku` (
  `id_buku` int(11) NOT NULL,
  `kode_buku` varchar(15) NOT NULL,
  `nama_buku` varchar(50) NOT NULL,
  `ucode_buku` varchar(16) NOT NULL,
  `ucode_pengarang` varchar(16) NOT NULL,
  `ucode_penerbit` varchar(16) NOT NULL,
  `ucode_kategori` varchar(16) NOT NULL,
  `tahun_terbit` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_m_kategori`
--

CREATE TABLE `tb_m_kategori` (
  `id_kategori` int(11) NOT NULL,
  `ucode_kategori` varchar(16) NOT NULL,
  `nama_kategori` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_m_penerbit`
--

CREATE TABLE `tb_m_penerbit` (
  `id_penerbit` int(11) NOT NULL,
  `ucode_penerbit` varchar(15) NOT NULL,
  `nama_penerbit` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_m_pengarang`
--

CREATE TABLE `tb_m_pengarang` (
  `id_pengarang` int(11) NOT NULL,
  `ucode_pengarang` varchar(16) NOT NULL,
  `nama_pengarang` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_m_pinjam`
--

CREATE TABLE `tb_m_pinjam` (
  `id_pinjam` int(11) NOT NULL,
  `no_pinjam` varchar(25) NOT NULL,
  `ucode_buku` varchar(16) NOT NULL,
  `ucode_siswa` varchar(16) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_kembali` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_m_user`
--

CREATE TABLE `tb_m_user` (
  `id_user` int(11) NOT NULL,
  `ucode_user` varchar(16) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(125) NOT NULL,
  `password_salt` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `kategori_user` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_m_buku`
--
ALTER TABLE `tb_m_buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indexes for table `tb_m_kategori`
--
ALTER TABLE `tb_m_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tb_m_penerbit`
--
ALTER TABLE `tb_m_penerbit`
  ADD PRIMARY KEY (`id_penerbit`);

--
-- Indexes for table `tb_m_pengarang`
--
ALTER TABLE `tb_m_pengarang`
  ADD PRIMARY KEY (`id_pengarang`);

--
-- Indexes for table `tb_m_pinjam`
--
ALTER TABLE `tb_m_pinjam`
  ADD PRIMARY KEY (`id_pinjam`);

--
-- Indexes for table `tb_m_user`
--
ALTER TABLE `tb_m_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_m_buku`
--
ALTER TABLE `tb_m_buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_m_kategori`
--
ALTER TABLE `tb_m_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_m_penerbit`
--
ALTER TABLE `tb_m_penerbit`
  MODIFY `id_penerbit` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_m_pengarang`
--
ALTER TABLE `tb_m_pengarang`
  MODIFY `id_pengarang` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_m_pinjam`
--
ALTER TABLE `tb_m_pinjam`
  MODIFY `id_pinjam` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_m_user`
--
ALTER TABLE `tb_m_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
