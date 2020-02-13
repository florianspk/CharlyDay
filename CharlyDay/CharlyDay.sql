-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 09 jan. 2020 à 19:55
-- Version du serveur :  8.0.18
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `percin4u`
--

-- --------------------------------------------------------

--
-- Structure de la table `apporte`
--

DROP TABLE IF EXISTS `apporte`;
CREATE TABLE IF NOT EXISTS `apporte` (
  `idCli` int(14) NOT NULL,
  `idIngre` int(14) NOT NULL,
  `idEvent` int(14) NOT NULL,
  `quantite` int(5) DEFAULT NULL,
  PRIMARY KEY (`idCli`,`idIngre`,`idEvent`),
  KEY `idCli` (`idCli`),
  KEY `idIngre` (`idIngre`),
  KEY `idEvent` (`idEvent`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `idCli` int(14) NOT NULL AUTO_INCREMENT,
  `tokenCli` varchar(255) NOT NULL,
  `nomCli` text,
  `prenomCli` text,
  `login` text,
  `mdp` text,
  `mailCli` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idCli`),
  UNIQUE KEY (`tokenCli`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`idCli`, `nomCli`, `prenomCli`, `login`, `mdp`, `mailCli`, `tokenCli`) VALUES
(1, 'Percin', 'Cahit', 'cpercin', 'mdp1', 'cpercin@contact.com', 't0O0k0e0nPerc0Cah'),
(2, 'Krell', 'Lucas', 'lkrell', 'mdp2', 'lkrell@hotmail.fr', 't0o0k0E0nkrel0LuC'),
(3, 'Spick', 'Florian', 'fspick', 'mdp3', 'fspick@gmail.com', 't0O0e0nFlOR0FSpicK'),
(4, 'Sassu', 'Thomas', 'tsassu', 'mdp4', 'sthomas@contact.com', 'T0o0k0e0nSAss0ToMa');

-- --------------------------------------------------------

--
-- Structure de la table `contient`
--

DROP TABLE IF EXISTS `contient`;
CREATE TABLE IF NOT EXISTS `contient` (
  `idRecette` int(14) NOT NULL,
  `idIngre` int(14) NOT NULL,
  `quantite` int(5) DEFAULT NULL,
  `unite` text,
  PRIMARY KEY (`idRecette`,`idIngre`),
  KEY `idIngre` (`idIngre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `contient`
--

INSERT INTO `contient` (`idRecette`, `idIngre`, `quantite`, `unite`) VALUES
(1, 1, 500, 'grammes'),
(1, 2, 3, 'jaunes d oeufs'),
(1, 3, 50, 'cl'),
(1, 4, 1, 'pincée'),
(1, 5, 2, 'pincées'),
(1, 6, 250, 'grammes');

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

DROP TABLE IF EXISTS `evenement`;
CREATE TABLE IF NOT EXISTS `evenement` (
  `idEvent` int(14) NOT NULL AUTO_INCREMENT,
  `tokenEvent` varchar(255) NOT NULL,
  `nomEvent` text,
  `description` text,
  `idRecette` int(14) DEFAULT NULL,
  `dateEvenement` datetime DEFAULT NULL,
  `idCli` int(14) NOT NULL,
  PRIMARY KEY (`idEvent`),
  KEY `idRecette` (`idRecette`),
  KEY `idCli` (`idCli`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `evenement`
--

INSERT INTO `evenement` (`idEvent`, `nomEvent`, `tokenEvent`, `description`, `idRecette`, `dateEvenement`, `idCli`) VALUES
(1, 'Soirée Pâtes !', 'S0i5R86pta86s4816', 'Le 15 Janvier ça vous dirait de manger ensemble?', 1, '2020-01-15 00:00:00', 2);

-- --------------------------------------------------------

--
-- Structure de la table `ingredient`
--

DROP TABLE IF EXISTS `ingredient`;
CREATE TABLE IF NOT EXISTS `ingredient` (
  `idIngre` int(14) NOT NULL AUTO_INCREMENT,
  `categorieIngre` text,
  `libelleIngre` text,
  `scoreIngre` decimal(2,2) DEFAULT NULL,
  `unite` text DEFAULT NULL,
  PRIMARY KEY (`idIngre`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ingredient`
--

INSERT INTO `ingredient` (`idIngre`, `categorieIngre`, `libelleIngre`, `scoreIngre`) VALUES
(1, 'Féculent', 'Spaghettis', NULL),
(2, 'Oeufs', 'Oeuf', NULL),
(3, 'Produit Laitier', 'Crème fraîche', NULL),
(4, 'Condiment', 'Sel', NULL),
(5, 'Condiment', 'Poivre', NULL),
(6, 'Viande', 'Lardons', NULL),
(7, 'Légume', 'Oignon', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `participe`
--

DROP TABLE IF EXISTS `participe`;
CREATE TABLE IF NOT EXISTS `participe` (
  `idEvent` int(14) NOT NULL,
  `idCli` int(14) NOT NULL,
  PRIMARY KEY (`idEvent`,`idCli`),
  KEY `idCli` (`idCli`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `participe`
--

INSERT INTO `participe` (`idEvent`, `idCli`) VALUES
(1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `recette`
--

DROP TABLE IF EXISTS `recette`;
CREATE TABLE IF NOT EXISTS `recette` (
  `idRecette` int(14) NOT NULL AUTO_INCREMENT,
  `libelleRecette` text,
  `quantite` int(14) DEFAULT NULL,
  PRIMARY KEY (`idRecette`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `recette`
--

INSERT INTO `recette` (`idRecette`, `libelleRecette`, `quantite`) VALUES
(1, 'Pâtes carbonara', 5);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `apporte`
--
ALTER TABLE `apporte`
  ADD CONSTRAINT `apporte_ibfk_1` FOREIGN KEY (`idCli`) REFERENCES `client` (`idCli`),
  ADD CONSTRAINT `apporte_ibfk_2` FOREIGN KEY (`idIngre`) REFERENCES `ingredient` (`idIngre`),
  ADD CONSTRAINT `apporte_ibfk_3` FOREIGN KEY (`idEvent`) REFERENCES `evenement` (`idEvent`);

--
-- Contraintes pour la table `contient`
--
ALTER TABLE `contient`
  ADD CONSTRAINT `contient_ibfk_1` FOREIGN KEY (`idRecette`) REFERENCES `recette` (`idRecette`),
  ADD CONSTRAINT `contient_ibfk_2` FOREIGN KEY (`idIngre`) REFERENCES `ingredient` (`idIngre`);

--
-- Contraintes pour la table `evenement`
--
ALTER TABLE `evenement`
  ADD CONSTRAINT `evenement_ibfk_1` FOREIGN KEY (`idRecette`) REFERENCES `recette` (`idRecette`);

--
-- Contraintes pour la table `participe`
--
ALTER TABLE `participe`
  ADD CONSTRAINT `participe_ibfk_1` FOREIGN KEY (`idEvent`) REFERENCES `evenement` (`idEvent`),
  ADD CONSTRAINT `participe_ibfk_2` FOREIGN KEY (`idCli`) REFERENCES `client` (`idCli`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
