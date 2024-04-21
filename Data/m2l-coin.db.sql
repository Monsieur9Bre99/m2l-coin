-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 10 juin 2023 à 23:00
-- Version du serveur : 5.7.36
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `m2l-coin`
--

-- --------------------------------------------------------

--
-- Structure de la table `annonce`
--

DROP TABLE IF EXISTS `annonce`;
CREATE TABLE IF NOT EXISTS `annonce` (
  `idAnnonce` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(200) NOT NULL,
  `prix` double NOT NULL,
  `description` text NOT NULL,
  `photo` varchar(500) NOT NULL,
  `dateAjout` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idCategorie` int(11) NOT NULL,
  `codeLocalisation` varchar(3) NOT NULL,
  `idUser` int(11) NOT NULL,
  PRIMARY KEY (`idAnnonce`),
  KEY `FK_localisation_annonce` (`codeLocalisation`),
  KEY `FK_cat_annonce` (`idCategorie`),
  KEY `fk_user_annonce` (`idUser`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `annonce`
--

INSERT INTO `annonce` (`idAnnonce`, `titre`, `prix`, `description`, `photo`, `dateAjout`, `idCategorie`, `codeLocalisation`, `idUser`) VALUES
(4, 'Maillot du PSG', 25, 'Test', 'img/annonce/Maillot du PSG.png', '2023-03-21 12:42:09', 7, '15', 1),
(5, 'Livre Naruto', 50, 'Ceci est un livre du mangas Naruto.', 'img/annonce/Livre Naruto.png', '2023-03-21 12:57:18', 5, '59', 1),
(7, 'Samsung S20', 300, 'Ceci est un t&eacute;l&eacute;phone de marque Samsung.', 'img/annonce/Samsung S20.png', '2023-03-25 22:45:45', 8, '94', 5),
(8, 'iPhone 12', 650, 'Ceci est un t&eacute;l&eacute;phone', 'img/annonce/iPhone 12.png', '2023-03-30 14:33:29', 7, '92', 1);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `idCategorie` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(50) NOT NULL,
  PRIMARY KEY (`idCategorie`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`idCategorie`, `libelle`) VALUES
(1, 'Véhicule'),
(2, 'Mode'),
(3, 'Jeu de société'),
(4, 'Jeu vidéo'),
(5, 'Livre/BD/Manga'),
(6, 'Musique'),
(7, 'Sport'),
(8, 'Autres');

-- --------------------------------------------------------

--
-- Structure de la table `conversation`
--

DROP TABLE IF EXISTS `conversation`;
CREATE TABLE IF NOT EXISTS `conversation` (
  `idConversation` int(5) NOT NULL AUTO_INCREMENT,
  `idAnnonce` int(5) NOT NULL,
  `idQ` int(5) NOT NULL,
  `idR` int(5) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idConversation`),
  KEY `fk_ann_conv` (`idAnnonce`),
  KEY `fk_utilQ_conv` (`idQ`),
  KEY `fk_utilR_conv` (`idR`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `conversation`
--

INSERT INTO `conversation` (`idConversation`, `idAnnonce`, `idQ`, `idR`, `createdAt`) VALUES
(1, 7, 1, 5, '2023-05-27 15:09:03');

-- --------------------------------------------------------

--
-- Structure de la table `favoris`
--

DROP TABLE IF EXISTS `favoris`;
CREATE TABLE IF NOT EXISTS `favoris` (
  `idFavoris` int(5) NOT NULL AUTO_INCREMENT,
  `idUtilisateur` int(5) NOT NULL,
  `idA` int(5) NOT NULL,
  PRIMARY KEY (`idFavoris`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `favoris`
--

INSERT INTO `favoris` (`idFavoris`, `idUtilisateur`, `idA`) VALUES
(11, 1, 4);

-- --------------------------------------------------------

--
-- Structure de la table `localisation`
--

DROP TABLE IF EXISTS `localisation`;
CREATE TABLE IF NOT EXISTS `localisation` (
  `codeDep` varchar(3) NOT NULL,
  `dep` varchar(23) NOT NULL,
  PRIMARY KEY (`codeDep`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `localisation`
--

INSERT INTO `localisation` (`codeDep`, `dep`) VALUES
('02', 'Aisne'),
('03', 'Allier'),
('04', 'Alpes-de-Haute-Provence'),
('05', 'Hautes-Alpes'),
('06', 'Alpes-Maritimes'),
('07', 'Ardèche'),
('08', 'Ardennes'),
('09', 'Ariège'),
('10', 'Aube'),
('11', 'Aude'),
('12', 'Aveyron'),
('13', 'Bouches-du-Rhône'),
('14', 'Calvados'),
('15', 'Cantal'),
('16', 'Charente'),
('17', 'Charente-Maritime'),
('18', 'Cher'),
('19', 'Corrèze'),
('21', 'Côte-d\'Or'),
('22', 'Côtes-d\'Armor'),
('23', 'Creuse'),
('24', 'Dordogne'),
('25', 'Doubs'),
('26', 'Drôme'),
('27', 'Eure'),
('28', 'Eure-et-Loir'),
('29', 'Finistère'),
('2A', 'Corse-du-Sud'),
('2B', 'Haute-Corse'),
('30', 'Gard'),
('31', 'Haute-Garonne'),
('32', 'Gers'),
('33', 'Gironde'),
('34', 'Hérault'),
('35', 'Ille-et-Vilaine'),
('36', 'Indre'),
('37', 'Indre-et-Loire'),
('38', 'Isère'),
('39', 'Jura'),
('40', 'Landes'),
('41', 'Loir-et-Cher'),
('42', 'Loire'),
('43', 'Haute-Loire'),
('44', 'Loire-Atlantique'),
('45', 'Loiret'),
('46', 'Lot'),
('47', 'Lot-et-Garonne'),
('48', 'Lozère'),
('49', 'Maine-et-Loire'),
('50', 'Manche'),
('51', 'Marne'),
('52', 'Haute-Marne'),
('53', 'Mayenne'),
('54', 'Meurthe-et-Moselle'),
('55', 'Meuse'),
('56', 'Morbihan'),
('57', 'Moselle'),
('58', 'Nièvre'),
('59', 'Nord'),
('60', 'Oise'),
('61', 'Orne'),
('62', 'Pas-de-Calais'),
('63', 'Puy-de-Dôme'),
('64', 'Pyrénées-Atlantiques'),
('65', 'Hautes-Pyrénées'),
('66', 'Pyrénées-Orientales'),
('67', 'Bas-Rhin'),
('68', 'Haut-Rhin'),
('69', 'Rhône'),
('70', 'Haute-Saône'),
('71', 'Saône-et-Loire'),
('72', 'Sarthe'),
('73', 'Savoie'),
('74', 'Haute-Savoie'),
('75', 'Paris'),
('76', 'Seine-Maritime'),
('77', 'Seine-et-Marne'),
('78', 'Yvelines'),
('79', 'Deux-Sèvres'),
('80', 'Somme'),
('81', 'Tarn'),
('82', 'Tarn-et-Garonne'),
('83', 'Var'),
('84', 'Vaucluse'),
('85', 'Vendée'),
('86', 'Vienne'),
('87', 'Haute-Vienne'),
('88', 'Vosges'),
('89', 'Yonne'),
('90', 'Territoire de Belfort'),
('91', 'Essonne'),
('92', 'Hauts-de-Seine'),
('93', 'Seine-St-Denis'),
('94', 'Val-de-Marne'),
('95', 'Val-D\'Oise'),
('971', 'Guadeloupe'),
('972', 'Martinique'),
('973', 'Guyane'),
('974', 'La Réunion'),
('976', 'Mayotte');

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `idM` int(5) NOT NULL AUTO_INCREMENT,
  `idSender` int(5) NOT NULL,
  `idReceiver` int(5) NOT NULL,
  `idC` int(5) NOT NULL,
  `contenu` text NOT NULL,
  `dateEnvoi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idM`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`idM`, `idSender`, `idReceiver`, `idC`, `contenu`, `dateEnvoi`) VALUES
(1, 1, 5, 1, 'Bonjour', '2023-05-27 15:09:03'),
(2, 5, 1, 1, 'Oui bonjour !', '2023-06-10 21:24:06');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `idU` int(5) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `adresseEmail` varchar(100) NOT NULL,
  `telephone` varchar(10) NOT NULL,
  `mdp` varchar(500) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idU`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`idU`, `nom`, `prenom`, `adresseEmail`, `telephone`, `mdp`, `created_at`) VALUES
(1, 'OKETOKOUN', 'Hamid', 'hamid@m2lcoin.fr', '0630042543', 'a65ec3cef8aebc6b4e73c500a92d45ce', '2023-03-16 14:25:32'),
(2, 'DUPONT', 'Antoine', 'antoinedupont@outlook.fr', '0702030405', '9d21bfc41c05ebbc779000c456c1097c', '2023-03-17 09:44:18');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `annonce`
--
ALTER TABLE `annonce`
  ADD CONSTRAINT `FK_cat_annonce` FOREIGN KEY (`idCategorie`) REFERENCES `categorie` (`idCategorie`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_localisation_annonce` FOREIGN KEY (`codeLocalisation`) REFERENCES `localisation` (`codeDep`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_user_annonce` FOREIGN KEY (`idUser`) REFERENCES `users` (`idU`);

--
-- Contraintes pour la table `conversation`
--
ALTER TABLE `conversation`
  ADD CONSTRAINT `fk_ann_conv` FOREIGN KEY (`idAnnonce`) REFERENCES `annonce` (`idAnnonce`),
  ADD CONSTRAINT `fk_utilQ_conv` FOREIGN KEY (`idQ`) REFERENCES `users` (`idU`),
  ADD CONSTRAINT `fk_utilR_conv` FOREIGN KEY (`idR`) REFERENCES `users` (`idU`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
