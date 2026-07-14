-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Serveur: 127.0.0.1
-- Généré le : Mar 22 Novembre 2022 à 03:55
-- Version du serveur: 5.1.54
-- Version de PHP: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `testdrive`
--

-- --------------------------------------------------------

--
-- Structure de la table `evaluation`
--

CREATE TABLE IF NOT EXISTS `evaluation` (
  `numPermis` varchar(8) NOT NULL,
  `idModele` int(11) NOT NULL,
  `dateTest` datetime NOT NULL,
  `securite` int(11) NOT NULL,
  `conduite` int(11) NOT NULL,
  `confort` int(11) NOT NULL,
  PRIMARY KEY (`numPermis`,`idModele`),
  KEY `idModele` (`idModele`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `evaluation`
--

INSERT INTO `evaluation` (`numPermis`, `idModele`, `dateTest`, `securite`, `conduite`, `confort`) VALUES
('21/12345', 15, '2022-11-19 11:00:02', 1, 1, 1),
('21/12345', 26, '2022-11-20 11:00:21', 5, 5, 5),
('22/55555', 15, '2022-11-21 10:59:14', 3, 2, 4);

-- --------------------------------------------------------

--
-- Structure de la table `modelevoiture`
--

CREATE TABLE IF NOT EXISTS `modelevoiture` (
  `idModele` int(11) NOT NULL,
  `libelle` varchar(20) NOT NULL,
  PRIMARY KEY (`idModele`),
  UNIQUE KEY `libelle` (`libelle`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `modelevoiture`
--

INSERT INTO `modelevoiture` (`idModele`, `libelle`) VALUES
(38, 'WALLYS 216'),
(26, 'WALLYS 619'),
(15, 'WALLYS IRIS');

-- --------------------------------------------------------

--
-- Structure de la table `testeur`
--

CREATE TABLE IF NOT EXISTS `testeur` (
  `numPermis` varchar(8) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `genre` varchar(1) NOT NULL,
  `idVille` int(11) NOT NULL,
  PRIMARY KEY (`numPermis`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `testeur`
--

INSERT INTO `testeur` (`numPermis`, `nom`, `prenom`, `genre`, `idVille`) VALUES
('21/12345', 'Barhoumi', 'Ahmed', 'M', 3),
('22/55555', 'Mouradi', 'Ines', 'F', 2),
('23/66666', 'Ayari', 'Mounir', 'M', 3),
('33/44444', 'Jebri', 'Mouna', 'F', 1),
('58/98765', 'Jouini', 'Ramzi', 'M', 2);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `evaluation`
--
ALTER TABLE `evaluation`
  ADD CONSTRAINT `evaluation_ibfk_1` FOREIGN KEY (`numPermis`) REFERENCES `testeur` (`numPermis`),
  ADD CONSTRAINT `evaluation_ibfk_2` FOREIGN KEY (`idModele`) REFERENCES `modelevoiture` (`idModele`),
  ADD CONSTRAINT `evaluation_ibfk_3` FOREIGN KEY (`numPermis`) REFERENCES `testeur` (`numPermis`),
  ADD CONSTRAINT `evaluation_ibfk_4` FOREIGN KEY (`idModele`) REFERENCES `modelevoiture` (`idModele`);
