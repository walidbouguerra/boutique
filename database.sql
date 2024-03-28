-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 21 jan. 2024 à 12:51
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `boutique`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `nom`) VALUES
(1, 'Informatique'),
(2, 'Image & son'),
(3, 'Jeux');

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE `panier` (
  `id` int(11) NOT NULL,
  `prix` float NOT NULL,
  `quantite` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL,
  `sessid` varchar(250) NOT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `panier`
--

INSERT INTO `panier` (`id`, `prix`, `quantite`, `id_produit`, `sessid`, `id_user`) VALUES
(58, 39.99, 2, 14, '2nu126fe30718fg11ge1o1vfm9', NULL),
(60, 79.94, 2, 11, '2nu126fe30718fg11ge1o1vfm9', 1);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id` int(11) NOT NULL,
  `nom` varchar(250) NOT NULL,
  `prix` float NOT NULL,
  `image` varchar(250) NOT NULL,
  `id_sous_categorie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id`, `nom`, `prix`, `image`, `id_sous_categorie`) VALUES
(1, 'LDLC PC Bazooka Gen 12 ', 999, 'pc_bazooka.jpg', 1),
(2, 'LDLC PC Perfect DDR5 ', 1599.95, 'pc_perfect.jpg', 1),
(3, 'LDLC PC Zenartic ', 949.96, 'pc_zenartic.jpg', 1),
(4, 'LDLC Aurore N3U-8-S2', 493.94, 'portable_aurore.jpg', 2),
(5, 'LDLC SPC-I3-8-240-N', 339.95, 'portable_spc.jpg', 2),
(6, 'ASRock AMD Radeon RX 7600 Phantom Gaming 8GB OC ', 349.94, 'cg_rx7600.jpg', 3),
(7, 'AMD Ryzen 3 3200G Wraith Stealth Edition (3.6 GHz / 4 GHz) ', 109.94, 'proc_ryzen.jpg', 3),
(8, 'Logitech G G502 Lightspeed ', 114.95, 'souris.jpg', 4),
(9, 'Logitech G G915 Tenkeyless Lightspeed Carbone (Tactile Version) ', 219.95, 'clavier.jpg', 4),
(10, 'Samsung 32\" LED - Smart Monitor M7 S32BM700UP ', 299.95, 'tv.jpg', 5),
(11, 'AKG K240 MKII ', 79.94, 'casque.jpg', 6),
(12, 'Sony PlayStation 5 Slim ', 599.95, 'ps5.jpg', 7),
(14, 'Assetto Corsa Competizione PS5 ', 39.99, 'jeu.jpeg', 8);

-- --------------------------------------------------------

--
-- Structure de la table `sous_categorie`
--

CREATE TABLE `sous_categorie` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `id_categorie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `sous_categorie`
--

INSERT INTO `sous_categorie` (`id`, `nom`, `id_categorie`) VALUES
(1, 'Ordinateurs', 1),
(2, 'Portables', 1),
(3, 'Pièces', 1),
(4, 'Périphériques', 1),
(5, 'Télévision', 2),
(6, 'Son numérique', 2),
(7, 'Consoles', 3),
(8, 'Jeux vidéo', 3);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(1, 'test', '$2y$10$nuHVbnZV6lOPJzCSsu718.kp7B9ERquJ6baCJOSdowOZAeMwwA9b.');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_produit` (`id_produit`),
  ADD KEY `id_user` (`id_user`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_sous_categorie` (`id_sous_categorie`);

--
-- Index pour la table `sous_categorie`
--
ALTER TABLE `sous_categorie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categorie` (`id_categorie`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `panier`
--
ALTER TABLE `panier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `sous_categorie`
--
ALTER TABLE `sous_categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `panier`
--
ALTER TABLE `panier`
  ADD CONSTRAINT `panier_ibfk_1` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id`),
  ADD CONSTRAINT `panier_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `produit_ibfk_2` FOREIGN KEY (`id_sous_categorie`) REFERENCES `sous_categorie` (`id`);

--
-- Contraintes pour la table `sous_categorie`
--
ALTER TABLE `sous_categorie`
  ADD CONSTRAINT `sous_categorie_ibfk_1` FOREIGN KEY (`id_categorie`) REFERENCES `categorie` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
