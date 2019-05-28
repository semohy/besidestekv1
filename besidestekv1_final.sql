-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 28 May 2019, 03:25:27
-- Sunucu sürümü: 5.7.21
-- PHP Sürümü: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `besidestekv1`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `alimdisigider`
--

DROP TABLE IF EXISTS `alimdisigider`;
CREATE TABLE IF NOT EXISTS `alimdisigider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `giderKategori_id` int(11) NOT NULL,
  `adi` varchar(255) NOT NULL,
  `miktar` float NOT NULL,
  `birim` varchar(255) NOT NULL,
  `birim_alis_fiyat` decimal(15,2) NOT NULL,
  `toplam_fiyat` decimal(15,2) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tarih` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `alimdisigider`
--

INSERT INTO `alimdisigider` (`id`, `giderKategori_id`, `adi`, `miktar`, `birim`, `birim_alis_fiyat`, `toplam_fiyat`, `user_id`, `tarih`) VALUES
(6, 19, 'dsads', 1600, 'Kw', '1.20', '1920.00', 1, '2018-12-23'),
(7, 26, 'fdfdfs', 150, 'metreküp', '2.00', '300.00', 1, '2019-05-15');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `gelir_kategori`
--

DROP TABLE IF EXISTS `gelir_kategori`;
CREATE TABLE IF NOT EXISTS `gelir_kategori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adi` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `gelir_kategori`
--

INSERT INTO `gelir_kategori` (`id`, `adi`, `user_id`) VALUES
(2, 'Hayvan Satımı', 1),
(3, 'yün satım', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `gider_kategori`
--

DROP TABLE IF EXISTS `gider_kategori`;
CREATE TABLE IF NOT EXISTS `gider_kategori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `gider_kategori`
--

INSERT INTO `gider_kategori` (`id`, `name`, `user_id`) VALUES
(10, 'yeni2', 1),
(19, 'elektrik', 1),
(25, 'su', 1),
(26, 'doğalgaz', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `hayvankilo_log`
--

DROP TABLE IF EXISTS `hayvankilo_log`;
CREATE TABLE IF NOT EXISTS `hayvankilo_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hayvan_id` int(11) NOT NULL,
  `kupe_no` varchar(255) NOT NULL,
  `kilo` float NOT NULL,
  `user_id` int(11) NOT NULL,
  `updated_at` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `hayvankilo_log`
--

INSERT INTO `hayvankilo_log` (`id`, `hayvan_id`, `kupe_no`, `kilo`, `user_id`, `updated_at`) VALUES
(1, 1, '#tr23sd', 30, 0, '2019-05-27'),
(2, 1, '#tr23sd', 60, 0, '2019-05-27');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `hayvanlar`
--

DROP TABLE IF EXISTS `hayvanlar`;
CREATE TABLE IF NOT EXISTS `hayvanlar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kategori_id` int(11) NOT NULL,
  `kupe_no` varchar(255) NOT NULL,
  `kilo` float NOT NULL,
  `dogum_tarihi` date NOT NULL,
  `giris_tarihi` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `updated_at` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `hayvanlar`
--

INSERT INTO `hayvanlar` (`id`, `kategori_id`, `kupe_no`, `kilo`, `dogum_tarihi`, `giris_tarihi`, `user_id`, `updated_at`) VALUES
(1, 1, '#tr23sd', 60, '2019-04-22', '2019-05-27', 0, '2019-05-27');

--
-- Tetikleyiciler `hayvanlar`
--
DROP TRIGGER IF EXISTS `insert_kilo_log`;
DELIMITER $$
CREATE TRIGGER `insert_kilo_log` AFTER INSERT ON `hayvanlar` FOR EACH ROW Insert into hayvankilo_log (hayvan_id,kupe_no,kilo,updated_at) VALUES (new.id,new.kupe_no,new.kilo,now())
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `update_kilo_log`;
DELIMITER $$
CREATE TRIGGER `update_kilo_log` AFTER UPDATE ON `hayvanlar` FOR EACH ROW Insert into hayvankilo_log (hayvan_id,kupe_no,kilo,updated_at) VALUES (new.id,new.kupe_no,new.kilo,now())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `hayvan_satim`
--

DROP TABLE IF EXISTS `hayvan_satim`;
CREATE TABLE IF NOT EXISTS `hayvan_satim` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kupe_no` varchar(255) NOT NULL,
  `musteri_adSoyad` varchar(255) NOT NULL,
  `musteri_tel` varchar(255) NOT NULL,
  `alis_kg` float NOT NULL,
  `birim_fiyat` decimal(15,2) NOT NULL,
  `iskonto` decimal(15,2) NOT NULL,
  `toplam` decimal(15,2) NOT NULL,
  `tarih` date NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kategoriler`
--

DROP TABLE IF EXISTS `kategoriler`;
CREATE TABLE IF NOT EXISTS `kategoriler` (
  `kategori_id` int(11) NOT NULL AUTO_INCREMENT,
  `kategori_adi` varchar(255) NOT NULL,
  `ust_kategori_id` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`kategori_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `kategoriler`
--

INSERT INTO `kategoriler` (`kategori_id`, `kategori_adi`, `ust_kategori_id`, `user_id`) VALUES
(1, 'Hayvan', '0', 1),
(3, 'Küçükbaş', '0.1', 1),
(4, 'Koç', '0.1.3', 1),
(6, 'Süt', '0', 1),
(5, 'Keçi', '0.1.3', 1),
(7, 'Yün', '0', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `satin_alinanlar`
--

DROP TABLE IF EXISTS `satin_alinanlar`;
CREATE TABLE IF NOT EXISTS `satin_alinanlar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gider_kategorisi` int(11) NOT NULL,
  `stok_kodu` int(11) NOT NULL,
  `miktar` float NOT NULL,
  `toplam_fiyat` decimal(15,2) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tarih` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `satin_alinanlar`
--

INSERT INTO `satin_alinanlar` (`id`, `gider_kategorisi`, `stok_kodu`, `miktar`, `toplam_fiyat`, `user_id`, `tarih`) VALUES
(2, 10, 12, 200, '300.00', 1, '2019-05-24'),
(5, 10, 1, 8, '3100.00', 1, '2019-05-24');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `satisdisigelir`
--

DROP TABLE IF EXISTS `satisdisigelir`;
CREATE TABLE IF NOT EXISTS `satisdisigelir` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adi` varchar(255) NOT NULL,
  `birim` varchar(255) NOT NULL,
  `birim_satis_fiyat` decimal(15,2) NOT NULL,
  `gelirKategori_id` int(11) NOT NULL,
  `miktar` float NOT NULL,
  `toplam_fiyat` decimal(15,2) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tarih` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `satislar`
--

DROP TABLE IF EXISTS `satislar`;
CREATE TABLE IF NOT EXISTS `satislar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gelir_kategorisi` int(11) NOT NULL,
  `stok_kodu` int(11) NOT NULL,
  `miktar` float NOT NULL,
  `toplam_fiyat` decimal(15,2) NOT NULL,
  `iskonto` decimal(15,2) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tarih` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `satislar`
--

INSERT INTO `satislar` (`id`, `gelir_kategorisi`, `stok_kodu`, `miktar`, `toplam_fiyat`, `iskonto`, `user_id`, `tarih`) VALUES
(1, 2, 1, 58, '1856.00', '0.00', 1, '2019-05-05'),
(2, 3, 12, 100, '490.00', '10.00', 1, '2019-05-27'),
(3, 3, 12, 150, '730.00', '20.00', 1, '2019-05-27'),
(4, 3, 12, 25, '125.00', '0.00', 1, '2019-05-27'),
(5, 3, 12, 10, '47.00', '3.00', 1, '2019-05-27');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `stoklar`
--

DROP TABLE IF EXISTS `stoklar`;
CREATE TABLE IF NOT EXISTS `stoklar` (
  `stok_kodu` int(11) NOT NULL AUTO_INCREMENT,
  `adi` varchar(255) NOT NULL,
  `miktar` float DEFAULT NULL,
  `birim` varchar(255) NOT NULL,
  `birim_alis_fiyat` decimal(15,2) NOT NULL,
  `birim_satis_fiyat` decimal(15,2) NOT NULL,
  `alis_satis_birim` varchar(255) NOT NULL,
  `stok_takip` tinyint(1) NOT NULL,
  `kritik_stok_miktar` float DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `updated_at` date NOT NULL,
  PRIMARY KEY (`stok_kodu`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `stoklar`
--

INSERT INTO `stoklar` (`stok_kodu`, `adi`, `miktar`, `birim`, `birim_alis_fiyat`, `birim_satis_fiyat`, `alis_satis_birim`, `stok_takip`, `kritik_stok_miktar`, `user_id`, `updated_at`) VALUES
(1, 'Koyun', 100, 'adet', '25.40', '32.00', 'kg', 1, NULL, 1, '2019-08-14'),
(11, 'yeni stok', 1000, 'kg', '5.00', '0.00', 'kg', 0, NULL, 1, '2019-07-18'),
(12, 'yeni2', 15, 'adet', '10.00', '5.00', 'kg', 1, 20, 1, '2019-05-27'),
(15, 'dsdad', 2, 'sdasd', '2.00', '3.00', 'a', 1, NULL, 1, '2019-05-26');

--
-- Tetikleyiciler `stoklar`
--
DROP TRIGGER IF EXISTS `stok_alim_log`;
DELIMITER $$
CREATE TRIGGER `stok_alim_log` AFTER INSERT ON `stoklar` FOR EACH ROW INSERT INTO stok_log (stok_kodu,miktar,birim_alis_fiyat,birim_satis_fiyat,user_id,updated_at) VALUES (new.stok_kodu,new.miktar,new.birim_alis_fiyat,new.birim_satis_fiyat,new.user_id,new.updated_at)
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `stok_alim_update_log`;
DELIMITER $$
CREATE TRIGGER `stok_alim_update_log` AFTER UPDATE ON `stoklar` FOR EACH ROW INSERT INTO stok_log (stok_kodu,miktar,birim_alis_fiyat,birim_satis_fiyat,user_id,updated_at) VALUES (new.stok_kodu,new.miktar,new.birim_alis_fiyat,new.birim_satis_fiyat,new.user_id,new.updated_at)
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `stok_log_delete`;
DELIMITER $$
CREATE TRIGGER `stok_log_delete` AFTER DELETE ON `stoklar` FOR EACH ROW DELETE FROM stok_log WHERE stok_kodu = old.stok_kodu
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `stok_log`
--

DROP TABLE IF EXISTS `stok_log`;
CREATE TABLE IF NOT EXISTS `stok_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stok_kodu` int(11) NOT NULL,
  `miktar` int(11) DEFAULT NULL,
  `birim_alis_fiyat` decimal(15,2) NOT NULL,
  `birim_satis_fiyat` decimal(15,2) NOT NULL,
  `user_id` int(11) NOT NULL,
  `updated_at` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `stok_log`
--

INSERT INTO `stok_log` (`id`, `stok_kodu`, `miktar`, `birim_alis_fiyat`, `birim_satis_fiyat`, `user_id`, `updated_at`) VALUES
(1, 1, 48, '25.00', '29.60', 1, '2018-09-10'),
(16, 11, 100, '5.00', '0.00', 1, '2019-05-24'),
(17, 12, 200, '10.00', '5.00', 1, '2019-05-24'),
(20, 1, 60, '25.00', '31.60', 1, '2018-10-13'),
(21, 1, 68, '25.40', '32.00', 1, '2019-05-22'),
(22, 1, 30, '25.40', '32.00', 1, '2019-05-24'),
(23, 1, 30, '25.40', '32.00', 1, '2019-06-18'),
(24, 1, 30, '25.40', '32.00', 1, '2019-08-13'),
(25, 1, 100, '25.40', '32.00', 1, '2019-08-14'),
(26, 11, 100, '5.00', '0.00', 1, '2019-05-31'),
(27, 11, 10, '5.00', '0.00', 1, '2019-05-31'),
(28, 11, 10, '5.00', '0.00', 1, '2019-07-18'),
(29, 11, 1000, '5.00', '0.00', 1, '2019-07-18'),
(30, 15, 2, '2.00', '3.00', 1, '2019-05-26'),
(31, 12, 300, '10.00', '5.00', 1, '2019-05-27'),
(32, 12, 200, '10.00', '5.00', 1, '2019-05-27'),
(33, 12, 50, '10.00', '5.00', 1, '2019-05-27'),
(34, 12, 25, '10.00', '5.00', 1, '2019-05-27'),
(35, 12, 50, '10.00', '5.00', 1, '2019-05-27'),
(36, 12, 25, '10.00', '5.00', 1, '2019-05-27'),
(37, 12, 15, '10.00', '5.00', 1, '2019-05-27');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 'test', 'semih-yarar@hotmail.com', '$2y$10$F.1IYSGR0TFhwwozC2IbIuUEgMbqLfporHECp9hMSJnZH4pGVQT46', 2, '2019-05-19 13:02:03', '2019-05-19 13:02:03'),
(4, 'dsdsadas', 'test@test.com', '$2y$10$RfJmJfdqq3XNIEi7fbyiDu06msS9j/Hr9bthc8PJa3BeekGc3EV6K', 2, '2019-05-19 16:04:35', '2019-05-19 16:04:35');

-- --------------------------------------------------------

--
-- Görünüm yapısı durumu `view_gelirler`
-- (Asıl görünüm için aşağıya bakın)
--
DROP VIEW IF EXISTS `view_gelirler`;
CREATE TABLE IF NOT EXISTS `view_gelirler` (
`kategori` int(11)
,`toplam` decimal(15,2)
,`user_id` int(11)
,`tarih` date
);

-- --------------------------------------------------------

--
-- Görünüm yapısı durumu `view_giderler`
-- (Asıl görünüm için aşağıya bakın)
--
DROP VIEW IF EXISTS `view_giderler`;
CREATE TABLE IF NOT EXISTS `view_giderler` (
`kategori` int(11)
,`toplam` decimal(15,2)
,`user_id` int(11)
,`tarih` date
);

-- --------------------------------------------------------

--
-- Görünüm yapısı `view_gelirler`
--
DROP TABLE IF EXISTS `view_gelirler`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_gelirler`  AS  select `gelirler`.`kategori` AS `kategori`,`gelirler`.`toplam` AS `toplam`,`gelirler`.`user_id` AS `user_id`,`gelirler`.`tarih` AS `tarih` from (select `satislar`.`gelir_kategorisi` AS `kategori`,`satislar`.`toplam_fiyat` AS `toplam`,`satislar`.`tarih` AS `tarih`,`satislar`.`user_id` AS `user_id` from `satislar` union select `satisdisigelir`.`gelirKategori_id` AS `kategori`,`satisdisigelir`.`toplam_fiyat` AS `toplam`,`satisdisigelir`.`tarih` AS `tarih`,`satisdisigelir`.`user_id` AS `user_id` from `satisdisigelir`) `gelirler` ;

-- --------------------------------------------------------

--
-- Görünüm yapısı `view_giderler`
--
DROP TABLE IF EXISTS `view_giderler`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_giderler`  AS  select `giderler`.`kategori` AS `kategori`,`giderler`.`toplam` AS `toplam`,`giderler`.`user_id` AS `user_id`,`giderler`.`tarih` AS `tarih` from (select `satin_alinanlar`.`gider_kategorisi` AS `kategori`,`satin_alinanlar`.`toplam_fiyat` AS `toplam`,`satin_alinanlar`.`tarih` AS `tarih`,`satin_alinanlar`.`user_id` AS `user_id` from `satin_alinanlar` union select `alimdisigider`.`giderKategori_id` AS `kategori`,`alimdisigider`.`toplam_fiyat` AS `toplam`,`alimdisigider`.`tarih` AS `tarih`,`alimdisigider`.`user_id` AS `user_id` from `alimdisigider`) `giderler` ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
