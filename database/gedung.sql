-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.11-MariaDB - Source distribution
-- Server OS:                    Linux
-- HeidiSQL Version:             12.5.0.6677
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for view dbgedung.q_booking
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `q_booking` (
	`id` INT(11) NOT NULL,
	`id_gedung` VARCHAR(11) NULL COLLATE 'utf8mb4_general_ci',
	`id_fasilitas` VARCHAR(11) NULL COLLATE 'utf8mb4_general_ci',
	`id_penyewa` VARCHAR(11) NULL COLLATE 'utf8mb4_general_ci',
	`tanggal_acara` DATE NULL,
	`harga_gedung` DOUBLE NULL,
	`harga_fasilitas` DOUBLE NULL,
	`dp` DOUBLE NULL,
	`lunas` DOUBLE NULL,
	`tgl` VARCHAR(10) NULL COLLATE 'utf8mb4_general_ci',
	`nama_gedung` VARCHAR(250) NULL COLLATE 'utf8mb4_general_ci',
	`deskripsi` TEXT NULL COLLATE 'utf8mb4_general_ci',
	`kategori` TEXT NULL COLLATE 'latin1_swedish_ci',
	`total` DOUBLE NULL,
	`sisa` DOUBLE NULL,
	`nama_fasilitas` VARCHAR(50) NULL COLLATE 'utf8mb4_general_ci',
	`des_fas` TEXT NULL COLLATE 'utf8mb4_general_ci',
	`nama_penyewa` VARCHAR(50) NULL COLLATE 'utf8mb4_general_ci',
	`nomor_ktp` VARCHAR(50) NULL COLLATE 'utf8mb4_general_ci',
	`alamat` TEXT NULL COLLATE 'utf8mb4_general_ci',
	`nomor_telpon` VARCHAR(20) NULL COLLATE 'utf8mb4_general_ci'
) ENGINE=MyISAM;

-- Dumping structure for view dbgedung.q_gedung
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `q_gedung` (
	`id` INT(11) NOT NULL,
	`nama_gedung` VARCHAR(250) NULL COLLATE 'utf8mb4_general_ci',
	`id_kategori` VARCHAR(11) NULL COLLATE 'utf8mb4_general_ci',
	`deskripsi` TEXT NULL COLLATE 'utf8mb4_general_ci',
	`harga` DOUBLE NULL,
	`kategori` TEXT NULL COLLATE 'latin1_swedish_ci'
) ENGINE=MyISAM;

-- Dumping structure for view dbgedung.q_laporan
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `q_laporan` (
	`id` INT(11) NOT NULL,
	`id_gedung` VARCHAR(11) NULL COLLATE 'utf8mb4_general_ci',
	`id_fasilitas` VARCHAR(11) NULL COLLATE 'utf8mb4_general_ci',
	`id_penyewa` VARCHAR(11) NULL COLLATE 'utf8mb4_general_ci',
	`tanggal_acara` DATE NULL,
	`harga_gedung` DOUBLE NULL,
	`harga_fasilitas` DOUBLE NULL,
	`dp` DOUBLE NULL,
	`lunas` DOUBLE NULL,
	`nama_gedung` VARCHAR(250) NULL COLLATE 'utf8mb4_general_ci',
	`deskripsi` TEXT NULL COLLATE 'utf8mb4_general_ci',
	`kategori` TEXT NULL COLLATE 'latin1_swedish_ci',
	`total` DOUBLE NULL,
	`sisa` DOUBLE NULL,
	`nama_fasilitas` VARCHAR(50) NULL COLLATE 'utf8mb4_general_ci',
	`des_fas` TEXT NULL COLLATE 'utf8mb4_general_ci',
	`nama_penyewa` VARCHAR(50) NULL COLLATE 'utf8mb4_general_ci',
	`nomor_ktp` VARCHAR(50) NULL COLLATE 'utf8mb4_general_ci',
	`alamat` TEXT NULL COLLATE 'utf8mb4_general_ci',
	`nomor_telpon` VARCHAR(20) NULL COLLATE 'utf8mb4_general_ci'
) ENGINE=MyISAM;

-- Dumping structure for view dbgedung.q_lunas
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `q_lunas` (
	`id` INT(11) NOT NULL,
	`id_gedung` VARCHAR(11) NULL COLLATE 'utf8mb4_general_ci',
	`id_fasilitas` VARCHAR(11) NULL COLLATE 'utf8mb4_general_ci',
	`id_penyewa` VARCHAR(11) NULL COLLATE 'utf8mb4_general_ci',
	`tanggal_acara` DATE NULL,
	`harga_gedung` DOUBLE NULL,
	`harga_fasilitas` DOUBLE NULL,
	`dp` DOUBLE NULL,
	`lunas` DOUBLE NULL,
	`tgl` VARCHAR(10) NULL COLLATE 'utf8mb4_general_ci',
	`nama_gedung` VARCHAR(250) NULL COLLATE 'utf8mb4_general_ci',
	`deskripsi` TEXT NULL COLLATE 'utf8mb4_general_ci',
	`kategori` TEXT NULL COLLATE 'latin1_swedish_ci',
	`total` DOUBLE NULL,
	`sisa` DOUBLE NULL,
	`nama_fasilitas` VARCHAR(50) NULL COLLATE 'utf8mb4_general_ci',
	`des_fas` TEXT NULL COLLATE 'utf8mb4_general_ci',
	`nama_penyewa` VARCHAR(50) NULL COLLATE 'utf8mb4_general_ci',
	`nomor_ktp` VARCHAR(50) NULL COLLATE 'utf8mb4_general_ci',
	`alamat` TEXT NULL COLLATE 'utf8mb4_general_ci',
	`nomor_telpon` VARCHAR(20) NULL COLLATE 'utf8mb4_general_ci'
) ENGINE=MyISAM;

-- Dumping structure for table dbgedung.tb_booking
CREATE TABLE IF NOT EXISTS `tb_booking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_gedung` varchar(11) DEFAULT NULL,
  `id_fasilitas` varchar(11) DEFAULT NULL,
  `id_penyewa` varchar(11) DEFAULT NULL,
  `tanggal_acara` date DEFAULT NULL,
  `harga_gedung` double DEFAULT NULL,
  `harga_fasilitas` double DEFAULT NULL,
  `dp` double DEFAULT NULL,
  `lunas` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table dbgedung.tb_booking: ~0 rows (approximately)

-- Dumping structure for table dbgedung.tb_fasilitas
CREATE TABLE IF NOT EXISTS `tb_fasilitas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_fasilitas` varchar(50) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `harga` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table dbgedung.tb_fasilitas: ~0 rows (approximately)

-- Dumping structure for table dbgedung.tb_gedung
CREATE TABLE IF NOT EXISTS `tb_gedung` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_gedung` varchar(250) DEFAULT NULL,
  `id_kategori` varchar(11) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `harga` double DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table dbgedung.tb_gedung: ~0 rows (approximately)

-- Dumping structure for table dbgedung.tb_penyewa
CREATE TABLE IF NOT EXISTS `tb_penyewa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_penyewa` varchar(50) DEFAULT NULL,
  `nomor_ktp` varchar(50) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `nomor_telpon` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table dbgedung.tb_penyewa: ~0 rows (approximately)

-- Dumping structure for table dbgedung.tb_tipe_gedung
CREATE TABLE IF NOT EXISTS `tb_tipe_gedung` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kategori` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table dbgedung.tb_tipe_gedung: ~2 rows (approximately)
INSERT INTO `tb_tipe_gedung` (`id`, `kategori`) VALUES
	(2, 'Acara Umum'),
	(3, 'Acara Pemerintahan'),
	(4, 'Acara Bupati'),
	(5, 'Acara Organisasi');

-- Dumping structure for table dbgedung.tb_users
CREATE TABLE IF NOT EXISTS `tb_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `level` enum('Admin','Guru','Siswa','Wali') NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `remember_me` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- Dumping data for table dbgedung.tb_users: ~1 rows (approximately)
INSERT INTO `tb_users` (`id`, `full_name`, `email`, `username`, `password`, `level`, `status`, `remember_me`) VALUES
	(2, 'Administrator', 'admin@gmail.com', 'Admin', '$2y$10$qGtSTKeASa.Z1PZDD7vAcu.IYSukWOmT.DptVS1xxle98ti85Tpdi', 'Admin', 1, 'PuRrF2IySPM5nDZ8NGvbwlYHkFB5O98sgJad7UGW0Q3JHVAjf4ymx7x6YsRcpu96');

-- Dumping structure for table dbgedung.tb_website
CREATE TABLE IF NOT EXISTS `tb_website` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `school_name` varchar(50) NOT NULL,
  `point` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table dbgedung.tb_website: ~1 rows (approximately)
INSERT INTO `tb_website` (`id`, `school_name`, `point`) VALUES
	(1, 'SI PENYEWAAN GEDUNG', 65);

-- Dumping structure for view dbgedung.q_booking
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `q_booking`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `q_booking` AS select `E`.`id` AS `id`,`E`.`id_gedung` AS `id_gedung`,`E`.`id_fasilitas` AS `id_fasilitas`,`E`.`id_penyewa` AS `id_penyewa`,`E`.`tanggal_acara` AS `tanggal_acara`,`E`.`harga_gedung` AS `harga_gedung`,`E`.`harga_fasilitas` AS `harga_fasilitas`,`E`.`dp` AS `dp`,`E`.`lunas` AS `lunas`,`E`.`tgl` AS `tgl`,`E`.`nama_gedung` AS `nama_gedung`,`E`.`deskripsi` AS `deskripsi`,`E`.`kategori` AS `kategori`,`E`.`total` AS `total`,`E`.`sisa` AS `sisa`,`E`.`nama_fasilitas` AS `nama_fasilitas`,`E`.`des_fas` AS `des_fas`,`E`.`nama_penyewa` AS `nama_penyewa`,`E`.`nomor_ktp` AS `nomor_ktp`,`E`.`alamat` AS `alamat`,`E`.`nomor_telpon` AS `nomor_telpon` from (select `A`.`id` AS `id`,`A`.`id_gedung` AS `id_gedung`,`A`.`id_fasilitas` AS `id_fasilitas`,`A`.`id_penyewa` AS `id_penyewa`,`A`.`tanggal_acara` AS `tanggal_acara`,`A`.`harga_gedung` AS `harga_gedung`,`A`.`harga_fasilitas` AS `harga_fasilitas`,`A`.`dp` AS `dp`,`A`.`lunas` AS `lunas`,date_format(`A`.`tanggal_acara`,'%d-%m-%Y') AS `tgl`,`B`.`nama_gedung` AS `nama_gedung`,`B`.`deskripsi` AS `deskripsi`,`B`.`kategori` AS `kategori`,`A`.`harga_gedung` + `A`.`harga_fasilitas` AS `total`,`A`.`harga_gedung` + `A`.`harga_fasilitas` - `A`.`dp` - `A`.`lunas` AS `sisa`,`C`.`nama_fasilitas` AS `nama_fasilitas`,`C`.`deskripsi` AS `des_fas`,`D`.`nama_penyewa` AS `nama_penyewa`,`D`.`nomor_ktp` AS `nomor_ktp`,`D`.`alamat` AS `alamat`,`D`.`nomor_telpon` AS `nomor_telpon` from (((`dbgedung`.`tb_booking` `A` left join `dbgedung`.`q_gedung` `B` on(`B`.`id` = `A`.`id_gedung`)) left join `dbgedung`.`tb_penyewa` `D` on(`D`.`id` = `A`.`id_penyewa`)) left join `dbgedung`.`tb_fasilitas` `C` on(`C`.`id` = `A`.`id_fasilitas`))) `E` where `E`.`sisa` > 0 order by `E`.`tanggal_acara` desc;

-- Dumping structure for view dbgedung.q_gedung
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `q_gedung`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `q_gedung` AS select `A`.`id` AS `id`,`A`.`nama_gedung` AS `nama_gedung`,`A`.`id_kategori` AS `id_kategori`,`A`.`deskripsi` AS `deskripsi`,`A`.`harga` AS `harga`,`B`.`kategori` AS `kategori` from (`tb_gedung` `A` left join `tb_tipe_gedung` `B` on(`B`.`id` = `A`.`id_kategori`));

-- Dumping structure for view dbgedung.q_laporan
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `q_laporan`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `q_laporan` AS select `E`.`id` AS `id`,`E`.`id_gedung` AS `id_gedung`,`E`.`id_fasilitas` AS `id_fasilitas`,`E`.`id_penyewa` AS `id_penyewa`,`E`.`tanggal_acara` AS `tanggal_acara`,`E`.`harga_gedung` AS `harga_gedung`,`E`.`harga_fasilitas` AS `harga_fasilitas`,`E`.`dp` AS `dp`,`E`.`lunas` AS `lunas`,`E`.`nama_gedung` AS `nama_gedung`,`E`.`deskripsi` AS `deskripsi`,`E`.`kategori` AS `kategori`,`E`.`total` AS `total`,`E`.`sisa` AS `sisa`,`E`.`nama_fasilitas` AS `nama_fasilitas`,`E`.`des_fas` AS `des_fas`,`E`.`nama_penyewa` AS `nama_penyewa`,`E`.`nomor_ktp` AS `nomor_ktp`,`E`.`alamat` AS `alamat`,`E`.`nomor_telpon` AS `nomor_telpon` from (select `A`.`id` AS `id`,`A`.`id_gedung` AS `id_gedung`,`A`.`id_fasilitas` AS `id_fasilitas`,`A`.`id_penyewa` AS `id_penyewa`,`A`.`tanggal_acara` AS `tanggal_acara`,`A`.`harga_gedung` AS `harga_gedung`,`A`.`harga_fasilitas` AS `harga_fasilitas`,`A`.`dp` AS `dp`,`A`.`lunas` AS `lunas`,`B`.`nama_gedung` AS `nama_gedung`,`B`.`deskripsi` AS `deskripsi`,`B`.`kategori` AS `kategori`,`A`.`harga_gedung` + `A`.`harga_fasilitas` AS `total`,`A`.`harga_gedung` + `A`.`harga_fasilitas` - `A`.`dp` - `A`.`lunas` AS `sisa`,`C`.`nama_fasilitas` AS `nama_fasilitas`,`C`.`deskripsi` AS `des_fas`,`D`.`nama_penyewa` AS `nama_penyewa`,`D`.`nomor_ktp` AS `nomor_ktp`,`D`.`alamat` AS `alamat`,`D`.`nomor_telpon` AS `nomor_telpon` from (((`dbgedung`.`tb_booking` `A` left join `dbgedung`.`q_gedung` `B` on(`B`.`id` = `A`.`id_gedung`)) left join `dbgedung`.`tb_penyewa` `D` on(`D`.`id` = `A`.`id_penyewa`)) left join `dbgedung`.`tb_fasilitas` `C` on(`C`.`id` = `A`.`id_fasilitas`))) `E` order by `E`.`tanggal_acara`;

-- Dumping structure for view dbgedung.q_lunas
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `q_lunas`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `q_lunas` AS select `E`.`id` AS `id`,`E`.`id_gedung` AS `id_gedung`,`E`.`id_fasilitas` AS `id_fasilitas`,`E`.`id_penyewa` AS `id_penyewa`,`E`.`tanggal_acara` AS `tanggal_acara`,`E`.`harga_gedung` AS `harga_gedung`,`E`.`harga_fasilitas` AS `harga_fasilitas`,`E`.`dp` AS `dp`,`E`.`lunas` AS `lunas`,`E`.`tgl` AS `tgl`,`E`.`nama_gedung` AS `nama_gedung`,`E`.`deskripsi` AS `deskripsi`,`E`.`kategori` AS `kategori`,`E`.`total` AS `total`,`E`.`sisa` AS `sisa`,`E`.`nama_fasilitas` AS `nama_fasilitas`,`E`.`des_fas` AS `des_fas`,`E`.`nama_penyewa` AS `nama_penyewa`,`E`.`nomor_ktp` AS `nomor_ktp`,`E`.`alamat` AS `alamat`,`E`.`nomor_telpon` AS `nomor_telpon` from (select `A`.`id` AS `id`,`A`.`id_gedung` AS `id_gedung`,`A`.`id_fasilitas` AS `id_fasilitas`,`A`.`id_penyewa` AS `id_penyewa`,`A`.`tanggal_acara` AS `tanggal_acara`,`A`.`harga_gedung` AS `harga_gedung`,`A`.`harga_fasilitas` AS `harga_fasilitas`,`A`.`dp` AS `dp`,`A`.`lunas` AS `lunas`,date_format(`A`.`tanggal_acara`,'%d-%m-%Y') AS `tgl`,`B`.`nama_gedung` AS `nama_gedung`,`B`.`deskripsi` AS `deskripsi`,`B`.`kategori` AS `kategori`,`A`.`harga_gedung` + `A`.`harga_fasilitas` AS `total`,`A`.`harga_gedung` + `A`.`harga_fasilitas` - `A`.`dp` - `A`.`lunas` AS `sisa`,`C`.`nama_fasilitas` AS `nama_fasilitas`,`C`.`deskripsi` AS `des_fas`,`D`.`nama_penyewa` AS `nama_penyewa`,`D`.`nomor_ktp` AS `nomor_ktp`,`D`.`alamat` AS `alamat`,`D`.`nomor_telpon` AS `nomor_telpon` from (((`dbgedung`.`tb_booking` `A` left join `dbgedung`.`q_gedung` `B` on(`B`.`id` = `A`.`id_gedung`)) left join `dbgedung`.`tb_penyewa` `D` on(`D`.`id` = `A`.`id_penyewa`)) left join `dbgedung`.`tb_fasilitas` `C` on(`C`.`id` = `A`.`id_fasilitas`))) `E` where `E`.`sisa` = 0 order by `E`.`tanggal_acara` desc;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
