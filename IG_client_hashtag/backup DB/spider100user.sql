CREATE DATABASE  IF NOT EXISTS `spider` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `spider`;
-- MySQL dump 10.13  Distrib 5.6.17, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: spider
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
  UNIQUE KEY `post_social_id_UNIQUE` (`post_social_id`,`post_channel`),
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
  `user_ig_id_user` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_ig_name` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `user_ig_type` enum('username','hashtag') CHARACTER SET latin1 NOT NULL DEFAULT 'username',
  `user_ig_feed_date` datetime NOT NULL,
  `user_ig_queue_date` datetime NOT NULL,
  PRIMARY KEY (`user_ig_id`),
  UNIQUE KEY `user_ig_id_user_UNIQUE` (`user_ig_id_user`),
  KEY `name_type_UNIQUE` (`user_ig_name`,`user_ig_type`)
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_ig`
--

LOCK TABLES `user_ig` WRITE;
/*!40000 ALTER TABLE `user_ig` DISABLE KEYS */;
INSERT INTO `user_ig` VALUES (8,'9595407','aum_patchrapa','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(9,'3896328','chermarn','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(10,'8176054','boy_pakorn','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(11,'4275583','chomismaterialgirl','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(12,'6453456','vjwoonsen','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(13,'4913605','margie_rasri','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(14,'5201816','davikah','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(15,'7930203','kimmy_kimberley','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(16,'16555858','jirayu_jj','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(17,'7556118','aom_sushar','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(18,'350211613','mario_mm38','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(19,'4918087','mark_prin','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(20,'2456104','domepakornlam','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(21,'2301760','toeyjarinporn','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(22,'9023378','tukky66','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(23,'6410563','noeychotika','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(24,'3083324','nuneworanuch','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(25,'16149283','poydtreechada','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(26,'5200199','mint_chalida','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(27,'650307687','yayaying_yaya','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(28,'3066027','m1keangelo','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(29,'6508889','annethong','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(30,'17148708','minpechaya','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(31,'1315309274','baitoey_rsiam','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(32,'373837786','gggubgib','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(33,'5018815','khunfour','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(34,'1274108667','baifrenbah','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(35,'7358306','peakpattarasaya','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(36,'9448472','pattieung','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(37,'2503243','crishorwang','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(39,'2600642','ppanward','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(40,'600694929','vic_to_ri_a2','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(41,'4915793','pearypie','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(42,'10326001','sriritajensen','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(44,'17468287','supassra_sp','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(45,'6100653','babymelony','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(46,'2782743','opalpanisara','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(47,'41966516','ken_phupoom','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(48,'9432216','amy_klinpratoom','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(49,'9157126','mayfuang','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(50,'7657093','aey_pornthip','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(51,'225787094','kalamare','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(52,'5250289','maypitchy','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(53,'14700695','nanarybena','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(54,'11766638','bellacampen','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(55,'301039370','lilwanmai','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(56,'20762657','mind_napasasi','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(57,'10240918','kootee','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(58,'8744830','poh_natthawut','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(59,'5589889','warattaya','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(60,'1068272','khemanito','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(61,'6103613','aff_taksaorn','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(62,'8020750','pinenerize','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(63,'179645682','madame_mod','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(65,'6885538','kankantathavorn','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(66,'25875583','yae_uunws','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(67,'711856','hanongh','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(68,'15853812','lekteeradetch','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(69,'1181166950','popezaap','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(70,'6012188','apitsada','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(71,'12451337','lydiasarunrat','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(72,'234480684','tubtimofficial','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(73,'5204409','appleminiberry','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(74,'484945386','gybzygirlyberry','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(75,'1946876','woodytalk','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(76,'4607044','aimeemorakot','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(77,'6278402','great_rider10','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(78,'2936729','jeab_pijittra','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(80,'6113862','janesuda','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(81,'17669057','marchutavuth','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(82,'9032146','mattperanee','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(83,'1433978306','janienineeleven','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(84,'5887301','weir19','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(85,'322980','awnoom','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(87,'14135996','nadech_kugimiya','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(88,'3769665','ningpanita','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(89,'3244161','prayalundberg','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(90,'2084727','peach_pachara','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(91,'226773192','gracekanklao','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(92,'5119062','kwanusa9','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(93,'7366357','bowie_atthama','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(94,'5116932','siwat_c','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(95,'5492163','noona_nuengtida','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(96,'7538062','mewnittha','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(97,'233560804','putdejudom','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(98,'2844626','esthersupree','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(99,'509949896','earlyboysd','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(100,'3314581','ploychava','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(101,'21672370','a_supachai1','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(102,'2150385','pimtdao','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(103,'2172330','pornchita','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(104,'5687458','ayasakai','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(105,'3599932','iamkratae','username','0000-00-00 00:00:00','0000-00-00 00:00:00'),(106,'223336502','momomama123','username','0000-00-00 00:00:00','0000-00-00 00:00:00');
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

-- Dump completed on 2014-09-22 22:04:29
