-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : jeu. 23 mars 2023 à 10:37
-- Version du serveur : 10.5.18-MariaDB-0+deb11u1
-- Version de PHP : 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `PROJETWEBEDIA`
--

-- --------------------------------------------------------

--
-- Structure de la table `CanalEquipement`
--

CREATE TABLE `CanalEquipement` (
  `id` int(11) NOT NULL,
  `orderIndex` int(11) NOT NULL,
  `idEquipement` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `CanalValue`
--

CREATE TABLE `CanalValue` (
  `idInstanceEquip` int(11) NOT NULL,
  `idCanalEquip` int(11) NOT NULL,
  `idScene` int(11) NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Equipement`
--

CREATE TABLE `Equipement` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `InstanceEquipement`
--

CREATE TABLE `InstanceEquipement` (
  `idEquipement` int(11) NOT NULL,
  `adresse` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Scene`
--

CREATE TABLE `Scene` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Scene`
--

INSERT INTO `Scene` (`id`, `name`) VALUES
(1, 'Océan'),
(2, 'Volcan');

-- --------------------------------------------------------

--
-- Structure de la table `SceneParUser`
--

CREATE TABLE `SceneParUser` (
  `idUser` int(11) NOT NULL,
  `idScene` int(11) NOT NULL,
  `positionTableau` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `User`
--

CREATE TABLE `User` (
  `id` int(11) NOT NULL,
  `login` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `User`
--

INSERT INTO `User` (`id`, `login`, `password`) VALUES
(1, 'Inox', 'Tag');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `CanalEquipement`
--
ALTER TABLE `CanalEquipement`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idEquipement` (`idEquipement`);

--
-- Index pour la table `CanalValue`
--
ALTER TABLE `CanalValue`
  ADD KEY `idCanalEquip` (`idCanalEquip`),
  ADD KEY `idScene` (`idScene`),
  ADD KEY `idInstanceEquip` (`idInstanceEquip`);

--
-- Index pour la table `Equipement`
--
ALTER TABLE `Equipement`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `InstanceEquipement`
--
ALTER TABLE `InstanceEquipement`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Scene`
--
ALTER TABLE `Scene`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `SceneParUser`
--
ALTER TABLE `SceneParUser`
  ADD KEY `idUser` (`idUser`,`idScene`),
  ADD KEY `idScene` (`idScene`);

--
-- Index pour la table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `CanalEquipement`
--
ALTER TABLE `CanalEquipement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Equipement`
--
ALTER TABLE `Equipement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Scene`
--
ALTER TABLE `Scene`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `User`
--
ALTER TABLE `User`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `CanalEquipement`
--
ALTER TABLE `CanalEquipement`
  ADD CONSTRAINT `CanalEquipement_ibfk_1` FOREIGN KEY (`idEquipement`) REFERENCES `Equipement` (`id`);

--
-- Contraintes pour la table `CanalValue`
--
ALTER TABLE `CanalValue`
  ADD CONSTRAINT `CanalValue_ibfk_1` FOREIGN KEY (`idCanalEquip`) REFERENCES `CanalEquipement` (`id`),
  ADD CONSTRAINT `CanalValue_ibfk_2` FOREIGN KEY (`idScene`) REFERENCES `Scene` (`id`),
  ADD CONSTRAINT `CanalValue_ibfk_3` FOREIGN KEY (`idInstanceEquip`) REFERENCES `InstanceEquipement` (`id`);

--
-- Contraintes pour la table `SceneParUser`
--
ALTER TABLE `SceneParUser`
  ADD CONSTRAINT `SceneParUser_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `User` (`id`),
  ADD CONSTRAINT `SceneParUser_ibfk_2` FOREIGN KEY (`idScene`) REFERENCES `Scene` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;