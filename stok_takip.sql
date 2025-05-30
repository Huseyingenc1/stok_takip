-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 30 May 2025, 13:42:28
-- Sunucu sürümü: 9.1.0
-- PHP Sürümü: 8.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `stok_takip`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `genel_stok`
--

DROP TABLE IF EXISTS `genel_stok`;
CREATE TABLE IF NOT EXISTS `genel_stok` (
  `id` int NOT NULL AUTO_INCREMENT,
  `urun_adi` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL,
  `model` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL,
  `kw` varchar(250) COLLATE utf8mb4_turkish_ci NOT NULL,
  `onceki_siparis_adedi` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci DEFAULT NULL,
  `kalan_adet` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL,
  `guncel_siparis_adedi` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL,
  `siparis_verildigi_yer` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL,
  `siparis_tarihi` datetime NOT NULL,
  `siparis_veren_kisi` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL,
  `siparis_durumu` text CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=124 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `genel_stok`
--

INSERT INTO `genel_stok` (`id`, `urun_adi`, `model`, `kw`, `onceki_siparis_adedi`, `kalan_adet`, `guncel_siparis_adedi`, `siparis_verildigi_yer`, `siparis_tarihi`, `siparis_veren_kisi`, `siparis_durumu`, `updated_at`, `created_at`, `deleted_at`) VALUES
(1, 'SCHNEIDER', 'ATV320', '0.55', '16', '13', '0', 'KONYA ENERJİ', '2025-05-29 10:42:00', 'HÜSEYİN YOLDAŞ', 'sipariş beklemede', '2025-05-30 10:43:29', '2025-05-30 10:43:29', NULL),
(2, 'SCHNEIDER', 'ATV320', '0.75', '16', '15', '0', 'KONYA ENERJİ', '2025-05-29 10:42:00', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 10:43:29', '2025-05-30 10:43:29', NULL),
(3, 'SCHNEIDER', 'ATV320', '1.1', '16', '4', '0', 'KONYA ENERJİ', '2025-05-29 10:42:33', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 10:43:29', '2025-05-30 10:43:29', NULL),
(4, 'SCHNEIDER', 'ATV320', '1.5', '16', '16', '0', 'KONYA ENERJİ', '2025-05-29 10:42:33', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 10:43:29', '2025-05-30 10:43:29', NULL),
(5, 'SCHNEIDER', 'ATV320', '2.2', '9', '7', '0', 'KONYA ENERJİ', '2025-05-29 10:42:33', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 10:43:29', '2025-05-30 10:43:29', NULL),
(6, 'SCHNEIDER', 'ATV320', '3', '9', '0', '0', 'KONYA ENERJİ', '2025-05-29 10:42:33', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 10:43:29', '2025-05-30 10:43:29', NULL),
(7, 'SCHNEIDER', 'ATV320', '4', '18', '13', '0', 'KONYA ENERJİ', '2025-05-29 10:42:33', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 10:43:29', '2025-05-30 10:43:29', NULL),
(8, 'SCHNEIDER', 'ATV320', '5.5', '10', '7', '0', 'KONYA ENERJİ', '2025-05-29 10:42:33', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 10:43:29', '2025-05-30 10:43:29', NULL),
(9, 'SCHNEIDER', 'ATV320', '7.5', '10', '2', '0', 'KONYA ENERJİ', '2025-05-29 10:42:33', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 10:43:29', '2025-05-30 10:43:29', NULL),
(10, 'SCHNEIDER', 'ATV320', '11', '8', '6', '0', 'KONYA ENERJİ', '2025-05-29 10:42:33', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 10:43:29', '2025-05-30 10:43:29', NULL),
(11, 'SCHNEIDER', 'ATV340', '11', '16', '0', '0', 'KONYA ENERJİ', '2025-05-29 10:42:33', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 10:43:29', '2025-05-30 10:43:29', NULL),
(12, 'SCHNEIDER', 'ATV340', '15', '4', '3', '0', 'KONYA ENERJİ', '2025-05-29 10:42:33', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 10:43:29', '2025-05-30 10:43:29', NULL),
(13, 'SCHNEIDER', 'ATV340', '18.5', '4', '2', '0', 'KONYA ENERJİ', '2025-05-29 10:42:33', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 10:43:29', '2025-05-30 10:43:29', NULL),
(14, 'SCHNEIDER', 'ATV340', '22', '4', '2', '0', 'klemsan', '2025-05-29 10:42:33', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 10:43:29', '2025-05-30 10:43:29', NULL),
(15, 'LENZE', 'İ550', '0.55', '20', '6', '0', 'KONYA ENERJİ', '2025-05-29 10:42:00', 'HÜSEYİN YOLDAŞ', 'sipariş beklemede', '2025-05-30 10:43:29', '2025-05-30 10:43:29', NULL),
(16, 'LENZE', 'İ550', '0.75', '20', '0', '0', 'KONYA ENERJİ', '2025-05-29 10:42:33', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 10:43:29', '2025-05-30 10:43:29', NULL),
(29, 'AKKOR', 'AKKOR', '0.5', '50', '40', '0', 'KONYA ENERJİ', '2025-05-30 11:34:21', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 14:36:38', '2025-05-30 14:36:38', NULL),
(18, 'LENZE', 'İ550', '1.5', '20', '2', '0', 'KONYA ENERJİ', '2025-05-29 10:42:33', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 10:43:29', '2025-05-30 10:43:29', NULL),
(28, 'LENZE', 'İ550', '22\r\n', '0', '1', '10', 'KONYA ENERJİ', '2025-05-29 10:42:33', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 10:43:29', '2025-05-30 10:43:29', NULL),
(20, 'LENZE', 'İ550', '3', '20', '2', '0', 'KONYA ENERJİ', '2025-05-29 10:42:33', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 10:43:29', '2025-05-30 10:43:29', NULL),
(21, 'LENZE', 'İ550', '4 ', '20', '2', '0', 'KONYA ENERJİ', '2025-05-29 10:42:33', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 10:43:29', '2025-05-30 10:43:29', NULL),
(22, 'LENZE', 'İ550', '5.5', '20', '0', '0', 'KONYA ENERJİ', '2025-05-29 10:42:33', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 10:43:29', '2025-05-30 10:43:29', NULL),
(23, 'LENZE', 'İ550', '7.5', '20', '1', '0', 'KONYA ENERJİ', '2025-05-29 10:42:33', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 10:43:29', '2025-05-30 10:43:29', NULL),
(24, 'LENZE', 'İ550', '11', '20', '15', '0', 'KONYA ENERJİ', '2025-05-29 10:42:33', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 10:43:29', '2025-05-30 10:43:29', NULL),
(25, 'LENZE', 'İ550', '15', '10', '0', '0', 'KONYA ENERJİ', '2025-05-29 10:42:33', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 10:43:29', '2025-05-30 10:43:29', NULL),
(26, 'LENZE', 'İ550', '18.5', '10', '1', '10', 'KONYA ENERJİ', '2025-05-29 10:42:33', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 10:43:29', '2025-05-30 10:43:29', NULL),
(27, 'LENZE', 'İ550', '22', '25', '5', '20', 'KONYA ENERJİ', '2025-05-29 10:42:33', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 10:43:29', '2025-05-30 10:43:29', NULL),
(30, 'AKKOR', 'AKKOR', '1.5 ', '50', '10', '0', 'KONYA ENERJİ', '2025-05-30 11:34:21', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 14:36:38', '2025-05-30 14:36:38', NULL),
(31, 'AKKOR ', 'AKKOR ', '1.7', '30', '25', '0', 'KONYA ENERJİ', '2025-05-30 11:36:40', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 14:38:11', '2025-05-30 14:38:11', NULL),
(32, 'AKKOR ', 'AKKOR', '3.5', '72', '32', '0', 'KONYA ENERJİ', '2025-05-30 11:36:40', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 14:38:11', '2025-05-30 14:38:11', NULL),
(33, 'AKKOR ', 'AKKOR ', '8 ', '40', '32', '0', 'KONYA ENERJİ', '2025-05-30 11:38:18', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 14:39:49', '2025-05-30 14:39:49', NULL),
(34, 'AKKOR ', 'AKKOR', '13 ', '24', '13', '0', 'KONYA ENERJİ', '2025-05-30 11:38:18', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 14:39:49', '2025-05-30 14:39:49', NULL),
(35, 'AKKOR ', 'AKKOR', '30', '8', '8', '0', 'KONYA ENERJİ', '2025-05-30 11:40:06', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 14:41:50', '2025-05-30 14:41:50', NULL),
(36, 'CRESTECH', 'CRESTECH', '0.7', '50', '25', '0', 'KONYA ENERJİ', '2025-05-30 11:40:06', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 14:41:50', '2025-05-30 14:41:50', NULL),
(37, 'CRESTECH', 'CRESTECH', '1.7 ', '50', '45', '0', 'KONYA ENERJİ', '2025-05-30 11:41:52', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 14:43:19', '2025-05-30 14:43:19', NULL),
(38, 'CRESTECH', 'CRESTECH', '3.5', '80', '30', '0', 'KONYA ENERJİ', '2025-05-30 11:41:52', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 14:43:19', '2025-05-30 14:43:19', NULL),
(39, 'CRESTECH', 'CRESTECH', '8', '15', '5', '0', 'KONYA ENERJİ', '2025-05-30 11:43:26', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 14:45:21', '2025-05-30 14:45:21', NULL),
(40, 'SCADA NORMAL PANO', '40 X 55 X 20', '0', '50', '20', '0', 'SCADA', '2025-05-30 11:43:26', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 14:45:21', '2025-05-30 14:45:21', NULL),
(41, 'SCADA NORMAL PANO', '40 X 65 X 20', '0', '50', '20', '0', 'SCADA', '2025-05-30 11:47:37', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 14:48:27', '2025-05-30 14:48:27', NULL),
(42, 'SCADA NORMAL PANO', '53 X 55 X 21', '0', '50', '20', '0', 'SCADA', '2025-05-30 11:43:26', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 14:45:21', '2025-05-30 14:45:21', NULL),
(43, 'SCADA NORMAL PANO', '53 X 70 X 25', '0', '50', '20', '0', 'SCADA', '2025-05-30 11:47:37', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 14:48:27', '2025-05-30 14:48:27', NULL),
(44, 'SCADA NORMAL PANO', '53 X 80 X 26', '0', '50', '20', '0', 'SCADA', '2025-05-30 11:43:26', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 14:45:21', '2025-05-30 14:45:21', NULL),
(45, 'SCADA NORMAL PANO', '53 X 100 X 26', '0', '50', '20', '0', 'SCADA', '2025-05-30 11:47:37', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 14:48:27', '2025-05-30 14:48:27', NULL),
(46, 'SCADA NORMAL PANO', '60 X 110 X 28', '0', '50', '20', '0', 'SCADA', '2025-05-30 11:43:26', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 14:45:21', '2025-05-30 14:45:21', NULL),
(47, 'SCADA NORMAL PANO', '65 X 125 X 30', '0', '50', '20', '0', 'SCADA', '2025-05-30 11:47:37', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 14:48:27', '2025-05-30 14:48:27', NULL),
(48, 'SCADA NORMAL PANO', '75 X 125 X 30', '0', '50', '20', '0', 'SCADA', '2025-05-30 11:47:37', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 14:48:27', '2025-05-30 14:48:27', NULL),
(49, 'SCADA ÇATILI PANO', '53 X 100 X 26', '0', '50', '20', '0', 'SCADA', '2025-05-30 11:43:26', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 14:45:21', '2025-05-30 14:45:21', NULL),
(50, 'SCADA ÇATILI PANO', '60 X 110 X 28', '0', '50', '20', '0', 'SCADA', '2025-05-30 11:47:37', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 14:48:27', '2025-05-30 14:48:27', NULL),
(51, 'SCADA ÇATILI PANO', '65 X 125 X 30', '0', '50', '20', '0', 'SCADA', '2025-05-30 11:43:26', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 14:45:21', '2025-05-30 14:45:21', NULL),
(52, 'SCADA ÇATILI PANO', '65 X 125 X 30', '0', '50', '20', '0', 'SCADA', '2025-05-30 11:47:37', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 14:48:27', '2025-05-30 14:48:27', NULL),
(53, 'SCADA ÇATILI PANO', '75 X 125 X 30', '0', '50', '20', '0', 'SCADA', '2025-05-30 11:43:26', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 14:45:21', '2025-05-30 14:45:21', NULL),
(54, 'SCADA DİRENÇ PANOSU', '64 X 75 X 30', '0', '50', '20', '0', 'SCADA', '2025-05-30 11:47:37', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 14:48:27', '2025-05-30 14:48:27', NULL),
(55, 'SCADA KÖPRÜ GALVANİZLİ KAREBUAT', '18 X 31 X 9 ', '0', '50', '20', '0', 'SCADA', '2025-05-30 11:47:37', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 14:48:27', '2025-05-30 14:48:27', NULL),
(56, 'SCADA KEDİ KAREBUAT', '18 X 31 X 9 ', '0', '50', '20', '0', 'SCADA', '2025-05-30 11:47:37', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 14:48:27', '2025-05-30 14:48:27', NULL),
(57, 'SCADA AYAKLI KAREBUAT', '50 X 40 X 16', '0', '50', '20', '0', 'SCADA', '2025-05-30 11:47:37', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 14:48:27', '2025-05-30 14:48:27', NULL),
(58, 'SCADA KUMANDA MUHAFAZA PANOSU', '69 X 15 X 15', '0', '50', '20', '0', 'SCADA', '2025-05-30 11:47:37', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 14:48:27', '2025-05-30 14:48:27', NULL),
(59, 'SCHNEIDER SİGORTA', 'EASY PRO SERİSİ', '3 X C6A', '30', '12', '0', 'KONYA ENERJİ', '2025-05-30 11:58:17', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede\r\n', '2025-05-30 15:01:36', '2025-05-30 15:01:36', NULL),
(60, 'SCHNEIDER SİGORTA', 'EASY PRO SERİSİ', '3 X C10A', '30', '12', '0', 'KONYA ENERJİ', '2025-05-30 11:58:17', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede\r\n', '2025-05-30 15:01:36', '2025-05-30 15:01:36', NULL),
(61, 'SCHNEIDER SİGORTA', 'EASY PRO SERİSİ', '3 X C16A', '30', '12', '0', 'KONYA ENERJİ', '2025-05-30 11:58:17', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede\r\n', '2025-05-30 15:01:36', '2025-05-30 15:01:36', NULL),
(62, 'SCHNEIDER SİGORTA', 'EASY PRO SERİSİ', '3 X C25A', '30', '12', '0', 'KONYA ENERJİ', '2025-05-30 11:58:17', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede\r\n', '2025-05-30 15:01:36', '2025-05-30 15:01:36', NULL),
(63, 'SCHNEIDER SİGORTA', 'EASY PRO SERİSİ', '3 X C32A', '30', '12', '0', 'KONYA ENERJİ', '2025-05-30 11:58:17', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede\r\n', '2025-05-30 15:01:36', '2025-05-30 15:01:36', NULL),
(64, 'SCHNEIDER SİGORTA', 'EASY PRO SERİSİ', '3 X C40A', '30', '12', '0', 'KONYA ENERJİ', '2025-05-30 11:58:17', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede\r\n', '2025-05-30 15:01:36', '2025-05-30 15:01:36', NULL),
(65, 'SCHNEIDER SİGORTA', 'EASY PRO SERİSİ', '3 X C63A', '30', '12', '0', 'KONYA ENERJİ', '2025-05-30 11:58:17', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede\r\n', '2025-05-30 15:01:36', '2025-05-30 15:01:36', NULL),
(66, 'SCHNEIDER SİGORTA', 'EASY PRO SERİSİ', '3 X C80', '30', '12', '0', 'KONYA ENERJİ', '2025-05-30 11:58:17', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede\r\n', '2025-05-30 15:01:36', '2025-05-30 15:01:36', NULL),
(67, 'SCHNEIDER SİGORTA', 'EASY PRO SERİSİ', '3 X C100A', '30', '12', '0', 'KONYA ENERJİ', '2025-05-30 11:58:17', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede\r\n', '2025-05-30 15:01:36', '2025-05-30 15:01:36', NULL),
(68, 'SCHNEIDER SİGORTA', 'EASY PRO SERİSİ', '3 X C125A', '30', '12', '0', 'KONYA ENERJİ', '2025-05-30 11:58:17', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede\r\n', '2025-05-30 15:01:36', '2025-05-30 15:01:36', NULL),
(69, 'SCHNEIDER SİGORTA', 'EASY PRO SERİSİ', '2 X C6A', '30', '12', '0', 'KONYA ENERJİ', '2025-05-30 11:58:17', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede\r\n', '2025-05-30 15:01:36', '2025-05-30 15:01:36', NULL),
(70, 'SCHNEIDER SİGORTA', 'EASY PRO SERİSİ', '2 X C10A', '30', '12', '0', 'KONYA ENERJİ', '2025-05-30 11:58:17', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede\r\n', '2025-05-30 15:01:36', '2025-05-30 15:01:36', NULL),
(71, 'SCHNEIDER SİGORTA', 'EASY PRO SERİSİ', '1 X C6A', '30', '12', '0', 'KONYA ENERJİ', '2025-05-30 11:58:17', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede\r\n', '2025-05-30 15:01:36', '2025-05-30 15:01:36', NULL),
(72, 'SCHNEIDER SİGORTA', 'EASY PRO SERİSİ', '1 X C10A', '30', '12', '0', 'KONYA ENERJİ', '2025-05-30 11:58:17', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede\r\n', '2025-05-30 15:01:36', '2025-05-30 15:01:36', NULL),
(73, 'SCHNEIDER SİGORTA', 'EASY PRO SERİSİ', '1 X C16A', '30', '12', '0', 'KONYA ENERJİ', '2025-05-30 11:58:17', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede\r\n', '2025-05-30 15:01:36', '2025-05-30 15:01:36', NULL),
(74, 'SCHNEIDER SİGORTA', 'EASY PRO SERİSİ', '1 X C32A', '30', '12', '0', 'KONYA ENERJİ', '2025-05-30 11:58:17', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede\r\n', '2025-05-30 15:01:36', '2025-05-30 15:01:36', NULL),
(75, 'SIEMENS KONDAKTÖR', '3RT2015', '3 ', '30', '12', '0', 'KONYA ENERJİ', '2025-05-30 11:58:17', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede\r\n', '2025-05-30 15:01:36', '2025-05-30 15:01:36', NULL),
(76, 'SIEMENS KONDAKTÖR', '3RT2016', '4 ', '30', '12', '0', 'KONYA ENERJİ', '2025-05-30 11:58:17', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede\r\n', '2025-05-30 15:01:36', '2025-05-30 15:01:36', NULL),
(77, 'SIEMENS KONDAKTÖR', '3RT2017', '5.5 ', '30', '12', '0', 'KONYA ENERJİ', '2025-05-30 11:58:17', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede\r\n', '2025-05-30 15:01:36', '2025-05-30 15:01:36', NULL),
(78, 'SIEMENS KONDAKTÖR', '3RT2018', '7.5', '30', '12', '0', 'KONYA ENERJİ', '2025-05-30 11:58:17', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede\r\n', '2025-05-30 15:01:36', '2025-05-30 15:01:36', NULL),
(79, 'SIEMENS KONDAKTÖR', '3RT2026', '11', '30', '12', '0', 'KONYA ENERJİ', '2025-05-30 11:58:17', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede\r\n', '2025-05-30 15:01:36', '2025-05-30 15:01:36', NULL),
(80, 'SIEMENS KONDAKTÖR', '3RT2027', '15', '30', '12', '0', 'KONYA ENERJİ', '2025-05-30 11:58:17', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede\r\n', '2025-05-30 15:01:36', '2025-05-30 15:01:36', NULL),
(81, 'SIEMENS KONDAKTÖR', '3RT2035', '18.5', '30', '12', '0', 'KONYA ENERJİ', '2025-05-30 11:58:17', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede\r\n', '2025-05-30 15:01:36', '2025-05-30 15:01:36', NULL),
(82, 'SIEMENS KONDAKTÖR', '3RT2036', '22', '30', '12', '0', 'KONYA ENERJİ', '2025-05-30 11:58:17', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede\r\n', '2025-05-30 15:01:36', '2025-05-30 15:01:36', NULL),
(83, 'SIEMENS KONDAKTÖR', '3RT2037', '30', '30', '12', '0', 'KONYA ENERJİ', '2025-05-30 11:58:17', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede\r\n', '2025-05-30 15:01:36', '2025-05-30 15:01:36', NULL),
(84, 'SIEMENS KONDAKTÖR', '3RT2038', '37', '30', '12', '0', 'KONYA ENERJİ', '2025-05-30 11:58:17', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede\r\n', '2025-05-30 15:01:36', '2025-05-30 15:01:36', NULL),
(85, 'SIEMENS KONDAKTÖR', '3RT2045', '37', '30', '12', '0', 'KONYA ENERJİ', '2025-05-30 11:58:17', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede\r\n', '2025-05-30 15:01:36', '2025-05-30 15:01:36', NULL),
(86, 'SIEMENS KONDAKTÖR', '3RT2046', '45', '30', '12', '0', 'KONYA ENERJİ', '2025-05-30 11:58:17', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede\r\n', '2025-05-30 15:01:36', '2025-05-30 15:01:36', NULL),
(87, 'SIEMENS KONDAKTÖR', '3RT2047', '55', '30', '12', '0', 'KONYA ENERJİ', '2025-05-30 11:58:17', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede\r\n', '2025-05-30 15:01:36', '2025-05-30 15:01:36', NULL),
(88, 'SIEMENS KONDAKTÖR', '3RT1055', '75', '30', '12', '0', 'KONYA ENERJİ', '2025-05-30 11:58:17', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede\r\n', '2025-05-30 15:01:36', '2025-05-30 15:01:36', NULL),
(89, 'SIEMENS KONDAKTÖR', '3RT1056', '90', '30', '12', '0', 'KONYA ENERJİ', '2025-05-30 11:58:17', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede\r\n', '2025-05-30 15:01:36', '2025-05-30 15:01:36', NULL),
(90, 'SCHNEIDER KONDAKTÖR', 'LC1D SERİSİ', '4', '100', '50', '0', 'KONYA ENERJİ', '2025-05-30 12:19:59', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 15:21:20', '2025-05-30 15:21:20', NULL),
(91, 'SCHNEIDER KONDAKTÖR', 'LC1D SERİSİ', '5.5', '100', '50', '0', 'KONYA ENERJİ', '2025-05-30 12:19:59', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 15:21:20', '2025-05-30 15:21:20', NULL),
(92, 'SCHNEIDER KONDAKTÖR', 'LC1D SERİSİ', '7.5', '100', '50', '0', 'KONYA ENERJİ', '2025-05-30 12:19:59', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 15:21:20', '2025-05-30 15:21:20', NULL),
(93, 'SCHNEIDER KONDAKTÖR', 'LC1D SERİSİ', '11', '100', '50', '0', 'KONYA ENERJİ', '2025-05-30 12:19:59', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 15:21:20', '2025-05-30 15:21:20', NULL),
(94, 'SCHNEIDER KONDAKTÖR', 'LC1D SERİSİ', '15', '100', '50', '0', 'KONYA ENERJİ', '2025-05-30 12:19:59', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 15:21:20', '2025-05-30 15:21:20', NULL),
(95, 'SCHNEIDER KONDAKTÖR', 'LC1D SERİSİ', '18.5', '100', '50', '0', 'KONYA ENERJİ', '2025-05-30 12:19:59', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 15:21:20', '2025-05-30 15:21:20', NULL),
(96, 'SCHNEIDER KONDAKTÖR', 'LC1D SERİSİ', '22', '100', '50', '0', 'KONYA ENERJİ', '2025-05-30 12:19:59', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 15:21:20', '2025-05-30 15:21:20', NULL),
(97, 'SCHNEIDER KONDAKTÖR', 'LC1D SERİSİ', '30', '100', '50', '0', 'KONYA ENERJİ', '2025-05-30 12:19:59', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 15:21:20', '2025-05-30 15:21:20', NULL),
(98, 'SCHNEIDER KONDAKTÖR', 'LC1D SERİSİ', '37', '100', '50', '0', 'KONYA ENERJİ', '2025-05-30 12:19:59', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 15:21:20', '2025-05-30 15:21:20', NULL),
(99, 'SCHNEIDER KONDAKTÖR', 'LC1D SERİSİ', '45', '100', '50', '0', 'KONYA ENERJİ', '2025-05-30 12:19:59', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 15:21:20', '2025-05-30 15:21:20', NULL),
(100, 'SCHNEIDER KONDAKTÖR', 'LC1D SERİSİ', '55', '100', '50', '0', 'KONYA ENERJİ', '2025-05-30 12:19:59', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 15:21:20', '2025-05-30 15:21:20', NULL),
(101, 'SCHNEIDER KONDAKTÖR', 'LC1D SERİSİ', '55', '100', '50', '0', 'KONYA ENERJİ', '2025-05-30 12:19:59', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 15:21:20', '2025-05-30 15:21:20', NULL),
(102, 'SCHNEIDER KONDAKTÖR', 'LC1D SERİSİ', '75', '100', '50', '0', 'KONYA ENERJİ', '2025-05-30 12:19:59', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 15:21:20', '2025-05-30 15:21:20', NULL),
(103, 'SCHNEIDER KONDAKTÖR', 'LC1D SERİSİ', '90', '100', '50', '0', 'KONYA ENERJİ', '2025-05-30 12:19:59', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 15:21:20', '2025-05-30 15:21:20', NULL),
(104, 'SIEMENS MOTOR K. TERMİĞİ', 'RV SERİSİ ', '0.37 ', '20', '18', '0', 'KONYA ENERJİ', '2025-05-30 12:24:35', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 15:26:14', '2025-05-30 15:26:14', NULL),
(105, 'SIEMENS MOTOR K. TERMİĞİ', 'RV SERİSİ ', '0.55', '20', '18', '0', 'KONYA ENERJİ', '2025-05-30 12:24:35', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 15:26:14', '2025-05-30 15:26:14', NULL),
(106, 'SIEMENS MOTOR K. TERMİĞİ', 'RV SERİSİ ', '0.75', '20', '18', '0', 'KONYA ENERJİ', '2025-05-30 12:24:35', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 15:26:14', '2025-05-30 15:26:14', NULL),
(107, 'SIEMENS MOTOR K. TERMİĞİ', 'RV SERİSİ ', '1.1', '20', '18', '0', 'KONYA ENERJİ', '2025-05-30 12:24:35', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 15:26:14', '2025-05-30 15:26:14', NULL),
(108, 'SIEMENS MOTOR K. TERMİĞİ', 'RV SERİSİ ', '1.5', '20', '18', '0', 'KONYA ENERJİ', '2025-05-30 12:24:35', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 15:26:14', '2025-05-30 15:26:14', NULL),
(109, 'SIEMENS MOTOR K. TERMİĞİ', 'RV SERİSİ ', '2.2', '20', '18', '0', 'KONYA ENERJİ', '2025-05-30 12:24:35', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 15:26:14', '2025-05-30 15:26:14', NULL),
(110, 'SIEMENS MOTOR K. TERMİĞİ', 'RV SERİSİ ', '3', '20', '18', '0', 'KONYA ENERJİ', '2025-05-30 12:24:35', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 15:26:14', '2025-05-30 15:26:14', NULL),
(111, 'SIEMENS MOTOR K. TERMİĞİ', 'RV SERİSİ ', '4', '20', '18', '0', 'KONYA ENERJİ', '2025-05-30 12:24:35', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 15:26:14', '2025-05-30 15:26:14', NULL),
(112, 'SIEMENS MOTOR K. TERMİĞİ', 'RV SERİSİ ', '5.5', '20', '18', '0', 'KONYA ENERJİ', '2025-05-30 12:24:35', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 15:26:14', '2025-05-30 15:26:14', NULL),
(113, 'SIEMENS MOTOR K. TERMİĞİ', 'RV SERİSİ ', '7.5', '20', '18', '0', 'KONYA ENERJİ', '2025-05-30 12:24:35', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 15:26:14', '2025-05-30 15:26:14', NULL),
(114, 'SIEMENS MOTOR K. TERMİĞİ', 'RV SERİSİ ', '11', '20', '18', '0', 'KONYA ENERJİ', '2025-05-30 12:24:35', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 15:26:14', '2025-05-30 15:26:14', NULL),
(115, 'SIEMENS MOTOR K. TERMİĞİ', 'RV SERİSİ ', '15', '20', '18', '0', 'KONYA ENERJİ', '2025-05-30 12:24:35', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 15:26:14', '2025-05-30 15:26:14', NULL),
(116, 'SIEMENS MOTOR K. TERMİĞİ', 'RV SERİSİ ', '18.5', '20', '18', '0', 'KONYA ENERJİ', '2025-05-30 12:24:35', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 15:26:14', '2025-05-30 15:26:14', NULL),
(117, 'SIEMENS MOTOR K. TERMİĞİ', 'RV SERİSİ ', '22', '20', '18', '0', 'KONYA ENERJİ', '2025-05-30 12:24:35', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 15:26:14', '2025-05-30 15:26:14', NULL),
(118, 'SIEMENS MOTOR K. TERMİĞİ', 'RV SERİSİ ', '30', '20', '18', '0', 'KONYA ENERJİ', '2025-05-30 12:24:35', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 15:26:14', '2025-05-30 15:26:14', NULL),
(119, 'SIEMENS MOTOR K. TERMİĞİ', 'RV SERİSİ ', '37', '20', '18', '0', 'KONYA ENERJİ', '2025-05-30 12:24:35', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 15:26:14', '2025-05-30 15:26:14', NULL),
(120, 'SIEMENS MOTOR K. TERMİĞİ', 'RV SERİSİ ', '45', '20', '18', '0', 'KONYA ENERJİ', '2025-05-30 12:24:35', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 15:26:14', '2025-05-30 15:26:14', NULL),
(121, 'SIEMENS MOTOR K. TERMİĞİ', 'RV SERİSİ ', '55', '20', '18', '0', 'KONYA ENERJİ', '2025-05-30 12:24:35', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 15:26:14', '2025-05-30 15:26:14', NULL),
(122, 'NYAF SİYAH KABLO', '0.75 ', '0', '500 M', '100', '0 M', 'KONYA ENERJİ', '2025-05-30 12:47:40', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 15:51:25', '2025-05-30 15:51:25', NULL),
(123, 'NYAF SİYAH KABLO', '1.5 ', '0', '500', '100', '0', 'KONYA ENERJİ', '2025-05-30 12:47:40', 'HÜSEYİN YOLDAŞ', 'Sipariş Beklemede', '2025-05-30 15:51:25', '2025-05-30 15:51:25', NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `stok`
--

DROP TABLE IF EXISTS `stok`;
CREATE TABLE IF NOT EXISTS `stok` (
  `id` int NOT NULL AUTO_INCREMENT,
  `urun_adi` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL,
  `model` varchar(250) COLLATE utf8mb4_turkish_ci NOT NULL,
  `kw_degeri` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `stok`
--

INSERT INTO `stok` (`id`, `urun_adi`, `model`, `kw_degeri`, `updated_at`, `created_at`, `deleted_at`) VALUES
(1, 'SCHNEIDER', 'ATV 320', '0.55 ', '2025-05-27 14:42:03', '2025-05-27 14:42:03', NULL),
(2, 'lenze', 'lnz', '22', '2025-05-27 14:52:04', '2025-05-27 14:52:04', NULL),
(3, 'SCHNEIDER', 'ATV 320', '0.75', '2025-05-28 12:08:05', '2025-05-28 12:08:05', NULL),
(4, 'SCHNEIDER', 'ATV 320', '1.1', '2025-05-28 12:09:04', '2025-05-28 12:09:04', NULL),
(5, 'SCHNEIDER', 'ATV 320', '1.5', '2025-05-28 12:09:17', '2025-05-28 12:09:17', NULL),
(6, 'SCHNEIDER', 'ATV 320', '2.2', '2025-05-28 12:09:30', '2025-05-28 12:09:30', NULL),
(7, 'SCHNEIDER', 'ATV 320', '3', '2025-05-28 12:09:35', '2025-05-28 12:09:35', NULL),
(8, 'SCHNEIDER', 'ATV 320', '5.5', '2025-05-28 12:09:47', '2025-05-28 12:09:47', NULL),
(9, 'SCHNEIDER', 'ATV 320', '7.5', '2025-05-28 12:09:55', '2025-05-28 12:09:55', NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
