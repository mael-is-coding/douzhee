-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 04 fév. 2025 à 11:35
-- Version du serveur : 9.1.0
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bddouzheetest`
--

-- --------------------------------------------------------

--
-- Structure de la table `achetermusique`
--

DROP TABLE IF EXISTS `achetermusique`;
CREATE TABLE IF NOT EXISTS `achetermusique` (
  `idJoueur` varchar(50) NOT NULL,
  `idMusique` smallint NOT NULL,
  PRIMARY KEY (`idJoueur`,`idMusique`),
  KEY `idMusique` (`idMusique`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `achetermusique`
--

INSERT INTO `achetermusique` (`idJoueur`, `idMusique`) VALUES
('aad581aaa28c8eb59d811e1c75eb', 1),
('ad0dc7940c13f005aab750d299c4d2d6', 1),
('ad0dc7940c13f005aab750d299c4d2d6', 2),
('ad0dc7940c13f005aab750d299c4d2d6', 3),
('ad0dc7940c13f005aab750d299c4d2d6', 4);

-- --------------------------------------------------------

--
-- Structure de la table `achetertheme`
--

DROP TABLE IF EXISTS `achetertheme`;
CREATE TABLE IF NOT EXISTS `achetertheme` (
  `idJoueur` varchar(50) NOT NULL,
  `idTheme` smallint NOT NULL,
  PRIMARY KEY (`idJoueur`,`idTheme`),
  KEY `idTheme` (`idTheme`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `achetertheme`
--

INSERT INTO `achetertheme` (`idJoueur`, `idTheme`) VALUES
('aad581aaa28c8eb59d811e1c75eb', 1),
('ad0dc7940c13f005aab750d299c4d2d6', 1),
('ad0dc7940c13f005aab750d299c4d2d6', 2),
('ad0dc7940c13f005aab750d299c4d2d6', 3),
('ad0dc7940c13f005aab750d299c4d2d6', 4);

-- --------------------------------------------------------

--
-- Structure de la table `joueur`
--

DROP TABLE IF EXISTS `joueur`;
CREATE TABLE IF NOT EXISTS `joueur` (
  `idJoueur` varchar(50) NOT NULL,
  `pseudo` varchar(25) NOT NULL,
  `mdp` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(50) NOT NULL,
  `bio` varchar(50) DEFAULT NULL,
  `douzCoins` int NOT NULL DEFAULT '0',
  `dateInscription` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `avatarChemin` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '../../assets/images/imageavatars/photodefault.jpg',
  `idMusique` int NOT NULL DEFAULT '1',
  `idTheme` int NOT NULL DEFAULT '1',
  `nbPartieGagnees` smallint NOT NULL DEFAULT '0',
  `scoreMax` smallint NOT NULL DEFAULT '0',
  `tempsJeu` int NOT NULL DEFAULT '0',
  `ratioVictoire` float NOT NULL DEFAULT '0',
  `nbSucces` smallint NOT NULL DEFAULT '0',
  `nbPartiesJouees` smallint NOT NULL DEFAULT '0',
  `nbDouzhee` smallint NOT NULL DEFAULT '0',
  PRIMARY KEY (`idJoueur`),
  KEY `idMusque` (`idMusique`),
  KEY `idTheme` (`idTheme`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `joueur`
--

INSERT INTO `joueur` (`idJoueur`, `pseudo`, `mdp`, `email`, `bio`, `douzCoins`, `dateInscription`, `avatarChemin`, `idMusique`, `idTheme`, `nbPartieGagnees`, `scoreMax`, `tempsJeu`, `ratioVictoire`, `nbSucces`, `nbPartiesJouees`, `nbDouzhee`) VALUES
('ad0dc7940c13f005aab750d299c4d2d6', 'Nagisan', '$2y$10$QjxR4wU6AFjwL.uZZNeIPe5wBbYKgKCOkrYyjEgHrAA2k2sVFuXlO', 'killuasiota@gmail.com', '', 92799, '2025-01-26 17:29:07', '../../assets/images/imageavatars/photodefault.jpg', 1, 1, 0, 0, 21454, 0, 0, 0, 0),
('aad581aaa28c8eb59d811e1c75eb', 'NagisanBis', '$2y$10$svZkOMU0qtDz25vhePu6AO1C3nUB7Y2I82qrsILFvBIh3M2Js4v5W', 'badincedric20@gmail.com', NULL, 0, '2025-02-04 08:22:33', '../../assets/images/imageavatars/photodefault.jpg', 1, 1, 0, 0, 5917, 0, 0, 0, 0);

--
-- Déclencheurs `joueur`
--
DROP TRIGGER IF EXISTS `trg_after_delete_joueur`;
DELIMITER $$
CREATE TRIGGER `trg_after_delete_joueur` AFTER DELETE ON `joueur` FOR EACH ROW BEGIN
    DELETE FROM AcheterTheme
    WHERE idJoueur = OLD.idJoueur;

    DELETE FROM AcheterMusique
    WHERE idJoueur = OLD.idJoueur;

    DELETE FROM JoueurPartie
    WHERE idJoueur = OLD.idJoueur;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `trg_after_insert_joueur`;
DELIMITER $$
CREATE TRIGGER `trg_after_insert_joueur` AFTER INSERT ON `joueur` FOR EACH ROW BEGIN
    INSERT INTO AcheterTheme (idJoueur, idTheme)
    VALUES (NEW.idJoueur, 1);
    INSERT INTO AcheterMusique (idJoueur, idMusique)
    VALUES (NEW.idJoueur, 1);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `joueurpartie`
--

DROP TABLE IF EXISTS `joueurpartie`;
CREATE TABLE IF NOT EXISTS `joueurpartie` (
  `idJoueur` varchar(50) NOT NULL,
  `idPartie` varchar(50) NOT NULL,
  `score` smallint DEFAULT '0',
  `estGagnant` smallint NOT NULL DEFAULT '0',
  `positionPartie` int NOT NULL,
  PRIMARY KEY (`idJoueur`,`idPartie`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `joueurpartie`
--

INSERT INTO `joueurpartie` (`idJoueur`, `idPartie`, `score`, `estGagnant`, `positionPartie`) VALUES
('aad581aaa28c8eb59d811e1c75eb', '2f01c2b453637b271757', 0, 0, 2),
('ad0dc7940c13f005aab750d299c4d2d6', '2f01c2b453637b271757', 0, 0, 1),
('ad0dc7940c13f005aab750d299c4d2d6', '713970bf50e91943ad6e', 17, 0, 1),
('aad581aaa28c8eb59d811e1c75eb', '713970bf50e91943ad6e', 17, 0, 2),
('ad0dc7940c13f005aab750d299c4d2d6', '4f788b50f4258b6b42f0', 0, 0, 1),
('ad0dc7940c13f005aab750d299c4d2d6', '5a9cdc960502b72109ed', 129, 1, 1),
('aad581aaa28c8eb59d811e1c75eb', '5a9cdc960502b72109ed', 129, 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `musique`
--

DROP TABLE IF EXISTS `musique`;
CREATE TABLE IF NOT EXISTS `musique` (
  `idMusique` smallint NOT NULL AUTO_INCREMENT,
  `nomMusique` varchar(25) NOT NULL,
  `cheminMusique` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `prix` smallint DEFAULT NULL,
  `imgChemin` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`idMusique`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `musique`
--

INSERT INTO `musique` (`idMusique`, `nomMusique`, `cheminMusique`, `prix`, `imgChemin`) VALUES
(1, 'musique1', '../../assets/audio/MusicAccueil5.mp3', 0, '../../assets/Images/imagePersonnalisation/imgMusique.png'),
(2, 'musique2', '../../assets/audio/MusicAccueil6.mp3', 1100, '../../assets/Images/imagePersonnalisation/imgMusique.png'),
(3, 'musique3', '../../assets/audio/MusicAccueil7.mp3', 1200, '../../assets/Images/imagePersonnalisation/imgMusique.png'),
(4, 'musique4', '../../assets/audio/MusicAccueil8.mp3', 1300, '../../assets/Images/imagePersonnalisation/imgMusique.png');

-- --------------------------------------------------------

--
-- Structure de la table `partie`
--

DROP TABLE IF EXISTS `partie`;
CREATE TABLE IF NOT EXISTS `partie` (
  `idPartie` varchar(50) NOT NULL,
  `datePartie` date NOT NULL,
  `scoreTotalPartie` smallint DEFAULT '0',
  `nbJoueur` tinyint NOT NULL,
  `statut` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`idPartie`)
) ;

--
-- Déchargement des données de la table `partie`
--

INSERT INTO `partie` (`idPartie`, `datePartie`, `scoreTotalPartie`, `nbJoueur`, `statut`) VALUES
('4f788b50f4258b6b42f0', '2025-02-04', 0, 2, 2),
('713970bf50e91943ad6e', '2025-02-04', 0, 2, 2),
('2f01c2b453637b271757', '2025-02-04', 0, 2, 2),
('5a9cdc960502b72109ed', '2025-02-04', 0, 2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `succes`
--

DROP TABLE IF EXISTS `succes`;
CREATE TABLE IF NOT EXISTS `succes` (
  `idSucces` int NOT NULL AUTO_INCREMENT,
  `nomSucces` varchar(35) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Condition` varchar(350) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `typeSucces` varchar(35) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`idSucces`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `succes`
--

INSERT INTO `succes` (`idSucces`, `nomSucces`, `Condition`, `typeSucces`) VALUES
(1, 'Premiers Pas', 'Se connecter pour la première fois.', 'Progression Générale'),
(2, 'Débutant Passionné', 'Avoir plus de 3 heures de jeu.', 'Progression Générale'),
(3, 'Aventurier téméraire', 'Avoir plus de 4 heures de jeu.', 'Progression Générale'),
(4, 'Joueur Dévoué', 'Avoir plus de 5 heures de jeu.', 'Progression Générale'),
(5, 'Marathonien', 'Jouer plus de 100 parties.', 'Progression Générale'),
(6, 'Amateur', 'Faire un score maximal de 150 ou plus.', 'Performances'),
(7, 'Champion', 'Faire un score maximal de 200 ou plus.', 'Performances'),
(8, 'Expert', 'Faire un score maximal de 250 ou plus.', 'Performances'),
(9, 'Maître', 'Faire un score maximal de 300 ou plus.', 'Performances'),
(10, 'Douzhee Instinctif', 'Réussir un Douzhee du premier coup.', 'Performances'),
(11, 'Douzhee Multiples', 'Faire 3 Douzhee en une seule partie.', 'Performances'),
(12, 'Maître Stratégique', 'Finir une partie en ne barrant aucun choix.', 'Performances'),
(13, 'Vainqueur', 'Gagner une partie.', 'Performances'),
(14, 'Victorieux Sérieux', 'Gagner 25 parties.', 'Performances'),
(15, 'Légende Vivante', 'Gagner plus de 50 parties.', 'Performances'),
(16, 'Maître de Précision', 'Avoir un ratio de victoire de plus de 80% en plus de 15 parties.', 'Performances'),
(17, 'Premier Gains', 'Avoir plus de 350 Douzcoin.', 'Récompenses'),
(18, 'Accumulateur', 'Avoir plus de 1000 Douzcoin.', 'Récompenses'),
(19, 'Grand Investisseur', 'Avoir plus de 2500 Douzcoin.', 'Récompenses'),
(20, 'Millionnaire Virtuel', 'Avoir plus de 5000 Douzcoin.', 'Récompenses'),
(21, 'Milliardaire Futuriste', 'Avoir plus de 10000 Douzcoin.', 'Récompenses'),
(22, 'Esthète Ludique', 'Obtenir tous les thèmes de jeu.', 'Collection'),
(23, 'Collectionneur de Dés', 'Obtenir tous les styles de dés.', 'Collection'),
(24, 'Maitre de la collection', 'Obtenir tous les skin.', 'Collection'),
(25, 'Montée en Puissance', 'Finir dans le top 10.', 'Classements');

-- --------------------------------------------------------

--
-- Structure de la table `succesjoueur`
--

DROP TABLE IF EXISTS `succesjoueur`;
CREATE TABLE IF NOT EXISTS `succesjoueur` (
  `idJoueur` varchar(50) NOT NULL,
  `idSucces` smallint NOT NULL,
  PRIMARY KEY (`idJoueur`,`idSucces`),
  KEY `idSucces` (`idSucces`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `succesjoueur`
--

INSERT INTO `succesjoueur` (`idJoueur`, `idSucces`) VALUES
('1b730b0ffa7726f624942e61e3', 1),
('377dfc44012e59c77522c994036c882ae462ab098117c344cd', 1),
('61c47ebe92fe935618799a03ed1a31c04913f0a3ff0e55583f', 1),
('aad581aaa28c8eb59d811e1c75eb', 1),
('aad581aaa28c8eb59d811e1c75eb', 12),
('ad0dc7940c13f005aab750d299c4d2d6', 1),
('ad0dc7940c13f005aab750d299c4d2d6', 12),
('e162ce7c5581eee7daf3801368fc62caabcecb', 1);

-- --------------------------------------------------------

--
-- Structure de la table `theme`
--

DROP TABLE IF EXISTS `theme`;
CREATE TABLE IF NOT EXISTS `theme` (
  `idTheme` smallint NOT NULL AUTO_INCREMENT,
  `nomTheme` varchar(25) NOT NULL,
  `prix` smallint NOT NULL,
  `imgChemin` varchar(50) NOT NULL,
  PRIMARY KEY (`idTheme`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `theme`
--

INSERT INTO `theme` (`idTheme`, `nomTheme`, `prix`, `imgChemin`) VALUES
(1, 'purple', 0, '../../assets/Images/imagePersonnalisation/Theme1'),
(2, 'green', 1100, '../../assets/Images/imagePersonnalisation/Theme2'),
(3, 'red', 1200, '../../assets/Images/imagePersonnalisation/Theme3'),
(4, 'blue', 1300, '../../assets/Images/imagePersonnalisation/Theme4');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
