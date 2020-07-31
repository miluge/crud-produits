-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 31 juil. 2020 à 08:07
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

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
(1, 'Test'),
(2, 'cat2');

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

DROP TABLE IF EXISTS `image`;
CREATE TABLE IF NOT EXISTS `image` (
  `id_image` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `image` varchar(45) NOT NULL,
  PRIMARY KEY (`id_image`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `image`
--

INSERT INTO `image` (`id_image`, `name`, `image`) VALUES
(1, 'Test', ''),
(2, 'image2', '');

-- --------------------------------------------------------

--
-- Structure de la table `manual`
--

DROP TABLE IF EXISTS `manual`;
CREATE TABLE IF NOT EXISTS `manual` (
  `id_manual` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_manual`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `manual`
--

INSERT INTO `manual` (`id_manual`, `name`) VALUES
(1, 'Test'),
(2, 'manual2');

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id_products` int(11) NOT NULL AUTO_INCREMENT,
  `image_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `manual_id` int(11) NOT NULL,
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
  KEY `image_id` (`image_id`),
  KEY `manual_id` (`manual_id`),
  KEY `id_type` (`id_type`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`id_products`, `image_id`, `category_id`, `manual_id`, `source`, `id_type`, `name`, `reference_number`, `price`, `buy_date`, `end_warranty`, `care_products`) VALUES
(1, 1, 1, 1, 'blabla', 1, 'Test', '1234', '100', '2020-07-01', '2020-07-02', 'Test care instructions'),
(3, 2, 2, 2, 'bla', 2, 'nom prod', '1111', '222', '2020-07-28', '2020-07-24', 'DDDDDDDDDDDDDD');

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

DROP TABLE IF EXISTS `type`;
CREATE TABLE IF NOT EXISTS `type` (
  `id_type` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id_type`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

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
(2, 'John Doe', 'admin@login.com', '12345'),
(3, 'John Doe', 'admin@login.com', '12345');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `image_ibfk_1` FOREIGN KEY (`id_image`) REFERENCES `products` (`image_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `manual`
--
ALTER TABLE `manual`
  ADD CONSTRAINT `manual_ibfk_1` FOREIGN KEY (`id_manual`) REFERENCES `products` (`manual_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `type`
--
ALTER TABLE `type`
  ADD CONSTRAINT `type_ibfk_1` FOREIGN KEY (`id_type`) REFERENCES `products` (`id_type`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
