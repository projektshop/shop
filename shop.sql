-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 05 Cze 2019, 10:46
-- Wersja serwera: 10.1.40-MariaDB
-- Wersja PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `shop`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `category` char(1) COLLATE utf8_polish_ci NOT NULL,
  `brand` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `size` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `category`, `brand`, `size`, `image`) VALUES
(1, 'Nike Internationalist\r\n', '379', 'M', 'Nike', 42, 'internationalist.png'),
(2, 'Nike Air Force 1 Sage Low', '469', 'D', 'Nike', 39, 'sage.webp'),
(3, 'Nike Air Max 97 RF', '799', 'M', 'Nike', 41, 'rf.webp'),
(4, 'Nike Blazer Mid Rebel', '469', 'D', 'Nike', 38, 'blazer.webp'),
(5, 'Nike Phantom Vision Academy', '469', 'U', 'Nike', 40, 'phantom.webp');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_polish_ci DEFAULT NULL,
  `role` varchar(25) COLLATE utf8_polish_ci NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `address`, `role`) VALUES
(1, 'admin@admin.pl', 'Administrator', '$2a$10$tieGy/JQdPyYmtdKFopqHuJWRGqJysuMwjuMvzW3S/tj/QHP0iDRe', NULL, 'admin'),
(2, 'psobczyk@gmail.com', 'Piotr Sobczyk', '$2y$10$0uk3KGp8PSvVwiny291TvOUFrz1lq2mlydMgXlLzx1iOOX32mISJy', 'Al.Jana PawÅ‚a II', 'user'),
(3, 'emalina@hotmail.com', 'Erik Malinowski', '$2y$10$TIUoFhUSw4gPRSOGHoXhG.obm9DPKTjsrxt4Qd396dnZfOcNZNaiC', 'Al.Jana PawÅ‚a II', 'user');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeksy dla tabeli `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `cart_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
