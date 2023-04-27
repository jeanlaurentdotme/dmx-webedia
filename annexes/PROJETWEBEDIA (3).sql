-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : jeu. 27 avr. 2023 à 15:07
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
-- Structure de la table `SceneParUserTest`
--

CREATE TABLE `SceneParUserTest` (
  `idUser` int(11) DEFAULT NULL,
  `idScene` int(11) DEFAULT NULL,
  `positionTableau` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `SceneParUserTest`
--

INSERT INTO `SceneParUserTest` (`idUser`, `idScene`, `positionTableau`) VALUES
(5, 30, 1);

-- --------------------------------------------------------

--
-- Structure de la table `SceneTest`
--

CREATE TABLE `SceneTest` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `couleurscene` varchar(50) NOT NULL,
  `L1` varchar(50) NOT NULL,
  `L2` varchar(50) NOT NULL,
  `L3` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `SceneTest`
--

INSERT INTO `SceneTest` (`id`, `nom`, `couleurscene`, `L1`, `L2`, `L3`) VALUES
(3, 'Océan', '#18afcd', '#1962d7', '#39aadb', '#37dee1'),
(4, 'sa1', '#298e3a', '#af3131', '#d3caca', '#ecb6b6'),
(5, 'sa', '#e31c1c', '#8b1313', '#473e3e', '#691717'),
(6, 'Luigi', '#00ff40', '#0aff54', '#00ff1e', '#37ff00'),
(7, 'Momo', '#ff00c8', '#ff0000', '#00e1ff', '#ffffff'),
(14, 'caCa', '#8f3900', '#bd8a00', '#b89900', '#943b00'),
(15, 'z', '#000000', '#000000', '#000000', '#000000'),
(16, 'e', '#000000', '#000000', '#000000', '#000000'),
(17, 'r', '#000000', '#000000', '#000000', '#000000'),
(18, 't', '#000000', '#000000', '#000000', '#000000'),
(19, 'y', '#000000', '#000000', '#000000', '#000000'),
(20, 'u', '#000000', '#000000', '#000000', '#000000'),
(21, 'i', '#000000', '#000000', '#000000', '#000000'),
(22, 'o', '#000000', '#000000', '#000000', '#000000'),
(23, 'p', '#000000', '#000000', '#000000', '#000000'),
(24, 'q', '#000000', '#000000', '#000000', '#000000'),
(25, 's', '#000000', '#000000', '#000000', '#000000'),
(26, 'd', '#000000', '#000000', '#000000', '#000000'),
(27, 'f', '#000000', '#000000', '#000000', '#000000'),
(28, 'g', '#000000', '#000000', '#000000', '#000000'),
(29, 'h', '#000000', '#000000', '#000000', '#000000'),
(30, 'j', '#000000', '#000000', '#000000', '#000000'),
(33, 'm', '#000000', '#000000', '#000000', '#000000'),
(34, 'w', '#000000', '#000000', '#000000', '#000000'),
(35, 'x', '#000000', '#000000', '#000000', '#000000'),
(36, 'c', '#000000', '#000000', '#000000', '#000000'),
(75, ' testhexa ', '#123abc', '#123abc', '#123abc', '#123abc');

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
(2, 'oui', '14b8f0494c6f1460c3720d0ce692dbca'),
(3, 'Zoé', 'c88a65120330cfc69d5dbe1916fc8cd2'),
(4, 'Admin', '21232f297a57a5a743894a0e4a801fc3'),
(5, 'Gautgaut', '3bb85da11dd9186e9fdddd5bd660439d');

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
-- Index pour la table `SceneParUserTest`
--
ALTER TABLE `SceneParUserTest`
  ADD KEY `idScene` (`idScene`),
  ADD KEY `idUser` (`idUser`);

--
-- Index pour la table `SceneTest`
--
ALTER TABLE `SceneTest`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT pour la table `SceneTest`
--
ALTER TABLE `SceneTest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT pour la table `User`
--
ALTER TABLE `User`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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

--
-- Contraintes pour la table `SceneParUserTest`
--
ALTER TABLE `SceneParUserTest`
  ADD CONSTRAINT `SceneParUserTest_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `User` (`id`),
  ADD CONSTRAINT `SceneParUserTest_ibfk_2` FOREIGN KEY (`idScene`) REFERENCES `SceneTest` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
