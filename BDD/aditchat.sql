-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 08 Décembre 2015 à 16:58
-- Version du serveur :  5.6.15-log
-- Version de PHP :  5.5.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `chat`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrator`
--

CREATE TABLE IF NOT EXISTS `administrator` (
  `id_admin` int(255) NOT NULL,
  `statut` int(255) NOT NULL,
  `ableGetMessage` tinyint(4) NOT NULL DEFAULT '0',
  `ableGetProfil` tinyint(4) NOT NULL DEFAULT '0',
  `ableSetup` tinyint(4) NOT NULL DEFAULT '0',
  `ableRootPrivilege` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_admin`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `canal`
--

CREATE TABLE IF NOT EXISTS `canal` (
  `id_canal` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `dateCreated` date NOT NULL,
  PRIMARY KEY (`id_canal`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id_message` int(11) NOT NULL,
  `transmitter` int(11) NOT NULL,
  `ipTransmitter` varchar(40) NOT NULL,
  `content` text NOT NULL,
  `date` date NOT NULL,
  `wasSent` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_message`,`transmitter`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(255) NOT NULL,
  `pseudo` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `phoneNumber` varchar(10) NOT NULL,
  `birth` date NOT NULL,
  `avatar` varchar(100) NOT NULL,
  `sexe` varchar(10) NOT NULL,
  `country` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `inscricption` date NOT NULL,
  `isOnline` tinyint(1) NOT NULL DEFAULT '0',
  `lastMessage` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lastConnexion` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
