CREATE DATABASE  IF NOT EXISTS `cr11_haefner_travelmatic` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `cr11_haefner_travelmatic`;
-- MySQL dump 10.13  Distrib 5.7.24, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: cr11_haefner_travelmatic
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.36-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `address`
--

DROP TABLE IF EXISTS `address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city` varchar(155) NOT NULL,
  `zip` varchar(15) NOT NULL,
  `street` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `address`
--

LOCK TABLES `address` WRITE;
/*!40000 ALTER TABLE `address` DISABLE KEYS */;
INSERT INTO `address` VALUES (1,'Vienna','1100','Fernkorngasse 10'),(2,'Vienna','1010','Stephansplatz 1'),(4,'Vienna','1234','Horststraße 1'),(5,'Vienna','1234','Horststraße 1'),(6,'Vienna','1234','Horststraße 1'),(7,'Vienna','1234','Horststraße 1'),(8,'Vienna','1234','Horststraße 1'),(9,'Vienna','1234','Horststraße 1'),(10,'Vienna','1234','Horststraße 1'),(11,'Vienna','1234','Horststraße 1'),(12,'Vienna','1234','Horststraße 1'),(13,'Vienna','1234','Horststraße 1'),(14,'Vienna','1234','Horststraße 1'),(15,'Vienna','1234','Horststraße 1'),(16,'Vienna','1234','Horststraße 1'),(17,'Vienna','1234','Horststraße 1'),(18,'Vienna','1234','Horststraße 1'),(19,'Vienna','1234','Horststraße 1'),(20,'Vienna','1234','Horststraße 1'),(21,'Vienna','1234','Horststraße 1'),(22,'Vienna','1234','Horststraße 1'),(23,'Vienna','1234','Horststraße 1'),(24,'Vienna','1234','Horststraße 1'),(25,'Vienna','1234','Horststraße 1');
/*!40000 ALTER TABLE `address` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event`
--

DROP TABLE IF EXISTS `event`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `address_id` int(11) DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `image` longtext,
  `category` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_event_1_idx` (`address_id`),
  CONSTRAINT `fk_event_1` FOREIGN KEY (`address_id`) REFERENCES `address` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event`
--

LOCK TABLES `event` WRITE;
/*!40000 ALTER TABLE `event` DISABLE KEYS */;
INSERT INTO `event` VALUES (1,'Lenny Kravitz',1,'2019-05-12 19:30:00',573,'Stadthalle, Halle 42','img/event.jpg','event'),(2,'Horst Skulpturen zerstören!',22,'2019-12-04 09:30:00',5,'Schlachthaus','img/event.jpg','event'),(3,'Sticken und Häckeln!',21,'2022-11-01 06:00:00',983,'WUK','img/event.jpg','event'),(4,'Monster Nerf Battle!',2,'2018-11-20 18:30:00',1,'','img/event.jpg','event');
/*!40000 ALTER TABLE `event` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `restaurant`
--

DROP TABLE IF EXISTS `restaurant`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `restaurant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `phone` bigint(20) DEFAULT NULL,
  `type` varchar(55) NOT NULL,
  `description` varchar(2555) DEFAULT NULL,
  `address_id` int(11) NOT NULL,
  `webpage` varchar(255) DEFAULT NULL,
  `image` longtext,
  `category` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_restaurant_2_idx` (`address_id`),
  CONSTRAINT `fk_restaurant_2` FOREIGN KEY (`address_id`) REFERENCES `address` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `restaurant`
--

LOCK TABLES `restaurant` WRITE;
/*!40000 ALTER TABLE `restaurant` DISABLE KEYS */;
INSERT INTO `restaurant` VALUES (1,'Kopp',4315689456,'Austrian','Best food in Vienna',1,'www.kopp-restaurant.at','img/food.jpg','restaurant'),(2,'Am Steffel',4319867356,'Austrian','Food in the heart of Vienna',2,'','img/food.jpg','restaurant'),(3,'Hasenkante',43158948763,'Austrian','You want rabbit? Come to us!',2,'','img/food.jpg','restaurant'),(4,'Völlerei',4315987325,'Indian','The Best Indian Food you can find!',4,'www.fddb.info','img/food.jpg','restaurant');
/*!40000 ALTER TABLE `restaurant` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sight`
--

DROP TABLE IF EXISTS `sight`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sight` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `address_id` int(11) NOT NULL,
  `visit_date` datetime DEFAULT NULL,
  `type` varchar(55) NOT NULL,
  `image` longtext,
  `category` varchar(45) NOT NULL,
  `webpage` varchar(255) DEFAULT NULL,
  `description` varchar(2555) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_sight_1_idx` (`address_id`),
  KEY `fk_sight_2_idx` (`type`),
  CONSTRAINT `fk_sight_1` FOREIGN KEY (`address_id`) REFERENCES `address` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sight`
--

LOCK TABLES `sight` WRITE;
/*!40000 ALTER TABLE `sight` DISABLE KEYS */;
INSERT INTO `sight` VALUES (1,'Karlskirche',1,'0000-00-00 00:00:00','Building','img/church.jpg','sight','www.karlskirche.at','The church Karl build.'),(2,'Kunsthistorisches Museum',11,'2018-11-10 18:00:00','Museum','img/church.jpg','sight','www.khm.at','The best Art museum you can imagine!'),(3,'Aupark',12,'2018-10-05 13:00:00','Park','img/church.jpg','sight','','You are searching for a Nerf war? Go, and find it there!'),(4,'Hermesvilla',16,'0000-00-00 00:00:00','Building','img/church.jpg','sight','https://www.wienmuseum.at/en/locations/hermesvilla.html','Sissis hunting Chateau!');
/*!40000 ALTER TABLE `sight` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `idUsers` int(11) NOT NULL AUTO_INCREMENT,
  `uidUsers` text NOT NULL,
  `emailUsers` text NOT NULL,
  `pwdUsers` longtext NOT NULL,
  `category` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idUsers`),
  UNIQUE KEY `id_UNIQUE` (`idUsers`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'marco','marco@gmail.com','$2y$10$EipUg.w0XrX1Bqcfhsf9Wuubuc0rLfAXB56DDpe51aqJfFPSBeFra','admin'),(2,'marcouser','marcouser@gmail.com','$2y$10$bU/ieeWegBdYh/kqY0HYZur6WKsPnHjOoJRAKl69bsYs8JdJZLKQq','user');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-11-17 16:47:27
