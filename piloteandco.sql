-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 13 fév. 2025 à 13:34
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `piloteandco`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id_categorie` int(8) NOT NULL,
  `nom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id_commande` int(8) NOT NULL,
  `id_utilisateur` int(8) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `prix_total` float NOT NULL,
  `id_lieu` int(8) NOT NULL,
  `id_type` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `detailscommande`
--

CREATE TABLE `detailscommande` (
  `id_commande` int(8) NOT NULL,
  `id_produit` int(8) NOT NULL,
  `qte` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `lieu`
--

CREATE TABLE `lieu` (
  `id_lieu` int(8) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE `panier` (
  `id_utilisateur` int(8) NOT NULL,
  `id_produit` int(8) NOT NULL,
  `qte` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id_produit` int(8) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `qte_dispo` int(4) NOT NULL,
  `img` varchar(255) NOT NULL,
  `poids` int(4) NOT NULL,
  `description` varchar(255) NOT NULL,
  `id_categorie` int(8) NOT NULL,
  `prix` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `typelivraison`
--

CREATE TABLE `typelivraison` (
  `id_type` int(8) NOT NULL,
  `nom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id_utilisateur` int(8) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `date_naiss` date NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `code_postal` int(5) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `isadmin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id_categorie`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id_commande`),
  ADD KEY `lieu_commande_fk` (`id_lieu`),
  ADD KEY `type_commande_fk` (`id_type`),
  ADD KEY `utilisateur_commande_fk` (`id_utilisateur`);

--
-- Index pour la table `detailscommande`
--
ALTER TABLE `detailscommande`
  ADD PRIMARY KEY (`id_commande`,`id_produit`),
  ADD KEY `produit_contrainte` (`id_produit`);

--
-- Index pour la table `lieu`
--
ALTER TABLE `lieu`
  ADD PRIMARY KEY (`id_lieu`);

--
-- Index pour la table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`id_utilisateur`,`id_produit`),
  ADD KEY `produit_panier_fk` (`id_produit`),
  ADD KEY `utilisateur_panier_fk` (`id_utilisateur`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id_produit`),
  ADD KEY `categorie_produit_fk` (`id_categorie`);

--
-- Index pour la table `typelivraison`
--
ALTER TABLE `typelivraison`
  ADD PRIMARY KEY (`id_type`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id_utilisateur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id_categorie` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id_commande` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `lieu`
--
ALTER TABLE `lieu`
  MODIFY `id_lieu` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id_produit` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `typelivraison`
--
ALTER TABLE `typelivraison`
  MODIFY `id_type` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id_utilisateur` int(8) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `lieu_commande_fk` FOREIGN KEY (`id_lieu`) REFERENCES `lieu` (`id_lieu`),
  ADD CONSTRAINT `type_commande_fk` FOREIGN KEY (`id_type`) REFERENCES `typelivraison` (`id_type`),
  ADD CONSTRAINT `utilisateur_commande_fk` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`);

--
-- Contraintes pour la table `detailscommande`
--
ALTER TABLE `detailscommande`
  ADD CONSTRAINT `commande_contrainte` FOREIGN KEY (`id_commande`) REFERENCES `commande` (`id_commande`),
  ADD CONSTRAINT `produit_contrainte` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id_produit`);

--
-- Contraintes pour la table `panier`
--
ALTER TABLE `panier`
  ADD CONSTRAINT `produit_panier_fk` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id_produit`),
  ADD CONSTRAINT `utilisateur_panier_fk` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `categorie_produit_fk` FOREIGN KEY (`id_categorie`) REFERENCES `categorie` (`id_categorie`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
