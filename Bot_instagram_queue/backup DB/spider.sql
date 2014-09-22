CREATE DATABASE  IF NOT EXISTS `spider` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `spider`;
-- MySQL dump 10.13  Distrib 5.6.13, for Win32 (x86)
--
-- Host: localhost    Database: spider
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
-- Table structure for table `author`
--

DROP TABLE IF EXISTS `author`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `author` (
  `author_id` int(11) unsigned NOT NULL,
  `author_username` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  `author_type` enum('facebook','pantip','twitter','website','instagram','youtube') CHARACTER SET latin1 NOT NULL DEFAULT 'website',
  PRIMARY KEY (`author_id`),
  KEY `author_username` (`author_username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
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
  `post_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_date` datetime DEFAULT NULL,
  `post_parse_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `post_author_display_name` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL,
  `post_author_id` int(11) unsigned NOT NULL,
  `post_body` text CHARACTER SET utf8mb4,
  `post_social_id` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `post_type` enum('post','comment','retweet') COLLATE utf8_unicode_ci NOT NULL,
  `post_channel` enum('facebook','pantip','twitter','website','instagram','youtube') COLLATE utf8_unicode_ci NOT NULL,
  `post_spam` set('sell','spam') COLLATE utf8_unicode_ci DEFAULT NULL,
  `post_parent_social_id` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `post_website_url_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`post_id`),
  UNIQUE KEY `post_social_id_UNIQUE` (`post_social_id`),
  KEY `post_parse_date` (`post_parse_date`),
  KEY `post_website_url_id_fk_idx` (`post_website_url_id`),
  KEY `post_author_id_fk_idx` (`post_author_id`),
  CONSTRAINT `post_author_id_fk` FOREIGN KEY (`post_author_id`) REFERENCES `author` (`author_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `post_website_url_id_fk` FOREIGN KEY (`post_website_url_id`) REFERENCES `website_url` (`website_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post`
--

LOCK TABLES `post` WRITE;
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
/*!40000 ALTER TABLE `post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_ig`
--

DROP TABLE IF EXISTS `user_ig`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_ig` (
  `user_ig_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_ig_name` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `user_ig_type` enum('username','hashtag') CHARACTER SET latin1 NOT NULL DEFAULT 'username',
  PRIMARY KEY (`user_ig_id`),
  UNIQUE KEY `client_id_UNIQUE` (`user_ig_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_ig`
--

LOCK TABLES `user_ig` WRITE;
/*!40000 ALTER TABLE `user_ig` DISABLE KEYS */;
INSERT INTO `user_ig` VALUES (1,'aum_patchrapa','username'),(2,'php','hashtag'),(3,'photoshoot','hashtag'),(4,'photoshootready','hashtag'),(7,'sunnamaja','username');
/*!40000 ALTER TABLE `user_ig` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `website_url`
--

DROP TABLE IF EXISTS `website_url`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `website_url` (
  `website_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `website_url` tinytext CHARACTER SET latin1,
  PRIMARY KEY (`website_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `website_url`
--

LOCK TABLES `website_url` WRITE;
/*!40000 ALTER TABLE `website_url` DISABLE KEYS */;
/*!40000 ALTER TABLE `website_url` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-09-17 17:47:38
