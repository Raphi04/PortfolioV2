-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 26 fév. 2024 à 13:40
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gustave`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `nom` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `type` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `reference` int NOT NULL,
  `description` varchar(800) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`reference`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`nom`, `type`, `reference`, `description`) VALUES
('PC GAMING DELL 01', 'Équipement', 1, 'Disque dur: 1To SSD M2 NVME <br> \r\nRAM: 64 Go DDR4 <br>\r\nCarte Graphique: Nvidia Quadro RTX 4000 8Go <br>\r\nProcesseur: Intel Xeon Silver 4210'),
('PC GAMING DELL 02', 'Équipement', 2, 'Disque dur: 1To SSD M2 NVME <br> \r\nRAM: 64 Go DDR4 <br>\r\nCarte Graphique: Nvidia Quadro RTX 4000 8Go <br>\r\nProcesseur: Intel Xeon Silver 4210'),
('OCULUS QUEST 2 01', 'Équipement', 3, 'Casque de réalité virtuelle tout-en-un, utilisable avec ou sans fil.<br>\r\nStockage: 256 Go<br>\r\nRAM: 6 Go<br>\r\nProcesseur: Qualcomm Snapdragon XR2<br>\r\nécran LCD : Résolution de 1832 x 1920 pixels par oeil<br>\r\nHaut-parleurs: intégrés pour une immersion à 360°<br>\r\nAngle de vision: 120° (horizontal)<br>\r\n\r\nChaque casque est accompagné de:<br>\r\n2 manettes Touch<br>\r\nCâble de chargement<br>\r\nAdaptateur secteur<br>\r\nEspacement pour lunettes<br>\r\nCâble Oculus Link (pour le lier au PC, pratique pour le développement)<br>'),
('OCULUS QUEST 2 02', 'Équipement', 4, 'Casque de réalité virtuelle tout-en-un, utilisable avec ou sans fil.<br>\nStockage: 256 Go<br>\nRAM: 6 Go<br>\nProcesseur: Qualcomm Snapdragon XR2<br>\nécran LCD : Résolution de 1832 x 1920 pixels par oeil<br>\nHaut-parleurs: intégrés pour une immersion à 360°<br>\nAngle de vision: 120° (horizontal)<br>\n\nChaque casque est accompagné de:<br>\n2 manettes Touch<br>\nCâble de chargement<br>\nAdaptateur secteur<br>\nEspacement pour lunettes<br>\nCâble Oculus Link (pour le lier au PC, pratique pour le développement)<br>'),
('CAMÉRA 360° RICOH THETA', 'Vidéo', 5, 'Type de capteur: CMOS<br>\nRésolution: 14,4 Mégapixels<br>\nStockage: 14 Go<br>\nFormat d\'enregistrement: MP4<br>\nQualité d\'enregistrement: Ultra HD (4K)<br>\nWiFi: Oui<br>\nBluetooth: Oui<br>\nTransfert sur smartphone: Oui<br>\nContrôle à distance via smartphone: Oui<br>\nApplication dédiée gratuite: Theta / Theta +'),
('WEBCAM LOGITECH BRIO 4K', 'Vidéo', 6, 'Interface avec l\'ordinateur: USB 3.0<br>\r\nSans-fil: Non<br>\r\nType de capteur: CMOS<br>\r\nRésolution vidéo: 3840 x 2160 pixels<br>\r\nMicrophone intégré: Oui<br>\r\nCette webcam est pratique pour le développement en réalité augmentée, avec Unity 3D et Vuforia.'),
('TRÉPIED BENRO', 'Vidéo', 7, 'Idéal pour la fixation de la caméra 360° ou d\'un smartphone/tablette.<br>\nCharge maximale: 4 kg<br>\nCorps de trépied en magnésium avec 3 positions de réglage <br>\nHauteur max (24°) avec colonne dépliée: 57.6 cm<br>\nHauteur max (24°) avec colonne repliée: 48.4 cm<br>\nHauteur min: 15.7 cm<br>\nHauteur max: 57.6 cm<br>\nTaille replié: 20.1 cm<br>\nSystème de verrouillage: bague à vis\nTête rotule amovible <br>\nPlateau rapide en aluminium anodisé<br>\nDiamètre colonne centrale: 20 mm<br>\nNiveau à bulle <br>\nAvec housse de transport<br>\nPoids : 2.6 kg<br>'),
('MICROPHONE HYPERX QUADCAST', 'Vidéo', 8, 'Pour enregistrer des sons lors du développement de jeux vidéos.<br>\r\nSélection entre quatre diagrammes polaires<br>\r\nPied amortisseur contre les vibrations<br>\r\nCapteur de fonction mute par pression et témoin LED<br>\r\nMolette de réglage du contrôle de gain pratique<br>\r\nFiltre anti-pop interne<br>\r\nPrise casque intégrée<br>\r\nCompatibilité multi-dispositif et chat<br>\r\nContient un adaptateur de pied'),
('CASQUE STEELSERIES ARCTIS 5', 'Audio', 9, 'Casque au son DTS Headphone: X v2.0<br> Surround avec rétroéclairage RGB personnalisable (16.8 millions de couleurs)<br>\r\nMicrophone bidirectionnel rétractable avec suppression du bruit<br>\r\nConnecteur: USB ou jack 3.5 mm 4 pôles<br>\r\nContrôle audio via télécommande filaire<br>\r\nBandeau de suspension s\'adaptant à toutes les formes de tête<br>\r\nLogiciel SteelSeries Engine 3'),
('VIDÉOPROJECTEUR LASER', 'Équipement', 10, 'Vidéoprojecteur DLP Full HD<br>\nLuminosité: 1500 Lumens<br>\nFocale ultra-courte: image de 90\" avec recul de 8 cm / 120\" avec recul de 20 cm<br>\nCorrection manuelle de la distorsion trapézoïdale (H/V)<br>\nPrise en charge d\'un son Dolby Audio et DTS-HD<br>\nSmart Share: Miracast, Contents Sharing<br>\nBluetooth audio<br>\nwebOS 4.0<br>\nLecteur multimédia intégré via port USB<br>\nConnectiques: HDMI x2, USB, S/PDIF Optique, Fast Ethernet'),
('LOGO', 'Équipement', 11, 'logo portfolio');

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
CREATE TABLE IF NOT EXISTS `reservation` (
  `debut` date DEFAULT NULL,
  `fin` date DEFAULT NULL,
  `reference` int NOT NULL,
  `mail` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `statut` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `numero` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`reference`,`mail`,`numero`),
  KEY `FK_mail` (`mail`),
  KEY `numero` (`numero`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`debut`, `fin`, `reference`, `mail`, `statut`, `numero`) VALUES
('2004-12-12', '2004-12-12', 4, 'raphaelcadete@gmail.com', 'Accepté', 15),
('1111-11-11', '1111-11-11', 8, 'gustave-eiffel@admin.fr', 'Accepté', 12),
('2004-12-14', '2004-12-14', 8, 'gustave-eiffel@admin.fr', 'Refusé', 14),
('2004-12-11', '2004-12-13', 9, 'gustave-eiffel@admin.fr', 'Accepté', 16),
('2004-12-12', '2004-12-12', 9, 'gustave-eiffel@admin.fr', 'En attente de confirmation', 17),
('2023-02-01', '2023-02-02', 9, 'raphaelcadete04@gmail.com', 'Accepté', 18),
('2023-02-01', '2023-02-02', 9, 'raphaelcadete04@gmail.com', 'Refusé', 19);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `prenom` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `nom` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `mail` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `naissance` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `mdp` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `role` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`mail`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`prenom`, `nom`, `mail`, `naissance`, `mdp`, `role`) VALUES
('admin', '1', 'gustave-eiffel@admin.fr', '01/01/0000', 'd779abe160e46c506899e6452db3480648e59b91522ed8c91108ea0a67d363d6', 'admin'),
('Raphael', 'Cadete', 'raphaelcadete04@gmail.com', '14/12/2004', '053e9c5f1a29bea66ff896d7a8f217bf380b8e3973e7f13c1acbe14ef7fc947e', 'utilisateur'),
('Raphael', 'Cadete', 'raphaelcadete@gmail.com', '11/05/2005', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'utilisateur');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `FK_mail` FOREIGN KEY (`mail`) REFERENCES `user` (`mail`),
  ADD CONSTRAINT `FK_reference` FOREIGN KEY (`reference`) REFERENCES `article` (`reference`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
