-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 11 juin 2020 à 01:43
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP : 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bd_anticorps`
--

-- --------------------------------------------------------

--
-- Structure de la table `anticorps`
--

CREATE TABLE `anticorps` (
  `IdentifiantA` int(11) NOT NULL,
  `DesignationA` varchar(255) NOT NULL,
  `SeuilAlerte` int(11) NOT NULL,
  `EtatStockA` enum('Rupture','Risque','Signaler','Bon') NOT NULL,
  `VolumePreconise` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `anticorps`
--

INSERT INTO `anticorps` (`IdentifiantA`, `DesignationA`, `SeuilAlerte`, `EtatStockA`, `VolumePreconise`) VALUES
(1, 'Mouse_AntiHuman', 13, 'Risque', 5),
(2, 'Rat anti-human CD45', 50, 'Bon', 11),
(3, 'hamster_BV421', 30, 'Risque', 8),
(4, 'Goat-4PE5', 50, 'Bon', 7),
(5, 'Alexa_rat2', 20, 'Rupture', 5);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `anticorps`
--
ALTER TABLE `anticorps`
  ADD PRIMARY KEY (`IdentifiantA`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `anticorps`
--
ALTER TABLE `anticorps`
  MODIFY `IdentifiantA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
