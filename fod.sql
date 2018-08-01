-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2018 at 09:00 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `fod`
--

-- --------------------------------------------------------

--
-- Table structure for table `d_transaksi`
--

CREATE TABLE IF NOT EXISTS `d_transaksi` (
  `no_transaksi` char(12) DEFAULT NULL,
  `id_produk` char(10) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `d_transaksi`
--

INSERT INTO `d_transaksi` (`no_transaksi`, `id_produk`, `quantity`) VALUES
('NT1612070001', 'M161000404', 5),
('NT1612180001', 'M161000401', 9),
('NT1612180001', 'M161000402', 2),
('NT1612180001', 'M161000403', 5),
('NT1612180001', 'M161000404', 4),
('NT1612180001', 'M161000406', 8),
('NT1612220001', 'M161000104', 3),
('NT1703030001', 'M161000402', 3),
('NT1703030001', 'M161000404', 4),
('NT1703030001', 'M161000405', 4);

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE IF NOT EXISTS `keranjang` (
  `id_pembeli` char(10) DEFAULT NULL,
  `id_produk` char(10) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keranjang`
--

INSERT INTO `keranjang` (`id_pembeli`, `id_produk`, `quantity`) VALUES
('P161222001', 'M161000405', 1),
('P161014001', 'M161000403', 14),
('P170304001', 'M161000405', 6),
('P170304001', 'M161000406', 1),
('P161014001', 'M161000408', 2),
('P161014001', 'M161000401', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pembeli`
--

CREATE TABLE IF NOT EXISTS `pembeli` (
  `id_pembeli` char(10) NOT NULL,
  `nama_pembeli` varchar(100) DEFAULT NULL,
  `provinsi` varchar(20) DEFAULT NULL,
  `kota` varchar(50) DEFAULT NULL,
  `alamat` text,
  `telp` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembeli`
--

INSERT INTO `pembeli` (`id_pembeli`, `nama_pembeli`, `provinsi`, `kota`, `alamat`, `telp`, `email`, `password`) VALUES
('P161014001', 'Ben', 'Jogja', 'Bantul', 'bantul yk', '0985', 'beniwahyuadi@gmail.com', '123'),
('P161127001', 'Muhamad Elza Febrianto', 'Yogyakarta', 'Bantul', 'Belakang rumahnya desi', '0857332767', '', '123'),
('P161127002', 'Cahyo Nur Johansyah', 'Jogja', 'Sleman', 'Meguo', '0874355552', 'johan@gmail.com', '123'),
('P161130001', 'Febry', 'Jogja', 'Bantul', 'Ngipik', '089675631305', 'muhammadelzaips@gmail.com', '123'),
('P161130002', 'muslih', 'jateng', 'solo', 'solo baru', '08232230', 'mslin@gmal.om', '1234'),
('P161206001', 'demo', 'demo', 'demo', 'demo', 'demo', 'demo', 'demo'),
('P161222001', 'M Elza Febrianto', 'Yogyakarta', 'Bantul', 'Mupit', '085734422', 'elzafeb@gmail.com', '123'),
('P170303001', 'BDB', 'Jogja', 'Bantul', 'Pajangan', '+6285743339929', 'sapi@m.com', '123'),
('P170304001', 'test desc', 'dsds', 'dsds', 'sds', 'sds', 'sds@g.b', 'ds');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE IF NOT EXISTS `produk` (
  `id_produk` char(10) NOT NULL,
  `nama_produk` varchar(100) DEFAULT NULL,
  `jenis_produk` enum('Makanan','Minuman') DEFAULT NULL,
  `diskripsi` text,
  `harga` int(11) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `foto` varchar(250) DEFAULT NULL,
  `id_toko` char(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `jenis_produk`, `diskripsi`, `harga`, `stok`, `foto`, `id_toko`) VALUES
('M161000101', 'Bakso Jaran', 'Makanan', 'Bakso Daging Sapi + Jarang Menambah Stamina dan Halal Lhooo', 20000, 20, 'BAKSO2.jpg', 'T1610001'),
('M161000102', 'Soto Ayam', 'Makanan', 'Soto Ayam dengan ayam kampung asli ternak sendiri', 15000, 13, 'BAKSO2.jpg', 'T1610001'),
('M161000103', 'Bakso Rudal', 'Makanan', 'Bakso Daging Sapi dengan ukuran jumbo yang membuat perut mledak', 20000, 40, 'BAKSO3.jpg', 'T1610001'),
('M161000104', 'Bakso Granat', 'Makanan', 'Bakso Granat adalah bakso dengan rasa pedas yang meledak pedasnya seperti granat', 15000, 46, 'BAKSO4.jpg', 'T1610001'),
('M161000105', 'Es teh', 'Minuman', 'Es teh dengan gula aren yang memberi khas manis yang berbeda', 2500, 1, '2.jpg', 'T1610001'),
('M161000106', 'Es teh', 'Minuman', 'Es teh dengan gula aren yang memberi khas manis yang berbeda', 2500, 1, '2.jpg', 'T1610001'),
('M161000107', 'Es lemon tea', 'Minuman', 'Es lemon tea dengan gula aren yang memberi khas manis yang berbeda', 2500, 1, '3.jpg', 'T1610001'),
('M161000110', 'Bakso super', 'Makanan', 'super super', 40000, 40, '', 'T1610001'),
('M161000201', 'Gado gado jos', 'Makanan', 'Gado gado adalah makan sehat dengan banyak sayur', 8000, 94, 'gado1.jpg', 'T1610002'),
('M161000202', 'Gado gado janti', 'Makanan', 'Gado gado janti adalah warung makan yang berada dibawah jembatan janti', 7000, 20, 'gado2.jpg', 'T1610002'),
('M161000203', 'Gado gado item', 'Makanan', 'Gado gado amplaz adalah warung makan gado gado yang dekan dengan J-Co yang berada diamplaz', 9000, 34, 'gado3.jpg', 'T1610002'),
('M161000204', 'Gado gado sip', 'Makanan', 'Gado gado sleman adalah warung makan gado gado cabang sleman yang berada di sekitar terminal jombor', 10000, 17, 'gado4.jpg', 'T1610002'),
('M161000205', 'Es lemon tea', 'Minuman', 'Es lemon tea dengan gula aren yang memberi khas manis yang berbeda', 2000, 1, '4.jpg', 'T1610002'),
('M161000206', 'Es jusbuah', 'Minuman', 'Es jusbuah dengan campuran buah segar dengan tambahan susu', 5000, 16, '5.jpg', 'T1610002'),
('M161000207', 'Sup buah', 'Minuman', 'Sup buah adalah minuman dengan bermacam-macam buah yang diblender menjadi satu dan ditambahi dengan susu', 4000, 27, '7.jpg', 'T1610002'),
('M161000301', 'Empek piyungan', 'Makanan', 'Empek-empek asli khas palembang joss lho. nak dek pokoke...', 5000, 27, 'empek1.jpg', 'T1610003'),
('M161000302', 'Empek janti', 'Makanan', 'Empek-empek asli khas palembang joss lho. nak dek pokoke...', 6000, 34, 'empek2.jpg', 'T1610003'),
('M161000303', 'Empek amplaz', 'Makanan', 'Empek-empek asli khas palembang joss lho. nak dek pokoke...', 13000, 22, 'empek3.jpg', 'T1610003'),
('M161000304', 'Empek sleman', 'Makanan', 'Empek-empek asli khas palembang joss lho. nak dek pokoke...', 4000, 9, 'empek4.jpg', 'T1610003'),
('M161000305', 'Es dawet', 'Minuman', 'Es dawet dengan gula aren yang memberi khas manis yang berbeda serta tambahan santen yang kental', 2000, 11, '9.jpg', 'T1610003'),
('M161000306', 'Es teh', 'Minuman', 'Es teh dengan gula aren yang memberi khas manis yang berbeda', 1500, 18, '10.jpg', 'T1610003'),
('M161000307', 'Es krim', 'Minuman', 'Es krim rasa susu adalah minuman es yang dibuat dengan susu coklat yang disimpan didalam kulkas dan agar disajikan bisa dingin', 3000, 8, '11.jpg', 'T1610003'),
('M161000401', 'Burger Jumbo', 'Makanan', 'Burger makanan eropa yang banyak disukai masyarakat lokal karena lezat dan nikmatnya', 8000, 12, 'All alone.png', 'T1610004'),
('M161000402', 'Burger janti', 'Makanan', 'Burger makanan eropa yang banyak disukai masyarakat lokal karena lezat dan nikmatnya', 13000, 28, 'burger2.jpg', 'T1610004'),
('M161000403', 'Burger amplaz', 'Makanan', 'Burger makanan eropa yang banyak disukai masyarakat lokal karena lezat dan nikmatnya', 9000, 19, 'burger3.jpg', 'T1610004'),
('M161000404', 'Burger sleman', 'Makanan', 'Burger makanan eropa yang banyak disukai masyarakat lokal karena lezat dan nikmatnya', 11000, 4, 'burger4.jpg', 'T1610004'),
('M161000405', 'Es teh', 'Minuman', 'Es teh dengan gula aren yang memberi khas manis yang berbeda', 1500, 20, '1.jpg', 'T1610004'),
('M161000406', 'Es teh', 'Minuman', 'Es teh dengan gula aren yang memberi khas manis yang berbeda', 2000, 21, '2.jpg', 'T1610004'),
('M161000407', 'Es lemon tea', 'Minuman', 'Es lemon tea dengan gula aren yang memberi khas manis yang berbeda', 2500, 19, '3.jpg', 'T1610004'),
('M161000408', 'Susu', 'Minuman', 'Dengan Susu murni segar', 3000, 21, NULL, 'T1610004');

-- --------------------------------------------------------

--
-- Table structure for table `toko`
--

CREATE TABLE IF NOT EXISTS `toko` (
  `id_toko` char(8) NOT NULL,
  `nama_toko` varchar(100) DEFAULT NULL,
  `diskripsi` text,
  `provinsi` varchar(20) DEFAULT NULL,
  `kota` varchar(50) DEFAULT NULL,
  `alamat` text,
  `telp` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `foto` varchar(250) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `toko`
--

INSERT INTO `toko` (`id_toko`, `nama_toko`, `diskripsi`, `provinsi`, `kota`, `alamat`, `telp`, `email`, `foto`, `password`) VALUES
('FT001', 'PemWok test', NULL, 'Pemwok prov', NULL, NULL, NULL, NULL, NULL, '112'),
('FT002', 'PemWok test', NULL, 'Pemwok prov', NULL, NULL, NULL, NULL, NULL, '112'),
('T1610001', 'Bakso Solo', 'Toko ini menjual bakso daging sapi murni', 'Jawa Tengah', 'Solo', 'Jl.Yosodipuro No.12B Banjarsari', '085678987212', 'Baksosap@gmail.com', 'TOKOBAKSO.jpg', '123'),
('T1610002', 'Gado-Gado', 'Toko ini menjual makanan Gado-gado', 'Yogyakarta', 'Sleman', 'Jl.Tentara Pelajar Km.10,5', '085678987222', 'Bakso@gmail.com', 'tokogado.jpg', '123'),
('T1610003', 'Empek-Empek', 'Toko ini menjual makanan empek empek asli palembang', 'Palembang', 'Kutaikartanegara', 'Jl.Kutaikartanegara Km.10,5', '085678987255', 'empek@gmail.com', 'tokoempek.jpg', '123'),
('T1610004', 'Master Burger', 'Toko ini menjual makanan empek empek asli palembang', 'Palembang', 'Kutaikartanegara', 'Jl.Kutaikartanegara Km.10,5', '085678987255', 'burger@gmail.com', 'tokoburger.jpg', '123'),
('T1612001', 'test Toko', 'testtstst', 'Yogyakarta', 'Kulon Progo', 'test', '45446', 'test@gmail.com', '', '123'),
('T1701001', 'tessss', 'tes dis', 'tes prov', 'tes kot', 'tes alamat', '87878', 't@fff.c', '', '123');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE IF NOT EXISTS `transaksi` (
  `no_transaksi` char(12) NOT NULL,
  `id_pembeli` char(10) DEFAULT NULL,
  `tgl_transaksi` date DEFAULT NULL,
  `status_transaksi` enum('Diterima','Belum diterima') DEFAULT NULL,
  `alamat_pengiriman` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`no_transaksi`, `id_pembeli`, `tgl_transaksi`, `status_transaksi`, `alamat_pengiriman`) VALUES
('NT1612070001', 'P161206001', '2016-12-07', 'Diterima', 'Ngipik'),
('NT1612180001', 'P161014001', '2016-12-18', 'Diterima', 'Pajangan Bantul Yogyakarta'),
('NT1612220001', 'P161014001', '2016-12-22', 'Diterima', 'Halloo'),
('NT1703030001', 'P170303001', '2017-03-03', 'Belum diterima', 'Pajangan Jogja');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `d_transaksi`
--
ALTER TABLE `d_transaksi`
  ADD KEY `no_transaksi` (`no_transaksi`), ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD KEY `id_pembeli` (`id_pembeli`), ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `pembeli`
--
ALTER TABLE `pembeli`
  ADD PRIMARY KEY (`id_pembeli`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`), ADD KEY `id_toko` (`id_toko`);

--
-- Indexes for table `toko`
--
ALTER TABLE `toko`
  ADD PRIMARY KEY (`id_toko`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`no_transaksi`), ADD KEY `id_pembeli` (`id_pembeli`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `d_transaksi`
--
ALTER TABLE `d_transaksi`
ADD CONSTRAINT `d_transaksi_ibfk_1` FOREIGN KEY (`no_transaksi`) REFERENCES `transaksi` (`no_transaksi`),
ADD CONSTRAINT `d_transaksi_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`);

--
-- Constraints for table `keranjang`
--
ALTER TABLE `keranjang`
ADD CONSTRAINT `keranjang_ibfk_1` FOREIGN KEY (`id_pembeli`) REFERENCES `pembeli` (`id_pembeli`),
ADD CONSTRAINT `keranjang_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`);

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`id_toko`) REFERENCES `toko` (`id_toko`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_pembeli`) REFERENCES `pembeli` (`id_pembeli`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
