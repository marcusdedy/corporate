-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Inang: 127.0.0.1
-- Waktu pembuatan: 09 Des 2018 pada 21.03
-- Versi Server: 5.5.27
-- Versi PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Basis data: `corporate`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `faktur_jual`
--

CREATE TABLE IF NOT EXISTS `faktur_jual` (
  `faktur` varchar(15) NOT NULL,
  `date_faktur` date NOT NULL,
  `tot_qty` int(5) NOT NULL,
  `tot_price` int(15) NOT NULL,
  `po_number` varchar(25) NOT NULL,
  `user_input_faktur` varchar(10) NOT NULL,
  `update_date_faktur` datetime NOT NULL,
  PRIMARY KEY (`faktur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `invoice`
--

CREATE TABLE IF NOT EXISTS `invoice` (
  `invoice_number` varchar(32) NOT NULL,
  `invoice_date` date NOT NULL,
  `sub_total` int(15) NOT NULL,
  `ppn` int(15) NOT NULL,
  `total` int(15) NOT NULL,
  `user_id_approve` varchar(10) NOT NULL,
  `user_print_invoice` varchar(10) NOT NULL,
  `invoice_noted` varchar(50) NOT NULL,
  `faktur` varchar(15) NOT NULL,
  `resi_number` varchar(32) NOT NULL,
  `resi_input_date` date NOT NULL,
  `file_tax` varchar(50) NOT NULL,
  `upload_date_tax` date NOT NULL,
  `invoice_paid` varchar(15) NOT NULL,
  `date_of_payment` date NOT NULL,
  `user_input_payment` varchar(10) NOT NULL,
  `user_date_input_payment` date NOT NULL,
  PRIMARY KEY (`invoice_number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_company`
--

CREATE TABLE IF NOT EXISTS `master_company` (
  `company_id` varchar(10) NOT NULL,
  `company_name` varchar(50) NOT NULL,
  `update_date` datetime NOT NULL,
  PRIMARY KEY (`company_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `master_company`
--

INSERT INTO `master_company` (`company_id`, `company_name`, `update_date`) VALUES
('SAT', 'Alfamart', '2018-12-06 02:45:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_customer`
--

CREATE TABLE IF NOT EXISTS `master_customer` (
  `customer_id` varchar(6) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `customer_address` varchar(100) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `company_id` varchar(10) NOT NULL,
  `for_attention` varchar(25) NOT NULL,
  `user_update` varchar(10) NOT NULL,
  `update_date` datetime NOT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `master_customer`
--

INSERT INTO `master_customer` (`customer_id`, `customer_name`, `customer_address`, `phone_number`, `company_id`, `for_attention`, `user_update`, `update_date`) VALUES
('az001', 'SERPONG', 'SERPONG', '748923748728', 'SAT', 'JONI', 'user', '2018-12-07 10:10:51');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_employee`
--

CREATE TABLE IF NOT EXISTS `master_employee` (
  `user_id` varchar(10) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `department` varchar(9) NOT NULL,
  `position` varchar(12) NOT NULL,
  `update_date` datetime NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `master_employee`
--

INSERT INTO `master_employee` (`user_id`, `user_name`, `password`, `department`, `position`, `update_date`) VALUES
('user', 'User Buyer', '289dff07669d7a23de0ef88d2f7129e7', 'Buyer', 'Coordinator', '2018-12-04 01:00:00'),
('user2', 'User Warehouse', '289dff07669d7a23de0ef88d2f7129e7', 'Warehouse', 'Coordinator', '2018-12-04 01:00:00'),
('user3', 'User Finance', '289dff07669d7a23de0ef88d2f7129e7', 'Finance', 'Coordinator', '2018-12-04 01:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_product`
--

CREATE TABLE IF NOT EXISTS `master_product` (
  `product_id` varchar(6) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `cost` int(10) NOT NULL,
  `margin` int(10) NOT NULL,
  `price` int(10) NOT NULL,
  `status` varchar(1) NOT NULL,
  `update_date` datetime NOT NULL,
  `user_update` varchar(10) NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `master_product`
--

INSERT INTO `master_product` (`product_id`, `product_name`, `cost`, `margin`, `price`, `status`, `update_date`, `user_update`) VALUES
('234', 'dji sam soe', 15000, 5000, 20000, 'T', '2018-12-07 11:50:25', 'user'),
('456', 'test', 9000, 600, 9600, 'T', '2018-12-08 09:24:48', 'user');

-- --------------------------------------------------------

--
-- Struktur dari tabel `purchase_order_detail`
--

CREATE TABLE IF NOT EXISTS `purchase_order_detail` (
  `po_number` varchar(25) NOT NULL,
  `product_id` varchar(6) NOT NULL,
  `qty` int(5) NOT NULL,
  `total` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `purchase_order_detail`
--

INSERT INTO `purchase_order_detail` (`po_number`, `product_id`, `qty`, `total`) VALUES
('test', '234', 2, 40000),
('xxx-001', '234', 2, 40000),
('xxx-001', '456', 2, 19200),
('t-01', '234', 4, 80000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `purchase_order_header`
--

CREATE TABLE IF NOT EXISTS `purchase_order_header` (
  `po_number` varchar(25) NOT NULL,
  `po_date` date NOT NULL,
  `customer_id` varchar(6) NOT NULL,
  `input_date` datetime NOT NULL,
  `user_input` varchar(10) NOT NULL,
  `po_noted` varchar(50) NOT NULL,
  `upload_file_date` datetime NOT NULL,
  `file_name_detail` varchar(50) NOT NULL,
  `user_upload_file` varchar(10) NOT NULL,
  PRIMARY KEY (`po_number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `purchase_order_header`
--

INSERT INTO `purchase_order_header` (`po_number`, `po_date`, `customer_id`, `input_date`, `user_input`, `po_noted`, `upload_file_date`, `file_name_detail`, `user_upload_file`) VALUES
('t-01', '0000-00-00', '', '2018-12-09 03:19:35', 'user', '', '0000-00-00 00:00:00', '', ''),
('test', '2018-12-08', 'az001', '2018-12-09 03:04:00', 'user', 'test', '2018-12-09 08:39:38', 'jojostore.PNG', 'user'),
('xxx-001', '2018-12-09', 'az001', '2018-12-09 03:04:50', 'user', 'dsdsdsd', '0000-00-00 00:00:00', '', ''),
('XXXX-001', '0000-00-00', '', '2018-12-09 03:15:54', 'user', '', '0000-00-00 00:00:00', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tmp_purchase_order_dtl`
--

CREATE TABLE IF NOT EXISTS `tmp_purchase_order_dtl` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `product_id` varchar(10) DEFAULT NULL,
  `price` int(15) DEFAULT NULL,
  `qty` int(10) DEFAULT NULL,
  `user_id` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=74 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
