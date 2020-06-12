-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 12 juin 2020 à 05:52
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

-- --------------------------------------------------------

--
-- Structure de la table `cloneanticorps`
--

CREATE TABLE `cloneanticorps` (
  `IdentifiantA` int(11) NOT NULL,
  `IdentifiantC` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `cloneanticorps`
--

INSERT INTO `cloneanticorps` (`IdentifiantA`, `IdentifiantC`) VALUES
(2, 3),
(3, 2),
(3, 3),
(4, 3),
(4, 4);

-- --------------------------------------------------------

--
-- Structure de la table `clones`
--

CREATE TABLE `clones` (
  `IdentifiantC` int(11) NOT NULL,
  `LibelleC` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `clones`
--

INSERT INTO `clones` (`IdentifiantC`, `LibelleC`) VALUES
(1, '2DF'),
(2, '5T45'),
(3, '4RD'),
(4, '2RT');

-- --------------------------------------------------------

--
-- Structure de la table `contenir`
--

CREATE TABLE `contenir` (
  `ReferenceT` int(11) NOT NULL,
  `Volume` int(11) NOT NULL,
  `IdentifiantA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `contenir`
--

INSERT INTO `contenir` (`ReferenceT`, `Volume`, `IdentifiantA`) VALUES
(1, 34, 1),
(1, 10, 2),
(35, 40, 3),
(36, 54, 5);

-- --------------------------------------------------------

--
-- Structure de la table `equipes`
--

CREATE TABLE `equipes` (
  `IdentifiantE` int(11) NOT NULL,
  `NomE` varchar(255) NOT NULL,
  `ThematiqueE` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `equipes`
--

INSERT INTO `equipes` (`IdentifiantE`, `NomE`, `ThematiqueE`) VALUES
(1, 'Plasticité des tissus adipieux ', ''),
(2, 'CSM et ingénieurie cellilaire', '');

-- --------------------------------------------------------

--
-- Structure de la table `especeanticorps`
--

CREATE TABLE `especeanticorps` (
  `IdentifiantA` int(11) NOT NULL,
  `IdentifiantEsp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `especeanticorps`
--

INSERT INTO `especeanticorps` (`IdentifiantA`, `IdentifiantEsp`) VALUES
(1, 4),
(2, 1),
(3, 1),
(4, 3),
(5, 2);

-- --------------------------------------------------------

--
-- Structure de la table `especes`
--

CREATE TABLE `especes` (
  `IdentifiantEsp` int(11) NOT NULL,
  `LibelleEsp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `especes`
--

INSERT INTO `especes` (`IdentifiantEsp`, `LibelleEsp`) VALUES
(1, 'mouse'),
(2, 'rat'),
(3, 'hamster'),
(4, 'goat');

-- --------------------------------------------------------

--
-- Structure de la table `fluorochromeanticorps`
--

CREATE TABLE `fluorochromeanticorps` (
  `IdentifiantA` int(11) NOT NULL,
  `IdentifiantFluo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `fluorochromeanticorps`
--

INSERT INTO `fluorochromeanticorps` (`IdentifiantA`, `IdentifiantFluo`) VALUES
(1, 19),
(1, 26),
(2, 4),
(2, 7),
(3, 1),
(5, 18);

-- --------------------------------------------------------

--
-- Structure de la table `fluorochromes`
--

CREATE TABLE `fluorochromes` (
  `IdentifiantFluo` int(11) NOT NULL,
  `LibelleFluo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `fluorochromes`
--

INSERT INTO `fluorochromes` (`IdentifiantFluo`, `LibelleFluo`) VALUES
(1, 'FITC'),
(2, 'efluor 605'),
(3, 'PerCP fluor 710'),
(4, 'efluor 660'),
(5, 'PE'),
(6, 'PE Cy7'),
(7, 'PE Cy5'),
(8, 'PEVio615'),
(9, 'PerCP'),
(10, 'PerCPCy5.5'),
(11, 'APC'),
(12, 'APC Vio770'),
(13, 'AlexaFluor 647'),
(14, 'AlexaFluor 780'),
(15, 'AlexaFluor 770'),
(16, 'APCCy7'),
(17, 'BV421'),
(18, 'V450'),
(19, 'V500'),
(20, 'BV510'),
(21, 'BV786'),
(22, 'BV605'),
(23, 'BV480'),
(24, 'superbrigh645'),
(25, 'BV650'),
(26, 'BV711');

-- --------------------------------------------------------

--
-- Structure de la table `fournir`
--

CREATE TABLE `fournir` (
  `ReferenceT` int(11) NOT NULL,
  `IdentifiantA` int(11) NOT NULL,
  `IdentifiantF` int(11) NOT NULL,
  `QuantiteLiv` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `fournir`
--

INSERT INTO `fournir` (`ReferenceT`, `IdentifiantA`, `IdentifiantF`, `QuantiteLiv`) VALUES
(1, 3, 6, 76),
(36, 4, 4, 100),
(37, 3, 6, 44);

-- --------------------------------------------------------

--
-- Structure de la table `fournisseurs`
--

CREATE TABLE `fournisseurs` (
  `IdentifiantF` int(11) NOT NULL,
  `NomF` varchar(255) NOT NULL,
  `PrenomF` varchar(255) NOT NULL,
  `EmailF` varchar(255) NOT NULL,
  `TelephoneF` varchar(255) NOT NULL,
  `SiteWebF` varchar(255) NOT NULL,
  `ListeDesPrix` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `fournisseurs`
--

INSERT INTO `fournisseurs` (`IdentifiantF`, `NomF`, `PrenomF`, `EmailF`, `TelephoneF`, `SiteWebF`, `ListeDesPrix`) VALUES
(2, 'dufour', 'laurent', 'laurentdufour@gmail.com', '0667897654', 'http://dedalus.fr', ''),
(4, 'Martin ', 'Jean', 'martin.jean@gmail.com', '0677874355', '', ''),
(5, 'Bernard ', 'Marie', 'marie.bernard@gmail.com', '0765431123', 'www.mariemag.com', ''),
(6, 'Thomas ', 'Pierre', 'thomas.pierre@gmail.com', '0677899954', '', ''),
(7, 'Durand ', 'Jeanne', 'durand.jeanne@gmail.com', '0537981187', 'www.bioanti.fr', ''),
(8, 'Robert', 'Philippe', 'philipe67@gmail.com', '0678545567', '', ''),
(9, 'Moreau', 'Catherine', 'morceau.4cat@gmail.com', '0788123444', 'www.geniticsfourn.fr', ''),
(11, 'Moreau ', 'Madeleine', 'madeleine.morceau@gmail.com', '0677543211', 'www.logomagazin.fr', '');

-- --------------------------------------------------------

--
-- Structure de la table `gestionnaire`
--

CREATE TABLE `gestionnaire` (
  `IdentifiantG` int(11) NOT NULL,
  `Nom` varchar(255) NOT NULL,
  `Login` varchar(255) NOT NULL,
  `MotDePasse` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `gestionnaire`
--

INSERT INTO `gestionnaire` (`IdentifiantG`, `Nom`, `Login`, `MotDePasse`) VALUES
(1, 'Marie', 'admin', 'admin123');

-- --------------------------------------------------------

--
-- Structure de la table `lots`
--

CREATE TABLE `lots` (
  `IdentifiantL` int(11) NOT NULL,
  `DatePeremption` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `lots`
--

INSERT INTO `lots` (`IdentifiantL`, `DatePeremption`) VALUES
(1, '2020-05-30'),
(2, '2020-06-10'),
(3, '2020-06-19'),
(4, '2020-06-27'),
(5, '2020-06-30');

-- --------------------------------------------------------

--
-- Structure de la table `projets`
--

CREATE TABLE `projets` (
  `IdentifiantP` int(11) NOT NULL,
  `NomP` varchar(255) NOT NULL,
  `EmailR` varchar(255) NOT NULL,
  `DateDebutP` date NOT NULL,
  `DateFinP` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `projets`
--

INSERT INTO `projets` (`IdentifiantP`, `NomP`, `EmailR`, `DateDebutP`, `DateFinP`) VALUES
(1, 'technologie génitics', 'pierre.marron6@gmail.com', '2020-05-07', '2020-06-25'),
(2, 'l\'anapathe', 'lina.duval@gmail.com', '2020-05-03', '2020-06-27'),
(3, 'Hybridomes', 'meryem.dufour@gmail.com', '2020-06-26', '2020-08-21');

-- --------------------------------------------------------

--
-- Structure de la table `signaler`
--

CREATE TABLE `signaler` (
  `DateSignalement` date NOT NULL,
  `IdentifiantA` int(11) NOT NULL,
  `IdentifiantP` int(11) NOT NULL,
  `Commentaire` varchar(255) NOT NULL,
  `TypeSignalement` enum('Manque de Stock','Erreur de Stock') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `signaler`
--

INSERT INTO `signaler` (`DateSignalement`, `IdentifiantA`, `IdentifiantP`, `Commentaire`, `TypeSignalement`) VALUES
('2020-05-30', 1, 1, 'l\'anticorps 1 est en rupture', 'Manque de Stock');

-- --------------------------------------------------------

--
-- Structure de la table `travailler`
--

CREATE TABLE `travailler` (
  `IdentifiantE` int(11) NOT NULL,
  `IdentifiantP` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `travailler`
--

INSERT INTO `travailler` (`IdentifiantE`, `IdentifiantP`) VALUES
(1, 2),
(1, 3),
(2, 1),
(2, 3);

-- --------------------------------------------------------

--
-- Structure de la table `tubes`
--

CREATE TABLE `tubes` (
  `ReferenceT` int(11) NOT NULL,
  `IdentifiantL` int(11) NOT NULL,
  `TailleT` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `tubes`
--

INSERT INTO `tubes` (`ReferenceT`, `IdentifiantL`, `TailleT`) VALUES
(1, 1, 15),
(35, 2, 33),
(36, 3, 50),
(37, 5, 112),
(38, 4, 86);

-- --------------------------------------------------------

--
-- Structure de la table `typeanticorps`
--

CREATE TABLE `typeanticorps` (
  `IdentifiantA` int(11) NOT NULL,
  `IdentifiantType` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `typeanticorps`
--

INSERT INTO `typeanticorps` (`IdentifiantA`, `IdentifiantType`) VALUES
(1, 5),
(4, 1),
(4, 5),
(5, 9);

-- --------------------------------------------------------

--
-- Structure de la table `types`
--

CREATE TABLE `types` (
  `IdentifiantType` int(11) NOT NULL,
  `LibelleType` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `types`
--

INSERT INTO `types` (`IdentifiantType`, `LibelleType`) VALUES
(1, 'IgG'),
(2, 'IgG1k'),
(3, 'igG2'),
(5, 'IgG2a k'),
(6, 'IgG2b k'),
(7, 'IgG2 g'),
(8, 'IgG2b g1'),
(9, 'IgM k');

-- --------------------------------------------------------

--
-- Structure de la table `utiliser`
--

CREATE TABLE `utiliser` (
  `IdentifiantP` int(11) NOT NULL,
  `IdentifiantA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `utiliser`
--

INSERT INTO `utiliser` (`IdentifiantP`, `IdentifiantA`) VALUES
(1, 1),
(2, 2),
(3, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `anticorps`
--
ALTER TABLE `anticorps`
  ADD PRIMARY KEY (`IdentifiantA`);

--
-- Index pour la table `cloneanticorps`
--
ALTER TABLE `cloneanticorps`
  ADD PRIMARY KEY (`IdentifiantA`,`IdentifiantC`),
  ADD KEY `FK_clone_anti` (`IdentifiantC`);

--
-- Index pour la table `clones`
--
ALTER TABLE `clones`
  ADD PRIMARY KEY (`IdentifiantC`);

--
-- Index pour la table `contenir`
--
ALTER TABLE `contenir`
  ADD PRIMARY KEY (`ReferenceT`,`IdentifiantA`),
  ADD KEY `FK_cont_anti` (`IdentifiantA`);

--
-- Index pour la table `equipes`
--
ALTER TABLE `equipes`
  ADD PRIMARY KEY (`IdentifiantE`);

--
-- Index pour la table `especeanticorps`
--
ALTER TABLE `especeanticorps`
  ADD PRIMARY KEY (`IdentifiantA`,`IdentifiantEsp`),
  ADD KEY `FK_esp_anti` (`IdentifiantEsp`);

--
-- Index pour la table `especes`
--
ALTER TABLE `especes`
  ADD PRIMARY KEY (`IdentifiantEsp`);

--
-- Index pour la table `fluorochromeanticorps`
--
ALTER TABLE `fluorochromeanticorps`
  ADD PRIMARY KEY (`IdentifiantA`,`IdentifiantFluo`),
  ADD KEY `FK_fluo_anti` (`IdentifiantFluo`);

--
-- Index pour la table `fluorochromes`
--
ALTER TABLE `fluorochromes`
  ADD PRIMARY KEY (`IdentifiantFluo`);

--
-- Index pour la table `fournir`
--
ALTER TABLE `fournir`
  ADD PRIMARY KEY (`ReferenceT`,`IdentifiantA`,`IdentifiantF`),
  ADD KEY `FK_four_fournisseur` (`IdentifiantF`),
  ADD KEY `FK_four_anti` (`IdentifiantA`);

--
-- Index pour la table `fournisseurs`
--
ALTER TABLE `fournisseurs`
  ADD PRIMARY KEY (`IdentifiantF`),
  ADD UNIQUE KEY `emailF` (`EmailF`),
  ADD UNIQUE KEY `telephoneF` (`TelephoneF`);

--
-- Index pour la table `gestionnaire`
--
ALTER TABLE `gestionnaire`
  ADD PRIMARY KEY (`IdentifiantG`),
  ADD UNIQUE KEY `login` (`Login`);

--
-- Index pour la table `lots`
--
ALTER TABLE `lots`
  ADD PRIMARY KEY (`IdentifiantL`);

--
-- Index pour la table `projets`
--
ALTER TABLE `projets`
  ADD PRIMARY KEY (`IdentifiantP`);

--
-- Index pour la table `signaler`
--
ALTER TABLE `signaler`
  ADD PRIMARY KEY (`IdentifiantA`,`IdentifiantP`,`DateSignalement`) USING BTREE,
  ADD KEY `FK_sig_proj` (`IdentifiantP`);

--
-- Index pour la table `travailler`
--
ALTER TABLE `travailler`
  ADD PRIMARY KEY (`IdentifiantE`,`IdentifiantP`),
  ADD KEY `FK_tra_projet` (`IdentifiantP`);

--
-- Index pour la table `tubes`
--
ALTER TABLE `tubes`
  ADD PRIMARY KEY (`ReferenceT`),
  ADD KEY `FK_tubes_lots` (`IdentifiantL`);

--
-- Index pour la table `typeanticorps`
--
ALTER TABLE `typeanticorps`
  ADD PRIMARY KEY (`IdentifiantA`,`IdentifiantType`),
  ADD KEY `FK_type_anti` (`IdentifiantType`);

--
-- Index pour la table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`IdentifiantType`);

--
-- Index pour la table `utiliser`
--
ALTER TABLE `utiliser`
  ADD PRIMARY KEY (`IdentifiantP`,`IdentifiantA`),
  ADD KEY `FK_utiliser_ant` (`IdentifiantA`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `anticorps`
--
ALTER TABLE `anticorps`
  MODIFY `IdentifiantA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `clones`
--
ALTER TABLE `clones`
  MODIFY `IdentifiantC` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `equipes`
--
ALTER TABLE `equipes`
  MODIFY `IdentifiantE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `especes`
--
ALTER TABLE `especes`
  MODIFY `IdentifiantEsp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `fluorochromes`
--
ALTER TABLE `fluorochromes`
  MODIFY `IdentifiantFluo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT pour la table `fournisseurs`
--
ALTER TABLE `fournisseurs`
  MODIFY `IdentifiantF` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `gestionnaire`
--
ALTER TABLE `gestionnaire`
  MODIFY `IdentifiantG` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `lots`
--
ALTER TABLE `lots`
  MODIFY `IdentifiantL` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `projets`
--
ALTER TABLE `projets`
  MODIFY `IdentifiantP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `tubes`
--
ALTER TABLE `tubes`
  MODIFY `ReferenceT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT pour la table `types`
--
ALTER TABLE `types`
  MODIFY `IdentifiantType` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `cloneanticorps`
--
ALTER TABLE `cloneanticorps`
  ADD CONSTRAINT `FK_anti_clone` FOREIGN KEY (`IdentifiantA`) REFERENCES `anticorps` (`IdentifiantA`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_clone_anti` FOREIGN KEY (`IdentifiantC`) REFERENCES `clones` (`IdentifiantC`) ON DELETE CASCADE;

--
-- Contraintes pour la table `contenir`
--
ALTER TABLE `contenir`
  ADD CONSTRAINT `FK_cont_anti` FOREIGN KEY (`IdentifiantA`) REFERENCES `anticorps` (`IdentifiantA`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_cont_tub` FOREIGN KEY (`ReferenceT`) REFERENCES `tubes` (`ReferenceT`) ON DELETE CASCADE;

--
-- Contraintes pour la table `especeanticorps`
--
ALTER TABLE `especeanticorps`
  ADD CONSTRAINT `FK_anti_esp` FOREIGN KEY (`IdentifiantA`) REFERENCES `anticorps` (`IdentifiantA`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_esp_anti` FOREIGN KEY (`IdentifiantEsp`) REFERENCES `especes` (`IdentifiantEsp`) ON DELETE CASCADE;

--
-- Contraintes pour la table `fluorochromeanticorps`
--
ALTER TABLE `fluorochromeanticorps`
  ADD CONSTRAINT `FK_anti_fluo` FOREIGN KEY (`IdentifiantA`) REFERENCES `anticorps` (`IdentifiantA`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_fluo_anti` FOREIGN KEY (`IdentifiantFluo`) REFERENCES `fluorochromes` (`IdentifiantFluo`) ON DELETE CASCADE;

--
-- Contraintes pour la table `fournir`
--
ALTER TABLE `fournir`
  ADD CONSTRAINT `FK_four_anti` FOREIGN KEY (`IdentifiantA`) REFERENCES `anticorps` (`IdentifiantA`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_four_fournisseur` FOREIGN KEY (`IdentifiantF`) REFERENCES `fournisseurs` (`IdentifiantF`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_four_tubes` FOREIGN KEY (`ReferenceT`) REFERENCES `tubes` (`ReferenceT`) ON DELETE CASCADE;

--
-- Contraintes pour la table `signaler`
--
ALTER TABLE `signaler`
  ADD CONSTRAINT `FK_sig_anti` FOREIGN KEY (`IdentifiantA`) REFERENCES `anticorps` (`IdentifiantA`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_sig_proj` FOREIGN KEY (`IdentifiantP`) REFERENCES `projets` (`IdentifiantP`) ON DELETE CASCADE;

--
-- Contraintes pour la table `travailler`
--
ALTER TABLE `travailler`
  ADD CONSTRAINT `FK_tra_equi` FOREIGN KEY (`IdentifiantE`) REFERENCES `equipes` (`IdentifiantE`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_tra_projet` FOREIGN KEY (`IdentifiantP`) REFERENCES `projets` (`IdentifiantP`) ON DELETE CASCADE;

--
-- Contraintes pour la table `tubes`
--
ALTER TABLE `tubes`
  ADD CONSTRAINT `FK_tubes_lots` FOREIGN KEY (`IdentifiantL`) REFERENCES `lots` (`IdentifiantL`);

--
-- Contraintes pour la table `typeanticorps`
--
ALTER TABLE `typeanticorps`
  ADD CONSTRAINT `FK_anti_type` FOREIGN KEY (`IdentifiantA`) REFERENCES `anticorps` (`IdentifiantA`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_type_anti` FOREIGN KEY (`IdentifiantType`) REFERENCES `types` (`IdentifiantType`) ON DELETE CASCADE;

--
-- Contraintes pour la table `utiliser`
--
ALTER TABLE `utiliser`
  ADD CONSTRAINT `FK_utiliser_ant` FOREIGN KEY (`IdentifiantA`) REFERENCES `anticorps` (`IdentifiantA`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_utiliser_proj` FOREIGN KEY (`IdentifiantP`) REFERENCES `projets` (`IdentifiantP`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
