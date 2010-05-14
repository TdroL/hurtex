-- phpMyAdmin SQL Dump
-- version 3.3.0
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas wygenerowania: 15 Maj 2010, 01:53
-- Wersja serwera: 5.1.37
-- Wersja PHP: 5.3.0

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
-- Struktura tabeli dla  `alt_addresses`
--

CREATE TABLE IF NOT EXISTS `alt_addresses` (
  `id` int(11) unsigned NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `alt_addresses`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Zrzut danych tabeli `categories`
--

INSERT INTO `categories` (`id`, `title`, `category_id`) VALUES
(0, 'Brak', NULL),
(1, 'RTV', 0),
(2, 'Telewizory', 1),
(3, 'Hi-Fi', 1),
(5, 'Nowe prawo cywilne', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `second_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `password` char(32) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `company_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nip` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Zrzut danych tabeli `clients`
--

INSERT INTO `clients` (`id`, `first_name`, `second_name`, `email`, `password`, `address`, `phone_number`, `company_name`, `nip`) VALUES
(1, 'Jan', 'Kowalski', 'dupa2@o2.pl', '', 'ul. ajrzynowA 32/6', '9876543219', '', 0),
(3, 'Alina', 'Krawczyk', 'dupa1@o2.pl', '8451ba8a14d79753d34cb33b51ba46b4', 'ul. Wolska 4', '0815015781', 'Dupa', 2147483647);

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
  `paragon_number` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `invoice` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `address_id` int(11) unsigned DEFAULT NULL,
  `payment` enum('cach','transfer') COLLATE utf8_unicode_ci NOT NULL,
  `send_form_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `paragon_number` (`paragon_number`,`invoice`),
  KEY `client_id` (`client_id`),
  KEY `address_id` (`address_id`),
  KEY `send_form_id` (`send_form_id`)
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=21 ;

--
-- Zrzut danych tabeli `prices`
--

INSERT INTO `prices` (`id`, `product_id`, `price`, `date`, `vat_id`) VALUES
(1, 9, 23.4, 1234567890, 2),
(9, NULL, 23.45, 1273762291, 4),
(10, NULL, 123.45, 1273762732, 4),
(11, NULL, 12.32, 1273763728, 4),
(12, NULL, 324, 1273763743, 3),
(13, NULL, 12.323, 1273763758, 4),
(14, NULL, 1352, 1273836663, 1),
(15, NULL, 1352, 1273836718, 1),
(16, NULL, 1352, 1273836747, 1),
(17, NULL, 1352, 1273836759, 1),
(18, NULL, 1352, 1273836766, 1),
(19, NULL, 1352, 1273836779, 1),
(20, 13, 1352, 1273836824, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(11) unsigned DEFAULT NULL,
  `unit_id` int(11) unsigned DEFAULT NULL,
  `quantity` float NOT NULL,
  `minimal_quantity` float NOT NULL,
  `price_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  KEY `unit_id` (`unit_id`),
  KEY `price_id` (`price_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- Zrzut danych tabeli `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `category_id`, `unit_id`, `quantity`, `minimal_quantity`, `price_id`) VALUES
(1, 'nowy produkt', 'opis produktu', 1, 1, 2, 1, NULL),
(2, 'pupa, edytowany', 'pupa, poslady', 3, 2, 2, 1, NULL),
(3, 'duplikat', 'duplikat', 1, 1, 1, 1, NULL),
(7, 'Nowy produkt 2', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 3, 1, 1000, 10, NULL),
(8, 'dfasdf', 'asdf', 1, 1, 0, 0, NULL),
(9, 'szdfasdf', 'asdfasdf', 1, 1, 0, 0, 10),
(10, 'dgfh', 'dfgh', 1, 1, 0, 0, 12),
(11, 'asd', 'dfhdfgh', 1, 1, 0, 0, 13),
(12, 'asdf', 'sdf', 1, 1, 3, 2, 19),
(13, 'asdf', 'sdf', 1, 1, 3, 2, 20);

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
  FULLTEXT KEY `name` (`name`),
  FULLTEXT KEY `full_data` (`full_data`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `product_search`
--


-- --------------------------------------------------------

--
-- Struktura tabeli dla  `send_form`
--

CREATE TABLE IF NOT EXISTS `send_form` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `price_id` int(11) unsigned NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `prive_id` (`price_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Zrzut danych tabeli `send_form`
--


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
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`address_id`) REFERENCES `alt_addresses` (`id`);

--
-- Ograniczenia dla tabeli `prices`
--
ALTER TABLE `prices`
  ADD CONSTRAINT `prices_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prices_ibfk_2` FOREIGN KEY (`vat_id`) REFERENCES `vats` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `products_ibfk_3` FOREIGN KEY (`price_id`) REFERENCES `prices` (`id`);

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

--
-- Ograniczenia dla tabeli `send_form`
--
ALTER TABLE `send_form`
  ADD CONSTRAINT `send_form_ibfk_1` FOREIGN KEY (`price_id`) REFERENCES `prices` (`id`);
