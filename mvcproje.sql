-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 04 Haz 2021, 15:27:44
-- Sunucu sürümü: 10.4.14-MariaDB
-- PHP Sürümü: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `mvcproje`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `adresler`
--

CREATE TABLE `adresler` (
  `id` int(11) NOT NULL,
  `uyeid` int(11) NOT NULL,
  `adres` text NOT NULL,
  `varsayilan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `adresler`
--

INSERT INTO `adresler` (`id`, `uyeid`, `adres`, `varsayilan`) VALUES
(3, 15, 'izmir', 1),
(4, 16, 'ankara', 0),
(10, 14, 'izmir', 0),
(11, 14, 'ankara', 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `alt_kategori`
--

CREATE TABLE `alt_kategori` (
  `id` int(11) NOT NULL,
  `cocuk_kat_id` int(11) NOT NULL,
  `ana_kat_id` int(11) NOT NULL,
  `ad` varchar(20) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `alt_kategori`
--

INSERT INTO `alt_kategori` (`id`, `cocuk_kat_id`, `ana_kat_id`, `ad`) VALUES
(1, 1, 1, 'Üçgen tabaklar'),
(2, 1, 1, 'Yuvarlak tabaklar'),
(3, 1, 1, 'Kare tabaklar'),
(4, 1, 1, 'Şekilli tabaklar'),
(5, 2, 1, 'Üçgen tabaklar'),
(6, 2, 1, 'Yuvarlak tabaklar'),
(10, 3, 1, '6 kişilik'),
(9, 3, 1, '12 kişilik	'),
(11, 4, 2, 'Reaktif'),
(12, 4, 2, 'Dekorsuz'),
(13, 5, 2, 'Reaktif'),
(14, 5, 2, 'Dekorsuz'),
(15, 6, 2, 'Eldekoru'),
(16, 6, 2, 'Dekorlu'),
(17, 6, 2, 'Dekorsuz'),
(18, 7, 3, '8 cm kase'),
(19, 7, 3, '16 cm kase'),
(20, 7, 3, '30 cm kase'),
(21, 8, 3, 'Kolye'),
(22, 8, 3, 'Yüzük'),
(23, 8, 3, 'Takı seti'),
(24, 9, 3, '10cm vazo'),
(25, 9, 3, '15cm vazo'),
(26, 9, 3, '25cm vazo');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ana_kategori`
--

CREATE TABLE `ana_kategori` (
  `id` int(11) NOT NULL,
  `ad` varchar(20) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `ana_kategori`
--

INSERT INTO `ana_kategori` (`id`, `ad`) VALUES
(1, 'PORSELEN'),
(2, 'Çay kahve'),
(3, 'ÇİNİ'),
(10, '123'),
(11, '123');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ayarlar`
--

CREATE TABLE `ayarlar` (
  `id` int(11) NOT NULL,
  `sloganUst1` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `sloganAlt1` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `sloganUst2` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `sloganAlt2` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `sloganUst3` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `sloganAlt3` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `title` varchar(150) COLLATE utf8_turkish_ci NOT NULL,
  `sayfaAciklama` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `anahtarKelime` text COLLATE utf8_turkish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `ayarlar`
--

INSERT INTO `ayarlar` (`id`, `sloganUst1`, `sloganAlt1`, `sloganUst2`, `sloganAlt2`, `sloganUst3`, `sloganAlt3`, `title`, `sayfaAciklama`, `anahtarKelime`) VALUES
(1, 'DB-Üst Slogan 1', 'DB-Alt Slogan 1', 'DB-Üst Slogan  2', 'DB-Alt Slogan 2', 'DB-Üst Slogan 3', 'DB-Alt Slogan 3', 'E-ÇİNİ YE HOŞ GELDİNİZ', 'MVC E-TİCARET UYGULAMASI', 'anahtar,kelimeler,buraya,virgüller,koyularak,yazilacak');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `bulten`
--

CREATE TABLE `bulten` (
  `id` int(11) NOT NULL,
  `mailadres` varchar(30) COLLATE utf8_turkish_ci NOT NULL,
  `tarih` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `bulten`
--

INSERT INTO `bulten` (`id`, `mailadres`, `tarih`) VALUES
(8, 'mail@mail.com', '2021-04-01'),
(9, 'deneme@mail.com', '2021-03-09'),
(10, 'ssss@mail.com', '2021-04-13'),
(11, 'sefa@mail.com', '2021-04-27'),
(12, 'sdadasdadasdas@mail.com', '2021-04-27');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `cocuk_kategori`
--

CREATE TABLE `cocuk_kategori` (
  `id` int(11) NOT NULL,
  `ana_kat_id` int(11) NOT NULL,
  `ad` varchar(20) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `cocuk_kategori`
--

INSERT INTO `cocuk_kategori` (`id`, `ana_kat_id`, `ad`) VALUES
(1, 1, 'Servis tabakları'),
(2, 1, 'Çukur tabaklar'),
(3, 1, 'Yemek seti'),
(4, 2, 'Çay takımı'),
(5, 2, 'Kahve takımı'),
(6, 2, 'Çay tabağı'),
(7, 3, 'Çini kaseler'),
(8, 3, 'Çini takı'),
(9, 3, 'Çini vazo');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `iletisim`
--

CREATE TABLE `iletisim` (
  `id` int(11) NOT NULL,
  `ad` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `mail` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `konu` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `mesaj` text COLLATE utf8_turkish_ci NOT NULL,
  `tarih` varchar(20) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `iletisim`
--

INSERT INTO `iletisim` (`id`, `ad`, `mail`, `konu`, `mesaj`, `tarih`) VALUES
(1, 'sefa denek', 'sefadenek@gmail.com', 'deneme Konu', 'asdasd', '20-05-2019'),
(2, 'sefa', 'sefa@gmail.com', 'seasdas', 'asdasdasd', '01-01-2021'),
(3, 'asdasdasd', 'sasad@gasda.com', 'asdasd', '546465', '01-01-2021');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `siparisler`
--

CREATE TABLE `siparisler` (
  `id` int(11) NOT NULL,
  `siparis_no` int(11) NOT NULL,
  `adresid` int(11) NOT NULL,
  `uyeid` int(11) NOT NULL,
  `urunad` varchar(30) COLLATE utf8_turkish_ci NOT NULL,
  `urunadet` int(11) NOT NULL,
  `urunfiyat` int(11) NOT NULL,
  `toplamfiyat` int(11) NOT NULL,
  `kargodurum` int(11) NOT NULL DEFAULT 0,
  `odemeturu` varchar(10) COLLATE utf8_turkish_ci NOT NULL,
  `tarih` varchar(10) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `siparisler`
--

INSERT INTO `siparisler` (`id`, `siparis_no`, `adresid`, `uyeid`, `urunad`, `urunadet`, `urunfiyat`, `toplamfiyat`, `kargodurum`, `odemeturu`, `tarih`) VALUES
(26, 91490605, 4, 16, 'gri yemek takımı', 1, 147, 147, 0, 'Nakit', '11.05.2021'),
(25, 91490605, 4, 16, 'siyah yemek takımı ', 4, 169, 676, 0, 'Nakit', '11.05.2021'),
(24, 91490605, 4, 16, 'çay tabağı1', 1, 90, 90, 0, 'Nakit', '11.05.2021'),
(23, 39254652, 10, 14, 'çay tabağı1', 1, 90, 90, 0, 'Nakit', '11.05.2021');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `teslimatbilgileri`
--

CREATE TABLE `teslimatbilgileri` (
  `id` int(11) NOT NULL,
  `siparis_no` int(11) NOT NULL,
  `ad` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `soyad` varchar(30) COLLATE utf8_turkish_ci NOT NULL,
  `mail` varchar(30) COLLATE utf8_turkish_ci NOT NULL,
  `telefon` varchar(11) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `teslimatbilgileri`
--

INSERT INTO `teslimatbilgileri` (`id`, `siparis_no`, `ad`, `soyad`, `mail`, `telefon`) VALUES
(1, 72383860, 'sefa', 'denek', 'mail@gmail.com', '123'),
(2, 32656807, 'sefa', 'denek', 'mail@gmail.com', '123'),
(3, 26810671, 'sefa', 'denek', 'mail@gmail.com', '123'),
(4, 61936987, 'sefa', 'denek', 'mail@gmail.com', '123'),
(5, 5171545, 'sefa', 'denek', 'mail@gmail.com', '123'),
(6, 76977111, 'sefa', 'denek', 'mail@gmail.com', '123'),
(7, 46998700, 'sefa', 'denek', 'mail@gmail.com', '123'),
(8, 21117859, 'sefa', 'denek', 'mail@gmail.com', '123'),
(9, 49525656, 'sefa', 'denek', 'mail@gmail.com', '123'),
(10, 55479711, 'sefa', 'denek', 'mail@gmail.com', '123'),
(11, 90157672, 'sefa', 'denek', 'mail@gmail.com', '05072683300'),
(12, 95972503, 'denemehesap', 'denemehesap', 'denemehesap@gmail.com', '123123'),
(13, 92627858, 'sefa', 'denek', 'mail@gmail.com', '123'),
(14, 39254652, 'sefa', 'denek', 'mail@gmail.com', '123'),
(15, 91490605, 'denemehesap', 'denemehesap', 'denemehesap@gmail.com', '123123');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `urunler`
--

CREATE TABLE `urunler` (
  `id` int(11) NOT NULL,
  `katid` int(11) NOT NULL,
  `urunad` varchar(80) COLLATE utf8_turkish_ci NOT NULL,
  `res1` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `res2` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `res3` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `durum` int(11) NOT NULL DEFAULT 0,
  `aciklama` text COLLATE utf8_turkish_ci NOT NULL,
  `malzeme` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `urtYeri` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `renk` varchar(10) COLLATE utf8_turkish_ci NOT NULL,
  `fiyat` float NOT NULL,
  `stok` int(11) NOT NULL,
  `ozellik` text COLLATE utf8_turkish_ci NOT NULL,
  `ekstraBilgi` text COLLATE utf8_turkish_ci NOT NULL,
  `satisadet` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `urunler`
--

INSERT INTO `urunler` (`id`, `katid`, `urunad`, `res1`, `res2`, `res3`, `durum`, `aciklama`, `malzeme`, `urtYeri`, `renk`, `fiyat`, `stok`, `ozellik`, `ekstraBilgi`, `satisadet`) VALUES
(1, 1, 'gül desenli tabak', 'l4.jpg', 'l4.jpg', 'l4.jpg', 0, ' ürün hakkında bilgi ', 'porselen', ' Kütahya', 'Beyaz', 380, 10000, 'gül desenli tabak Kütahya özellikler', 'gül desenli tabak  Kütahya ekstra bilgi', 2),
(2, 1, 'mavi desenli tabak', 'p2.jpg', 'p2.jpg', 'p2.jpg', 0, ' ürün hakkında bilgi ', 'porselen', ' Kütahya', 'mavi', 270, 10000, 'mavi desenli tabak özellikler', 'mavi desenli tabak ekstra bilgi', 4),
(3, 2, 'bordo tabak seti', 'p32.jpg', 'p32.jpg', 'p32.jpg', 0, ' ürün hakkında bilgi ', 'porselen', ' Kütahya', 'bordo', 140, 10000, 'bordo tabak seti özellikler', 'bordo tabak seti ekstra bilgi', 5),
(4, 2, 'altın sarısı tabak takımı', 'p42.jpg', 'p42.jpg', 'p42.jpg', 0, ' ürün hakkında bilgi ', 'porselen', ' Kütahya', 'Sarı', 90, 10000, 'altın sarısı tabak takımı özellikler', 'altın sarısı tabak takımı ekstra bilgi', 7),
(5, 3, 'gri yemek takımı', 'p52.jpg', 'p52.jpg', 'p52.jpg', 0, ' ürün hakkında bilgi ', 'porselen', ' Kütahya', 'Gri', 147, 190, 'gri yemek takımı özellikler', 'gri yemek takımı ekstra bilgi', 11),
(6, 3, 'siyah yemek takımı ', 'p62.jpg', 'p62.jpg', 'p62.jpg', 0, ' ürün hakkında bilgi ', 'porselen', ' Kütahya', 'siyah', 169, 10000, 'siyah yemek takımı  özellikler', 'siyah yemek takımı  ekstra bilgi', 14),
(7, 13, 'pembe yemek takımı', 'p72.jpg', 'p72.jpg', 'p72.jpg', 1, ' ürün hakkında bilgi ', 'porselen', ' Kütahya', 'pembe', 570, 170, 'pembe yemek takımı özellikler', 'pembe yemek takımı ekstra bilgi', 23),
(8, 8, 'çocuk yemek takımı', 'p82.jpg', 'p82.jpg', 'p82.jpg', 1, ' ürün hakkında bilgi ', 'porselen', ' Kütahya', 'yeşil', 684, 10000, 'çocuk yemek takımı özellikler', 'çocuk yemek takımı ekstra bilgi', 44),
(9, 9, 'siyah yemek takımı', 'p92.jpg', 'p92.jpg', 'p92.jpg', 1, ' ürün hakkında bilgi ', 'porselen', ' Kütahya', 'siyah', 157, 10000, 'siyah yemek takımı özellikler', 'siyah yemek takımı ekstra bilgi', 123),
(10, 4, 'şekilli tabaklar', '19.png', '20.png', '21.png', 0, ' ürün hakkında bilgi ', 'porselen', ' Kütahya', 'Beyaz', 380, 10000, 'Beyaz  özellikler', 'Beyaz  ekstra bilgi', 0),
(11, 4, 'şekilli tabaklar2', '22.png', '23.png', '24.png', 0, ' ürün hakkında bilgi ', 'porselen', ' Kütahya', 'Sarı', 270, 10000, 'Sarı  özellikler', 'Sarı  ekstra bilgi', 0),
(12, 5, 'üçgen tabaklar', '25.png', '26.png', '27.png', 0, ' ürün hakkında bilgi ', 'porselen', ' Kütahya', 'pembe', 140, 10000, 'Pembe  özellikler', 'Pembe  ekstra bilgi', 0),
(13, 5, 'üçgen tabaklar2', '28.png', '29.png', '30.png', 0, ' ürün hakkında bilgi ', 'porselen', ' Kütahya', 'Sarı', 90, 10000, 'Kırmızı  özellikler', 'Kırmızı  ekstra bilgi', 0),
(14, 6, 'yuvarlak tabaklar', '31.png', '32.png', '33.png', 0, ' ürün hakkında bilgi ', 'porselen', ' Kütahya', 'Gri', 147, 190, 'Gri  özellikler', 'Gri  ekstra bilgi', 0),
(15, 6, 'yuvarlak tabaklar', '34.png', '35.png', '36.png', 0, ' ürün hakkında bilgi ', 'porselen', ' Kütahya', 'Mavi', 169, 10000, 'Mavi  özellikler', 'Mavi  ekstra bilgi', 0),
(16, 10, '6 kişilik', '37.png', '38.png', '39.png', 1, ' ürün hakkında bilgi ', 'porselen', ' Kütahya', 'pembe', 140, 10000, 'Pembe  özellikler', 'Pembe  ekstra bilgi', 0),
(17, 10, '6 kişilik2', '40.png', '41.png', '42.png', 0, ' ürün hakkında bilgi ', 'porselen', ' Kütahya', 'Sarı', 90, 10000, 'Kırmızı  özellikler', 'Kırmızı  ekstra bilgi', 0),
(18, 9, '12 kişilik', '43.png', '44.png', '45.png', 1, ' ürün hakkında bilgi ', 'porselen', ' Kütahya', 'Gri', 147, 190, 'Gri  özellikler', 'Gri  ekstra bilgi', 0),
(19, 9, '12 kişilik2', '46.png', '47.png', '48.png', 0, ' ürün hakkında bilgi ', 'porselen', ' Kütahya', 'Mavi', 169, 10000, 'Mavi  özellikler', 'Mavi  ekstra bilgi', 0),
(20, 11, 'reaktif', '49.png', '50.png', '51.png', 0, ' ürün hakkında bilgi ', 'porselen', ' Kütahya', 'pembe', 140, 10000, 'Pembe  özellikler', 'Pembe  ekstra bilgi', 0),
(21, 11, 'reaktif2', '52.png', '53.png', '54.png', 0, ' ürün hakkında bilgi ', 'porselen', ' Kütahya', 'Sarı', 90, 10000, 'Kırmızı  özellikler', 'Kırmızı  ekstra bilgi', 0),
(22, 12, 'dekorsuz', '55.png', '56.png', '57.png', 1, ' ürün hakkında bilgi ', 'porselen', ' Kütahya', 'Gri', 147, 190, 'Gri  özellikler', 'Gri  ekstra bilgi', 0),
(23, 12, 'dekorsuz2', '58.png', '59.png', '60.png', 0, ' ürün hakkında bilgi ', 'porselen', ' Kütahya', 'Mavi', 169, 10000, 'Mavi  özellikler', 'Mavi  ekstra bilgi', 0),
(24, 13, 'reaktif', '61.png', '62.png', '63.png', 0, ' ürün hakkında bilgi ', 'porselen', ' Kütahya', 'pembe', 140, 10000, 'Pembe  özellikler', 'Pembe  ekstra bilgi', 0),
(25, 13, 'reaktif2', '64.png', '65.png', '66.png', 0, ' ürün hakkında bilgi ', 'porselen', ' Kütahya', 'Sarı', 90, 10000, 'Kırmızı  özellikler', 'Kırmızı  ekstra bilgi', 0),
(26, 14, 'dekorsuz', '67.png', '68.png', '69.png', 0, 'ürün hakkında bilgi ', 'porselen', ' Kütahya', 'Gri', 147, 190, 'Gri  özellikler', 'Gri  ekstra bilgi', 0),
(27, 14, 'dekorsuz2', '70.png', '71.png', '72.png', 0, ' ürün hakkında bilgi ', 'porselen', ' Kütahya', 'Mavi', 169, 10000, 'Mavi  özellikler', 'Mavi  ekstra bilgi', 0),
(28, 15, 'çay tabağı el dekoru', '73.png', '74.png', '75.png', 0, 'ürün hakkında bilgi ', 'porselen', ' Kütahya', 'pembe', 140, 10000, 'Pembe  özellikler', 'Pembe  ekstra bilgi', 0),
(29, 15, 'çay tabağı1', '76.png', '77.png', '78.png', 0, ' ürün hakkında bilgi ', 'porselen', ' Kütahya', 'Sarı', 90, 10000, 'Kırmızı  özellikler', 'Kırmızı  ekstra bilgi', 0),
(30, 16, 'çay tabağı3', '79.png', '80.png', '81.png', 0, ' ürün hakkında bilgi', 'porselen', ' Kütahya', 'Gri', 147, 190, 'Gri  özellikler', 'Gri  ekstra bilgi', 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `uye_panel`
--

CREATE TABLE `uye_panel` (
  `id` int(11) NOT NULL,
  `ad` varchar(40) COLLATE utf8_turkish_ci NOT NULL,
  `soyad` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `mail` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `sifre` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `telefon` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `durum` int(11) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `uye_panel`
--

INSERT INTO `uye_panel` (`id`, `ad`, `soyad`, `mail`, `sifre`, `telefon`, `durum`) VALUES
(16, 'denemehesap', 'denemehesap', 'denemehesap@gmail.com', 'q5ijvc1oc5CRiRGbkmo2g2gg00kA', '123123', 1),
(15, 'sdsd', 'sdsd', 'sdsd@gmail.com', 'q5ijvc1oc5CRiZGZoWnwJjYG0VKmSwA=', '123456', 1),
(17, 'denemehesap', 'asdasda', 'asdasdasd@gmail.com', 'q5ijvc1oY5CWn65f6CY2BuHvzN4A', '123123', 1),
(14, 'sefa', 'denek', 'mail@gmail.com', 'q5ijvc1oW5CRiVHYJjYG3kQmAwA=', '123', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yonetim`
--

CREATE TABLE `yonetim` (
  `id` int(11) NOT NULL,
  `ad` varchar(40) NOT NULL,
  `sifre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `yonetim`
--

INSERT INTO `yonetim` (`id`, `ad`, `sifre`) VALUES
(1, 'sefa', 'q5ijvc1oW5CRiVHYJjYG3kQmAwA='),
(3, 'deneme', 'q5ijvc1oW5CRiVHYJjYG3kQmAwA=');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yorumlar`
--

CREATE TABLE `yorumlar` (
  `id` int(11) NOT NULL,
  `uyeid` int(11) NOT NULL,
  `urunid` int(11) NOT NULL,
  `ad` varchar(40) COLLATE utf8_turkish_ci NOT NULL,
  `icerik` text COLLATE utf8_turkish_ci NOT NULL,
  `tarih` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `durum` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `yorumlar`
--

INSERT INTO `yorumlar` (`id`, `uyeid`, `urunid`, `ad`, `icerik`, `tarih`, `durum`) VALUES
(14, 14, 14, 'sefa', 'elinize sağlık', '01-03-2021', 1),
(15, 14, 10, 'sefa', 'ne hoş ürün', '01-03-2021', 1);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `adresler`
--
ALTER TABLE `adresler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `alt_kategori`
--
ALTER TABLE `alt_kategori`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `ana_kategori`
--
ALTER TABLE `ana_kategori`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `ayarlar`
--
ALTER TABLE `ayarlar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `bulten`
--
ALTER TABLE `bulten`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `cocuk_kategori`
--
ALTER TABLE `cocuk_kategori`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `iletisim`
--
ALTER TABLE `iletisim`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `siparisler`
--
ALTER TABLE `siparisler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `teslimatbilgileri`
--
ALTER TABLE `teslimatbilgileri`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `urunler`
--
ALTER TABLE `urunler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `uye_panel`
--
ALTER TABLE `uye_panel`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `yonetim`
--
ALTER TABLE `yonetim`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ad` (`ad`);

--
-- Tablo için indeksler `yorumlar`
--
ALTER TABLE `yorumlar`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `adresler`
--
ALTER TABLE `adresler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Tablo için AUTO_INCREMENT değeri `alt_kategori`
--
ALTER TABLE `alt_kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Tablo için AUTO_INCREMENT değeri `ana_kategori`
--
ALTER TABLE `ana_kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Tablo için AUTO_INCREMENT değeri `ayarlar`
--
ALTER TABLE `ayarlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `bulten`
--
ALTER TABLE `bulten`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Tablo için AUTO_INCREMENT değeri `cocuk_kategori`
--
ALTER TABLE `cocuk_kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Tablo için AUTO_INCREMENT değeri `iletisim`
--
ALTER TABLE `iletisim`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `siparisler`
--
ALTER TABLE `siparisler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Tablo için AUTO_INCREMENT değeri `teslimatbilgileri`
--
ALTER TABLE `teslimatbilgileri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Tablo için AUTO_INCREMENT değeri `urunler`
--
ALTER TABLE `urunler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- Tablo için AUTO_INCREMENT değeri `uye_panel`
--
ALTER TABLE `uye_panel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Tablo için AUTO_INCREMENT değeri `yonetim`
--
ALTER TABLE `yonetim`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tablo için AUTO_INCREMENT değeri `yorumlar`
--
ALTER TABLE `yorumlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
