-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: database
-- Час створення: Бер 01 2023 р., 20:23
-- Версія сервера: 5.7.41
-- Версія PHP: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База даних: `crud`
--

-- --------------------------------------------------------

--
-- Структура таблиці `doctrine_migration_versions`
--

CREATE DATABASE crud;

USE crud;

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп даних таблиці `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20230202131437', '2023-02-02 18:08:24', 139),
('DoctrineMigrations\\Version20230202133814', '2023-02-02 18:08:24', 35),
('DoctrineMigrations\\Version20230204100136', '2023-02-04 10:02:17', 1413),
('DoctrineMigrations\\Version20230226195532', '2023-03-01 20:02:53', 430);

-- --------------------------------------------------------

--
-- Структура таблиці `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблиці `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп даних таблиці `order`
--

INSERT INTO `order` (`id`, `user_id`, `product_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 26, 4),
(4, 25, 5),
(5, 1, 3),
(6, 3, 9),
(7, 3, 1),
(8, 1, 7),
(9, 23, 6),
(10, 1, 9),
(11, 30, 6);

-- --------------------------------------------------------

--
-- Структура таблиці `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `varehouse_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп даних таблиці `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `varehouse_id`) VALUES
(1, 'Milk', 3, 1),
(2, 'Bread', 2, 4),
(3, 'Butter', 8, 2),
(4, 'Table', 199, 2),
(5, 'Phone', 899, 4),
(6, 'TV', 599, 3),
(7, 'Apple', 1, 1),
(8, 'Cabbage', 9, 6),
(9, 'Coffee', 15, 1);

-- --------------------------------------------------------

--
-- Структура таблиці `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп даних таблиці `user`
--

INSERT INTO `user` (`id`, `name`, `password`, `email`, `role`, `avatar`, `city`) VALUES
(1, 'Serhii', '85136c79cbf', 'asdkjagh@df.ka', 'admin', NULL, NULL),
(3, 'Linch', 'linchpenetraitor', 'd12@asd.sd', '1d', 'C:\\Users\\PaCCiFFisT\\AppData\\Local\\Temp\\php10EC.tmp', NULL),
(4, 'first', 'asdasdasdasd', 'asdasd@asd.sdo', 'admin', NULL, NULL),
(23, 'Thanos', '123333s', 'asdasd@asd.sdo3233', 'admin1231', NULL, NULL),
(24, 'serhii', 'qwe``q', 'asd@asd.sd', 'admin', NULL, 'Lutsk'),
(25, 'Serhii', '123', 'sdkjfs@asd.ss', 'user', NULL, 'Lutsk'),
(26, 'Iryna', 'a;ljkflskjglsdehjf', 'asdaddf@asdd1245.sd', 'admin', NULL, 'Lutsk'),
(27, 'aaasd', 'ddd', 'ddsd@asd.sddddd', 'admin', NULL, 'ds'),
(28, 'Alex', 'lallkdkkfkdfkfo', 'asldkfhjsklg@asdasd.ddd', 'admin', NULL, 'oooasd'),
(29, 'kldjmfhgksdyghk;sjgh', 'ojkshdgksjdgh;i', 'olsdhg@asd.asd', 'user', NULL, 'sjhhhh'),
(30, 'lloooooooo', 'o10294u0wuetlsdfng984yu39846', 'lsdhfgjjks@asdf.ss', 'admin', NULL, 'Liiitg'),
(31, 'OOpprr asddd', 'fasfzxvczvxcb', 'fffffffff@fff.fff', 'admin', NULL, 'Liiitg'),
(32, 'Alex', 'lkdsfhdjfhjdjfmgh', 'alex@gmail.com', 'user', NULL, 'livia');

--
-- Індекси збережених таблиць
--

--
-- Індекси таблиці `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Індекси таблиці `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Індекси таблиці `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_PRODUCT` (`product_id`) USING BTREE,
  ADD KEY `fk_user` (`user_id`);

--
-- Індекси таблиці `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для збережених таблиць
--

--
-- AUTO_INCREMENT для таблиці `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблиці `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблиці `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблиці `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Обмеження зовнішнього ключа збережених таблиць
--

--
-- Обмеження зовнішнього ключа таблиці `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `fk_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
