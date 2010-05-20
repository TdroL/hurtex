-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas wygenerowania: 20 Maj 2010, 11:45
-- Wersja serwera: 5.1.41
-- Wersja PHP: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `projekt`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=61 ;

--
-- Zrzut danych tabeli `categories`
--

INSERT INTO `categories` (`id`, `title`, `category_id`) VALUES
(0, 'Brak', NULL),
(9, 'Edukacyjne', 0),
(10, 'Klocki', 0),
(11, 'Kolejki', 0),
(12, 'Lalki', 0),
(13, 'Maskotki', 0),
(14, 'Piłki', 0),
(15, 'Pojazdy', 0),
(16, 'Puzzle', 0),
(22, 'Pozostałe', 0),
(38, 'Modele', 0),
(39, 'Figurki', 0),
(40, 'AGD', 9),
(41, 'Do majsterkowania', 9),
(42, 'Gry', 9),
(43, 'Instrumenty', 9),
(44, 'Komputerki', 9),
(45, 'Układanki', 9),
(46, 'Pozostałe', 9),
(47, 'Action Man', 39),
(48, 'Postacie z bajek i filmów', 39),
(49, 'Power Rangers', 39),
(50, 'Star Wars', 39),
(51, 'Transformers', 39),
(52, 'Zwierzęta', 39),
(53, 'Pozostałe', 39),
(54, 'Do 100 elementów', 16),
(55, 'Od 101 do 500 elementów', 16),
(56, 'Powyżej 501', 16),
(57, 'Pozostałe', 16),
(58, 'Jeździki', 15),
(59, 'Na pedały', 15),
(60, 'Pozostałe', 15);

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `second_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `password` char(50) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `company_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nip` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Zrzut danych tabeli `clients`
--

INSERT INTO `clients` (`id`, `first_name`, `second_name`, `email`, `password`, `address`, `phone_number`, `company_name`, `nip`) VALUES
(1, 'Jan', 'Kowalski', 'dupa2@o2.pl', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'ul. ajrzynowA 32/6', '9876543219', '', '0'),
(3, 'Alina', 'Krawczyk', 'dupa1@o2.pl', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'ul. Wolska 4', '0815015781', 'Dupa', '2147483647'),
(4, 'Marian', 'Marian', 'marian@mail.com', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'test', '512 689 987', '', '768-000-24-66');

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `date` int(11) unsigned NOT NULL,
  `client_id` int(11) unsigned NOT NULL,
  `status` enum('added','accepted','send','canceled') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'accepted',
  `printed` tinyint(1) NOT NULL DEFAULT '0',
  `address` text COLLATE utf8_unicode_ci,
  `paragon_number` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `invoice` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment` enum('cash','transfer') COLLATE utf8_unicode_ci NOT NULL,
  `sendform_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `paragon_number` (`paragon_number`,`invoice`),
  KEY `client_id` (`client_id`),
  KEY `send_form_id` (`sendform_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Zrzut danych tabeli `orders`
--


-- --------------------------------------------------------

--
-- Struktura tabeli dla  `prices`
--

CREATE TABLE IF NOT EXISTS `prices` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) unsigned DEFAULT NULL,
  `price` float NOT NULL,
  `date` int(11) unsigned NOT NULL,
  `vat_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `vat_id` (`vat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Zrzut danych tabeli `prices`
--


-- --------------------------------------------------------

--
-- Struktura tabeli dla  `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `category_id` int(11) unsigned DEFAULT NULL,
  `unit_id` int(11) unsigned DEFAULT NULL,
  `quantity` float NOT NULL,
  `minimal_quantity` float NOT NULL,
  `price_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  KEY `unit_id` (`unit_id`),
  KEY `price_id` (`price_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Zrzut danych tabeli `products`
--


-- --------------------------------------------------------

--
-- Struktura tabeli dla  `products_orders`
--

CREATE TABLE IF NOT EXISTS `products_orders` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) unsigned NOT NULL,
  `quantity` float unsigned NOT NULL,
  `order_id` int(11) unsigned NOT NULL,
  `price_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`),
  KEY `price_id` (`price_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Zrzut danych tabeli `products_orders`
--


-- --------------------------------------------------------

--
-- Struktura tabeli dla  `products_suppliers`
--

CREATE TABLE IF NOT EXISTS `products_suppliers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `suppliers_id` int(11) unsigned NOT NULL,
  `products_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `suppliers_id` (`suppliers_id`),
  KEY `products_id` (`products_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Zrzut danych tabeli `products_suppliers`
--


-- --------------------------------------------------------

--
-- Struktura tabeli dla  `products_supplies`
--

CREATE TABLE IF NOT EXISTS `products_supplies` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `quantity` float NOT NULL,
  `product_id` int(11) unsigned NOT NULL,
  `supply_id` int(11) unsigned NOT NULL,
  `supplier_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`,`supply_id`,`supplier_id`),
  KEY `supply_id` (`supply_id`),
  KEY `supplier_id` (`supplier_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Zrzut danych tabeli `products_supplies`
--


-- --------------------------------------------------------

--
-- Struktura tabeli dla  `product_search`
--

CREATE TABLE IF NOT EXISTS `product_search` (
  `product_id` int(11) unsigned NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `full_data` text COLLATE utf8_unicode_ci NOT NULL,
  KEY `product_id` (`product_id`),
  FULLTEXT KEY `container` (`name`,`full_data`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `product_search`
--


-- --------------------------------------------------------

--
-- Struktura tabeli dla  `sendforms`
--

CREATE TABLE IF NOT EXISTS `sendforms` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `price` float unsigned NOT NULL DEFAULT '0',
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `prive_id` (`price`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Zrzut danych tabeli `sendforms`
--

INSERT INTO `sendforms` (`id`, `price`, `name`) VALUES
(1, 10, 'Poczta polska'),
(2, 0, 'Odbiór  osobisty');

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `suppliers`
--

CREATE TABLE IF NOT EXISTS `suppliers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Zrzut danych tabeli `suppliers`
--


-- --------------------------------------------------------

--
-- Struktura tabeli dla  `supplies`
--

CREATE TABLE IF NOT EXISTS `supplies` (
  `id` int(11) unsigned NOT NULL,
  `date` int(11) unsigned NOT NULL,
  `status` enum('added','in-progress','done','canceled') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'added',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `supplies`
--


-- --------------------------------------------------------

--
-- Struktura tabeli dla  `units`
--

CREATE TABLE IF NOT EXISTS `units` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` enum('integer','float') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'integer',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Zrzut danych tabeli `units`
--

INSERT INTO `units` (`id`, `name`, `type`) VALUES
(1, 'szt.', 'integer'),
(2, 'm', 'float');

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `vats`
--

CREATE TABLE IF NOT EXISTS `vats` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `value` float NOT NULL,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Zrzut danych tabeli `vats`
--

INSERT INTO `vats` (`id`, `value`, `name`) VALUES
(1, 0, 'z/w'),
(2, 0, '0%'),
(3, 0.07, '7%'),
(4, 0.22, '22%'),
(5, 0.4, '40%');

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`sendform_id`) REFERENCES `sendforms` (`id`);

--
-- Ograniczenia dla tabeli `prices`
--
ALTER TABLE `prices`
  ADD CONSTRAINT `prices_ibfk_4` FOREIGN KEY (`vat_id`) REFERENCES `vats` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `prices_ibfk_3` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Ograniczenia dla tabeli `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_6` FOREIGN KEY (`price_id`) REFERENCES `prices` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `products_ibfk_4` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `products_ibfk_5` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE SET NULL;

--
-- Ograniczenia dla tabeli `products_orders`
--
ALTER TABLE `products_orders`
  ADD CONSTRAINT `products_orders_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_orders_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_orders_ibfk_3` FOREIGN KEY (`price_id`) REFERENCES `prices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `products_suppliers`
--
ALTER TABLE `products_suppliers`
  ADD CONSTRAINT `products_suppliers_ibfk_1` FOREIGN KEY (`suppliers_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_suppliers_ibfk_2` FOREIGN KEY (`products_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `products_supplies`
--
ALTER TABLE `products_supplies`
  ADD CONSTRAINT `products_supplies_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `products_supplies_ibfk_2` FOREIGN KEY (`supply_id`) REFERENCES `supplies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_supplies_ibfk_3` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
