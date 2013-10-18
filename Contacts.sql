-- phpMyAdmin SQL Dump
-- version 3.5.5
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Ven 18 Octobre 2013 à 14:48
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
-- Structure de la table `Contacts`
--

CREATE TABLE IF NOT EXISTS `Contacts` (
  `ContactID` bigint(20) NOT NULL auto_increment,
  `id` text NOT NULL,
  `firstName` text,
  `lastName` text,
  `qte` decimal(7,2) default NULL,
  `MaJdate` date default NULL,
  `cbFait` tinyint(1) default NULL,
  `rbABC` text,
  `UniteID` int(11) NOT NULL,
  `last_sync_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`ContactID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Contenu de la table `Contacts`
--

INSERT INTO `Contacts` (`ContactID`, `id`, `firstName`, `lastName`, `qte`, `MaJdate`, `cbFait`, `rbABC`, `UniteID`, `last_sync_date`) VALUES
(5, '6', 'Xavier', 'Xoland', 1.11, '2011-09-22', 1, 'A', 5, '2013-10-16 18:57:10'),
(4, '2', 'Wilfried', 'Wild', 1.23, '2013-09-23', 1, 'A', 1, '2013-10-17 13:38:50'),
(7, '7', 'Zebulon', 'Zala', 2.20, '2013-09-23', 0, 'C', 2, '2013-10-17 13:38:50'),
(2, '8', 'Uclide', 'Uvil', 1.00, '2013-09-24', 1, 'B', 1, '2013-10-17 13:38:50'),
(1, '3', 'Thomas', 'Toupin', 1.00, '2013-09-24', 1, 'A', 1, '2013-10-14 20:56:42'),
(6, '4', 'Yvon', 'Yale', 1.00, '2013-09-26', 0, 'B', 2, '2013-10-14 20:56:42'),
(3, '5', 'Victor', 'Villeneuve', 11.00, '2013-09-30', 0, 'C', 1, '2013-10-14 20:56:42'),
(8, '1', 'Sylvie', 'Sirois', 8.00, '2013-10-08', 0, 'A', 5, '2013-10-16 18:49:49'),
(15, '9', 'Alain', 'Alarie', 1.00, '0000-00-00', 1, 'A', 1, '2013-10-17 13:38:50');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
