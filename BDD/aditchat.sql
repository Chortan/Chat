SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE IF NOT EXISTS `administrator` (
  `id_admin` int(255) NOT NULL,
  `statut` int(255) NOT NULL,
  `ableGetMessage` tinyint(4) NOT NULL DEFAULT '0',
  `ableGetProfil` tinyint(4) NOT NULL DEFAULT '0',
  `ableSetup` tinyint(4) NOT NULL DEFAULT '0',
  `ableRootPrivilege` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `canal` (
  `id_canal` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `dateCreated` date NOT NULL,
  `creator` int(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `canalMessage` (
  `id_canal` int(11) NOT NULL,
  `id_message` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `canalUser` (
  `id_canal` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `message` (
  `id_message` int(11) NOT NULL,
  `transmitter` int(11) NOT NULL,
  `ipTransmitter` varchar(40) NOT NULL,
  `content` text NOT NULL,
  `date` date NOT NULL,
  `wasSent` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
  `inscription` date NOT NULL,
  `isOnline` tinyint(1) NOT NULL DEFAULT '0',
  `lastMessage` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lastConnexion` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `administrator`
  ADD PRIMARY KEY (`id_admin`);

ALTER TABLE `canal`
  ADD PRIMARY KEY (`id_canal`);

ALTER TABLE `canalMessage`
  ADD PRIMARY KEY (`id_message`);

ALTER TABLE `canalUser`
  ADD PRIMARY KEY (`id_canal`,`id_user`);

ALTER TABLE `message`
  ADD PRIMARY KEY (`id_message`,`transmitter`);

ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
