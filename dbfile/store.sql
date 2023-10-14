-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mer. 17 août 2022 à 14:54
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `store`
--

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE `panier` (
  `commandeID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `produitID` int(11) NOT NULL,
  `produitNom` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `produitPrix` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `panier`
--

INSERT INTO `panier` (`commandeID`, `UserID`, `produitID`, `produitNom`, `image`, `produitPrix`) VALUES
(8, 2, 28, 'SAMSUNG NOTE20 ULTRA ', 'p28.jpg', 12499),
(10, 5, 33, 'SAMSUNG GALAXY A02S ROUGE', 'p33.jpg', 1490),
(11, 5, 28, 'SAMSUNG NOTE20 ULTRA ', 'p28.jpg', 12499),
(13, 3, 33, 'SAMSUNG GALAXY A02S ROUGE', 'p33.jpg', 1490),
(14, 2, 13, 'Samsung Galaxy Tab A 2019', 'p13.jpg', 1649),
(15, 2, 11, 'LG TV- 32 LED', 'p11.jpg', 1539),
(16, 7, 2, 'Samsung Galaxy A015F', 'p2.jpg', 949);

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `produitID` int(11) NOT NULL,
  `produitNom` varchar(255) NOT NULL,
  `produitPrix` int(11) NOT NULL,
  `produitDescription` varchar(255) NOT NULL,
  `produitCategorie` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `quantite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`produitID`, `produitNom`, `produitPrix`, `produitDescription`, `produitCategorie`, `image`, `quantite`) VALUES
(2, 'Samsung Galaxy A015F', 949, 'Samsung Galaxy A015F 5.7 (16Go, 2Go) Dual SIM Android 13MP+2MP/5MP - Noir', 'Téléphones', 'p2.jpg', 3),
(3, 'XIAOMI Redmi Note 8 4G', 1799, 'XIAOMI Redmi Note 8 4G 6.3 (4Go, 64Go) Android - Noir', 'Téléphones', 'p3.jpg', 5),
(4, 'Hp Probook 640 G1', 2899, 'Hp Probook 640 G1 Core i3 4eme HDD 320GB RAM 4GB 14 remis a neuf', 'Ordinateurs', 'p4.jpg', 4),
(5, 'Asus X543NA-AR289T', 3499, 'Asus X543NA-AR289T Intel - 15,6 HD Uslim - 4GO - 1TO - WINDOWS 10 - GREY', 'Ordinateurs', 'p5.jpg', 2),
(6, 'Hp PC Portable Probook 640 G1', 2645, 'Hp PC Portable Probook 640 G1 Core i3 4th Gén 320GB - 4GB RAM 14 -Remis a Neuf', 'Ordinateurs', 'p6.jpg', 6),
(7, 'Lenovo PC PORTABLE IdeaPad 330', 3490, 'Lenovo PC PORTABLE IdeaPad 330 15IGM-N4000 4GO 1TO 15.6 FreeDos GRIS', 'Ordinateurs', 'p7.jpg', 2),
(8, 'Hisense 32 FHD SMART TV ', 1499, 'Hisense 32″ FHD SMART TV 32B6200HW avec Récepteur intégré - Noir.', 'Télévisions', 'p8.jpg', 3),
(9, 'Infinix Smart 5', 1049, 'Infinix Smart 5 6.6 HD+ (2GB,32GB) Android Selfie 8MP Double Flash - Quetzal Cyan', 'Téléphones', 'p9.jpg', 4),
(10, 'Vivo Y91C', 985, 'Vivo Y91C - 6.22 - 32 Go - 2Go RAM - Android - 4030mAh - Rouge', 'Téléphones', 'p10.jpg', 2),
(11, 'LG TV- 32 LED', 1539, 'LG TV- 32 LED - Recepteur integré - USB - HDMI - TNT - 32LM550 - Support Mural-', 'Télévisions', 'p11.jpg', 10),
(12, 'Samsung 3 SAMSUNG Série 5', 2149, 'Samsung 32 SAMSUNG Série 5 Smart Tv WI-FI+TNT+Récepteur+Câble HDMI original', 'Télévisions', 'p12.jpg', 2),
(13, 'Samsung Galaxy Tab A 2019', 1649, 'Samsung Galaxy Tab A 2019 8.0 , QUAD 2 Ghz 2GB / 32Go LTE - NOIR', 'Tablettes', 'p13.jpg', 3),
(14, 'Huawei Mediapad T3 10', 1850, 'Huawei Mediapad T3 10 9.6 (32Go, 2Go) 5MP/2MP Android - Gris', 'Tablettes', 'p14.jpg', 3),
(15, 'Huawei Y7a', 1859, 'Huawei Y7a 6.67 (4GB,128GB) Dual SIM 48MP+8MP+2MP+2MP/8MP - Gold', 'Téléphones', 'p15.jpg', 3),
(16, 'Huawei Y9a', 2899, 'Huawei Y9a 6.63 (8GB,128GB) 64MP+8MP+2MP+2MP/16MP EMUI 10.1', 'Téléphones', 'p16.jpg', 1),
(17, 'M4 Smart Bracelet Fitness', 149, 'M4 Smart Bracelet Fitness Tracker Heart Rate Monitor NOir Montre intelligente Connectée', 'Accessoires-téléphones', 'p17.jpg', 10),
(18, 'Samsung Smart TV 55TU7000', 6199, 'Samsung Smart TV 55TU7000 Crystal UHD 4K série 7 HDR 10+ Récepteur Intégré Bluetooth TNT Modèle 2020', 'Télévisions', 'p18.jpg', 2),
(19, 'Vision TV VISION LED 24', 1049, 'Vision TV VISION LED 24 + Récepteur intégré (DVB-S2) - TNT / 1 HDMI / 1 USB / 1 VGA', 'Télévisions', 'p19.jpg', 3),
(20, 'Amoi Écouteur Bluetooth F9', 215, 'Amoi Écouteur Bluetooth F9 LED 5.0 Casque Stéréo Tactile Sans Fil + Batterie Externe 2200mAH', 'Accessoires-téléphones', 'p20.jpg', 4),
(21, 'i12 TWS Wireless Bluetooth ', 149, 'PARTAGEZ CE PRODUIT   i12 TWS Wireless Bluetooth - with Chargeable Case - Earphones for Android, iOS, All Smart Phone ', 'Accessoires-téléphones', 'p21.jpg', 7),
(22, 'Huawei WATCH GT 2e Sport 1,39', 1599, 'Huawei WATCH GT 2e Sport 1,39\" 4GB Mint Green', 'Accessoires-téléphones', 'p22.jpg', 3),
(23, 'Smartwatch V8 ', 175, 'Smartwatch V8 Smartwatch écran tactile support Micro carte SIM avec Bluetooth 3.0 Camera', 'Accessoires-téléphones', 'p23.jpg', 4),
(24, 'Lenovo V14-IIL - i5-1035G1', 6350, 'Lenovo V14-IIL - i5-1035G1 ( 10éme Génération ) - 14 - 4Gb RAM - 1To HDD - Ultraslim - FreeDos', 'Ordinateurs', 'p24.jpg', 3),
(25, 'Lenovo IdeaPad 330 15IGM-N4000', 3450, 'Lenovo IdeaPad 330 15IGM-N4000 4GO 1TO 15.6 FreeDos', 'Ordinateurs', 'p25.jpg', 2),
(26, 'Vision LED 32\"', 1399, 'Vision LED 32 Vision avec récepteur intégré, USB-VGA-HDMI-PC AUDIO IN1 + Support Mural', 'Télévisions', 'p26.jpg', 5),
(27, 'SAMSUNG QA55Q70TAUXMV', 11799, 'TAILLE D\'ÉCRAN : 55 TYPE D\'ECRAN : FLAT SMART TV : OUI NORME HD : UHD (4K)', 'Télévisions', 'p27.jpg', 4),
(28, 'SAMSUNG NOTE20 ULTRA ', 12499, 'MÉMOIRE DE STOCKAGE : 256 RESEAU : 4G COULEUR : BLANC DOUBLE SIM : OUI', 'Téléphones', 'p28.jpg', 1),
(29, 'XIAOMI Redmi 9', 1600, 'XIAOMI Redmi 9 6.53 (4Go, 64Go) 13 MP+8 MP+5 MP+2 MP/8 MP Android - Vert', 'Téléphones', 'p29.jpg', 6),
(30, 'STG TAB KEYTAB NOIR 8\'\'', 1299, 'TAILLE D\'ECRAN : 8\'\' MÉMOIRE RAM : 3 Go MÉMOIRE DE STOCKAGE : 32 RESEAU : 4G+', 'Tablettes', 'p30.jpg', 3),
(31, 'SAMSUNG TAB S5E SM-T725', 4990, 'TAILLE D\'ECRAN : 10.5\" MÉMOIRE RAM : 4 GO MÉMOIRE DE STOCKAGE : 64 COULEUR : GOLD', 'Tablettes', 'p31.jpg', 5),
(32, 'SAMSUNG A7 SM-T505 GRIS', 2990, 'MÉMOIRE DE STOCKAGE : 32 RESEAU : 4G COULEUR : GRIS', 'Tablettes', 'p32.jpg', 2),
(33, 'SAMSUNG GALAXY A02S ROUGE', 1490, 'MÉMOIRE DE STOCKAGE : 64 RESEAU : 4G+ COULEUR : ROUGE', 'Téléphones', 'p33.jpg', 5),
(34, 'OPPO A9 8G 128G BLEU OPPO', 3199, 'MÉMOIRE DE STOCKAGE : 128 RESEAU : 3G / 4G / LTE COULEUR : BLEU DOUBLE SIM : OUI', 'Téléphones', 'p34.jpg', 5),
(35, 'XIAOMI MI10T 8G 128G BLACK', 4799, 'MÉMOIRE DE STOCKAGE : 128 RESEAU : 3G / 4G / LTE COULEUR : NOIR DOUBLE SIM : OUI', 'Téléphones', 'p35.jpg', 3);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `groupeID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`UserID`, `email`, `password`, `username`, `nom`, `prenom`, `groupeID`) VALUES
(1, 'admin@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'admin', 'admin', 'admin', 1),
(3, 'yy@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'llll', 'll', 'll', 0),
(5, 'o@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'o', 'o', 'o', 0),
(6, 'q@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'q', 'q', 'q', 0),
(7, 'new@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'new', 'new ', 'new', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`commandeID`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`produitID`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `panier`
--
ALTER TABLE `panier`
  MODIFY `commandeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `produitID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
