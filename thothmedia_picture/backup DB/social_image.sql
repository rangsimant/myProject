CREATE DATABASE  IF NOT EXISTS `social_image` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `social_image`;
-- MySQL dump 10.13  Distrib 5.6.17, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: social_image
-- ------------------------------------------------------
-- Server version	5.6.16

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
-- Table structure for table `account`
--

DROP TABLE IF EXISTS `account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `account` (
  `account_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `account_id_user` varchar(30) NOT NULL,
  `account_username` varchar(45) DEFAULT NULL,
  `account_channel` enum('facebook','instagram') NOT NULL DEFAULT 'instagram',
  `account_last_datetime` datetime NOT NULL,
  PRIMARY KEY (`account_id`),
  UNIQUE KEY `account_id_user_UNIQUE` (`account_id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account`
--

LOCK TABLES `account` WRITE;
/*!40000 ALTER TABLE `account` DISABLE KEYS */;
INSERT INTO `account` VALUES (1,'118133614869896','samsungthailand','facebook','0000-00-00 00:00:00'),(2,'136805923037665','SamsungEgypt','facebook','0000-00-00 00:00:00'),(3,'161841567214009','SamsungSouthAfrica','facebook','0000-00-00 00:00:00'),(4,'210249512340911','SamsungMobileSA','facebook','0000-00-00 00:00:00'),(5,'208043925927503','SamsungAustralia','facebook','0000-00-00 00:00:00'),(6,'253147511975','SamsungHK','facebook','0000-00-00 00:00:00'),(7,'131173933569944','SamsungMobileHK','facebook','0000-00-00 00:00:00'),(8,'123688241046671','samsungIN','facebook','0000-00-00 00:00:00'),(9,'133803174373','SamsungMobileIndia','facebook','0000-00-00 00:00:00'),(10,'170499732992726','SamsungIndonesia','facebook','0000-00-00 00:00:00'),(11,'137362696323133','SamsungMobileIndonesia','facebook','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `author`
--

DROP TABLE IF EXISTS `author`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `author` (
  `author_id` varchar(30) NOT NULL,
  `author_displayname` varchar(50) DEFAULT NULL,
  `author_type` enum('facebook','instagram') NOT NULL DEFAULT 'instagram',
  PRIMARY KEY (`author_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `author`
--

LOCK TABLES `author` WRITE;
/*!40000 ALTER TABLE `author` DISABLE KEYS */;
/*!40000 ALTER TABLE `author` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post` (
  `post_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `author_id` varchar(30) DEFAULT NULL,
  `post_text` text,
  `post_like` int(11) DEFAULT NULL,
  `post_created_time` datetime NOT NULL,
  `post_added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `post_social_id` varchar(50) NOT NULL,
  `post_link` varchar(45) DEFAULT NULL,
  `post_channel` enum('facebook','instagram') NOT NULL DEFAULT 'instagram',
  PRIMARY KEY (`post_id`),
  UNIQUE KEY `post_social_id_UNIQUE` (`post_social_id`),
  KEY `author_id_fk_idx` (`author_id`),
  CONSTRAINT `author_id_fk` FOREIGN KEY (`author_id`) REFERENCES `author` (`author_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post`
--

LOCK TABLES `post` WRITE;
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
/*!40000 ALTER TABLE `post` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-09-25  1:51:56
