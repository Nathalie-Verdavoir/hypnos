-- MySQL dump 10.13  Distrib 8.0.28, for Win64 (x86_64)
--
-- Host: eu-cdbr-west-02.cleardb.net    Database: heroku_d25bce77eb730af
-- ------------------------------------------------------
-- Server version	5.6.50-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `chambres`
--

DROP TABLE IF EXISTS `chambres`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `chambres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hotel_id` int(11) NOT NULL,
  `prix` decimal(10,2) NOT NULL,
  `booking` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_36C929623243BB18` (`hotel_id`),
  CONSTRAINT `FK_36C929623243BB18` FOREIGN KEY (`hotel_id`) REFERENCES `hotel` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=171 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chambres`
--

LOCK TABLES `chambres` WRITE;
/*!40000 ALTER TABLE `chambres` DISABLE KEYS */;
INSERT INTO `chambres` VALUES (1,'Chambre Premium Lit Queen-Size avec Canapé-Lit','Superficie 24 m² Lits confortables, notés 9.1 (d\'après 903 commentaires) Dotée d\'une entrée privée, cette chambre double dispose d\'un peignoir et d\'un plateau/bouilloire.',3,130.00,'https://www.booking.com/hotel/fr/golden-tulip-strasbourg-centre-the-garden.fr.html?aid=356980;label=gog235jc-1DCAMoTTjiAkgNWANoTYgBAZgBDbgBF8gBDNgBA-gBAfgBAogCAagCA7gC9bmBkgbAAgHSAiQ4MmM4MGI1Yi02YWYyLTRmOGMtYTkyMy03MjNkYmE2MDU4NzTYAgTgAgE;sid=52f437eaad1a'),(2,'Suite Junior avec Lit King-Size','Superficie 35 m² Lits confortables, notés 9.1 (d\'après 903 commentaires) This suite has a private entrance, soundproofing and tea/coffee maker.',3,120.00,'https://www.booking.com/hotel/fr/golden-tulip-strasbourg-centre-the-garden.fr.html?aid=356980;label=gog235jc-1DCAMoTTjiAkgNWANoTYgBAZgBDbgBF8gBDNgBA-gBAfgBAogCAagCA7gC9bmBkgbAAgHSAiQ4MmM4MGI1Yi02YWYyLTRmOGMtYTkyMy03MjNkYmE2MDU4NzTYAgTgAgE;sid=52f437eaad1a'),(3,'Suite Lit King-Size avec Canapé-Lit','Superficie 39 m² Lits confortables, notés 9.1 (d\'après 903 commentaires) This suite features a electric kettle, soundproofing and tea/coffee maker.',3,160.00,'https://www.booking.com/hotel/fr/golden-tulip-strasbourg-centre-the-garden.fr.html?aid=356980;label=gog235jc-1DCAMoTTjiAkgNWANoTYgBAZgBDbgBF8gBDNgBA-gBAfgBAogCAagCA7gC9bmBkgbAAgHSAiQ4MmM4MGI1Yi02YWYyLTRmOGMtYTkyMy03MjNkYmE2MDU4NzTYAgTgAgE;sid=52f437eaad1a'),(4,'Chambre Standard','Superficie 21 m² Lits confortables, notés 9.1 (d\'après 908 commentaires) This double room features a tea/coffee maker, electric kettle and soundproofing.',3,100.00,'https://www.booking.com/hotel/fr/golden-tulip-strasbourg-centre-the-garden.fr.html?aid=356980;label=gog235jc-1DCAMoTTjiAkgNWANoTYgBAZgBDbgBF8gBDNgBA-gBAfgBAogCAagCA7gC9bmBkgbAAgHSAiQ4MmM4MGI1Yi02YWYyLTRmOGMtYTkyMy03MjNkYmE2MDU4NzTYAgTgAgE;sid=52f437eaad1a'),(5,'Chambre Double Privilège','Lits confortables, notés 9.2 (d\'après 451 commentaires) Cette chambre spacieuse comprend une baignoire ou une douche, des peignoirs et des chaussons.',5,150.00,'https://www.booking.com/hotel/fr/le-grand-balcon-toulouse.fr.html?aid=356980&label=gog235jc-1DCAMoTTjiAkgNWANoTYgBAZgBDbgBF8gBDNgBA-gBAfgBAogCAagCA7gC9bmBkgbAAgHSAiQ4MmM4MGI1Yi02YWYyLTRmOGMtYTkyMy03MjNkYmE2MDU4NzTYAgTgAgE&sid=52f437eaad1a851212038be9702f4'),(6,'Chambre Double Classique','Superficie 18 m² Lits confortables, notés 9.2 (d\'après 451 commentaires) Cette chambre comprend une machine à café Nespresso, un minibar et une télévision à écran plat.',5,130.00,'https://www.booking.com/hotel/fr/le-grand-balcon-toulouse.fr.html?aid=356980&label=gog235jc-1DCAMoTTjiAkgNWANoTYgBAZgBDbgBF8gBDNgBA-gBAfgBAogCAagCA7gC9bmBkgbAAgHSAiQ4MmM4MGI1Yi02YWYyLTRmOGMtYTkyMy03MjNkYmE2MDU4NzTYAgTgAgE&sid=52f437eaad1a851212038be9702f4'),(7,'Chambre Double Deluxe','Superficie 25 m² Lits confortables, notés 9.2 (d\'après 451 commentaires) Cette chambre spacieuse comprend une baignoire, des peignoirs et des chaussons.',5,140.00,'https://www.booking.com/hotel/fr/le-grand-balcon-toulouse.fr.html?aid=356980&label=gog235jc-1DCAMoTTjiAkgNWANoTYgBAZgBDbgBF8gBDNgBA-gBAfgBAogCAagCA7gC9bmBkgbAAgHSAiQ4MmM4MGI1Yi02YWYyLTRmOGMtYTkyMy03MjNkYmE2MDU4NzTYAgTgAgE&sid=52f437eaad1a851212038be9702f4'),(8,'Suite','Superficie 35 m² Lits confortables, notés 9.2 (d\'après 451 commentaires) Cette suite spacieuse dispose d\'un coin salon. Des peignoirs et des chaussons sont fournis dans la salle de bains.',5,240.00,'https://www.booking.com/hotel/fr/le-grand-balcon-toulouse.fr.html?aid=356980&label=gog235jc-1DCAMoTTjiAkgNWANoTYgBAZgBDbgBF8gBDNgBA-gBAfgBAogCAagCA7gC9bmBkgbAAgHSAiQ4MmM4MGI1Yi02YWYyLTRmOGMtYTkyMy03MjNkYmE2MDU4NzTYAgTgAgE&sid=52f437eaad1a851212038be9702f4'),(11,'Suite Château Angelus','Superficie 45 m² Lits confortables, notés 9.4 (d\'après 85 commentaires) Décorée dans un style chaleureux et élégant avec un mobilier design du créateur Philippe Starck, la suite Château Angelus dispose d\'une terrasse privée et d\'un bain à remous chauffé.',11,200.00,'https://www.booking.com/hotel/fr/le-boutique-bordeaux.fr.html?aid=356980&label=gog235jc-1DCAMoTTjiAkgNWANoTYgBAZgBDbgBF8gBDNgBA-gBAfgBAogCAagCA7gC9bmBkgbAAgHSAiQ4MmM4MGI1Yi02YWYyLTRmOGMtYTkyMy03MjNkYmE2MDU4NzTYAgTgAgE&sid=52f437eaad1a851212038be9702f4e49&'),(21,'Suite Château Margaux','Superficie 38 m² Lits confortables, notés 9.4 (d\'après 85 commentaires) Cette suite comprend un balcon, un coin salon et un minibar.',11,200.00,'https://www.booking.com/hotel/fr/le-boutique-bordeaux.fr.html?aid=356980&label=gog235jc-1DCAMoTTjiAkgNWANoTYgBAZgBDbgBF8gBDNgBA-gBAfgBAogCAagCA7gC9bmBkgbAAgHSAiQ4MmM4MGI1Yi02YWYyLTRmOGMtYTkyMy03MjNkYmE2MDU4NzTYAgTgAgE&sid=52f437eaad1a851212038be9702f4e49&'),(31,'Appartement','Superficie de l\'appartement : 85 m² Lits confortables, notés 9.4 (d\'après 85 commentaires) This apartment has a microwave, dishwasher and seating area.',11,250.00,'https://www.booking.com/hotel/fr/le-boutique-bordeaux.fr.html?aid=356980&label=gog235jc-1DCAMoTTjiAkgNWANoTYgBAZgBDbgBF8gBDNgBA-gBAfgBAogCAagCA7gC9bmBkgbAAgHSAiQ4MmM4MGI1Yi02YWYyLTRmOGMtYTkyMy03MjNkYmE2MDU4NzTYAgTgAgE&sid=52f437eaad1a851212038be9702f4e49&'),(41,'Suite Présidentielle','Superficie 125 m² Lits confortables, notés 9.4 (d\'après 85 commentaires) Salle de bains : 4 This suite features a balcony, minibar and soundproofing.',11,350.00,'https://www.booking.com/hotel/fr/le-boutique-bordeaux.fr.html?aid=356980&label=gog235jc-1DCAMoTTjiAkgNWANoTYgBAZgBDbgBF8gBDNgBA-gBAfgBAogCAagCA7gC9bmBkgbAAgHSAiQ4MmM4MGI1Yi02YWYyLTRmOGMtYTkyMy03MjNkYmE2MDU4NzTYAgTgAgE&sid=52f437eaad1a851212038be9702f4e49&'),(51,'Chambre Lit Queen-Size Moxy Sleeper','Superficie 14 m² Lits confortables, notés 8.9 (d\'après 606 commentaires) Cette chambre double est équipée de la climatisation.',2,132.00,'https://www.booking.com/hotel/fr/moxy-lille-city-center-france.fr.html?aid=304142&label=gen173nr-1DCAEoggI46AdIM1gEaE2IAQGYAQ24ARfIAQzYAQPoAQGIAgGoAgO4Aquh0pIGwAIB0gIkZmJhOWJlMDEtODBiYi00NGRjLTkxMDAtY2I0NzFlMWFmZjU52AIE4AIB&sid=4bfa091eaf0ce66a14b70c9d3a9'),(61,'Chambre Lits Jumeaux Moxy Sleeper avec 2 Lits','Superficie 14 m² 2 lits simples  Lits confortables, notés 8.9 (d\'après 606 commentaires) Ces chambres présentent une superficie de 30 m².',2,132.00,'https://www.booking.com/hotel/fr/moxy-lille-city-center-france.fr.html?aid=304142&label=gen173nr-1DCAEoggI46AdIM1gEaE2IAQGYAQ24ARfIAQzYAQPoAQGIAgGoAgO4Aquh0pIGwAIB0gIkZmJhOWJlMDEtODBiYi00NGRjLTkxMDAtY2I0NzFlMWFmZjU52AIE4AIB&sid=4bfa091eaf0ce66a14b70c9d3a9'),(71,'Suite Familiale Moxy Sleeper avec 1 Lit Queen-Size et Lit Gigogne','Superficie 14 m² 1 grand lit double  Lits confortables, notés 8.9 (d\'après 606 commentaires) Cette chambre double est dotée de la climatisation.',2,162.00,'https://www.booking.com/hotel/fr/moxy-lille-city-center-france.fr.html?aid=304142&label=gen173nr-1DCAEoggI46AdIM1gEaE2IAQGYAQ24ARfIAQzYAQPoAQGIAgGoAgO4Aquh0pIGwAIB0gIkZmJhOWJlMDEtODBiYi00NGRjLTkxMDAtY2I0NzFlMWFmZjU52AIE4AIB&sid=4bfa091eaf0ce66a14b70c9d3a9'),(81,'Chambre Double Standard','Superficie 24 m² 1 grand lit double  Lits confortables, notés 8.8 (d\'après 410 commentaires) Cette chambre climatisée est équipée d\'une bouilloire électrique, d\'un plateau/bouilloire et de la télévision par satellite à écran LCD.',21,114.00,'https://www.booking.com/hotel/fr/mercure-grand-saxe-lafayette.fr.html?aid=304142&label=gen173nr-1DCAEoggI46AdIM1gEaE2IAQGYAQ24ARfIAQzYAQPoAQGIAgGoAgO4Aquh0pIGwAIB0gIkZmJhOWJlMDEtODBiYi00NGRjLTkxMDAtY2I0NzFlMWFmZjU52AIE4AIB&sid=4bfa091eaf0ce66a14b70c9d3a98'),(91,'Chambre Privilège Lit King-Size','Superficie 27 m² 1 très grand lit double  Lits confortables, notés 8.8 (d\'après 410 commentaires) Toutes ces chambres possèdent une bouilloire électrique, une télévision par satellite à écran LCD et la climatisation.  Elles disposent en outre d\'une machin',21,159.00,'https://www.booking.com/hotel/fr/mercure-grand-saxe-lafayette.fr.html?aid=304142&label=gen173nr-1DCAEoggI46AdIM1gEaE2IAQGYAQ24ARfIAQzYAQPoAQGIAgGoAgO4Aquh0pIGwAIB0gIkZmJhOWJlMDEtODBiYi00NGRjLTkxMDAtY2I0NzFlMWFmZjU52AIE4AIB&sid=4bfa091eaf0ce66a14b70c9d3a98'),(101,'Chambre Double avec 2 Lits Doubles','Superficie 24 m² 2 lits doubles  Lits confortables, notés 8.8 (d\'après 410 commentaires) This double room features a satellite TV, minibar and air conditioning.',21,169.00,'https://www.booking.com/hotel/fr/mercure-grand-saxe-lafayette.fr.html?aid=304142&label=gen173nr-1DCAEoggI46AdIM1gEaE2IAQGYAQ24ARfIAQzYAQPoAQGIAgGoAgO4Aquh0pIGwAIB0gIkZmJhOWJlMDEtODBiYi00NGRjLTkxMDAtY2I0NzFlMWFmZjU52AIE4AIB&sid=4bfa091eaf0ce66a14b70c9d3a98'),(111,'Chambre Double','Superficie 18 m² 1 grand lit double  Lits confortables, notés 9.1 (d\'après 343 commentaires) This double room features a minibar, electric kettle and air conditioning.',31,171.00,'https://www.booking.com/hotel/fr/nice-azur-riviera.fr.html?aid=304142&label=gen173nr-1DCAEoggI46AdIM1gEaE2IAQGYAQ24ARfIAQzYAQPoAQGIAgGoAgO4Aquh0pIGwAIB0gIkZmJhOWJlMDEtODBiYi00NGRjLTkxMDAtY2I0NzFlMWFmZjU52AIE4AIB&sid=4bfa091eaf0ce66a14b70c9d3a984a9b&all_sr'),(121,'Chambre Double Supérieure','Superficie 18 m² 1 grand lit double  Lits confortables, notés 9.1 (d\'après 343 commentaires) This double room has air conditioning, flat-screen TV and minibar.',31,209.00,'https://www.booking.com/hotel/fr/nice-azur-riviera.fr.html?aid=304142&label=gen173nr-1DCAEoggI46AdIM1gEaE2IAQGYAQ24ARfIAQzYAQPoAQGIAgGoAgO4Aquh0pIGwAIB0gIkZmJhOWJlMDEtODBiYi00NGRjLTkxMDAtY2I0NzFlMWFmZjU52AIE4AIB&sid=4bfa091eaf0ce66a14b70c9d3a984a9b&all_sr'),(131,'Grande Chambre Double','Superficie 26 m² 1 grand lit double  Lits confortables, notés 9.1 (d\'après 343 commentaires) Cette chambre double dispose d\'un minibar, d\'une bouilloire électrique et de la climatisation.',31,237.00,'https://www.booking.com/hotel/fr/nice-azur-riviera.fr.html?aid=304142&label=gen173nr-1DCAEoggI46AdIM1gEaE2IAQGYAQ24ARfIAQzYAQPoAQGIAgGoAgO4Aquh0pIGwAIB0gIkZmJhOWJlMDEtODBiYi00NGRjLTkxMDAtY2I0NzFlMWFmZjU52AIE4AIB&sid=4bfa091eaf0ce66a14b70c9d3a984a9b&all_sr'),(141,'Chambre Double Confort','Superficie 21 m² Lits confortables, notés 7.9 (d\'après 281 commentaires) Cette chambre comprend une kitchenette.  Dans le cas où vous réservez 2 lits simples, veuillez noter que chaque lit possède une largeur de 80 cm.',41,268.00,'https://www.booking.com/hotel/fr/la-closerie-deauville.fr.html?aid=304142&label=gen173nr-1DCAEoggI46AdIM1gEaE2IAQGYAQ24ARfIAQzYAQPoAQGIAgGoAgO4Aquh0pIGwAIB0gIkZmJhOWJlMDEtODBiYi00NGRjLTkxMDAtY2I0NzFlMWFmZjU52AIE4AIB&sid=4bfa091eaf0ce66a14b70c9d3a984a9b&al'),(151,'Appartement 1 Chambre','Superficie de l\'appartement : 32 m² Chambre 1: 1 grand lit double  Salon : 1 canapé-lit  Lits confortables, notés 7.9 (d\'après 281 commentaires) Cet appartement comprend un salon avec un canapé-lit double.',41,334.00,'https://www.booking.com/hotel/fr/la-closerie-deauville.fr.html?aid=304142&label=gen173nr-1DCAEoggI46AdIM1gEaE2IAQGYAQ24ARfIAQzYAQPoAQGIAgGoAgO4Aquh0pIGwAIB0gIkZmJhOWJlMDEtODBiYi00NGRjLTkxMDAtY2I0NzFlMWFmZjU52AIE4AIB&sid=4bfa091eaf0ce66a14b70c9d3a984a9b&al'),(161,'Appartement 2 Chambres (6 Adultes)','Superficie de l\'appartement : 56 m² Chambre 1: 1 grand lit double  Chambre 2: 1 lit superposé  Salon : 1 canapé-lit  Lits confortables, notés 7.9 (d\'après 281 commentaires) Cet appartement comprend 2 chambres séparées et un salon doté d\'un canapé-lit doub',41,429.00,'https://www.booking.com/hotel/fr/la-closerie-deauville.fr.html?aid=304142&label=gen173nr-1DCAEoggI46AdIM1gEaE2IAQGYAQ24ARfIAQzYAQPoAQGIAgGoAgO4Aquh0pIGwAIB0gIkZmJhOWJlMDEtODBiYi00NGRjLTkxMDAtY2I0NzFlMWFmZjU52AIE4AIB&sid=4bfa091eaf0ce66a14b70c9d3a984a9b&al');
/*!40000 ALTER TABLE `chambres` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctrine_migration_versions`
--

LOCK TABLES `doctrine_migration_versions` WRITE;
/*!40000 ALTER TABLE `doctrine_migration_versions` DISABLE KEYS */;
INSERT INTO `doctrine_migration_versions` VALUES ('DoctrineMigrations\\Version20220316143026','2022-03-16 15:31:20',96),('DoctrineMigrations\\Version20220316143842','2022-03-16 15:38:46',102),('DoctrineMigrations\\Version20220316144659','2022-03-16 15:47:18',82);
/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hotel`
--

DROP TABLE IF EXISTS `hotel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hotel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ville` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hotel`
--

LOCK TABLES `hotel` WRITE;
/*!40000 ALTER TABLE `hotel` DISABLE KEYS */;
INSERT INTO `hotel` VALUES (2,'Moxy Lille City','Lille','1 km du centreProche du métro Le Moxy Lille City est situé à Lille, à 700 mètres de la braderie de Lille. Il propose des hébergements avec une terrasse et un parking privé.','3, Rue Jean Bart, Centre de Lille, 59000 Lille, France'),(3,'The Garden','Strasbourg','Doté d\'un jardin et d\'un restaurant, le Voco - Strasbourg Centre - The Garden - Garden est situé à Strasbourg. Il comporte une terrasse, un salon commun et un bar. Vous séjournerez à 1,5 km du marché de Noël et à 1,9 km de l\'église Saint-Paul. ','9 Rue des Magasins, 67000 Strasbourg, France'),(5,'Le Grand Balcon','Toulouse','Situé dans le centre de Toulouse, à 4 km du Stadium, Le Grand Balcon Hotel est un établissement 4 étoiles doté d\'une décoration des années 1930 et d\'une réception ouverte 24h/24. Il propose des chambres climatisées avec connexion Wi-Fi gratuite.','8-10 Rue Romiguieres, 31000 Toulouse, France'),(11,'Le Boutique','Bordeaux','Situé au cœur du centre historique de Bordeaux, Le Boutique Hotel Bordeaux est installé dans une maison de ville datant du XVIIIe siècle, entourée d\'une cour intérieure verdoyante et luxuriante.','3 Rue Lafaurie de Monbadon, Centre de Bordeaux, 33000 Bordeaux, France'),(21,'Saxe Lafayette','Lyon','Situé dans le centre de Lyon, le Mercure Lyon Centre Saxe Lafayette se trouve à 15 minutes à pied de la gare TGV Part-Dieu. Il propose une connexion Wi-Fi gratuite et une salle de sport avec une piscine intérieure. ','29 Rue de Bonnel, 3e arr., 69003 Lyon, France'),(31,'Azur Riviera','Nice','Vous pouvez bénéficier d\'une réduction Genius dans l\'établissement Hôtel Nice Azur Riviera ! Connectez-vous pour économiser.  Situé à Nice, à 1,2 km de la plage du Centenaire, l\'Hôtel Nice Azur Riviera propose des chambres non-fumeurs.','19 Rue Assalit, 06000 Nice, France'),(41,'La Closerie','Deauville','Cet établissement est à 8 minutes à pied de la plage. Installée près de la plage et de la promenade de Deauville, la Résidence La Closerie Deauville possède un espace de bien-être avec une piscine intérieure, un sauna et un jacuzzi. ','156, Avenue De La République, 14800 Deauville, France');
/*!40000 ALTER TABLE `hotel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `photo`
--

DROP TABLE IF EXISTS `photo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `photo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hotel_id` int(11) DEFAULT NULL,
  `lien` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover` tinyint(1) NOT NULL,
  `chambres_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_14B784183243BB18` (`hotel_id`),
  KEY `IDX_14B784188BEC3FB7` (`chambres_id`),
  CONSTRAINT `FK_14B784183243BB18` FOREIGN KEY (`hotel_id`) REFERENCES `hotel` (`id`),
  CONSTRAINT `FK_14B784188BEC3FB7` FOREIGN KEY (`chambres_id`) REFERENCES `chambres` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2001 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `photo`
--

LOCK TABLES `photo` WRITE;
/*!40000 ALTER TABLE `photo` DISABLE KEYS */;
INSERT INTO `photo` VALUES (2,2,'281571003-6240376e8a9d7.jpg',1,NULL),(3,2,'281571455-6240376f148ca.jpg',0,NULL),(4,2,'281572280-6240376f92cfd.jpg',0,NULL),(5,2,'281572722-624037701d0e5.jpg',0,NULL),(6,2,'cover-624037709e83c.jpg',0,NULL),(7,2,'281566932-62403a7f61510.jpg',0,NULL),(25,2,'281571003-6240409a49751.jpg',0,NULL),(28,3,'274497346-62405e576355c.jpg',1,NULL),(29,3,'180222767-6240610c1d25e.jpg',0,NULL),(30,3,'180222774-6240610c20e94.jpg',0,NULL),(31,3,'180225085-6240610c9fa80.jpg',0,NULL),(32,3,'180225089-6240610d28efd.jpg',0,NULL),(33,3,'180225094-6240610da979f.jpg',0,NULL),(34,3,'180497464-6240610e330e4.jpg',0,NULL),(35,3,'274497026-6240610eb4a8f.jpg',0,NULL),(36,3,'274497095-6240610f3e326.jpg',0,NULL),(37,3,'274497346-6240610fbf9f9.jpg',0,NULL),(54,NULL,'159718997-6241da7d3f464.jpg',0,1),(55,NULL,'180224314-6241da7d4184f.jpg',0,1),(57,NULL,'180506357-6241da7d42d97.jpg',0,1),(62,NULL,'181547452-6241e90aa2985.jpg',0,1),(63,NULL,'180506328-624207614b056.jpg',1,1),(64,NULL,'180224698-6243007a625d9.jpg',0,2),(65,NULL,'180224707-6243007a65024.jpg',0,2),(66,NULL,'180224907-6243007a65c6a.jpg',0,2),(67,NULL,'180506316-6243007a66710.jpg',0,2),(68,NULL,'181548794-6243007a670eb.jpg',1,2),(69,NULL,'180224685-624305d106991.jpg',0,3),(70,NULL,'180506316-624305d108f30.jpg',0,3),(71,NULL,'180506343-624305d109cd8.jpg',1,3),(72,NULL,'180506351-624305d10a9a6.jpg',0,3),(73,NULL,'274492756-624305d10b40c.jpg',0,3),(74,NULL,'274493318-624305d10bed7.jpg',0,3),(75,NULL,'159723939-6243172957932.jpg',0,4),(76,NULL,'180224326-6243172959fbd.jpg',0,4),(77,NULL,'180506332-624317295ab70.jpg',0,4),(78,NULL,'180506336-624317295b6e3.jpg',0,4),(79,NULL,'181548392-624317295c149.jpg',0,4),(80,NULL,'181548794-624317295caed.jpg',0,4),(81,NULL,'181549016-624317295d499.jpg',1,4),(82,NULL,'181549183-624317295ddcd.jpg',0,4),(83,NULL,'274491052-624317295e707.jpg',0,4),(84,NULL,'274491447-624317295f105.jpg',0,4),(85,NULL,'274491739-624317295fa97.jpg',0,4),(86,5,'203843-624b0de303c17.webp',0,NULL),(87,5,'208239-624b0de3082a0.webp',0,NULL),(88,5,'17113683-624b0de308fa9.jpg',1,NULL),(89,5,'138861309-624b0de309a64.jpg',0,NULL),(90,5,'138861312-624b0de30a3b2.jpg',0,NULL),(91,5,'138861323-624b0de30ace4.jpg',0,NULL),(92,5,'204977335-624b0de30b83a.jpg',0,NULL),(93,5,'204977345-624b0de30c2aa.jpg',0,NULL),(94,NULL,'4009319-624b19b3b50c7.jpg',0,5),(95,NULL,'12920265-624b19b3b68c5.jpg',0,5),(96,NULL,'17109727-624b19b3b7364.jpg',1,5),(97,NULL,'96016449-624b19b3b7d49.jpg',0,5),(98,NULL,'4009099-624b231ed4123.jpg',0,6),(99,NULL,'17113109-624b231ed58ba.jpg',0,6),(100,NULL,'204975746-624b231ed640d.jpg',0,6),(101,NULL,'204977177-624b231ed6ed5.jpg',1,6),(102,NULL,'4009075-624c06ce8794b.jpg',0,7),(103,NULL,'204974964-624c06ce88fc9.jpg',0,7),(104,NULL,'204975746-624c06ce89c24.jpg',0,7),(105,NULL,'204977302-624c06ce8a7a1.jpg',1,7),(106,NULL,'204977307-624c06ce8b2fd.jpg',0,7),(107,NULL,'12920656-624c07c64f682.jpg',0,8),(108,NULL,'204977168-624c07c650d44.jpg',1,8),(109,NULL,'204977192-624c07c651802.jpg',0,8),(110,NULL,'205083752-624c07c6522ce.jpg',0,8),(671,11,'81056155-624d558d03ba3.jpg',1,NULL),(681,11,'262499837-624d558d2e970.jpg',0,NULL),(691,11,'262499856-624d558d31386.jpg',0,NULL),(701,11,'318492315-624d558d3413b.jpg',0,NULL),(711,11,'318493242-624d558d372cf.jpg',0,NULL),(721,11,'320127249-624d558d3d1b9.jpg',0,NULL),(731,11,'320128950-624d558d3fd86.jpg',0,NULL),(781,NULL,'320122079-624d5660672f6.jpg',1,21),(791,NULL,'320141790-624d566070abe.jpg',0,21),(801,NULL,'320141796-624d566075685.jpg',0,21),(811,NULL,'332506405-624d56607939b.jpg',0,21),(821,NULL,'335874395-624d56841f951.jpg',0,31),(831,NULL,'335874396-624d56846b215.jpg',1,31),(841,NULL,'335874397-624d56846f057.jpg',0,31),(851,NULL,'335874398-624d568556a67.jpg',0,31),(861,NULL,'335874400-624d5685592d6.jpg',0,31),(871,NULL,'335874401-624d56855babe.jpg',0,31),(881,NULL,'318493242-624d56d4053ce.jpg',1,41),(891,NULL,'320121729-624d56d409ef0.jpg',0,41),(901,NULL,'320121732-624d56d40c52a.jpg',0,41),(911,NULL,'320121743-624d56d40ec74.jpg',0,41),(921,NULL,'320126902-624d56d411560.jpg',0,41),(931,NULL,'320126907-624d56d41435e.jpg',0,41),(941,NULL,'320127244-624d56d416f68.jpg',0,41),(951,NULL,'320127249-624d56d41945d.jpg',0,41),(961,NULL,'320127250-624d56d41c06b.jpg',0,41),(971,NULL,'320142306-624d56d41ef02.jpg',0,41),(981,NULL,'320142319-624d56d422041.jpg',0,41),(991,NULL,'320142349-624d56d424519.jpg',0,41),(1001,NULL,'320142352-624d56d42659b.jpg',0,41),(1011,NULL,'320142362-624d56d428a7a.jpg',0,41),(1021,NULL,'38188919-624f27f77aef8.jpg',1,11),(1031,NULL,'38199501-624f27f77eb73.jpg',0,11),(1041,NULL,'320122402-624f27f781276.jpg',0,11),(1051,NULL,'320122405-624f27f78391a.jpg',0,11),(1061,NULL,'281569456-62549212538bd.jpg',0,61),(1071,NULL,'281570430-625492125795c.jpg',0,61),(1081,NULL,'281570473-625492125a3a6.jpg',1,61),(1091,NULL,'281570481-625492125cc26.jpg',0,61),(1101,NULL,'281570222-62549242072ed.jpg',1,51),(1111,NULL,'281570734-625492420cc17.jpg',0,51),(1121,NULL,'281570741-625492420f1ba.jpg',0,51),(1131,NULL,'281570881-62549242118fc.jpg',0,51),(1141,NULL,'281572265-6254924213e73.jpg',0,51),(1151,NULL,'281570205-625492c2b3d75.jpg',0,71),(1161,NULL,'281570264-625492c2b7895.jpg',0,71),(1171,NULL,'281570713-625492c2b98c1.jpg',1,71),(1181,NULL,'281570992-625492c2bb79c.jpg',0,71),(1191,NULL,'281572790-625492c2bd656.jpg',0,71),(1201,21,'282450739-625497a67bd27.jpg',0,NULL),(1211,21,'297171008-625497a70dc5a.jpg',0,NULL),(1221,21,'297171063-625497a71047e.jpg',0,NULL),(1231,21,'304095332-625497a712f8f.jpg',0,NULL),(1241,21,'304351895-625497a7155e5.jpg',0,NULL),(1251,21,'304351898-625497a7182c5.jpg',0,NULL),(1261,21,'307789465-625497a71ae85.jpg',1,NULL),(1271,21,'307789468-625497a71e0f3.jpg',0,NULL),(1281,21,'307789471-625497a721f96.jpg',0,NULL),(1291,NULL,'8054184-6254983a02093.jpg',0,81),(1301,NULL,'8054319-6254983a49f85.jpg',1,81),(1311,NULL,'8054372-6254983a4d29b.jpg',0,81),(1321,NULL,'25629047-6254983a4fef9.jpg',0,81),(1331,NULL,'25629057-6254983a52bcd.jpg',0,81),(1341,NULL,'251798250-6254983a5589c.jpg',0,81),(1351,NULL,'269914134-6254983a589f9.jpg',0,81),(1361,NULL,'8054033-62549970cd1c5.jpg',0,91),(1371,NULL,'8054118-62549970d0a86.jpg',0,91),(1381,NULL,'8054184-62549970d2d88.jpg',0,91),(1391,NULL,'8054413-62549970d6241.jpg',1,91),(1401,NULL,'42625844-62549970d8e20.jpg',0,91),(1411,NULL,'276090110-62549970dacfc.jpg',0,91),(1421,NULL,'8054184-62549a1a73941.jpg',0,101),(1431,NULL,'8054443-62549a1ac135d.jpg',0,101),(1441,NULL,'25628992-62549a1ac34fa.jpg',0,101),(1451,NULL,'251798264-62549a1ac53bf.jpg',0,101),(1461,NULL,'269914133-62549a1ac7855.jpg',1,101),(1471,NULL,'247726683-62549b65a4229.jpg',0,111),(1481,NULL,'247727182-62549b65a8c23.jpg',0,111),(1491,NULL,'247727671-62549b65aaf9c.jpg',1,111),(1501,NULL,'247729304-62549b65ad3dd.jpg',0,111),(1511,NULL,'247731242-62549b65af814.jpg',0,111),(1521,NULL,'247733846-62549b65b1960.jpg',0,111),(1531,NULL,'247744262-62549b65b3be2.jpg',0,111),(1541,NULL,'247731242-62549c32a35dc.jpg',0,121),(1551,NULL,'247740382-62549c32a7427.jpg',1,121),(1561,NULL,'247743772-62549c32a95b8.jpg',0,121),(1571,NULL,'247756192-62549cfecf74f.jpg',0,131),(1581,NULL,'247756240-62549d0015a03.jpg',1,131),(1591,NULL,'247756414-62549d00185c6.jpg',0,131),(1601,NULL,'247756443-62549d001b28e.jpg',0,131),(1611,NULL,'247757122-62549d001dc09.jpg',0,131),(1621,31,'247753030-62549daf05e4a.jpg',0,NULL),(1631,31,'247753305-62549daf098f6.jpg',0,NULL),(1641,31,'247757722-62549daf0bedc.jpg',1,NULL),(1651,31,'247757869-62549daf0e04c.jpg',0,NULL),(1661,31,'247761004-62549daf1026b.jpg',0,NULL),(1671,31,'247761296-62549daf1261e.jpg',0,NULL),(1761,41,'7514215-6254a02b1cbde.jpg',0,NULL),(1771,41,'7514419-6254a02b21782.jpg',0,NULL),(1781,41,'7515142-6254a02b242c7.jpg',1,NULL),(1791,41,'64546332-6254a02b26ccc.jpg',0,NULL),(1801,41,'92402445-6254a02b2993c.jpg',0,NULL),(1811,41,'96994014-6254a02b2c302.jpg',0,NULL),(1821,41,'96999354-6254a02b2ee11.jpg',0,NULL),(1831,41,'96999373-6254a02b31846.jpg',0,NULL),(1841,NULL,'96999381-6254a0edeccf4.jpg',0,141),(1851,NULL,'97001311-6254a0edf1533.jpg',0,141),(1861,NULL,'197377416-6254a0ee003d6.jpg',1,141),(1871,NULL,'197378602-6254a0ee0307c.jpg',0,141),(1881,NULL,'197378633-6254a0ee0555f.jpg',0,141),(1891,NULL,'197378751-6254a0ee08fd5.jpg',0,141),(1901,NULL,'59482767-6254a19f41b1d.jpg',0,151),(1911,NULL,'64546295-6254a19f47787.jpg',0,151),(1921,NULL,'96999381-6254a19f4a382.jpg',0,151),(1931,NULL,'97001395-6254a19f4cee5.jpg',1,151),(1941,NULL,'304166571-6254a19f4f8ae.jpg',0,151),(1951,NULL,'59482600-6254a27642794.jpg',0,161),(1961,NULL,'64546313-6254a276477fe.jpg',0,161),(1971,NULL,'197377352-6254a27649efc.jpg',1,161),(1981,NULL,'197378421-6254a2764c8fa.jpg',0,161),(1991,NULL,'304166574-6254a276501d9.jpg',0,161);
/*!40000 ALTER TABLE `photo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reservation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `chambre_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `debut` date NOT NULL,
  `fin` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_42C849559B177F54` (`chambre_id`),
  KEY `IDX_42C8495519EB6921` (`client_id`),
  CONSTRAINT `FK_42C8495519EB6921` FOREIGN KEY (`client_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_42C849559B177F54` FOREIGN KEY (`chambre_id`) REFERENCES `chambres` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=151 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservation`
--

LOCK TABLES `reservation` WRITE;
/*!40000 ALTER TABLE `reservation` DISABLE KEYS */;
INSERT INTO `reservation` VALUES (1,2,4,'2022-04-25','2022-04-30'),(2,1,4,'2022-04-25','2022-04-30'),(3,3,4,'2022-04-25','2022-04-30'),(11,5,4,'2022-05-18','2022-05-21'),(51,11,4,'2022-04-11','2022-04-13'),(131,51,4,'2022-04-14','2022-04-16');
/*!40000 ALTER TABLE `reservation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hotel_id` int(11) DEFAULT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`),
  UNIQUE KEY `UNIQ_8D93D6493243BB18` (`hotel_id`),
  CONSTRAINT `FK_8D93D6493243BB18` FOREIGN KEY (`hotel_id`) REFERENCES `hotel` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,NULL,'superadmin@gmail.com','[\"ROLE_ADMIN\"]','$2y$13$ZMqr/jjw/8Ubb3Utk6f39O/.ILIpOYCDo/qTstV7D995rXSESYaK2','super','admin'),(2,2,'jules.leblanc@gmail.fr','[\"ROLE_GERANT\"]','$2y$13$yVA7yDIXId23BVUcY1wGfenwLNvRXw.OW0vgkcHmDmUEow61A3Byi','Leblanc','Jules'),(3,3,'lucien.lenoir@gmail.fr','[\"ROLE_GERANT\"]','$2y$13$Zl5vp3wy8P7e8r41iFgP4uYmczRzISIZWPHFVKx8UptW.3N2Tit5q','Lenoir','Lucien'),(4,NULL,'nhuey0@nsw.gov.au','[\"ROLE_CLIENT\"]','$2y$13$re9r9kiVDdiI3bHwdCoOIe9f7aNm6z4CTzzvPzTJFdhlzUlTLxgI2','Huey','Nelia'),(5,5,'colonel.moutarde@gmail.fr','[\"ROLE_GERANT\"]','$2y$13$9j1My1I7MucvHTTGjVdvYOSJ7194mk1VAQUGR.0TMCXUKcj6bR68W','Moutarde','Colonel'),(11,11,'pamela.rose@gmail.fr','[\"ROLE_GERANT\"]','$2y$13$iJ6GWSJXUlAor9NvkYvJCOqbfoB9koNKFxidHwZy5Wvaw2O8/1ZV2','Rose','Pamela'),(21,21,'docteur.olive@gmail.fr','[\"ROLE_GERANT\"]','$2y$13$VryzWhRba/WfEfGKFWTQT.ZeuPOd2zcXjxGbhK.z5yxNJpPcykRCW','Olive','Docteur'),(31,31,'professeur.violet@gmail.fr','[\"ROLE_GERANT\"]','$2y$13$dZzYfW0.m0fuEMQtNfgQS.pnGLPebSUnlY2mDk5JAzo.ooSY37wkq','Violet','Professeur'),(41,41,'marie.pervenche@gmail.fr','[\"ROLE_GERANT\"]','$2y$13$sL8EzDLlKxI09cJa.e/3WuT8qPijP0DmIb4R6AkPCQmcVDqQYAcKO','Pervenche','Marie'),(71,NULL,'wrye1@themeforest.net','[\"ROLE_CLIENT\"]','$2y$13$q2daWtL0H3.chlE.Hb2P5uGtByOIB6meGtN4aEsZrSlm0KpKPYWdm','Rye','Whitaker');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-04-17 18:08:19
