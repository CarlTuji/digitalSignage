-- MySQL dump 10.19  Distrib 10.3.31-MariaDB, for debian-linux-gnueabihf (armv8l)
--
-- Host: localhost    Database: digitalDisplay
-- ------------------------------------------------------
-- Server version	10.3.31-MariaDB-0+deb10u1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `digitalDisplay`
--

/*!40000 DROP DATABASE IF EXISTS `digitalDisplay`*/;

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `digitalDisplay` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `digitalDisplay`;

--
-- Table structure for table `currencies`
--

DROP TABLE IF EXISTS `currencies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `currencies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `currency` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` decimal(11,5) NOT NULL COMMENT 'equivalent US$1',
  PRIMARY KEY (`id`),
  KEY `value` (`value`),
  KEY `date` (`date`),
  KEY `time` (`time`),
  KEY `currency` (`currency`)
) ENGINE=InnoDB AUTO_INCREMENT=143 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `currencies`
--

LOCK TABLES `currencies` WRITE;
/*!40000 ALTER TABLE `currencies` DISABLE KEYS */;
INSERT INTO `currencies` VALUES (1,'2021-12-13','09:42:06','JPY',113.52293),(2,'2021-12-13','09:59:19','BRL',5.61278),(3,'2021-12-14','11:01:11','JPY',113.63319),(4,'2021-12-14','11:01:11','BRL',5.68055),(5,'2021-12-15','10:34:34','JPY',113.70116),(6,'2021-12-15','10:34:34','BRL',5.68165),(7,'2021-12-16','15:22:08','JPY',114.14119),(8,'2021-12-16','15:22:08','BRL',5.68074),(9,'2021-12-17','19:29:20','JPY',113.71209),(10,'2021-12-17','19:29:20','BRL',5.69500),(11,'2021-12-18','08:00:32','JPY',113.71230),(12,'2021-12-18','08:00:32','BRL',5.69506),(13,'2021-12-19','08:00:34','JPY',113.71279),(14,'2021-12-19','08:00:34','BRL',5.69604),(15,'2021-12-22','09:00:04','JPY',113.99211),(16,'2021-12-22','09:00:04','BRL',5.74517),(17,'2021-12-23','09:09:57','JPY',114.12247),(18,'2021-12-23','09:09:57','BRL',5.65407),(19,'2021-12-24','08:45:51','JPY',114.47322),(20,'2021-12-24','08:45:51','BRL',5.67268),(21,'2021-12-25','11:20:16','JPY',114.38309),(22,'2021-12-25','11:20:16','BRL',5.67515),(23,'2021-12-26','07:40:42','JPY',114.38133),(24,'2021-12-26','07:40:42','BRL',5.67516),(25,'2021-12-27','10:49:25','JPY',114.40203),(26,'2021-12-27','10:49:25','BRL',5.67508),(27,'2021-12-28','08:37:22','JPY',114.85124),(28,'2021-12-28','08:37:22','BRL',5.62496),(29,'2021-12-29','09:23:26','JPY',114.77226),(30,'2021-12-29','09:23:26','BRL',5.62791),(31,'2021-12-30','09:16:24','JPY',114.95342),(32,'2021-12-30','09:16:24','BRL',5.70334),(33,'2021-12-31','07:14:18','JPY',115.04252),(34,'2021-12-31','07:14:18','BRL',5.57113),(35,'2022-01-02','07:41:19','JPY',115.11135),(36,'2022-01-02','07:41:19','BRL',5.57036),(37,'2022-01-03','09:12:03','JPY',115.14131),(38,'2022-01-03','09:12:03','BRL',5.57036),(39,'2022-01-06','08:57:06','JPY',116.12232),(40,'2022-01-06','08:57:06','BRL',5.70877),(41,'2022-01-07','00:57:15','JPY',115.69330),(42,'2022-01-07','00:57:15','BRL',5.70761),(43,'2022-01-08','07:41:44','JPY',115.53263),(44,'2022-01-08','07:41:44','BRL',5.63558),(45,'2022-01-09','00:41:52','JPY',115.53163),(46,'2022-01-09','00:41:52','BRL',5.63564),(47,'2022-01-10','00:42:04','JPY',115.53119),(48,'2022-01-10','00:42:04','BRL',5.63563),(49,'2022-01-11','00:42:17','JPY',115.31125),(50,'2022-01-11','00:42:17','BRL',5.68242),(51,'2022-01-12','00:42:30','JPY',115.44330),(52,'2022-01-12','00:42:30','BRL',5.61217),(53,'2022-01-13','08:37:02','JPY',114.66202),(54,'2022-01-13','08:37:02','BRL',5.53338),(55,'2022-01-14','00:37:09','JPY',114.27198),(56,'2022-01-14','00:37:09','BRL',5.51736),(57,'2022-01-15','08:58:46','JPY',114.18127),(58,'2022-01-15','08:58:46','BRL',5.53519),(59,'2022-01-16','07:30:02','JPY',114.18213),(60,'2022-01-16','07:30:02','BRL',5.53516),(61,'2022-01-17','00:30:12','JPY',114.18268),(62,'2022-01-17','00:30:12','BRL',5.53516),(63,'2022-01-18','00:30:26','JPY',114.56141),(64,'2022-01-18','00:30:26','BRL',5.51218),(65,'2022-01-19','00:30:40','JPY',114.69120),(66,'2022-01-19','00:30:40','BRL',5.53173),(67,'2022-01-20','10:17:25','JPY',114.27077),(68,'2022-01-20','10:17:25','BRL',5.43843),(69,'2022-01-21','08:36:17','JPY',113.92710),(70,'2022-01-21','08:36:17','BRL',5.41871),(71,'2022-01-22','07:38:40','JPY',113.66698),(72,'2022-01-22','07:38:40','BRL',5.45864),(73,'2022-01-23','08:24:45','JPY',113.66681),(74,'2022-01-23','08:24:45','BRL',5.45860),(75,'2022-01-26','08:46:04','JPY',113.90968),(76,'2022-01-26','08:46:04','BRL',5.43823),(77,'2022-01-27','08:44:47','JPY',114.68293),(78,'2022-01-27','08:44:47','BRL',5.43125),(79,'2022-01-28','08:37:18','JPY',115.40006),(80,'2022-01-28','08:37:18','BRL',5.40286),(81,'2022-01-29','07:30:08','JPY',115.22889),(82,'2022-01-29','07:30:08','BRL',5.36883),(83,'2022-01-30','09:58:58','JPY',115.22790),(84,'2022-01-30','09:58:58','BRL',5.36883),(85,'2022-02-02','09:17:22','JPY',114.77407),(86,'2022-02-02','09:17:22','BRL',5.26593),(87,'2022-02-03','08:35:09','JPY',114.35567),(88,'2022-02-03','08:35:09','BRL',5.26289),(89,'2022-02-04','00:35:17','JPY',114.94215),(90,'2022-02-04','00:35:17','BRL',5.28846),(91,'2022-02-05','07:31:08','JPY',115.19624),(92,'2022-02-05','07:31:08','BRL',5.31884),(93,'2022-02-06','07:31:29','JPY',115.19681),(94,'2022-02-06','07:31:29','BRL',5.31882),(95,'2022-02-07','11:41:20','JPY',115.32733),(96,'2022-02-07','11:41:20','BRL',5.32535),(97,'2022-02-08','00:41:27','JPY',115.00538),(98,'2022-02-08','00:41:27','BRL',5.29246),(99,'2022-02-09','00:41:40','JPY',115.48849),(100,'2022-02-09','00:41:40','BRL',5.27831),(101,'2022-02-10','08:34:22','JPY',115.59137),(102,'2022-02-10','08:34:22','BRL',5.24005),(103,'2022-02-11','08:32:06','JPY',116.06356),(104,'2022-02-11','08:32:06','BRL',5.21937),(105,'2022-02-12','07:26:44','JPY',115.68802),(106,'2022-02-12','07:26:44','BRL',5.21436),(107,'2022-02-13','08:48:39','JPY',115.92981),(108,'2022-02-13','08:48:39','BRL',5.18645),(109,'2022-02-16','10:00:05','JPY',115.68726),(110,'2022-02-16','10:00:05','BRL',5.16024),(111,'2022-02-17','08:39:44','JPY',115.43105),(112,'2022-02-17','08:39:44','BRL',5.13695),(113,'2022-02-18','09:58:41','JPY',114.84767),(114,'2022-02-18','09:58:41','BRL',5.17118),(115,'2022-02-19','07:29:58','JPY',115.02951),(116,'2022-02-19','07:29:58','BRL',5.13631),(117,'2022-02-20','09:26:46','JPY',115.03466),(118,'2022-02-20','09:26:46','BRL',5.13634),(119,'2022-02-23','08:31:42','JPY',115.09533),(120,'2022-02-23','08:31:42','BRL',5.06070),(121,'2022-02-24','00:31:52','JPY',115.05934),(122,'2022-02-24','00:31:52','BRL',5.02119),(123,'2022-02-25','09:57:36','JPY',115.62045),(124,'2022-02-25','09:57:36','BRL',5.11586),(125,'2022-02-26','07:28:26','JPY',115.54089),(126,'2022-02-26','07:28:26','BRL',5.16242),(127,'2022-02-27','07:57:00','JPY',115.66247),(128,'2022-02-27','07:57:00','BRL',5.14240),(129,'2022-03-02','08:44:27','JPY',114.83857),(130,'2022-03-02','08:44:27','BRL',5.15962),(131,'2022-03-03','08:33:38','JPY',115.45142),(132,'2022-03-03','08:33:38','BRL',5.09060),(133,'2022-03-04','08:38:37','JPY',115.49236),(134,'2022-03-04','08:38:37','BRL',5.03231),(135,'2022-03-05','08:46:34','JPY',114.81641),(136,'2022-03-05','08:46:34','BRL',5.06425),(137,'2022-03-06','07:31:42','JPY',114.81681),(138,'2022-03-06','07:31:42','BRL',5.06425),(139,'2022-03-07','13:47:51','JPY',114.90923),(140,'2022-03-07','13:47:51','BRL',5.06211),(141,'2022-03-08','00:47:56','JPY',115.32829),(142,'2022-03-08','00:47:56','BRL',5.07146);
/*!40000 ALTER TABLE `currencies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `makers`
--

DROP TABLE IF EXISTS `makers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `makers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `maker_id` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `maker_name_ptbr` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `maker_name_jp` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `maker_entry_date` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `makerIndex` (`maker_id`),
  KEY `makerNamePtBrIndex` (`maker_name_ptbr`),
  KEY `makerNameJpIndex` (`maker_name_jp`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `makers`
--

LOCK TABLES `makers` WRITE;
/*!40000 ALTER TABLE `makers` DISABLE KEYS */;
INSERT INTO `makers` VALUES (1,'takara','TAKARA','タカラ','2021-05-16 23:10:15'),(2,'brasil','BRASIL','ブラジル','2021-05-16 23:10:34'),(3,'australia','AUSTRÁLIA','オーストラリア','2021-05-16 23:11:14'),(4,'usa','USA','アメリカ','2021-05-20 18:35:45'),(5,'mexico','MÉXICO','メキシコ','2021-05-20 19:00:57'),(6,'uk','INGLATERRA','英国','2021-09-16 16:05:22');
/*!40000 ALTER TABLE `makers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `price`
--

DROP TABLE IF EXISTS `price`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `price` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `prodCode` varchar(13) COLLATE utf8_unicode_ci NOT NULL COMMENT 'unique code to identify each item',
  `normal_price` int(11) NOT NULL,
  `entry_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `prodCodeIndex` (`prodCode`),
  KEY `prodPriceEntryDateIndex` (`entry_date`),
  CONSTRAINT `priceConstraint` FOREIGN KEY (`prodCode`) REFERENCES `products` (`prodCode`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `price`
--

LOCK TABLES `price` WRITE;
/*!40000 ALTER TABLE `price` DISABLE KEYS */;
INSERT INTO `price` VALUES (1,'4701',2580,'2022-04-15 20:14:45'),(2,'4702',2300,'2022-03-11 11:37:20'),(3,'4703',2180,'2022-03-03 19:58:05'),(4,'4704',2300,'2022-04-15 20:17:40'),(5,'4705',3980,'2022-04-15 20:18:50'),(6,'4706',2380,'2022-04-06 18:54:52'),(7,'4707',2380,'2021-11-25 17:19:21'),(8,'4708',2180,'2022-03-11 11:36:24'),(9,'4709',1980,'2021-12-08 09:23:46'),(10,'4710',3380,'2021-06-08 10:28:43'),(11,'4711',2300,'2022-08-05 09:14:58'),(12,'4712',1980,'2022-07-22 09:18:39'),(13,'4714',4980,'2021-06-08 10:28:43'),(14,'4718',2180,'2021-06-08 10:28:43'),(15,'4719',2380,'2022-03-11 11:38:37'),(16,'4720',2080,'2022-01-07 11:57:11'),(18,'4724',3480,'2022-08-19 08:30:42'),(19,'4730',2180,'2022-03-04 09:42:11'),(20,'470201',2200,'2022-03-11 13:31:47');
/*!40000 ALTER TABLE `price` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `price_special`
--

DROP TABLE IF EXISTS `price_special`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `price_special` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `prodCode` varchar(13) COLLATE utf8_unicode_ci NOT NULL COMMENT 'unique code to identify each item',
  `price_special` int(10) unsigned NOT NULL,
  `entry_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` tinyint(3) unsigned NOT NULL COMMENT 'set to 1 if the product is in special sale or 0 if it''s on normal price',
  PRIMARY KEY (`id`),
  UNIQUE KEY `prodCodeIndex` (`prodCode`),
  KEY `prodPriceStatusIndex` (`status`),
  CONSTRAINT `priceSpecialConstraint` FOREIGN KEY (`prodCode`) REFERENCES `products` (`prodCode`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `price_special`
--

LOCK TABLES `price_special` WRITE;
/*!40000 ALTER TABLE `price_special` DISABLE KEYS */;
INSERT INTO `price_special` VALUES (4,'4710',3280,'2022-04-07 17:41:16',1),(6,'4714',3400,'2021-06-08 10:28:43',1),(24,'4705',3280,'2022-04-15 20:18:50',1),(25,'4719',1890,'2022-07-27 15:39:05',1),(30,'4701',2280,'2022-07-22 09:15:49',1),(31,'4704',2180,'2022-07-22 09:16:16',1),(32,'4702',1980,'2022-07-22 09:16:26',1),(33,'4703',1980,'2022-07-22 09:16:36',1),(34,'4708',1890,'2022-07-22 09:16:44',1),(35,'470201',1980,'2022-07-22 09:16:56',1),(36,'4711',1980,'2022-08-11 18:30:00',1),(37,'4718',1820,'2022-08-11 19:13:00',1),(38,'4724',2980,'2022-08-19 08:30:42',1);
/*!40000 ALTER TABLE `price_special` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'unique index',
  `prodCode` varchar(13) COLLATE utf8_unicode_ci NOT NULL COMMENT 'unique code to identify each item',
  `prodNamePTBR` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'product description in foreigt language',
  `prodNameJP` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'products description in Japanese',
  `makerID` varchar(11) COLLATE utf8_unicode_ci NOT NULL COMMENT 'FK to makers table',
  `prodSize` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `saleUnitID` int(10) unsigned NOT NULL COMMENT 'FK to salesUnit table',
  `prod_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prodEntryDate` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'when the item was registered',
  `prodLastModified` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `active` tinyint(3) unsigned NOT NULL DEFAULT 1 COMMENT 'The product is Active (1) or Inactive (0)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `prodCode` (`prodCode`),
  KEY `prodNamePTBR` (`prodNamePTBR`),
  KEY `prodNameJP` (`prodNameJP`),
  KEY `makerID` (`makerID`),
  KEY `saleUnitIndex` (`saleUnitID`),
  KEY `prodActiveIndex` (`active`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'4701','ALCATRA C/ GORDURA','牛ランプ','australia','1kg',1,'4701.webp','2021-05-20 16:53:53','2022-08-11 19:14:12',1),(2,'4702','COXÃO DURO','牛外モモ','australia','1kg',1,'4702.webp','2021-05-20 16:55:46','2021-10-30 17:19:43',1),(3,'4703','PATINHO','牛芯玉','australia','1kg',1,'4703.webp','2021-05-20 16:57:36','2021-10-30 17:19:47',1),(4,'4704','COXÃO MOLE','牛内モモ','australia','1kg',1,'4704.webp','2021-05-20 16:59:09','2021-10-30 17:19:51',1),(5,'4705','CONTRA FILÉ','牛ロース','australia','1kg',1,'4705.webp','2021-05-20 17:01:40','2021-10-30 17:19:57',1),(6,'4706','PONTA DE PEITO','牛とうがらし','australia','1kg',1,'4706.webp','2021-05-20 17:03:09','2021-10-30 17:20:02',1),(7,'4707','ACÉM','牛肩ロース','australia','1kg',1,'4707.webp','2021-05-20 17:04:52','2021-10-30 17:20:07',1),(8,'4708','COSTELA DE BOI S/ OSSO','牛ばら','australia','1kg',1,'4708.webp','2021-05-20 17:06:34','2021-10-30 17:20:11',1),(9,'4709','MÚSCULO DE BOI','牛スネ肉','australia','1kg',1,'4709.webp','2021-05-20 17:07:46','2021-10-30 17:20:15',0),(10,'4710','FRALDINHA','牛ハラミ','australia','1kg',1,'4710.webp','2021-05-20 17:11:32','2021-10-30 17:20:20',1),(11,'4711','CUPIM','牛チャッククレスト','australia','1kg',1,'4711.webp','2021-05-20 18:13:32','2022-05-25 17:39:03',1),(12,'4712','MÚSCULO','牛スネ肉','australia','1kg',1,'4709.webp','2021-05-20 18:20:30','2021-10-30 17:20:31',1),(13,'4714','BISTECA DE BOI C/ OSSO','牛Tボーンステーキ','australia','1kg',1,'4714.webp','2021-05-20 18:22:38','2021-10-30 17:20:36',0),(14,'4718','COSTELA DE BOI C/ OSSO','牛ショットリーブ','mexico','1kg',1,'4718.webp','2021-05-20 18:37:01','2022-08-11 19:13:00',1),(15,'4719','PALETA','牛腕（肩三角）','australia','1kg',1,'4719.webp','2021-05-20 18:57:50','2021-10-30 17:20:47',1),(16,'4720','BANANINHA','牛リブフィンガー','mexico','1kg',1,'4720.webp','2021-05-20 19:01:38','2021-10-30 17:20:52',1),(18,'4724','PICANHA','牛いちぼ','takara','1kg',1,'4724.webp','2021-06-11 10:16:59','2021-10-30 17:20:56',1),(19,'4730','MAMINHA','牛トモサンカク','takara','1kg',1,'4730.webp','2021-06-21 18:24:37','2021-10-30 17:21:01',1),(20,'470201','LAGARTO','牛シキンボウ（ローストビーフ用）','takara','1kg',1,'470201.webp','2021-06-27 10:19:16','2021-10-30 17:21:05',1);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `units`
--

DROP TABLE IF EXISTS `units`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `units` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `unit_id` int(10) unsigned NOT NULL,
  `unit_text` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unitIndex` (`unit_id`),
  KEY `unitTextIndex` (`unit_text`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `units`
--

LOCK TABLES `units` WRITE;
/*!40000 ALTER TABLE `units` DISABLE KEYS */;
INSERT INTO `units` VALUES (3,1,'kg'),(4,2,'g'),(5,3,'cada');
/*!40000 ALTER TABLE `units` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `viewProducts`
--

DROP TABLE IF EXISTS `viewProducts`;
/*!50001 DROP VIEW IF EXISTS `viewProducts`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `viewProducts` (
  `id` tinyint NOT NULL,
  `prodCode` tinyint NOT NULL,
  `prodNamePTBR` tinyint NOT NULL,
  `prodNameJP` tinyint NOT NULL,
  `prodSize` tinyint NOT NULL,
  `prod_image` tinyint NOT NULL,
  `maker_name_ptbr` tinyint NOT NULL,
  `maker_name_jp` tinyint NOT NULL,
  `unit_text` tinyint NOT NULL,
  `normal_price` tinyint NOT NULL,
  `price_special` tinyint NOT NULL,
  `status` tinyint NOT NULL,
  `active` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `weather`
--

DROP TABLE IF EXISTS `weather`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `weather` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `weather` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `temp` decimal(5,2) NOT NULL,
  `temp_min` decimal(5,2) NOT NULL,
  `temp_max` decimal(5,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `date` (`date`),
  KEY `time` (`time`),
  KEY `location` (`location`),
  KEY `weather` (`weather`),
  KEY `temp_min` (`temp_min`),
  KEY `temp_max` (`temp_max`),
  KEY `temp` (`temp`)
) ENGINE=InnoDB AUTO_INCREMENT=203 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `weather`
--

LOCK TABLES `weather` WRITE;
/*!40000 ALTER TABLE `weather` DISABLE KEYS */;
INSERT INTO `weather` VALUES (1,'2021-12-12','16:29:48','fukuroi%2Cshizuoka%2Cjp','Clouds','nuvens dispersas',17.00,15.77,16.66),(2,'2021-12-13','09:13:34','fukuroi%2Cshizuoka%2Cjp','Clear','céu limpo',12.00,11.66,11.66),(3,'2021-12-14','11:01:10','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',11.00,9.01,10.55),(4,'2021-12-15','10:34:38','fukuroi%2Cshizuoka%2Cjp','Clear','céu limpo',13.00,12.77,13.32),(5,'2021-12-16','15:22:07','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',16.00,15.55,17.01),(6,'2021-12-17','19:29:19','fukuroi%2Cshizuoka%2Cjp','Clear','céu limpo',2.00,1.77,1.77),(7,'2021-12-18','08:00:31','fukuroi%2Cshizuoka%2Cjp','Clear','céu limpo',2.00,1.77,1.77),(8,'2021-12-19','08:00:33','fukuroi%2Cshizuoka%2Cjp','Clear','céu limpo',3.00,2.77,2.77),(9,'2021-12-21','10:19:24','fukuroi%2Cshizuoka%2Cjp','Clear','céu limpo',10.00,10.43,10.43),(10,'2021-12-22','09:00:02','fukuroi%2Cshizuoka%2Cjp','Clear','céu limpo',10.00,9.74,9.74),(11,'2021-12-23','09:09:56','fukuroi%2Cshizuoka%2Cjp','Clear','céu limpo',7.00,7.32,7.32),(12,'2021-12-24','08:45:50','fukuroi%2Cshizuoka%2Cjp','Clouds','algumas nuvens',8.00,7.77,7.77),(13,'2021-12-25','11:20:15','fukuroi%2Cshizuoka%2Cjp','Clear','céu limpo',14.00,13.77,13.77),(14,'2021-12-26','07:40:41','fukuroi%2Cshizuoka%2Cjp','Clear','céu limpo',1.00,0.77,0.77),(15,'2021-12-27','10:49:24','fukuroi%2Cshizuoka%2Cjp','Clear','céu limpo',3.00,2.77,2.77),(16,'2021-12-28','08:37:21','fukuroi%2Cshizuoka%2Cjp','Clear','céu limpo',3.00,2.77,4.01),(17,'2021-12-29','09:23:24','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',6.00,6.10,7.77),(18,'2021-12-30','09:16:23','fukuroi%2Cshizuoka%2Cjp','Clouds','algumas nuvens',9.00,9.43,9.77),(19,'2021-12-31','07:14:17','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',4.00,-0.06,3.88),(20,'2022-01-02','07:41:18','fukuroi%2Cshizuoka%2Cjp','Clouds','algumas nuvens',0.00,-0.06,-0.01),(21,'2022-01-03','09:12:02','fukuroi%2Cshizuoka%2Cjp','Clear','céu limpo',7.00,7.21,7.21),(22,'2022-01-06','08:57:05','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',4.00,3.77,4.43),(23,'2022-01-07','00:57:14','fukuroi%2Cshizuoka%2Cjp','Clouds','algumas nuvens',2.00,2.21,2.21),(24,'2022-01-08','07:41:43','fukuroi%2Cshizuoka%2Cjp','Clouds','nuvens dispersas',2.00,2.21,2.21),(25,'2022-01-09','00:41:51','fukuroi%2Cshizuoka%2Cjp','Clear','céu limpo',2.00,2.21,2.21),(26,'2022-01-10','00:42:03','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',8.00,8.32,8.32),(27,'2022-01-11','00:42:16','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',9.00,8.88,8.88),(28,'2022-01-12','00:42:29','fukuroi%2Cshizuoka%2Cjp','Clear','céu limpo',5.00,4.99,4.99),(29,'2022-01-13','08:37:01','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',4.00,2.77,4.43),(30,'2022-01-14','00:37:08','fukuroi%2Cshizuoka%2Cjp','Clouds','algumas nuvens',3.00,1.01,2.77),(31,'2022-01-15','08:58:45','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',5.00,2.77,4.99),(32,'2022-01-16','07:30:01','fukuroi%2Cshizuoka%2Cjp','Clear','céu limpo',1.00,1.10,1.10),(33,'2022-01-17','00:30:11','fukuroi%2Cshizuoka%2Cjp','Clear','céu limpo',5.00,4.99,4.99),(34,'2022-01-18','00:30:25','fukuroi%2Cshizuoka%2Cjp','Clouds','nuvens dispersas',4.00,4.01,4.43),(35,'2022-01-19','00:30:39','fukuroi%2Cshizuoka%2Cjp','Clear','céu limpo',2.00,2.21,2.21),(36,'2022-01-20','10:17:23','fukuroi%2Cshizuoka%2Cjp','Clear','céu limpo',6.00,6.10,6.10),(37,'2022-01-21','08:36:16','fukuroi%2Cshizuoka%2Cjp','Clear','céu limpo',3.00,1.77,3.32),(38,'2022-01-22','07:38:39','fukuroi%2Cshizuoka%2Cjp','Clear','céu limpo',0.00,-0.01,-0.01),(39,'2022-01-23','08:24:45','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',3.00,3.32,3.77),(40,'2022-01-26','08:46:04','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',7.00,5.77,7.21),(41,'2022-01-27','08:44:47','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',7.00,5.01,7.21),(42,'2022-01-28','08:37:17','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',5.00,4.77,4.99),(43,'2022-01-29','07:30:07','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',4.00,3.88,3.88),(44,'2022-01-30','09:58:57','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',8.00,5.77,8.33),(45,'2022-01-31','09:35:06','fukuroi%2Cshizuoka%2Cjp','Clear','céu limpo',7.00,6.77,7.21),(46,'2022-02-02','09:17:20','fukuroi%2Cshizuoka%2Cjp','Clear','céu limpo',7.00,5.77,7.21),(47,'2022-02-03','08:35:09','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',6.00,5.77,6.10),(48,'2022-02-04','00:35:17','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',6.00,5.55,6.01),(49,'2022-02-05','07:31:07','fukuroi%2Cshizuoka%2Cjp','Clear','céu limpo',3.00,2.69,2.69),(50,'2022-02-06','07:31:28','fukuroi%2Cshizuoka%2Cjp','Clouds','algumas nuvens',1.00,1.32,1.32),(51,'2022-02-07','11:41:19','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',7.00,6.77,6.77),(52,'2022-02-08','00:41:26','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',2.00,2.36,2.36),(53,'2022-02-09','00:41:39','fukuroi%2Cshizuoka%2Cjp','Clouds','nuvens dispersas',4.00,4.29,4.29),(54,'2022-02-10','08:34:21','fukuroi%2Cshizuoka%2Cjp','Rain','chuva leve',5.00,4.77,5.55),(55,'2022-02-11','08:32:05','fukuroi%2Cshizuoka%2Cjp','Clear','céu limpo',5.00,4.01,5.77),(56,'2022-02-12','07:26:43','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',3.00,0.55,2.77),(57,'2022-02-13','08:48:37','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',8.00,7.77,8.88),(58,'2022-02-16','09:59:59','fukuroi%2Cshizuoka%2Cjp','Clear','céu limpo',7.00,5.77,7.22),(59,'2022-02-17','08:39:43','fukuroi%2Cshizuoka%2Cjp','Clouds','algumas nuvens',2.00,0.77,2.21),(60,'2022-02-18','09:58:41','fukuroi%2Cshizuoka%2Cjp','Clear','céu limpo',6.00,4.77,6.11),(61,'2022-02-19','07:29:57','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',4.00,2.77,3.88),(62,'2022-02-20','09:26:45','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',10.00,8.77,9.99),(63,'2022-02-23','08:31:41','fukuroi%2Cshizuoka%2Cjp','Clouds','algumas nuvens',3.00,2.22,3.32),(64,'2022-02-24','00:31:51','fukuroi%2Cshizuoka%2Cjp','Clouds','nuvens dispersas',3.00,2.22,2.77),(65,'2022-02-25','09:57:35','fukuroi%2Cshizuoka%2Cjp','Clear','céu limpo',7.00,7.21,7.77),(66,'2022-02-26','07:28:25','fukuroi%2Cshizuoka%2Cjp','Clear','céu limpo',5.00,4.99,4.99),(67,'2022-02-27','07:56:59','fukuroi%2Cshizuoka%2Cjp','Clouds','nuvens dispersas',8.00,7.77,8.32),(68,'2022-03-02','08:44:26','fukuroi%2Cshizuoka%2Cjp','Clouds','nuvens dispersas',11.00,8.77,11.10),(69,'2022-03-03','08:33:36','fukuroi%2Cshizuoka%2Cjp','Clear','céu limpo',10.00,8.77,9.99),(70,'2022-03-04','08:38:35','fukuroi%2Cshizuoka%2Cjp','Clouds','algumas nuvens',8.00,5.01,7.77),(71,'2022-03-05','08:46:32','fukuroi%2Cshizuoka%2Cjp','Clear','céu limpo',10.00,7.77,10.55),(72,'2022-03-06','07:31:41','fukuroi%2Cshizuoka%2Cjp','Clear','céu limpo',6.00,4.44,5.55),(73,'2022-03-07','13:47:50','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',13.00,11.77,13.32),(74,'2022-03-08','00:47:55','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',7.00,4.99,7.21),(75,'2022-03-09','00:48:06','fukuroi%2Cshizuoka%2Cjp','Clear','céu limpo',6.00,4.44,6.10),(76,'2022-03-10','08:35:00','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',9.00,8.77,9.43),(77,'2022-03-11','08:55:18','fukuroi%2Cshizuoka%2Cjp','Clear','céu limpo',13.00,9.77,15.55),(78,'2022-03-12','08:52:58','fukuroi%2Cshizuoka%2Cjp','Clear','céu limpo',16.00,11.77,16.10),(79,'2022-03-13','08:54:40','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',16.00,12.77,16.10),(80,'2022-03-16','09:42:57','fukuroi%2Cshizuoka%2Cjp','Clear','céu limpo',19.00,16.77,18.88),(81,'2022-03-17','09:11:10','fukuroi%2Cshizuoka%2Cjp','Clouds','algumas nuvens',17.00,16.11,17.21),(82,'2022-03-18','00:11:16','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',15.00,14.44,14.99),(83,'2022-03-19','00:11:28','fukuroi%2Cshizuoka%2Cjp','Rain','chuva leve',13.00,12.77,13.32),(84,'2022-03-20','09:17:18','fukuroi%2Cshizuoka%2Cjp','Clouds','algumas nuvens',11.00,10.55,11.77),(85,'2022-03-23','09:15:33','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',11.00,10.55,10.55),(86,'2022-03-24','08:45:11','fukuroi%2Cshizuoka%2Cjp','Clear','céu limpo',11.00,8.77,11.10),(87,'2022-03-25','00:45:20','fukuroi%2Cshizuoka%2Cjp','Clear','céu limpo',10.00,8.88,9.99),(88,'2022-03-26','00:45:33','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',14.00,13.88,13.88),(89,'2022-03-27','08:41:52','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',16.00,16.10,16.77),(90,'2022-03-30','09:41:47','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',17.00,15.77,17.21),(91,'2022-03-31','00:41:55','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',16.00,14.44,15.55),(92,'2022-04-01','11:40:17','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',10.00,9.77,9.77),(93,'2022-04-02','00:40:25','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',9.00,8.88,9.43),(94,'2022-04-03','09:21:36','fukuroi%2Cshizuoka%2Cjp','Rain','chuva moderada',9.00,8.77,9.43),(95,'2022-04-06','09:13:07','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',18.00,17.01,18.88),(96,'2022-04-07','00:13:15','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',13.00,12.77,12.77),(97,'2022-04-08','00:13:27','fukuroi%2Cshizuoka%2Cjp','Clear','céu limpo',16.00,15.55,16.10),(98,'2022-04-09','00:13:42','fukuroi%2Cshizuoka%2Cjp','Clear','céu limpo',12.00,12.21,12.21),(99,'2022-04-10','00:13:55','fukuroi%2Cshizuoka%2Cjp','Clear','céu limpo',14.00,14.43,14.43),(100,'2022-04-13','10:03:41','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',24.00,23.88,23.88),(101,'2022-04-14','00:03:48','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',21.00,21.10,21.10),(102,'2022-04-15','00:04:02','fukuroi%2Cshizuoka%2Cjp','Rain','chuva leve',16.00,14.01,16.11),(103,'2022-04-16','00:24:47','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',17.00,17.21,17.22),(104,'2022-04-17','09:17:40','fukuroi%2Cshizuoka%2Cjp','Rain','chuva leve',12.00,10.77,12.77),(105,'2022-04-20','09:26:07','fukuroi%2Cshizuoka%2Cjp','Clear','céu limpo',20.00,17.77,20.55),(106,'2022-04-21','00:26:17','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',16.00,14.99,15.55),(107,'2022-04-22','00:26:30','fukuroi%2Cshizuoka%2Cjp','Rain','chuva leve',16.00,15.01,16.11),(108,'2022-04-23','00:26:43','fukuroi%2Cshizuoka%2Cjp','Clouds','nuvens dispersas',18.00,18.32,18.33),(109,'2022-04-24','08:30:11','fukuroi%2Cshizuoka%2Cjp','Rain','chuva leve',19.00,18.33,18.88),(110,'2022-04-27','09:45:02','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',22.00,20.77,21.66),(111,'2022-04-28','00:45:10','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',18.00,18.32,18.33),(112,'2022-04-29','00:45:23','fukuroi%2Cshizuoka%2Cjp','Clouds','nuvens dispersas',17.00,14.44,17.21),(113,'2022-04-30','00:45:38','fukuroi%2Cshizuoka%2Cjp','Clouds','algumas nuvens',13.00,12.77,16.01),(114,'2022-05-01','08:45:54','fukuroi%2Cshizuoka%2Cjp','Rain','chuva leve',17.00,14.77,17.21),(115,'2022-05-02','08:48:41','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',16.00,14.77,16.66),(116,'2022-05-03','08:32:59','fukuroi%2Cshizuoka%2Cjp','Clouds','nuvens dispersas',15.00,13.77,16.11),(117,'2022-05-04','08:17:08','fukuroi%2Cshizuoka%2Cjp','Clear','céu limpo',17.00,17.21,18.77),(118,'2022-05-05','07:51:40','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',19.00,17.77,19.99),(119,'2022-05-06','07:53:21','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',18.00,16.77,18.33),(120,'2022-05-07','00:38:33','fukuroi%2Cshizuoka%2Cjp','Clear','céu limpo',18.00,17.22,17.77),(121,'2022-05-08','08:42:27','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',22.00,20.77,22.22),(122,'2022-05-11','08:24:40','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',21.00,17.77,20.55),(123,'2022-05-12','00:24:50','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',17.00,17.21,17.21),(124,'2022-05-13','00:25:03','fukuroi%2Cshizuoka%2Cjp','Rain','chuva leve',18.00,17.77,18.01),(125,'2022-05-14','00:25:17','fukuroi%2Cshizuoka%2Cjp','Rain','chuva leve',22.00,21.01,21.66),(126,'2022-05-15','08:36:03','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',20.00,19.99,20.77),(127,'2022-05-16','00:36:12','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',17.00,16.66,17.01),(128,'2022-05-17','00:36:26','fukuroi%2Cshizuoka%2Cjp','Rain','chuva leve',16.00,16.10,16.10),(129,'2022-05-18','00:36:39','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',15.00,14.99,14.99),(130,'2022-05-19','08:22:44','fukuroi%2Cshizuoka%2Cjp','Clear','céu limpo',21.00,19.77,20.55),(131,'2022-05-20','08:27:31','fukuroi%2Cshizuoka%2Cjp','Rain','chuva leve',20.00,18.77,19.99),(132,'2022-05-21','09:01:57','fukuroi%2Cshizuoka%2Cjp','Rain','chuva forte',20.00,19.99,20.01),(133,'2022-05-22','07:35:05','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',18.00,18.32,18.32),(134,'2022-05-25','09:48:32','fukuroi%2Cshizuoka%2Cjp','Clouds','nuvens dispersas',26.00,25.55,25.55),(135,'2022-05-26','00:48:41','fukuroi%2Cshizuoka%2Cjp','Clear','céu limpo',21.00,20.55,21.01),(136,'2022-05-27','00:48:54','fukuroi%2Cshizuoka%2Cjp','Rain','chuva leve',21.00,19.01,20.55),(137,'2022-05-28','00:01:12','fukuroi%2Cshizuoka%2Cjp','Clear','céu limpo',22.00,22.21,22.21),(138,'2022-05-29','07:55:07','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',23.00,22.77,22.77),(139,'2022-06-01','09:07:13','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',24.00,23.88,23.88),(140,'2022-06-02','08:11:24','fukuroi%2Cshizuoka%2Cjp','Clouds','nuvens dispersas',24.00,20.77,23.88),(141,'2022-06-03','00:47:33','fukuroi%2Cshizuoka%2Cjp','Clear','céu limpo',21.00,20.55,20.55),(142,'2022-06-04','00:47:47','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',21.00,20.55,20.55),(143,'2022-06-05','09:03:18','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',25.00,24.99,24.99),(144,'2022-06-08','08:35:57','fukuroi%2Cshizuoka%2Cjp','Clouds','nuvens dispersas',23.00,19.77,22.77),(145,'2022-06-09','00:36:06','fukuroi%2Cshizuoka%2Cjp','Clear','céu limpo',18.00,18.32,18.32),(146,'2022-06-10','00:36:19','fukuroi%2Cshizuoka%2Cjp','Clouds','algumas nuvens',21.00,20.01,20.55),(147,'2022-06-11','00:02:38','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',22.00,21.01,21.66),(148,'2022-06-12','08:18:12','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',22.00,19.77,22.21),(149,'2022-06-15','07:40:41','fukuroi%2Cshizuoka%2Cjp','Rain','chuva leve',18.00,17.77,17.77),(150,'2022-06-16','08:33:21','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',22.00,20.77,22.21),(151,'2022-06-17','00:30:36','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',22.00,22.21,22.21),(152,'2022-06-18','06:26:53','fukuroi%2Cshizuoka%2Cjp','Rain','chuva moderada',22.00,22.21,22.21),(153,'2022-06-19','00:09:33','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',21.00,21.10,21.10),(154,'2022-06-20','08:58:12','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',26.00,23.77,25.55),(155,'2022-06-21','00:58:00','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',24.00,23.88,23.88),(156,'2022-06-22','00:58:14','fukuroi%2Cshizuoka%2Cjp','Rain','chuva leve',22.00,21.01,22.21),(157,'2022-06-23','00:58:27','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',24.00,23.88,23.88),(158,'2022-06-24','09:50:48','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',27.00,25.77,27.21),(159,'2022-06-25','07:25:26','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',26.00,25.55,25.55),(160,'2022-06-26','00:25:36','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',25.00,24.99,24.99),(161,'2022-06-29','08:23:08','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',28.00,27.77,28.77),(162,'2022-06-30','09:21:42','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',31.00,28.77,31.10),(163,'2022-07-01','00:21:49','fukuroi%2Cshizuoka%2Cjp','Clouds','algumas nuvens',26.00,25.55,25.55),(164,'2022-07-02','00:22:00','fukuroi%2Cshizuoka%2Cjp','Clouds','algumas nuvens',27.00,26.66,26.66),(165,'2022-07-03','09:26:54','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',29.00,28.01,28.88),(166,'2022-07-06','08:37:28','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',28.00,26.77,28.32),(167,'2022-07-07','00:06:11','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',26.00,26.01,26.01),(168,'2022-07-08','00:06:27','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',24.00,24.01,24.01),(169,'2022-07-09','00:06:45','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',23.00,23.01,23.01),(170,'2022-07-10','07:57:26','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',24.00,23.77,23.77),(171,'2022-07-13','10:33:52','fukuroi%2Cshizuoka%2Cjp','Clouds','algumas nuvens',28.00,27.77,28.01),(172,'2022-07-14','00:21:30','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',25.00,24.56,24.56),(173,'2022-07-15','00:21:45','fukuroi%2Cshizuoka%2Cjp','Rain','chuva moderada',24.00,23.78,23.78),(174,'2022-07-16','00:21:58','fukuroi%2Cshizuoka%2Cjp','Rain','chuva moderada',24.00,24.01,24.01),(175,'2022-07-17','08:56:42','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',23.00,22.77,24.01),(176,'2022-07-20','09:59:40','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',30.00,29.77,29.77),(177,'2022-07-21','00:00:56','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',26.00,25.85,25.85),(178,'2022-07-22','00:01:08','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',26.00,26.07,26.07),(179,'2022-07-23','00:01:21','fukuroi%2Cshizuoka%2Cjp','Clear','céu limpo',25.00,25.48,25.48),(180,'2022-07-24','00:07:30','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',26.00,25.73,25.73),(181,'2022-07-27','09:52:35','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',29.00,28.77,28.77),(182,'2022-07-28','00:52:42','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',26.00,25.72,25.72),(183,'2022-07-29','00:52:52','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',25.00,25.24,25.24),(184,'2022-07-30','00:53:03','fukuroi%2Cshizuoka%2Cjp','Clear','céu limpo',26.00,25.89,25.89),(185,'2022-07-31','07:42:24','fukuroi%2Cshizuoka%2Cjp','Clear','céu limpo',29.00,29.48,29.48),(186,'2022-08-03','09:57:50','fukuroi%2Cshizuoka%2Cjp','Clouds','algumas nuvens',33.00,32.77,32.77),(187,'2022-08-04','00:00:51','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',30.00,30.01,30.01),(188,'2022-08-05','00:01:11','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',26.00,26.01,26.01),(189,'2022-08-06','00:58:21','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',25.00,24.71,24.71),(190,'2022-08-07','08:46:05','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',27.00,26.77,28.01),(191,'2022-08-10','08:56:13','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',30.00,29.77,29.77),(192,'2022-08-11','08:32:19','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',28.00,27.77,27.77),(193,'2022-08-12','00:32:29','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',26.00,25.90,25.90),(194,'2022-08-13','08:51:54','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',25.00,24.01,24.77),(195,'2022-08-14','08:43:51','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',28.00,27.77,27.77),(196,'2022-08-15','08:52:54','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',30.00,29.77,29.77),(197,'2022-08-16','00:22:05','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',28.00,28.01,28.01),(198,'2022-08-17','08:22:01','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',27.00,26.77,26.77),(199,'2022-08-18','00:23:09','fukuroi%2Cshizuoka%2Cjp','Rain','chuva leve',26.00,26.12,26.12),(200,'2022-08-19','08:29:42','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',27.00,26.77,26.77),(201,'2022-08-20','08:26:24','fukuroi%2Cshizuoka%2Cjp','Clouds','nublado',27.00,26.77,26.77),(202,'2022-08-21','08:04:50','fukuroi%2Cshizuoka%2Cjp','Rain','chuva leve',25.00,24.77,26.01);
/*!40000 ALTER TABLE `weather` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Final view structure for view `viewProducts`
--

/*!50001 DROP TABLE IF EXISTS `viewProducts`*/;
/*!50001 DROP VIEW IF EXISTS `viewProducts`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`digitalDisplay`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `viewProducts` AS select `products`.`id` AS `id`,`products`.`prodCode` AS `prodCode`,`products`.`prodNamePTBR` AS `prodNamePTBR`,`products`.`prodNameJP` AS `prodNameJP`,`products`.`prodSize` AS `prodSize`,`products`.`prod_image` AS `prod_image`,`makers`.`maker_name_ptbr` AS `maker_name_ptbr`,`makers`.`maker_name_jp` AS `maker_name_jp`,`units`.`unit_text` AS `unit_text`,`price`.`normal_price` AS `normal_price`,`price_special`.`price_special` AS `price_special`,`price_special`.`status` AS `status`,`products`.`active` AS `active` from ((((`products` left join `makers` on(`products`.`makerID` = `makers`.`maker_id`)) left join `units` on(`products`.`saleUnitID` = `units`.`unit_id`)) left join `price` on(`products`.`prodCode` = `price`.`prodCode`)) left join `price_special` on(`products`.`prodCode` = `price_special`.`prodCode`)) where 0 <> 1 order by `products`.`prodNamePTBR` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-08-21 10:59:12
