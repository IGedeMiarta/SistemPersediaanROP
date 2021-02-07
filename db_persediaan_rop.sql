-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2021 at 09:22 PM
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
  `kode` varchar(11) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `satuan` int(11) NOT NULL,
  `jenis` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `sts` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`kd_barang`, `kode`, `nama_barang`, `satuan`, `jenis`, `stok`, `sts`) VALUES
(12, 'B000001', 'Aqua Kardus', 4, 2, 2, 1),
(14, 'B000002', 'Indomie ', 3, 5, 12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `kd_keluar` int(11) NOT NULL,
  `kd_barang` int(11) NOT NULL,
  `kode` varchar(111) NOT NULL,
  `waktu` datetime NOT NULL,
  `jumlah` int(11) NOT NULL,
  `pegawai` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang_keluar`
--

INSERT INTO `barang_keluar` (`kd_keluar`, `kd_barang`, `kode`, `waktu`, `jumlah`, `pegawai`) VALUES
(22, 12, 'T-BK-2102060001', '2021-02-03 00:00:00', 5, 'Risal Basri'),
(23, 12, 'T-BK-2102060002', '2021-02-06 00:00:00', 3, 'Risal Basri'),
(24, 14, 'T-BK-2102060003', '2021-02-01 00:00:00', 5, 'Risal Basri'),
(25, 14, 'T-BK-2102060004', '2021-02-06 00:00:00', 3, 'Risal Basri');

--
-- Triggers `barang_keluar`
--
DELIMITER $$
CREATE TRIGGER `on_delete_keluar` AFTER DELETE ON `barang_keluar` FOR EACH ROW BEGIN 
	UPDATE barang SET stok = stok + OLD.jumlah
	WHERE OLD.kd_barang=barang.kd_barang;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `on_insert_keluar` AFTER INSERT ON `barang_keluar` FOR EACH ROW BEGIN 
	UPDATE barang SET stok = stok - NEW.jumlah
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
  `kode` varchar(111) NOT NULL,
  `waktu` datetime NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `supplier` int(11) NOT NULL,
  `pegawai` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang_masuk`
--

INSERT INTO `barang_masuk` (`kd_masuk`, `kd_barang`, `kode`, `waktu`, `jumlah`, `harga`, `supplier`, `pegawai`) VALUES
(41, 12, 'T-BM-2102060001', '2021-02-01 00:00:00', 10, 35000, 1, 'Risal Basri'),
(42, 14, 'T-BM-2102060002', '2021-02-01 00:00:00', 20, 3500, 1, 'Risal Basri');

--
-- Triggers `barang_masuk`
--
DELIMITER $$
CREATE TRIGGER `on_delete_masuk` AFTER DELETE ON `barang_masuk` FOR EACH ROW BEGIN 
	UPDATE barang SET stok = stok - OLD.jumlah
	WHERE OLD.kd_barang=barang.kd_barang;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `on_insert_masuk` AFTER INSERT ON `barang_masuk` FOR EACH ROW BEGIN 
	UPDATE barang SET stok = stok + NEW.jumlah
	WHERE NEW.kd_barang=barang.kd_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_barang`
--

CREATE TABLE `jenis_barang` (
  `id` int(11) NOT NULL,
  `jenis` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_barang`
--

INSERT INTO `jenis_barang` (`id`, `jenis`) VALUES
(1, 'Snack'),
(2, 'Minuman'),
(3, 'Alat Masak'),
(5, 'Bahan Makan');

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
(3, 'Masya Ashari', 'P', 'Ende', '1998-02-22', '08152159911', 'Ende'),
(4, 'Febby Putri', 'P', 'Ende', '2021-01-20', '08152155999', 'Yogyakarta'),
(9, 'Diana Prastika', 'P', 'Ende', '2021-02-01', '081521555980', 'ende\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan`
--

CREATE TABLE `pengajuan` (
  `kd_pengajuan` int(11) NOT NULL,
  `barang` int(11) NOT NULL,
  `tgl_diajukan` date NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `supplier` int(11) NOT NULL,
  `ket` varchar(255) NOT NULL,
  `status` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengajuan`
--

INSERT INTO `pengajuan` (`kd_pengajuan`, `barang`, `tgl_diajukan`, `jumlah`, `harga`, `supplier`, `ket`, `status`) VALUES
(27, 14, '2021-02-08', 38, 3500, 1, 'Hasil Perhitungan Metode ROP', 'Diterima'),
(29, 12, '2021-02-07', 19, 35000, 1, 'Hasil Perhitungan Metode ROP', 'Pending');

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
-- Table structure for table `satuan_barang`
--

CREATE TABLE `satuan_barang` (
  `id` int(11) NOT NULL,
  `satuan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `satuan_barang`
--

INSERT INTO `satuan_barang` (`id`, `satuan`) VALUES
(1, 'Unit'),
(3, 'Pcs'),
(4, 'Kardus'),
(5, 'Liter'),
(6, 'Kilo');

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
(8, 'CV. Rukun Punia', 'Ibu Mita', '08152155999', 'Mlati, Sleman, Yogyakarta');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `role` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `id_pegawai`, `role`) VALUES
(1, 'admin', '$2y$10$FmO8fDbUZcPH7X9NP1NGoetVZ5YCo86uzQ2iBcOmH9UFBaNc1L86a', 0, 'admin'),
(3, 'user', '$2y$10$hWjKUbSRrHesTeyrMkt1qeruyS3m5E0OjLZtJNKEj5Njq8sduIoea', 2, 'Pegawai'),
(4, 'febby', '$2y$10$6AIKcrPScyEHDr8J/vsDv.KV298nhlYpF7Ffi/de9GlqMNyPPFG7y', 4, 'Pegawai'),
(7, 'diana111', '$2y$10$OUxUuDO1g6mkdNCfDfH5Fes5x/rF/5Tk1Idwm8XYX9OEinOSrrbLO', 9, 'pegawai'),
(8, 'manager', '$2y$10$hcWvlbjxrx.WVY3AtobXM.cG90TUfRxodgbZ4HpGaB.TKnIOodW/m', 3, 'Manager');

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
-- Indexes for table `jenis_barang`
--
ALTER TABLE `jenis_barang`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `satuan_barang`
--
ALTER TABLE `satuan_barang`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `kd_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  MODIFY `kd_keluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  MODIFY `kd_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `jenis_barang`
--
ALTER TABLE `jenis_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pengajuan`
--
ALTER TABLE `pengajuan`
  MODIFY `kd_pengajuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `retur`
--
ALTER TABLE `retur`
  MODIFY `kd_retur` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `satuan_barang`
--
ALTER TABLE `satuan_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `kd_supp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD CONSTRAINT `pengajuan_ibfk_1` FOREIGN KEY (`barang`) REFERENCES `barang` (`kd_barang`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
