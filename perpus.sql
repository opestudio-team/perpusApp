/*
SQLyog Enterprise v10.42 
MySQL - 5.5.5-10.1.9-MariaDB : Database - perpus
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`perpus` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `perpus`;

/*Table structure for table `tb_last_kode` */

DROP TABLE IF EXISTS `tb_last_kode`;

CREATE TABLE `tb_last_kode` (
  `id_name` varchar(25) DEFAULT NULL,
  `last_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_last_kode` */

insert  into `tb_last_kode`(`id_name`,`last_id`) values ('kode_produk',0);

/*Table structure for table `tb_m_buku` */

DROP TABLE IF EXISTS `tb_m_buku`;

CREATE TABLE `tb_m_buku` (
  `id_buku` int(11) NOT NULL AUTO_INCREMENT,
  `kode_buku` varchar(15) NOT NULL,
  `nama_buku` varchar(50) NOT NULL,
  `ucode_buku` varchar(16) NOT NULL,
  `ucode_pengarang` varchar(16) NOT NULL,
  `ucode_penerbit` varchar(16) NOT NULL,
  `ucode_kategori` varchar(16) NOT NULL,
  `tahun_terbit` date NOT NULL,
  PRIMARY KEY (`id_buku`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tb_m_buku` */

insert  into `tb_m_buku`(`id_buku`,`kode_buku`,`nama_buku`,`ucode_buku`,`ucode_pengarang`,`ucode_penerbit`,`ucode_kategori`,`tahun_terbit`) values (1,'B0001','Buku baru','','','','','0000-00-00'),(2,'B0002','Buku baru','','','','','0000-00-00');

/*Table structure for table `tb_m_kategori` */

DROP TABLE IF EXISTS `tb_m_kategori`;

CREATE TABLE `tb_m_kategori` (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `ucode_kategori` varchar(16) NOT NULL,
  `nama_kategori` varchar(25) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_m_kategori` */

/*Table structure for table `tb_m_penerbit` */

DROP TABLE IF EXISTS `tb_m_penerbit`;

CREATE TABLE `tb_m_penerbit` (
  `id_penerbit` int(11) NOT NULL AUTO_INCREMENT,
  `ucode_penerbit` varchar(15) NOT NULL,
  `nama_penerbit` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  PRIMARY KEY (`id_penerbit`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_m_penerbit` */

/*Table structure for table `tb_m_pengarang` */

DROP TABLE IF EXISTS `tb_m_pengarang`;

CREATE TABLE `tb_m_pengarang` (
  `id_pengarang` int(11) NOT NULL AUTO_INCREMENT,
  `ucode_pengarang` varchar(16) NOT NULL,
  `nama_pengarang` varchar(50) NOT NULL,
  PRIMARY KEY (`id_pengarang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_m_pengarang` */

/*Table structure for table `tb_m_pengembalian` */

DROP TABLE IF EXISTS `tb_m_pengembalian`;

CREATE TABLE `tb_m_pengembalian` (
  `id_pengembalian` int(11) NOT NULL AUTO_INCREMENT,
  `no_pinjam` varchar(15) NOT NULL,
  `ucode_buku` varchar(16) NOT NULL,
  `ucode_siswa` varchar(16) NOT NULL,
  `tgl_kembali` date NOT NULL,
  PRIMARY KEY (`id_pengembalian`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_m_pengembalian` */

/*Table structure for table `tb_m_pinjam` */

DROP TABLE IF EXISTS `tb_m_pinjam`;

CREATE TABLE `tb_m_pinjam` (
  `id_pinjam` int(11) NOT NULL AUTO_INCREMENT,
  `no_pinjam` varchar(25) NOT NULL,
  `ucode_buku` varchar(16) NOT NULL,
  `ucode_siswa` varchar(16) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  PRIMARY KEY (`id_pinjam`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_m_pinjam` */

/*Table structure for table `tb_m_user` */

DROP TABLE IF EXISTS `tb_m_user`;

CREATE TABLE `tb_m_user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `ucode_user` varchar(16) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(125) NOT NULL,
  `password_salt` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `kategori_user` varchar(25) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_m_user` */

/*Table structure for table `tb_uniq_code` */

DROP TABLE IF EXISTS `tb_uniq_code`;

CREATE TABLE `tb_uniq_code` (
  `code_name` varchar(25) DEFAULT NULL,
  `id_code` int(11) DEFAULT NULL,
  `last_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_uniq_code` */

insert  into `tb_uniq_code`(`code_name`,`id_code`,`last_id`) values ('buku',101,0),('pengarang',102,0),('penerbit',103,0),('kategori',104,0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
