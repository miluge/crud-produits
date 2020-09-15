-- phpMyAdmin SQL Dump
-- version 4.9.5deb2~bpo10+1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : ven. 21 août 2020 à 12:28
-- Version du serveur :  10.3.23-MariaDB-0+deb10u1
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `crud_produits`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `id_category` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id_category`, `name`) VALUES
(1, 'Home Appliances'),
(2, 'Tv, Video, Audio'),
(3, 'Tools'),
(4, 'Vehicle'),
(5, 'Electronics');

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE `products` (
  `id_products` int(11) NOT NULL,
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
  `care_products` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`id_products`, `image_url`, `category_id`, `manual_url`, `source`, `id_type`, `name`, `reference_number`, `price`, `buy_date`, `end_warranty`, `care_products`) VALUES
(55, 'TV Thomson.jpg', 2, 'TV Thomson.pdf', 'Boulanger Chateaufarine', 1, 'TV LED Thomson', '55UE6400', '429', '2020-04-01', '2022-04-01', 'Don\'t touch screen'),
(56, 'Golf.jpg', 4, '', 'Garage Volkswagen Besançon', 1, 'Volkswagen Golf 7', 'AA-123-AA', '17990', '2019-09-19', '2022-09-19', 'Contrôle technique tous les 2 ans'),
(59, 'lave linge.png', 1, 'Lave linge.pdf', 'www.boulanger.com', 1, 'Lave linge hublot LG', 'F94J62WH', '499', '2018-09-04', '2020-09-04', 'Vider la trappe régulièrement'),
(65, 'perceuse teeno.jpg', 3, 'perceuse.pdf', 'amazon.fr', 1, 'TEENO Perceuse visseuse', 'B07ZC1VN5N', '59', '2019-10-16', '2019-10-16', 'Changer les piles si manque de puissance'),
(66, 'ordi.jpg', 5, 'x240_ug_en.pdf', 'tradediscount.com', 1, 'Lenovo ThinkPad X240', '03TD3214', '199', '2020-04-09', '2021-04-09', 'Redémarrer de temps en temps'),
(67, 'iphone.jpg', 5, 'iphone-7-and-8-ios13-info.pdf', 'backmarket.fr', 2, 'iPhone 7', 'MN922GH/A', '210', '2020-03-13', '2021-03-13', 'Utiliser une coque de protection');

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

CREATE TABLE `type` (
  `id_type` int(11) NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(2, 'John Doe', 'admin@login.com', '12345');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_category`);

--
-- Index pour la table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_products`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `id_type` (`id_type`);

--
-- Index pour la table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id_type`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `id_products` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT pour la table `type`
--
ALTER TABLE `type`
  MODIFY `id_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
