CREATE DATABASE  IF NOT EXISTS `social_image` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `social_image`;
-- MySQL dump 10.13  Distrib 5.6.17, for Win32 (x86)
--
-- Host: tools.thothmedia.com    Database: social_image
-- ------------------------------------------------------
-- Server version	5.1.66-log

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
  `account_timestamp` datetime NOT NULL,
  PRIMARY KEY (`account_id`),
  UNIQUE KEY `account_id_user_UNIQUE` (`account_id_user`),
  UNIQUE KEY `account_username_UNIQUE` (`account_username`,`account_channel`)
) ENGINE=InnoDB AUTO_INCREMENT=411 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account`
--

LOCK TABLES `account` WRITE;
/*!40000 ALTER TABLE `account` DISABLE KEYS */;
INSERT INTO `account` VALUES (160,'136805923037665','SamsungEgypt','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(161,'161841567214009','SamsungSouthAfrica','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(162,'210249512340911','SamsungMobileSA','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(163,'208043925927503','SamsungAustralia','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(164,'253147511975','SamsungHK','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(165,'131173933569944','SamsungMobileHK','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(166,'123688241046671','samsungIN','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(167,'133803174373','SamsungMobileIndia','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(168,'170499732992726','SamsungIndonesia','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(169,'137362696323133','SamsungMobileIndonesia','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(170,'282271755','SamsungUSA','instagram','2014-01-01 00:00:00','0000-00-00 00:00:00'),(171,'1391036938','SamsungUkraine','instagram','2014-01-01 00:00:00','0000-00-00 00:00:00'),(172,'1090053653','SamsungUK','instagram','2014-01-01 00:00:00','0000-00-00 00:00:00'),(173,'234351584','SamsungTurkiye','instagram','2014-01-01 00:00:00','0000-00-00 00:00:00'),(174,'491368888','samsungsverige','instagram','2014-01-01 00:00:00','0000-00-00 00:00:00'),(175,'422412570','SamsungSuomi','instagram','2014-01-01 00:00:00','0000-00-00 00:00:00'),(176,'262813012','samsungru','instagram','2014-01-01 00:00:00','0000-00-00 00:00:00'),(177,'552959861','SamsungRomania','instagram','2014-01-01 00:00:00','0000-00-00 00:00:00'),(178,'349020456','samsungportugal','instagram','2014-01-01 00:00:00','0000-00-00 00:00:00'),(179,'266481824','SamsungPolska','instagram','2014-01-01 00:00:00','0000-00-00 00:00:00'),(180,'718614953','SamsungPH','instagram','2014-01-01 00:00:00','0000-00-00 00:00:00'),(181,'652774384','SamsungPakistan','instagram','2014-01-01 00:00:00','0000-00-00 00:00:00'),(182,'509996161','SamsungNorge','instagram','2014-01-01 00:00:00','0000-00-00 00:00:00'),(183,'299053021','SamsungNederland','instagram','2014-01-01 00:00:00','0000-00-00 00:00:00'),(184,'174053029','SamsungMobileUSA','instagram','2014-01-01 00:00:00','0000-00-00 00:00:00'),(185,'252410388','SamsungMobileNL','instagram','2014-01-01 00:00:00','0000-00-00 00:00:00'),(186,'187323885','samsungmobilemx','instagram','2014-01-01 00:00:00','0000-00-00 00:00:00'),(187,'321123051','samsungmobilebelgium','instagram','2014-01-01 00:00:00','0000-00-00 00:00:00'),(188,'386969432','SamsungMobileArabia','instagram','2014-01-01 00:00:00','0000-00-00 00:00:00'),(189,'178668260','samsungmexico','instagram','2014-01-01 00:00:00','0000-00-00 00:00:00'),(190,'356182089','SamsungKZ','instagram','2014-01-01 00:00:00','0000-00-00 00:00:00'),(191,'515550290','samsungitalia','instagram','2014-01-01 00:00:00','0000-00-00 00:00:00'),(192,'293673602','SamsungGulf','instagram','2014-01-01 00:00:00','0000-00-00 00:00:00'),(193,'270767318','SamsungGreece','instagram','2014-01-01 00:00:00','0000-00-00 00:00:00'),(194,'437920308','samsungfrance','instagram','2014-01-01 00:00:00','0000-00-00 00:00:00'),(195,'1433838588','SamsungEgypt','instagram','2014-01-01 00:00:00','0000-00-00 00:00:00'),(196,'280611592','SamsungDanmark','instagram','2014-01-01 00:00:00','0000-00-00 00:00:00'),(197,'611889780','SamsungColombia','instagram','2014-01-01 00:00:00','0000-00-00 00:00:00'),(198,'264358210','SamsungCanada','instagram','2014-01-01 00:00:00','0000-00-00 00:00:00'),(199,'43206570','SamsungBrasil','instagram','2014-01-01 00:00:00','0000-00-00 00:00:00'),(200,'436144145','SamsungAustria','instagram','2014-01-01 00:00:00','0000-00-00 00:00:00'),(201,'836678637','SamsungArgentina','instagram','2014-01-01 00:00:00','0000-00-00 00:00:00'),(213,'161949543871197','samsungmobilejapan','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(214,'21410149977','samsungmalaysia','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(215,'380295992012194','samsungmobilemalaysia','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(216,'176358752382299','SamsungNZ','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(217,'147255057856','SamsungPH','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(218,'146941488726138','SamsungMobilePH','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(219,'126398660715769','SamsungSingapore','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(220,'201671497624','SamsungMobileSingapore','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(221,'151945724845375','SamsungTaiwan','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(222,'100489613340306','SamsungMobileTaiwan','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(223,'122457774469068','samsungmobilethailand','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(224,'312859602115217','SamsungVietnam','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(225,'322004096814','SamsungMobileVietnam','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(226,'302536456510024','samsungarmenia','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(227,'160331670685001','SamsungAustria','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(228,'218390964845903','SamsungBelgium','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(229,'139419056118521','samsungmobilebelgium','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(230,'177610105653371','samsungczsk','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(231,'187552244612727','SamsungDanmark','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(232,'176516242367006','SamsungSuomi','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(233,'150846581627762','samsungfrance','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(234,'202828739757750','SamsungMobileFrance','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(235,'308714872532583','SamsungDeutschland','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(236,'273058856113933','SamsungMobileDeutschland','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(237,'353369828028789','SamsungGreece','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(238,'250524748345959','SamsungMobileGreece','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(239,'325501489382','SamsungMagyarorszag','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(240,'201797643167743','SamsungIreland','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(242,'143003844056','Samsung.Israel','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(243,'533687663325094','SamsungMobileIsrael','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(244,'303513992980','samsungitalia','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(245,'294939243866705','SamsungKZ','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(246,'147084022032235','SamsungNederland','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(247,'160640413958253','SamsungMobileNL','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(248,'201450226534069','SamsungNorge','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(249,'105164616191968','SamsungPolska','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(250,'114625091908026','TelefonySamsung','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(251,'407862499912','samsungportugal','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(252,'328337927227316','SamsungRomania','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(253,'114902995216649','SamsungMobileRomania','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(254,'294777871061','samsungru','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(255,'140689212627631','SamsungMobileRussia','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(256,'63319904781','SamsungSlovenia','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(257,'120695667974101','SamsungEspana','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(258,'108610811866','samsungmobilespain','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(259,'168883466495077','samsungsverige','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(260,'179562565419554','SamsungSwitzerland','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(261,'135448153150252','SamsungTurkiye','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(262,'126761694007536','SamsungUK','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(263,'366913066682949','SamsungMobileUK','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(264,'100874486651615','SamsungUkraine','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(265,'144601662246604','SamsungArgentina','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(266,'162523134477','SamsungBrasil','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(267,'262418623780864','SamsungMobileBrasil','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(268,'205112366200648','SamsungChile','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(269,'138531519510834','SamsungColombia','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(270,'125090680882096','SamsungMobileColombia','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(271,'155906554495058','samsungpanama','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(272,'122787028507','SamsungPeru','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(273,'103098293060117','samsungmobileperu','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(274,'171634442884718','samsungvenezuela','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(275,'155844124435837','samsungmobilevenezuela','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(276,'151132238272187','SamsungPakistan','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(277,'134007706724973','SamsungGulf','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(278,'107593572595009','SamsungMobileArabia','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(279,'107207475968476','SamsungCanada','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(280,'260085296049','samsungmobilecanada','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(281,'101400706583476','samsungmexico','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(282,'131389306871851','samsungmobilemx','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(283,'117058896692','SamsungUSA','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(284,'7224956785','SamsungMobileUSA','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(368,'368965879356','SamsungContent','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(369,'16614884445','samsungcamera','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(370,'204591969573673','SamsungCameraUSA','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(371,'252586685870','SamsungTV','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(372,'114841788592047','SamsungTVUSA','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(373,'426208864116145','SamsungHomeAppliances','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(374,'183923326374','samsunghomeappliancesusa','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(375,'314882591487','SamsungTomorrow','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(376,'114219621960016','SamsungMobile','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(377,'192771932654','samsungnx','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00'),(378,'129550143771581','Samsungnotebook','facebook','2014-01-01 00:00:00','0000-00-00 00:00:00');
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

-- Dump completed on 2014-09-30 23:20:37
