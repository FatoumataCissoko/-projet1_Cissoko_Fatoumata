-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 21 déc. 2023 à 05:36
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ecom1_project`
--

-- --------------------------------------------------------

--
-- Structure de la table `address`
--

CREATE TABLE `address` (
  `id` bigint(20) NOT NULL,
  `street_name` varchar(255) NOT NULL,
  `street_nb` int(11) NOT NULL,
  `city` varchar(40) NOT NULL,
  `province` varchar(40) NOT NULL,
  `zip_code` varchar(6) NOT NULL,
  `country` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `order_has_product`
--

CREATE TABLE `order_has_product` (
  `order_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

CREATE TABLE `product` (
  `id` bigint(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(5,2) NOT NULL,
  `img_url` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `img_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`id`, `name`, `quantity`, `price`, `img_url`, `description`, `img_path`) VALUES
(1, 'product1', 60, 20.99, 'images/produits/ch1.jpg', 'Description product1', ''),
(2, 'product2', 40, 39.55, 'images/produits/ch2.jpg', 'Description product2', ''),
(3, 'product3', 20, 40.20, 'images/produits/ch3.jpg', 'Description product3', ''),
(4, 'product4', 20, 55.00, 'images/produits/ch4.jpg', 'Description product4', '');

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `id` bigint(20) NOT NULL,
  `name` varchar(10) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id`, `name`, `description`) VALUES
(1, 'superadmin', 'Super Administrator'),
(2, 'admin', 'admin'),
(3, 'client', 'client');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` bigint(20) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `billing_address_id` bigint(20) NOT NULL,
  `shipping_address_id` bigint(20) NOT NULL,
  `token` varchar(255) NOT NULL,
  `role_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `user_name`, `email`, `pwd`, `fname`, `lname`, `billing_address_id`, `shipping_address_id`, `token`, `role_id`) VALUES
(12, 'cissoko', 'djeme@123.com', '$2y$10$F73SglDORPUnL9Bn9hsO3OaVDoCyMM.sqML0/xJ0mT3cPrde8zPqi', 'fatou', 'kourouma', 0, 0, '', 2),
(13, 'fanta', 'fanta@123.com', '$2y$10$ySHcUkKJ2fqvNMUXthk3uez2J2kCt6G3VNFp/X3OB4tW66aA5l0V6', '', '', 0, 0, '', 2),
(42, 'binta', 'binta@test.com', '$2y$10$IJDaQqPheyyPdcgrPpNjSe1gfXCyF2PK1qMWGdLFWU/kLTLgkrlSu', '', '', 0, 0, '', 2),
(47, 'saran', 'saran@123.com', '$2y$10$UgFbRLzeR9vZQBFucnv.H.pwuICHvUEtwJglGQORCHtZXYklZT6MC', '', '', 0, 0, '', 2),
(48, 'Aya', 'aya@gmail.com', '$2y$10$0lcCZ9mZWich0ygR7OENR.i1cJuxnLT.Mu3SmN/qD77yYmAGCgTqe', '', '', 0, 0, '', 3),
(50, 'user', 'test@test.ca', '$2y$10$q1NPF6wAZZiSvJNGRECIzeBYaPLGedAOx0M0cSKy4swFCXyaZ/p32', '', '', 0, 0, '', 1),
(52, 'fayel', 'fayel@test.com', '$2y$10$IQfkdKTPGcOqXw4H2Wzh8./PTwvE3jY05TBljwtMyH9j7/tVtBz..', '', '', 0, 0, '', 3),
(53, 'Edy', 'test@test.ca', '$2y$10$ZiqM6iSxrlJiBmze4rZbTexQhfPAi0Yd1sZKdHcsDCLkbyLGbFDF2', '', '', 0, 0, '', 3),
(57, 'admin', 'admin@gmail.com', '$2y$10$omzLC2lwNnxa1r8fsQem0.4zm1C0WYFCnR8vxGurwrQUAwFPMswjO', '', '', 0, 0, '', 3),
(59, 'client', 'client@gmail.com', '$2y$10$0eDzKZ9o.M3XIUIfDTDR0.69WlW8mxKij8HMl/qDc4WAflYzjHNP6', '', '', 0, 0, '', 3);

-- --------------------------------------------------------

--
-- Structure de la table `user_order`
--

CREATE TABLE `user_order` (
  `id` bigint(20) NOT NULL,
  `ref` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `user_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `order_has_product`
--
ALTER TABLE `order_has_product`
  ADD PRIMARY KEY (`product_id`,`order_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Index pour la table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD KEY `role_id` (`role_id`);

--
-- Index pour la table `user_order`
--
ALTER TABLE `user_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `address`
--
ALTER TABLE `address`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `product`
--
ALTER TABLE `product`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT pour la table `user_order`
--
ALTER TABLE `user_order`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `order_has_product`
--
ALTER TABLE `order_has_product`
  ADD CONSTRAINT `fk_order_id` FOREIGN KEY (`order_id`) REFERENCES `user_order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_role_id` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `user_order`
--
ALTER TABLE `user_order`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
