-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 05 avr. 2022 à 17:27
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `heroku_d25bce77eb730af`
--

-- --------------------------------------------------------

--
-- Structure de la table `chambres`
--

CREATE TABLE `chambres` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hotel_id` int(11) NOT NULL,
  `prix` decimal(10,2) NOT NULL,
  `booking` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `chambres`
--

INSERT INTO `chambres` (`id`, `titre`, `description`, `hotel_id`, `prix`, `booking`) VALUES
(1, 'Chambre Premium Lit Queen-Size avec Canapé-Lit', 'Superficie 24 m² Lits confortables, notés 9.1 (d\'après 903 commentaires) Dotée d\'une entrée privée, cette chambre double dispose d\'un peignoir et d\'un plateau/bouilloire.', 3, '130.00', 'https://www.booking.com/hotel/fr/golden-tulip-strasbourg-centre-the-garden.fr.html?aid=356980;label=gog235jc-1DCAMoTTjiAkgNWANoTYgBAZgBDbgBF8gBDNgBA-gBAfgBAogCAagCA7gC9bmBkgbAAgHSAiQ4MmM4MGI1Yi02YWYyLTRmOGMtYTkyMy03MjNkYmE2MDU4NzTYAgTgAgE;sid=52f437eaad1a'),
(2, 'Suite Junior avec Lit King-Size', 'Superficie 35 m² Lits confortables, notés 9.1 (d\'après 903 commentaires) This suite has a private entrance, soundproofing and tea/coffee maker.', 3, '120.00', 'https://www.booking.com/hotel/fr/golden-tulip-strasbourg-centre-the-garden.fr.html?aid=356980;label=gog235jc-1DCAMoTTjiAkgNWANoTYgBAZgBDbgBF8gBDNgBA-gBAfgBAogCAagCA7gC9bmBkgbAAgHSAiQ4MmM4MGI1Yi02YWYyLTRmOGMtYTkyMy03MjNkYmE2MDU4NzTYAgTgAgE;sid=52f437eaad1a'),
(3, 'Suite Lit King-Size avec Canapé-Lit', 'Superficie 39 m² Lits confortables, notés 9.1 (d\'après 903 commentaires) This suite features a electric kettle, soundproofing and tea/coffee maker.', 3, '160.00', 'https://www.booking.com/hotel/fr/golden-tulip-strasbourg-centre-the-garden.fr.html?aid=356980;label=gog235jc-1DCAMoTTjiAkgNWANoTYgBAZgBDbgBF8gBDNgBA-gBAfgBAogCAagCA7gC9bmBkgbAAgHSAiQ4MmM4MGI1Yi02YWYyLTRmOGMtYTkyMy03MjNkYmE2MDU4NzTYAgTgAgE;sid=52f437eaad1a'),
(4, 'Chambre Standard', 'Superficie 21 m² Lits confortables, notés 9.1 (d\'après 908 commentaires) This double room features a tea/coffee maker, electric kettle and soundproofing.', 3, '100.00', 'https://www.booking.com/hotel/fr/golden-tulip-strasbourg-centre-the-garden.fr.html?aid=356980;label=gog235jc-1DCAMoTTjiAkgNWANoTYgBAZgBDbgBF8gBDNgBA-gBAfgBAogCAagCA7gC9bmBkgbAAgHSAiQ4MmM4MGI1Yi02YWYyLTRmOGMtYTkyMy03MjNkYmE2MDU4NzTYAgTgAgE;sid=52f437eaad1a'),
(5, 'Chambre Double Privilège', 'Lits confortables, notés 9.2 (d\'après 451 commentaires) Cette chambre spacieuse comprend une baignoire ou une douche, des peignoirs et des chaussons.', 5, '150.00', 'https://www.booking.com/hotel/fr/le-grand-balcon-toulouse.fr.html?aid=356980&label=gog235jc-1DCAMoTTjiAkgNWANoTYgBAZgBDbgBF8gBDNgBA-gBAfgBAogCAagCA7gC9bmBkgbAAgHSAiQ4MmM4MGI1Yi02YWYyLTRmOGMtYTkyMy03MjNkYmE2MDU4NzTYAgTgAgE&sid=52f437eaad1a851212038be9702f4'),
(6, 'Chambre Double Classique', 'Superficie 18 m² Lits confortables, notés 9.2 (d\'après 451 commentaires) Cette chambre comprend une machine à café Nespresso, un minibar et une télévision à écran plat.', 5, '130.00', 'https://www.booking.com/hotel/fr/le-grand-balcon-toulouse.fr.html?aid=356980&label=gog235jc-1DCAMoTTjiAkgNWANoTYgBAZgBDbgBF8gBDNgBA-gBAfgBAogCAagCA7gC9bmBkgbAAgHSAiQ4MmM4MGI1Yi02YWYyLTRmOGMtYTkyMy03MjNkYmE2MDU4NzTYAgTgAgE&sid=52f437eaad1a851212038be9702f4'),
(7, 'Chambre Double Deluxe', 'Superficie 25 m² Lits confortables, notés 9.2 (d\'après 451 commentaires) Cette chambre spacieuse comprend une baignoire, des peignoirs et des chaussons.', 5, '140.00', 'https://www.booking.com/hotel/fr/golden-tulip-strasbourg-centre-the-garden.fr'),
(8, 'Suite', 'Superficie 35 m² Lits confortables, notés 9.2 (d\'après 451 commentaires) Cette suite spacieuse dispose d\'un coin salon. Des peignoirs et des chaussons sont fournis dans la salle de bains.', 5, '240.00', 'https://www.booking.com/hotel/fr/le-grand-balcon-toulouse.fr.html?aid=356980&label=gog235jc-1DCAMoTTjiAkgNWANoTYgBAZgBDbgBF8gBDNgBA-gBAfgBAogCAagCA7gC9bmBkgbAAgHSAiQ4MmM4MGI1Yi02YWYyLTRmOGMtYTkyMy03MjNkYmE2MDU4NzTYAgTgAgE&sid=52f437eaad1a851212038be9702f4');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20220316143026', '2022-03-16 15:31:20', 96),
('DoctrineMigrations\\Version20220316143842', '2022-03-16 15:38:46', 102),
('DoctrineMigrations\\Version20220316144659', '2022-03-16 15:47:18', 82);

-- --------------------------------------------------------

--
-- Structure de la table `hotel`
--

CREATE TABLE `hotel` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ville` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `hotel`
--

INSERT INTO `hotel` (`id`, `nom`, `ville`, `description`, `adresse`) VALUES
(2, 'Moxy Lille City', 'Lille', '1 km du centreProche du métro Le Moxy Lille City est situé à Lille, à 700 mètres de la braderie de Lille. Il propose des hébergements avec une terrasse et un parking privé.', '3, Rue Jean Bart, Centre de Lille, 59000 Lille, France'),
(3, 'The Garden', 'Strasbourg', 'Doté d\'un jardin et d\'un restaurant, le Voco - Strasbourg Centre - The Garden - Garden est situé à Strasbourg. Il comporte une terrasse, un salon commun et un bar. Vous séjournerez à 1,5 km du marché de Noël et à 1,9 km de l\'église Saint-Paul. ', '9 Rue des Magasins, 67000 Strasbourg, France'),
(5, 'Le Grand Balcon', 'Toulouse', 'Situé dans le centre de Toulouse, à 4 km du Stadium, Le Grand Balcon Hotel est un établissement 4 étoiles doté d\'une décoration des années 1930 et d\'une réception ouverte 24h/24. Il propose des chambres climatisées avec connexion Wi-Fi gratuite.', '8-10 Rue Romiguieres, 31000 Toulouse, France');

-- --------------------------------------------------------

--
-- Structure de la table `photo`
--

CREATE TABLE `photo` (
  `id` int(11) NOT NULL,
  `hotel_id` int(11) DEFAULT NULL,
  `lien` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover` tinyint(1) NOT NULL,
  `chambres_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `photo`
--

INSERT INTO `photo` (`id`, `hotel_id`, `lien`, `cover`, `chambres_id`) VALUES
(2, 2, '281571003-6240376e8a9d7.jpg', 1, NULL),
(3, 2, '281571455-6240376f148ca.jpg', 0, NULL),
(4, 2, '281572280-6240376f92cfd.jpg', 0, NULL),
(5, 2, '281572722-624037701d0e5.jpg', 0, NULL),
(6, 2, 'cover-624037709e83c.jpg', 0, NULL),
(7, 2, '281566932-62403a7f61510.jpg', 0, NULL),
(25, 2, '281571003-6240409a49751.jpg', 0, NULL),
(28, 3, '274497346-62405e576355c.jpg', 1, NULL),
(29, 3, '180222767-6240610c1d25e.jpg', 0, NULL),
(30, 3, '180222774-6240610c20e94.jpg', 0, NULL),
(31, 3, '180225085-6240610c9fa80.jpg', 0, NULL),
(32, 3, '180225089-6240610d28efd.jpg', 0, NULL),
(33, 3, '180225094-6240610da979f.jpg', 0, NULL),
(34, 3, '180497464-6240610e330e4.jpg', 0, NULL),
(35, 3, '274497026-6240610eb4a8f.jpg', 0, NULL),
(36, 3, '274497095-6240610f3e326.jpg', 0, NULL),
(37, 3, '274497346-6240610fbf9f9.jpg', 0, NULL),
(54, NULL, '159718997-6241da7d3f464.jpg', 0, 1),
(55, NULL, '180224314-6241da7d4184f.jpg', 0, 1),
(57, NULL, '180506357-6241da7d42d97.jpg', 0, 1),
(62, NULL, '181547452-6241e90aa2985.jpg', 0, 1),
(63, NULL, '180506328-624207614b056.jpg', 1, 1),
(64, NULL, '180224698-6243007a625d9.jpg', 0, 2),
(65, NULL, '180224707-6243007a65024.jpg', 0, 2),
(66, NULL, '180224907-6243007a65c6a.jpg', 0, 2),
(67, NULL, '180506316-6243007a66710.jpg', 0, 2),
(68, NULL, '181548794-6243007a670eb.jpg', 1, 2),
(69, NULL, '180224685-624305d106991.jpg', 0, 3),
(70, NULL, '180506316-624305d108f30.jpg', 0, 3),
(71, NULL, '180506343-624305d109cd8.jpg', 1, 3),
(72, NULL, '180506351-624305d10a9a6.jpg', 0, 3),
(73, NULL, '274492756-624305d10b40c.jpg', 0, 3),
(74, NULL, '274493318-624305d10bed7.jpg', 0, 3),
(75, NULL, '159723939-6243172957932.jpg', 0, 4),
(76, NULL, '180224326-6243172959fbd.jpg', 0, 4),
(77, NULL, '180506332-624317295ab70.jpg', 0, 4),
(78, NULL, '180506336-624317295b6e3.jpg', 0, 4),
(79, NULL, '181548392-624317295c149.jpg', 0, 4),
(80, NULL, '181548794-624317295caed.jpg', 0, 4),
(81, NULL, '181549016-624317295d499.jpg', 1, 4),
(82, NULL, '181549183-624317295ddcd.jpg', 0, 4),
(83, NULL, '274491052-624317295e707.jpg', 0, 4),
(84, NULL, '274491447-624317295f105.jpg', 0, 4),
(85, NULL, '274491739-624317295fa97.jpg', 0, 4),
(86, 5, '203843-624b0de303c17.webp', 0, NULL),
(87, 5, '208239-624b0de3082a0.webp', 0, NULL),
(88, 5, '17113683-624b0de308fa9.jpg', 1, NULL),
(89, 5, '138861309-624b0de309a64.jpg', 0, NULL),
(90, 5, '138861312-624b0de30a3b2.jpg', 0, NULL),
(91, 5, '138861323-624b0de30ace4.jpg', 0, NULL),
(92, 5, '204977335-624b0de30b83a.jpg', 0, NULL),
(93, 5, '204977345-624b0de30c2aa.jpg', 0, NULL),
(94, NULL, '4009319-624b19b3b50c7.jpg', 0, 5),
(95, NULL, '12920265-624b19b3b68c5.jpg', 0, 5),
(96, NULL, '17109727-624b19b3b7364.jpg', 1, 5),
(97, NULL, '96016449-624b19b3b7d49.jpg', 0, 5),
(98, NULL, '4009099-624b231ed4123.jpg', 0, 6),
(99, NULL, '17113109-624b231ed58ba.jpg', 0, 6),
(100, NULL, '204975746-624b231ed640d.jpg', 0, 6),
(101, NULL, '204977177-624b231ed6ed5.jpg', 1, 6),
(102, NULL, '4009075-624c06ce8794b.jpg', 0, 7),
(103, NULL, '204974964-624c06ce88fc9.jpg', 0, 7),
(104, NULL, '204975746-624c06ce89c24.jpg', 0, 7),
(105, NULL, '204977302-624c06ce8a7a1.jpg', 1, 7),
(106, NULL, '204977307-624c06ce8b2fd.jpg', 0, 7),
(107, NULL, '12920656-624c07c64f682.jpg', 0, 8),
(108, NULL, '204977168-624c07c650d44.jpg', 1, 8),
(109, NULL, '204977192-624c07c651802.jpg', 0, 8),
(110, NULL, '205083752-624c07c6522ce.jpg', 0, 8);

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `chambre_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `debut` date NOT NULL,
  `fin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`id`, `chambre_id`, `client_id`, `debut`, `fin`) VALUES
(1, 2, 4, '2022-04-25', '2022-04-30'),
(2, 1, 4, '2022-04-25', '2022-04-30'),
(3, 3, 4, '2022-04-25', '2022-04-30');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `hotel_id` int(11) DEFAULT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `hotel_id`, `email`, `roles`, `password`, `nom`, `prenom`) VALUES
(1, NULL, 'superadmin@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$7F0QLZT2uNQoXmzRAhi2/eZET.i8rLIqtc/UFLQIzeJg2LfF9GHGC', 'super', 'admin'),
(2, 2, 'jules.leblanc@gmail.fr', '[\"ROLE_GERANT\"]', '$2y$13$yVA7yDIXId23BVUcY1wGfenwLNvRXw.OW0vgkcHmDmUEow61A3Byi', 'Leblanc', 'Jules'),
(3, 3, 'lucien.lenoir@gmail.fr', '[\"ROLE_GERANT\"]', '$2y$13$Zl5vp3wy8P7e8r41iFgP4uYmczRzISIZWPHFVKx8UptW.3N2Tit5q', 'Lenoir', 'Lucien'),
(4, NULL, 'nhuey0@nsw.gov.au', '[\"ROLE_CLIENT\"]', '$2y$13$re9r9kiVDdiI3bHwdCoOIe9f7aNm6z4CTzzvPzTJFdhlzUlTLxgI2', 'Huey', 'Nelia'),
(5, 5, 'colonel.moutarde@gmail.fr', '[\"ROLE_GERANT\"]', '$2y$13$9j1My1I7MucvHTTGjVdvYOSJ7194mk1VAQUGR.0TMCXUKcj6bR68W', 'Moutarde', 'Colonel');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `chambres`
--
ALTER TABLE `chambres`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_36C929623243BB18` (`hotel_id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `hotel`
--
ALTER TABLE `hotel`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_14B784183243BB18` (`hotel_id`),
  ADD KEY `IDX_14B784188BEC3FB7` (`chambres_id`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_42C849559B177F54` (`chambre_id`),
  ADD KEY `IDX_42C8495519EB6921` (`client_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`),
  ADD UNIQUE KEY `UNIQ_8D93D6493243BB18` (`hotel_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `chambres`
--
ALTER TABLE `chambres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `hotel`
--
ALTER TABLE `hotel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `photo`
--
ALTER TABLE `photo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `chambres`
--
ALTER TABLE `chambres`
  ADD CONSTRAINT `FK_36C929623243BB18` FOREIGN KEY (`hotel_id`) REFERENCES `hotel` (`id`);

--
-- Contraintes pour la table `photo`
--
ALTER TABLE `photo`
  ADD CONSTRAINT `FK_14B784183243BB18` FOREIGN KEY (`hotel_id`) REFERENCES `hotel` (`id`),
  ADD CONSTRAINT `FK_14B784188BEC3FB7` FOREIGN KEY (`chambres_id`) REFERENCES `chambres` (`id`);

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `FK_42C8495519EB6921` FOREIGN KEY (`client_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_42C849559B177F54` FOREIGN KEY (`chambre_id`) REFERENCES `chambres` (`id`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_8D93D6493243BB18` FOREIGN KEY (`hotel_id`) REFERENCES `hotel` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
