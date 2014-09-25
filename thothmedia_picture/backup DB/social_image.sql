CREATE DATABASE  IF NOT EXISTS `social_image` /*!40100 DEFAULT CHARACTER SET latin1 */;
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
  `account_last_datetime` datetime NOT NULL DEFAULT '2014-09-01 00:00:00',
  PRIMARY KEY (`account_id`),
  UNIQUE KEY `account_id_user_UNIQUE` (`account_id_user`),
  UNIQUE KEY `account_username_UNIQUE` (`account_username`,`account_channel`)
) ENGINE=InnoDB AUTO_INCREMENT=203 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account`
--

LOCK TABLES `account` WRITE;
/*!40000 ALTER TABLE `account` DISABLE KEYS */;
INSERT INTO `account` VALUES (159,'118133614869896','samsungthailand','facebook','2014-09-01 00:00:00'),(160,'136805923037665','SamsungEgypt','facebook','2014-09-01 00:00:00'),(161,'161841567214009','SamsungSouthAfrica','facebook','2014-09-01 00:00:00'),(162,'210249512340911','SamsungMobileSA','facebook','2014-09-01 00:00:00'),(163,'208043925927503','SamsungAustralia','facebook','2014-09-01 00:00:00'),(164,'253147511975','SamsungHK','facebook','2014-09-01 00:00:00'),(165,'131173933569944','SamsungMobileHK','facebook','2014-09-01 00:00:00'),(166,'123688241046671','samsungIN','facebook','2014-09-01 00:00:00'),(167,'133803174373','SamsungMobileIndia','facebook','2014-09-01 00:00:00'),(168,'170499732992726','SamsungIndonesia','facebook','2014-09-01 00:00:00'),(169,'137362696323133','SamsungMobileIndonesia','facebook','2014-09-01 00:00:00'),(170,'282271755','SamsungUSA','instagram','2014-09-01 00:00:00'),(171,'1391036938','SamsungUkraine','instagram','2014-09-01 00:00:00'),(172,'1090053653','SamsungUK','instagram','2014-09-01 00:00:00'),(173,'234351584','SamsungTurkiye','instagram','2014-09-01 00:00:00'),(174,'491368888','samsungsverige','instagram','2014-09-01 00:00:00'),(175,'422412570','SamsungSuomi','instagram','2014-09-01 00:00:00'),(176,'262813012','samsungru','instagram','2014-09-01 00:00:00'),(177,'552959861','SamsungRomania','instagram','2014-09-01 00:00:00'),(178,'349020456','samsungportugal','instagram','2014-09-01 00:00:00'),(179,'266481824','SamsungPolska','instagram','2014-09-01 00:00:00'),(180,'718614953','SamsungPH','instagram','2014-09-01 00:00:00'),(181,'652774384','SamsungPakistan','instagram','2014-09-01 00:00:00'),(182,'509996161','SamsungNorge','instagram','2014-09-01 00:00:00'),(183,'299053021','SamsungNederland','instagram','2014-09-01 00:00:00'),(184,'174053029','SamsungMobileUSA','instagram','2014-09-01 00:00:00'),(185,'252410388','SamsungMobileNL','instagram','2014-09-01 00:00:00'),(186,'187323885','samsungmobilemx','instagram','2014-09-01 00:00:00'),(187,'321123051','samsungmobilebelgium','instagram','2014-09-01 00:00:00'),(188,'386969432','SamsungMobileArabia','instagram','2014-09-01 00:00:00'),(189,'178668260','samsungmexico','instagram','2014-09-01 00:00:00'),(190,'356182089','SamsungKZ','instagram','2014-09-01 00:00:00'),(191,'515550290','samsungitalia','instagram','2014-09-01 00:00:00'),(192,'293673602','SamsungGulf','instagram','2014-09-01 00:00:00'),(193,'270767318','SamsungGreece','instagram','2014-09-01 00:00:00'),(194,'437920308','samsungfrance','instagram','2014-09-01 00:00:00'),(195,'1433838588','SamsungEgypt','instagram','2014-09-01 00:00:00'),(196,'280611592','SamsungDanmark','instagram','2014-09-01 00:00:00'),(197,'611889780','SamsungColombia','instagram','2014-09-01 00:00:00'),(198,'264358210','SamsungCanada','instagram','2014-09-01 00:00:00'),(199,'43206570','SamsungBrasil','instagram','2014-09-01 00:00:00'),(200,'436144145','SamsungAustria','instagram','2014-09-01 00:00:00'),(201,'836678637','SamsungArgentina','instagram','2014-09-01 00:00:00');
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
  `post_channel` enum('facebook','instagram') NOT NULL DEFAULT 'instagram',
  `post_img_name` varchar(100) NOT NULL,
  `post_link` text,
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

-- Dump completed on 2014-09-26  1:31:46
