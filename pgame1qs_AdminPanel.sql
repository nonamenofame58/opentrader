-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost:3306
-- Üretim Zamanı: 28 Eyl 2021, 18:38:44
-- Sunucu sürümü: 5.7.23-23
-- PHP Sürümü: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `pgame1qs_AdminPanel`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `admin`
--

CREATE TABLE `admin` (
  `adminid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adminpass` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `uid` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Tablo döküm verisi `admin`
--

INSERT INTO `admin` (`adminid`, `adminpass`, `uid`) VALUES
('admin', '$2y$10$gYV1UjDeGAKubrXea8QcAuPaUSQECV.K4Xy2Kqk8ZHGCOkt6lNL7W', 13);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `carts`
--

CREATE TABLE `carts` (
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quantity` int(10) DEFAULT NULL,
  `size` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Tablo döküm verisi `carts`
--

INSERT INTO `carts` (`username`, `product`, `quantity`, `size`) VALUES
('', '_q6f4rjlpb68v9zda4o', 1, 'null');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `mainCategories`
--

CREATE TABLE `mainCategories` (
  `categories` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `uid` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Tablo döküm verisi `mainCategories`
--

INSERT INTO `mainCategories` (`categories`, `uid`) VALUES
('Cep Telefonu & Aksesuar', 115),
('Giyim', 117),
('Deneme', 119);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `markas`
--

CREATE TABLE `markas` (
  `subCategorie` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `marka` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Tablo döküm verisi `markas`
--

INSERT INTO `markas` (`subCategorie`, `marka`) VALUES
('Cep Telefonu', 'Acer'),
('Cep Telefonu', 'Aiek'),
('Cep Telefonu', 'Alcatech'),
('Cep Telefonu', 'Anka'),
('Cep Telefonu', 'Apple'),
('Cep Telefonu', 'Archos'),
('Cep Telefonu', 'Asus'),
('Cep Telefonu', 'Avea'),
('Cep Telefonu', 'BB Mobile'),
('Cep Telefonu', 'BlackBerry'),
('Cep Telefonu', 'Blackview'),
('T-Shirt', 'Kaft'),
('T-Shirt', 'Fox'),
('Shorts', 'Kaft'),
('Hoodie', 'Kaft'),
('Jackets', 'Kaft'),
('Alt demen', 'marka deneme');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `orders`
--

CREATE TABLE `orders` (
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `label` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` int(10) DEFAULT NULL,
  `size` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `totalPrice` int(255) DEFAULT NULL,
  `singlePrice` int(255) DEFAULT NULL,
  `orderid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `checked` int(1) NOT NULL,
  `completed` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `uid` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Tablo döküm verisi `orders`
--

INSERT INTO `orders` (`username`, `product`, `label`, `quantity`, `size`, `totalPrice`, `singlePrice`, `orderid`, `checked`, `completed`, `status`, `uid`) VALUES
('kratosc2', '_p0hbvxu16g99y9cziw', 'FELGIEL', 7, 'S', 2268, 324, '929973764', 0, 0, 'Beklemede', 1),
('kratosc2', '_orsk3lp3emm8xgqvcq', 'PAKARU - SULPHURPAKARU - SULPHURPAKARU - SULPHURPAKARU - SULPHUR', 6, 'XL', 2592, 432, '929973764', 0, 0, 'Beklemede', 2),
('kratosc2', '_79jarkzar2x91sep2l', 'WUMTES - SULPHUR', 10, 'Yok', 2300, 230, '929973764', 0, 0, 'Beklemede', 3),
('kratosc2', '_96nfogape65lre3iub', 'APENDA - OCEAN', 7, 'Yok', 161, 23, '929973764', 0, 0, 'Beklemede', 4),
('kratosc2', '_orsk3lp3emm8xgqvcq', 'PAKARU - SULPHURPAKARU - SULPHURPAKARU - SULPHURPAKARU - SULPHUR', 4, 'XL', 1728, 432, '929973764', 0, 0, 'Beklemede', 5),
('kratosc2', '_q6f4rjlpb68v9zda4o', 'Fox T-Shirt Mavi', 4, 'XL', 880, 220, '929973764', 0, 0, 'Beklemede', 6),
('kratosc2', '_79jarkzar2x91sep2l', 'WUMTES - SULPHUR', 10, 'Yok', 2300, 230, '929973765', 0, 0, 'İptal', 7),
('kratosc2', '_96nfogape65lre3iub', 'APENDA - OCEAN', 14, 'Yok', 322, 23, '929973765', 0, 0, 'İptal', 8),
('kratosc2', '_orsk3lp3emm8xgqvcq', 'PAKARU - SULPHURPAKARU - SULPHURPAKARU - SULPHURPAKARU - SULPHUR', 6, 'L', 2592, 432, '929973765', 0, 0, 'İptal', 9),
('kratosc2', '_orsk3lp3emm8xgqvcq', 'PAKARU - SULPHURPAKARU - SULPHURPAKARU - SULPHURPAKARU - SULPHUR', 6, 'XL', 2592, 432, '929973765', 0, 0, 'İptal', 10),
('kratosc2', '_moq8v6peup8ueexo1d', 'Fox T-Shirt Beyaz', 4, 'Yok', 1436, 359, '763640773', 0, 0, 'Beklemede', 11),
('kratosc2', '_96nfogape65lre3iub', 'APENDA - OCEAN', 4, 'Yok', 92, 23, '763640773', 0, 0, 'Beklemede', 12),
('kratosc333', '_96nfogape65lre3iub', 'APENDA - OCEAN', 5, 'Yok', 115, 23, '380163054', 0, 0, 'İptal', 13),
('kratosc333', '_orsk3lp3emm8xgqvcq', 'PAKARU - SULPHURPAKARU - SULPHURPAKARU - SULPHURPAKARU - SULPHUR', 5, 'XL', 2160, 432, '380163054', 0, 0, 'İptal', 14),
('kratosc333', '_5sn69cx7plxlb9l3fz', 'WUMTES - ASPHALT', 3, 'XL', 384, 128, '380163054', 0, 0, 'İptal', 15),
('kratosc333', '_79jarkzar2x91sep2l', 'WUMTES - SULPHUR', 2, 'XL', 460, 230, '380163054', 0, 0, 'İptal', 16),
('kratosc333', '_orsk3lp3emm8xgqvcq', 'PAKARU - SULPHURPAKARU - SULPHURPAKARU - SULPHURPAKARU - SULPHUR', 8, 'L', 3456, 432, '354764938', 0, 0, 'İptal', 17),
('kratosc333', '_96nfogape65lre3iub', 'APENDA - OCEAN', 11, 'L', 253, 23, '354764938', 0, 0, 'İptal', 18),
('kratosc333', '_5sn69cx7plxlb9l3fz', 'WUMTES - ASPHALT', 14, 'L', 1792, 128, '354764938', 0, 0, 'İptal', 19),
('kratosc333', '_orsk3lp3emm8xgqvcq', 'PAKARU - SULPHURPAKARU - SULPHURPAKARU - SULPHURPAKARU - SULPHUR', 6, 'L', 2592, 432, '395654341', 0, 0, 'Tamamlandı', 20),
('kratosc333', '_p0hbvxu16g99y9cziw', 'FELGIEL', 7, 'L', 2268, 324, '395654341', 0, 0, 'Tamamlandı', 21),
('nonamenofame58@gmail.com', '_q6f4rjlpb68v9zda4o', 'Fox T-Shirt Mavi', 1, 'Yok', 220, 220, '905461404', 0, 0, '', 22),
('nonamenofame58@gmail.com', '_moq8v6peup8ueexo1d', 'Fox T-Shirt Beyaz', 10, 'Yok', 3590, 359, '974354994', 0, 0, '', 23),
('nonamenofame58@gmail.com', '_m2pzt1zg6uulietdgq', 'Fox T-Shirt Turuncu', 6, 'Yok', 708, 118, '903698961', 0, 0, '', 24),
('nonamenofame58@gmail.com', '_moq8v6peup8ueexo1d', 'Fox T-Shirt Beyaz', 4, 'Yok', 1436, 359, '903698961', 0, 0, '', 25),
('nonamenofame58@gmail.com', '_96nfogape65lre3iub', 'APENDA - OCEAN', 7, 'Yok', 161, 23, '903698961', 0, 0, '', 26),
('admin', '_96nfogape65lre3iub', 'APENDA - OCEAN', 5, 'Yok', 115, 23, '462393398', 0, 0, '', 27),
('admin', '_moq8v6peup8ueexo1d', 'Fox T-Shirt Beyaz', 20, 'Yok', 7180, 359, '416715954', 0, 0, '', 28),
('admin', '_u88lfl549qqmmzux456', 'BURNIN TIRE', 11, 'Yok', 3564, 324, '416715954', 0, 0, '', 29);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `product`
--

CREATE TABLE `product` (
  `label` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `productStatus` int(1) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `tax` int(3) DEFAULT NULL,
  `stock` int(21) DEFAULT NULL,
  `mainCategorie` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subCategorie` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `marka` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `barcode` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `discount` int(3) DEFAULT NULL,
  `desi` int(3) DEFAULT NULL,
  `description` varchar(1048) COLLATE utf8_unicode_ci DEFAULT NULL,
  `uid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Tablo döküm verisi `product`
--

INSERT INTO `product` (`label`, `code`, `productStatus`, `price`, `tax`, `stock`, `mainCategorie`, `subCategorie`, `marka`, `barcode`, `discount`, `desi`, `description`, `uid`) VALUES
('Fox T-Shirt Mavi', '_q6f4rjlpb68v9zda4o', 1, 220, 18, 32, 'Giyim', 'T-Shirt', 'Fox', 'A312', 23, 5, ' Casio EFV-C100L-1AVDF Mavi tişört', 72),
('Fox T-Shirt Turuncu', '_m2pzt1zg6uulietdgq', 1, 118, 19, 252, 'Giyim', 'T-Shirt', 'Fox', 'A321', 32, 32, 'Casio EFV-C100L-1AVDF Turuncu Tişört ', 73),
('Fox T-Shirt Beyaz', '_moq8v6peup8ueexo1d', 1, 359, 18, 25, 'Giyim', 'T-Shirt', 'Fox', '', 32, 41, ' Casio EFV-C100L-1AVDF Beyaz tişört', 74),
('FELGIEL', '_p0hbvxu16g99y9cziw', 1, 324, 42, 32, 'Giyim', 'T-Shirt', 'Kaft', 'ABC-abc-1234', 32, 32, ' TASARIMIN HİKAYESİ\nBen, hayatınızın en önemli gününde arkada yürüyüp geçen figüran, detaylardan ibaret bulanık bir silüetim.', 76),
('BURNIN TIRE', '_u88lfl549qqmmzux456', 1, 324, 32, 2323, 'Giyim', 'T-Shirt', 'Kaft', 'F32', 32, 4, ' Bir avuç insan kalmıştık varlığımızı kutlayacak ve bildiğimiz tüm dilleri unutmuştuk.', 78),
('WUMTES - SULPHUR', '_79jarkzar2x91sep2l', 1, 230, 21, 123, 'Giyim', 'Shorts', 'Kaft', '', 23, 2, ' Can be worn for 24 hours, comfort for all day long. At home, while with friends, any moments you enjoy. High waist. Cosy feeling. Nice touches in color contrasts and embroidery details.\n\n', 79),
('WUMTES - ASPHALT', '_5sn69cx7plxlb9l3fz', 1, 128, 19, 23, 'Giyim', 'Shorts', 'Kaft', '', 23, 12, ' Can be worn for 24 hours, comfort for all day long. At home, while with friends, any moments you enjoy. High waist. Cosy feeling. Nice touches in color contrasts and embroidery details.\n\n', 80),
('APENDA - OCEAN', '_96nfogape65lre3iub', 1, 23, 23, 234, 'Giyim', 'Hoodie', 'Kaft', '', 321, 21, ' We like the tranquilityand the depth of spring and fall. To express this, we used slightly scattered lines and touches. Wear the APENDA hat and step out the door with your hands in your pockets.', 81),
('PAKARU - SULPHURPAKARU - SULPHURPAKARU - SULPHURPAKARU - SULPHUR', '_orsk3lp3emm8xgqvcq', 1, 432, 18, 23, 'Giyim', 'Jackets', 'Kaft', '', 15, 23, ' Designed as a product that you can comfortably walk around when it gets windy, and also will not leave you alone while it\'s raining lightly with its water repellency. There are many adjustable parts and it has an oversize style for daily life activities.', 85);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `productPhotos`
--

CREATE TABLE `productPhotos` (
  `productCode` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `productImg` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Tablo döküm verisi `productPhotos`
--

INSERT INTO `productPhotos` (`productCode`, `productImg`) VALUES
('_q6f4rjlpb68v9zda4o', '14new_1440x1800_crop_center@2x.jpg'),
('_q6f4rjlpb68v9zda4o', 'U5_1440x1800_crop_center@2x.jpg'),
('_q6f4rjlpb68v9zda4o', 'WWF-LB-D241-1680_1440x1800_crop_center@2x.jpg'),
('_q6f4rjlpb68v9zda4o', 'WWF-LB-D241-1682_1440x1800_crop_center@2x.jpg'),
('_m2pzt1zg6uulietdgq', '2new_1440x1800_crop_center@2x.jpg'),
('_m2pzt1zg6uulietdgq', 'H5_1440x1800_crop_center@2x.jpg'),
('_m2pzt1zg6uulietdgq', 'WWF-LB-15-1190_1440x1800_crop_center@2x.jpg'),
('_m2pzt1zg6uulietdgq', 'WWF-LB-15-1203_1440x1800_crop_center@2x.jpg'),
('_moq8v6peup8ueexo1d', '17new_1440x1800_crop_center@2x.jpg'),
('_moq8v6peup8ueexo1d', 'C5_1440x1800_crop_center@2x.jpg'),
('_moq8v6peup8ueexo1d', 'WWF-LB-09-0794_1440x1800_crop_center@2x.jpg'),
('_moq8v6peup8ueexo1d', 'WWF-LB-09-0795_1440x1800_crop_center@2x.jpg'),
('_u88lfl549qqmmzux456', '1282_1.jpg'),
('_u88lfl549qqmmzux456', '1282_3.jpg'),
('_u88lfl549qqmmzux456', '1282_4.jpg'),
('_u88lfl549qqmmzux456', '1282_5.jpg'),
('_u88lfl549qqmmzux456', 'tisort_burningtire_13653_922_922.jpg'),
('_p0hbvxu16g99y9cziw', '1466_1.jpg'),
('_p0hbvxu16g99y9cziw', '1466_2.jpg'),
('_p0hbvxu16g99y9cziw', '1466_3.jpg'),
('_p0hbvxu16g99y9cziw', '1466_4.jpg'),
('_p0hbvxu16g99y9cziw', '1466_5.jpg'),
('_79jarkzar2x91sep2l', '1543_1.jpg'),
('_79jarkzar2x91sep2l', '1543_2.jpg'),
('_79jarkzar2x91sep2l', '1543_3.jpg'),
('_79jarkzar2x91sep2l', '1543_4.jpg'),
('_79jarkzar2x91sep2l', '1543_5.jpg'),
('_79jarkzar2x91sep2l', '1543_6.jpg'),
('_5sn69cx7plxlb9l3fz', '1539_1.jpg'),
('_5sn69cx7plxlb9l3fz', '1539_2.jpg'),
('_5sn69cx7plxlb9l3fz', '1539_3.jpg'),
('_5sn69cx7plxlb9l3fz', '1539_4.jpg'),
('_5sn69cx7plxlb9l3fz', '1539_5.jpg'),
('_5sn69cx7plxlb9l3fz', '1539_6.jpg'),
('_96nfogape65lre3iub', '1414_2.jpg'),
('_96nfogape65lre3iub', '1414_3.jpg'),
('_96nfogape65lre3iub', '1414_5.jpg'),
('_96nfogape65lre3iub', '1414_6.jpg'),
('_96nfogape65lre3iub', '1414_7.jpg'),
('_96nfogape65lre3iub', '1414_8.jpg'),
('_orsk3lp3emm8xgqvcq', '1509_1.jpg'),
('_orsk3lp3emm8xgqvcq', '1509_2.jpg'),
('_orsk3lp3emm8xgqvcq', '1509_3.jpg'),
('_orsk3lp3emm8xgqvcq', '1509_4.jpg'),
('_orsk3lp3emm8xgqvcq', '1509_5.jpg'),
('_orsk3lp3emm8xgqvcq', '1509_8.jpg'),
('_orsk3lp3emm8xgqvcq', '1509_9.jpg'),
('_orsk3lp3emm8xgqvcq', '1509_10.jpg');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `productSizes`
--

CREATE TABLE `productSizes` (
  `productCode` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `size` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `stock` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Tablo döküm verisi `productSizes`
--

INSERT INTO `productSizes` (`productCode`, `size`, `stock`) VALUES
('_482ty5lp0cqrsjr2in', 'S', '12'),
('_482ty5lp0cqrsjr2in', 'M', '32'),
('_482ty5lp0cqrsjr2in', 'L', '32'),
('_p0hbvxu16g99y9cziw', 'S', '325'),
('_orsk3lp3emm8xgqvcq', 'S', '15'),
('_orsk3lp3emm8xgqvcq', 'M', '15'),
('_orsk3lp3emm8xgqvcq', 'L', '15'),
('_orsk3lp3emm8xgqvcq', 'XL', '15');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `productSpecs`
--

CREATE TABLE `productSpecs` (
  `productCode` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `specid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Tablo döküm verisi `productSpecs`
--

INSERT INTO `productSpecs` (`productCode`, `specid`) VALUES
('_q6f4rjlpb68v9zda4o', 'Bedava Kargo'),
('_m2pzt1zg6uulietdgq', 'Bedava Kargo'),
('_p0hbvxu16g99y9cziw', 'Bedava Kargo'),
('_79jarkzar2x91sep2l', 'Bedava Kargo'),
('_5sn69cx7plxlb9l3fz', 'Bedava Kargo'),
('_96nfogape65lre3iub', 'Bedava Kargo');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `productVariants`
--

CREATE TABLE `productVariants` (
  `productCode` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `variantName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `variantValue` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Tablo döküm verisi `productVariants`
--

INSERT INTO `productVariants` (`productCode`, `variantName`, `variantValue`) VALUES
('_q6f4rjlpb68v9zda4o', 'Renk', 'Mavi'),
('_m2pzt1zg6uulietdgq', 'Renk', 'Turuncu'),
('_moq8v6peup8ueexo1d', 'Renk', 'Beyaz'),
('_u88lfl549qqmmzux456', 'Renk', 'Siyah'),
('_p0hbvxu16g99y9cziw', 'Renk', 'Sarı'),
('_m2pzt1zg6uulietdgq', 'Tip', 'Uzun Kol'),
('_u88lfl549qqmmzux456', 'Tip', 'Uzun Kol'),
('_79jarkzar2x91sep2l', 'Renk', 'Sülfür'),
('_5sn69cx7plxlb9l3fz', 'Renk', 'Asfalt'),
('_96nfogape65lre3iub', 'Cinsiyet', 'Unisex'),
('_96nfogape65lre3iub', 'Renk', 'Okyanus'),
('_orsk3lp3emm8xgqvcq', 'Renk', 'Sulphur'),
('_p0hbvxu16g99y9cziw', 'Tip', 'Kısa kol');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `showcase`
--

CREATE TABLE `showcase` (
  `imgLink` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `uid` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Tablo döküm verisi `showcase`
--

INSERT INTO `showcase` (`imgLink`, `uid`) VALUES
('612d0f4fad06ashowcase1.png', 18);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `showcaseTime`
--

CREATE TABLE `showcaseTime` (
  `time` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Tablo döküm verisi `showcaseTime`
--

INSERT INTO `showcaseTime` (`time`) VALUES
(5);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sizes`
--

CREATE TABLE `sizes` (
  `size` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Tablo döküm verisi `sizes`
--

INSERT INTO `sizes` (`size`, `type`) VALUES
('S', NULL),
('M', NULL),
('L', NULL),
('XL', NULL),
('XS', NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `specs`
--

CREATE TABLE `specs` (
  `id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `img` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `uid` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Tablo döküm verisi `specs`
--

INSERT INTO `specs` (`id`, `img`, `uid`) VALUES
('Bedava Kargo', 'free-delivery.png', 17);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `subCategories`
--

CREATE TABLE `subCategories` (
  `mainCategorie` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subCategorie` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Tablo döküm verisi `subCategories`
--

INSERT INTO `subCategories` (`mainCategorie`, `subCategorie`) VALUES
('Cep Telefonu & Aksesuar', 'Cep Telefonu'),
('Cep Telefonu & Aksesuar', 'Cep Telefonu Aksesuar'),
('Cep Telefonu & Aksesuar', 'Giyilebilir Teknoloji'),
('Cep Telefonu & Aksesuar', 'Hafıza Kartı'),
('Cep Telefonu & Aksesuar', 'Cep Telefonu Yedek Parça'),
('Cep Telefonu & Aksesuar', 'Sim Kart, Hat'),
('Cep Telefonu & Aksesuar', 'Sabit Telefonlar'),
('Giyim', 'T-Shirt'),
('Giyim', 'Shorts'),
('Giyim', 'Hoodie'),
('Giyim', 'Jackets'),
('Deneme', 'Alt demen');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `User`
--

CREATE TABLE `User` (
  `ID` int(11) NOT NULL,
  `Username` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` text NOT NULL,
  `DateOfBirth` date NOT NULL,
  `Photo` varchar(255) DEFAULT NULL,
  `VerificationCode` varchar(255) NOT NULL,
  `Verified` tinyint(1) NOT NULL DEFAULT '0',
  `ResetPasswordHash` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `User`
--

INSERT INTO `User` (`ID`, `Username`, `Email`, `Password`, `DateOfBirth`, `Photo`, `VerificationCode`, `Verified`, `ResetPasswordHash`) VALUES
(17, 'admin', 'nonamenofame58@gmail.com', '$2y$10$gYV1UjDeGAKubrXea8QcAuPaUSQECV.K4Xy2Kqk8ZHGCOkt6lNL7W', '1111-11-11', '', '70c639df5e30bdee440e4cdf599fec2b', 1, NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `variants`
--

CREATE TABLE `variants` (
  `variant` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `uid` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Tablo döküm verisi `variants`
--

INSERT INTO `variants` (`variant`, `uid`) VALUES
('Renk', 12),
('Tip', 13),
('Model', 14),
('Cinsiyet', 16);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`uid`);

--
-- Tablo için indeksler `mainCategories`
--
ALTER TABLE `mainCategories`
  ADD PRIMARY KEY (`uid`);

--
-- Tablo için indeksler `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`uid`);

--
-- Tablo için indeksler `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`uid`);

--
-- Tablo için indeksler `showcase`
--
ALTER TABLE `showcase`
  ADD PRIMARY KEY (`uid`);

--
-- Tablo için indeksler `specs`
--
ALTER TABLE `specs`
  ADD PRIMARY KEY (`uid`);

--
-- Tablo için indeksler `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Tablo için indeksler `variants`
--
ALTER TABLE `variants`
  ADD PRIMARY KEY (`uid`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `admin`
--
ALTER TABLE `admin`
  MODIFY `uid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Tablo için AUTO_INCREMENT değeri `mainCategories`
--
ALTER TABLE `mainCategories`
  MODIFY `uid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- Tablo için AUTO_INCREMENT değeri `orders`
--
ALTER TABLE `orders`
  MODIFY `uid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Tablo için AUTO_INCREMENT değeri `product`
--
ALTER TABLE `product`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- Tablo için AUTO_INCREMENT değeri `showcase`
--
ALTER TABLE `showcase`
  MODIFY `uid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Tablo için AUTO_INCREMENT değeri `specs`
--
ALTER TABLE `specs`
  MODIFY `uid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Tablo için AUTO_INCREMENT değeri `User`
--
ALTER TABLE `User`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Tablo için AUTO_INCREMENT değeri `variants`
--
ALTER TABLE `variants`
  MODIFY `uid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
