SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE IF NOT EXISTS `crud` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `crud`;

CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20230202131437', '2023-02-02 18:08:24', 139),
('DoctrineMigrations\\Version20230202133814', '2023-02-02 18:08:24', 35),
('DoctrineMigrations\\Version20230204100136', '2023-02-04 10:02:17', 1413);

CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `varehouse_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
