-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2021 at 09:17 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_persediaan_rop`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `kd_barang` int(11) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `detail` enum('Dus','Buah','Pcs') NOT NULL,
  `brand` varchar(255) NOT NULL,
  `jenis` enum('Minuman','Bahan Pembersih','Alat Pembersih','Kebutuhan Mandi','Kebutuhan Dapur','Pengharum Ruangan','Pembersih Kaca','Alat Makan') NOT NULL,
  `stok` int(11) NOT NULL,
  `rop` int(11) NOT NULL,
  `sts` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`kd_barang`, `nama_barang`, `detail`, `brand`, `jenis`, `stok`, `rop`, `sts`) VALUES
(2, 'Pembersih Piring Sunlight', 'Buah', 'Sunlight', 'Bahan Pembersih', 20, 6, 0),
(3, 'Pengharum Lantai', 'Buah', 'Wipol', 'Bahan Pembersih', 40, 5, 0),
(4, 'Tissue', 'Buah', 'Passeo', 'Alat Pembersih', 5, 7, 1),
(5, 'Aqua', 'Dus', 'Agua', 'Minuman', 120, 0, 0),
(7, 'Amenetis', 'Pcs', '-', 'Kebutuhan Mandi', 150, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `kd_keluar` int(11) NOT NULL,
  `kd_barang` int(11) NOT NULL,
  `waktu` datetime NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang_keluar`
--

INSERT INTO `barang_keluar` (`kd_keluar`, `kd_barang`, `waktu`, `jumlah`) VALUES
(9, 4, '2021-01-26 20:48:20', 20),
(10, 3, '2021-01-26 20:55:01', 15);

--
-- Triggers `barang_keluar`
--
DELIMITER $$
CREATE TRIGGER `on_delete` AFTER DELETE ON `barang_keluar` FOR EACH ROW BEGIN 
	UPDATE barang SET stok = stok + OLD.jumlah
	WHERE OLD.kd_barang=barang.kd_barang;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `on_insert` AFTER INSERT ON `barang_keluar` FOR EACH ROW BEGIN 
	UPDATE barang SET stok = stok - NEW.jumlah
	WHERE NEW.kd_barang=barang.kd_barang
    AND barang.stok > NEW.jumlah ;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `on_update` AFTER UPDATE ON `barang_keluar` FOR EACH ROW BEGIN 
	UPDATE barang SET stok = (stok + OLD.jumlah)-NEW.jumlah
	WHERE NEW.kd_barang=barang.kd_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `kd_masuk` int(11) NOT NULL,
  `kd_barang` int(11) NOT NULL,
  `waktu` datetime NOT NULL,
  `jumlah` int(11) NOT NULL,
  `detail` varchar(255) NOT NULL,
  `supplier` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang_masuk`
--

INSERT INTO `barang_masuk` (`kd_masuk`, `kd_barang`, `waktu`, `jumlah`, `detail`, `supplier`) VALUES
(3, 2, '2021-01-24 15:29:23', 20, 'Buah', 3),
(4, 3, '2021-01-24 15:36:12', 20, 'Buah', 3),
(5, 4, '2021-01-24 15:38:13', 25, 'Buah', 3),
(6, 5, '2021-01-24 15:39:20', 120, 'Dus', 3),
(7, 7, '2021-01-26 16:50:18', 150, 'Pcs', 0),
(8, 3, '2021-01-27 17:21:09', 10, 'Buah', 1);

--
-- Triggers `barang_masuk`
--
DELIMITER $$
CREATE TRIGGER `masuk` AFTER INSERT ON `barang_masuk` FOR EACH ROW BEGIN 
	UPDATE barang SET stok = stok + NEW.jumlah, detail = NEW.detail
	WHERE NEW.kd_barang=barang.kd_barang;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update` AFTER UPDATE ON `barang_masuk` FOR EACH ROW BEGIN 
	UPDATE barang SET stok = (stok - OLD.jumlah)+NEW.jumlah
	WHERE NEW.kd_barang=barang.kd_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jenkel` enum('L','P') NOT NULL,
  `tmp_lahir` varchar(255) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nama`, `jenkel`, `tmp_lahir`, `tgl_lahir`, `no_hp`, `alamat`) VALUES
(2, 'Risal Basri', 'L', 'ende', '1999-01-22', '08152155999', 'Jl. Pejuang Kemerdekaan no 30, Ende'),
(3, 'Masya Ashari', 'P', 'Ende', '1998-02-22', '08152159911', 'Ende');

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan`
--

CREATE TABLE `pengajuan` (
  `kd_pengajuan` int(11) NOT NULL,
  `barang` int(11) NOT NULL,
  `tgl_diajukan` date NOT NULL,
  `jumlah` int(11) NOT NULL,
  `ket` varchar(255) NOT NULL,
  `status` enum('pending','waiting','approve','cancel','done') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengajuan`
--

INSERT INTO `pengajuan` (`kd_pengajuan`, `barang`, `tgl_diajukan`, `jumlah`, `ket`, `status`) VALUES
(17, 3, '2021-01-27', 50, 'Dibutuhkan Untuk keperluan kebersihan kamar', 'approve'),
(18, 4, '2021-01-27', 10, 'Pemesanan Otomatis Sistem', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `retur`
--

CREATE TABLE `retur` (
  `kd_retur` int(11) NOT NULL,
  `kd_barang` int(11) NOT NULL,
  `waktu` datetime NOT NULL,
  `status` varchar(255) NOT NULL,
  `detail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rop`
--

CREATE TABLE `rop` (
  `id` int(11) NOT NULL,
  `kd_barang` int(11) NOT NULL,
  `lt` int(11) NOT NULL,
  `ss` int(11) NOT NULL,
  `rop` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rop`
--

INSERT INTO `rop` (`id`, `kd_barang`, `lt`, `ss`, `rop`) VALUES
(1, 2, 2, 20, 6),
(2, 3, 1, 20, 5),
(3, 4, 2, 20, 7);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `kd_supp` int(11) NOT NULL,
  `nama_supp` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`kd_supp`, `nama_supp`, `owner`, `no_hp`, `alamat`) VALUES
(1, 'Sembada Supermarket', 'Bpk. Surya Winata', '08152155999', 'Mlati, Sleman'),
(3, 'CV. Rukun Semesta', 'Mhd. Puyono', '08152159911', 'yogya');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `role` enum('admin','pegawai') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `id_pegawai`, `role`) VALUES
(1, 'admin', '$2y$10$FmO8fDbUZcPH7X9NP1NGoetVZ5YCo86uzQ2iBcOmH9UFBaNc1L86a', 0, 'admin'),
(3, 'user', '$2y$10$RL42e1tfEgPZqYC.K0Gg6eeVJvU5knsoiZoUHaNd/Ks0/cNaZKPVi', 2, 'pegawai');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kd_barang`);

--
-- Indexes for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`kd_keluar`);

--
-- Indexes for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`kd_masuk`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indexes for table `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD PRIMARY KEY (`kd_pengajuan`),
  ADD KEY `barang` (`barang`);

--
-- Indexes for table `retur`
--
ALTER TABLE `retur`
  ADD PRIMARY KEY (`kd_retur`);

--
-- Indexes for table `rop`
--
ALTER TABLE `rop`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kd_barang` (`kd_barang`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`kd_supp`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `kd_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  MODIFY `kd_keluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  MODIFY `kd_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pengajuan`
--
ALTER TABLE `pengajuan`
  MODIFY `kd_pengajuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `retur`
--
ALTER TABLE `retur`
  MODIFY `kd_retur` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rop`
--
ALTER TABLE `rop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `kd_supp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD CONSTRAINT `pengajuan_ibfk_1` FOREIGN KEY (`barang`) REFERENCES `barang` (`kd_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rop`
--
ALTER TABLE `rop`
  ADD CONSTRAINT `rop_ibfk_1` FOREIGN KEY (`kd_barang`) REFERENCES `barang` (`kd_barang`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
