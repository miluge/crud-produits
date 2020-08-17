-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 17 août 2020 à 09:32
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `crud-produits`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id_category` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_category`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id_category`, `name`) VALUES
(1, 'cat1'),
(2, 'cat2');

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id_products` int(11) NOT NULL AUTO_INCREMENT,
  `image_url` varchar(45) NOT NULL,
  `category_id` int(11) NOT NULL,
  `manual_url` varchar(45) NOT NULL,
  `source` varchar(45) NOT NULL,
  `id_type` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `reference_number` varchar(45) NOT NULL,
  `price` varchar(45) NOT NULL,
  `buy_date` date NOT NULL,
  `end_warranty` date NOT NULL,
  `care_products` text NOT NULL,
  PRIMARY KEY (`id_products`),
  KEY `category_id` (`category_id`),
  KEY `id_type` (`id_type`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`id_products`, `image_url`, `category_id`, `manual_url`, `source`, `id_type`, `name`, `reference_number`, `price`, `buy_date`, `end_warranty`, `care_products`) VALUES
(16, '1', 1, '1', 'ici', 1, 'TTESTT', '1234', '9000', '2020-07-01', '2020-07-16', 'très fragile'),
(19, '1', 1, '1', 'evhuia', 1, 'Guillaume', '1212', '123', '2020-07-16', '2020-07-11', 'rvrzvr'),
(20, '1', 1, '1', 'qvqeb', 1, 'excursion test', '1212', '111', '2020-07-01', '2020-07-29', 'zefe'),
(21, '1', 1, '1', 'qvqeb', 1, 'excursion test', '1212', '111', '2020-07-01', '2020-07-29', 'zefe'),
(22, '1', 1, '1', 'qvqeb', 1, 'excursion test', '1212', '111', '2020-07-01', '2020-07-29', 'zefe'),
(23, '1', 1, '1', 'qvqeb', 1, 'excursion test', '1212', '111', '2020-07-01', '2020-07-29', 'zefe'),
(24, 'Array', 2, 'Array', 'efaevea', 1, 'OYUDONPZYD', '1233', '222', '2020-08-27', '2020-08-30', 'eavveve'),
(25, 'Array', 1, 'Array', 'cav', 1, 'TEEEEEETS', 'evaev', '344', '2020-08-07', '2020-08-21', 'aeveav'),
(26, 'Array', 2, 'Array', 'here.com', 2, 'local test', '777', '233', '2020-08-21', '2020-09-06', 'fragile');

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

DROP TABLE IF EXISTS `type`;
CREATE TABLE IF NOT EXISTS `type` (
  `id_type` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id_type`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `type`
--

INSERT INTO `type` (`id_type`, `name`) VALUES
(1, 'Offline'),
(2, 'Online');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(2, 'John Doe', 'admin@login.com', '12345');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`id_type`) REFERENCES `type` (`id_type`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id_category`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
