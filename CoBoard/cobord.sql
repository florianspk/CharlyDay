-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 13 fév. 2020 à 17:22
-- Version du serveur :  5.7.26
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
-- Base de données :  `coboard`
--

-- --------------------------------------------------------

--
-- Structure de la table `besoin`
--

DROP TABLE IF EXISTS `besoin`;
CREATE TABLE IF NOT EXISTS `besoin` (
  `role_id` int(11) NOT NULL,
  `creneau_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `recurent` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`role_id`,`creneau_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

-- --------------------------------------------------------

--
-- Structure de la table `creneau`
--

DROP TABLE IF EXISTS `creneau`;
CREATE TABLE IF NOT EXISTS `creneau` (
  `heure` date NOT NULL,
  `jour` int(11) NOT NULL,
  `semaine` varchar(3) COLLATE utf8_general_mysql500_ci NOT NULL,
  `id_cycle` int(11) NOT NULL,
  `id_creneau` int(10) NOT NULL AUTO_INCREMENT,
  `desc` text COLLATE utf8_general_mysql500_ci NOT NULL,
  `id_mois` int(11) NOT NULL,
  PRIMARY KEY (`id_creneau`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cycle`
--

DROP TABLE IF EXISTS `cycle`;
CREATE TABLE IF NOT EXISTS `cycle` (
  `id_cycle` int(11) NOT NULL,
  PRIMARY KEY (`id_cycle`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id`, `label`) VALUES
(1, 'Caissier titulaire'),
(2, 'Caissier assistant'),
(3, 'Gestionnaire de vrac titulaire'),
(4, 'Gestionnaire de vrac assistant'),
(5, 'Chargé d\'accueil titulaire'),
(6, 'Chargé d\'accueil assistant');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `login` varchar(30) NOT NULL,
  `mdp` varchar(30) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `tel` varchar(15) NOT NULL,
  `permanance` int(11) NOT NULL,
  `absences` int(11) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `token` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `nom`, `prenom`, `login`, `mdp`, `mail`, `tel`, `permanance`, `absences`, `photo`, `token`) VALUES
(1, 'Cassandre', '', '', '', '', '', 0, 0, '', '1'),
(2, 'Achille', '', '', '', '', '', 0, 0, '', '2'),
(3, 'Calypso', '', '', '', '', '', 0, 0, '', '3'),
(4, 'Bacchus', '', '', '', '', '', 0, 0, '', '4'),
(5, 'Diane', '', '', '', '', '', 0, 0, '', '5'),
(6, 'Clark', '', '', '', '', '', 0, 0, '', '8'),
(9, 'Bruce', '', '', '', '', '', 0, 0, '', '9'),
(10, 'Pénélope', '', '', '', '', '', 0, 0, '', '10'),
(11, 'Ariane', '', '', '', '', '', 0, 0, '', '11'),
(12, 'Lois', '', '', '', '', '', 0, 0, '', '12');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
