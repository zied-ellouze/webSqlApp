-- phpMyAdmin SQL Dump
-- version 3.5.5
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Ven 18 Octobre 2013 à 14:47
-- Version du serveur: 5.0.96-community-log
-- Version de PHP: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `affaire_UPdbDev`
--

-- --------------------------------------------------------

--
-- Structure de la table `RN_Unite`
--

CREATE TABLE IF NOT EXISTS `RN_Unite` (
  `UniteID` int(11) NOT NULL default '0',
  `UniteSymbol` varchar(10) NOT NULL,
  `last_sync_date` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`UniteID`,`UniteSymbol`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `RN_Unite`
--

INSERT INTO `RN_Unite` (`UniteID`, `UniteSymbol`, `last_sync_date`) VALUES
(0, 'h', '0000-00-00 00:00:00'),
(1, 'km', '0000-00-00 00:00:00'),
(2, '$', '0000-00-00 00:00:00'),
(3, 'U$', '0000-00-00 00:00:00'),
(4, '€', '0000-00-00 00:00:00'),
(5, '$P', '0000-00-00 00:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
