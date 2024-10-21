-- MariaDB dump 10.19  Distrib 10.5.12-MariaDB, for debian-linux-gnu (aarch64)
--
-- Host: localhost    Database: digitalDisplay
-- ------------------------------------------------------
-- Server version	10.5.12-MariaDB-0ubuntu0.21.04.1

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `makers`
--

LOCK TABLES `makers` WRITE;
/*!40000 ALTER TABLE `makers` DISABLE KEYS */;
INSERT INTO `makers` VALUES (1,'takara','TAKARA','タカラ','2021-05-16 23:10:15'),(2,'brasil','BRASIL','ブラジル','2021-05-16 23:10:34'),(3,'australia','AUSTRÁLIA','オーストラリア','2021-05-16 23:11:14'),(4,'usa','USA','アメリカ','2021-05-20 18:35:45'),(5,'mexico','MÉXICO','メキシコ','2021-05-20 19:00:57');
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
INSERT INTO `price` VALUES (1,'4701',1980,'2021-06-08 10:28:43'),(2,'4702',1680,'2021-06-08 10:28:43'),(3,'4703',1780,'2021-06-08 10:28:43'),(4,'4704',1880,'2021-08-20 13:09:12'),(5,'4705',3200,'2021-08-06 12:34:10'),(6,'4706',1980,'2021-06-08 10:28:43'),(7,'4707',1980,'2021-06-08 10:28:43'),(8,'4708',1680,'2021-06-08 10:28:43'),(9,'4709',1880,'2021-06-13 15:46:30'),(10,'4710',3380,'2021-06-08 10:28:43'),(11,'4711',2880,'2021-06-08 10:28:43'),(12,'4712',1880,'2021-08-06 12:40:37'),(13,'4714',4980,'2021-06-08 10:28:43'),(14,'4718',2180,'2021-06-08 10:28:43'),(15,'4719',1780,'2021-06-08 10:28:43'),(16,'4720',1980,'2021-06-08 10:28:43'),(18,'4724',2880,'2021-06-11 10:16:59'),(19,'4730',1880,'2021-06-21 18:24:37'),(20,'470201',1680,'2021-06-30 11:15:11');
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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `price_special`
--

LOCK TABLES `price_special` WRITE;
/*!40000 ALTER TABLE `price_special` DISABLE KEYS */;
INSERT INTO `price_special` VALUES (4,'4710',2880,'2021-06-08 10:28:43',1),(5,'4711',2780,'2021-06-08 10:28:43',1),(6,'4714',3400,'2021-06-08 10:28:43',1),(9,'4724',2680,'2021-08-06 12:42:16',1),(11,'4730',1780,'2021-08-06 12:42:34',1),(16,'4705',2980,'2021-08-21 08:02:19',1),(17,'4709',1780,'2021-08-21 08:03:46',1);
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
INSERT INTO `products` VALUES (1,'4701','ALCATRA C/ GORDURA','牛らんぷ','australia','1kg',1,'4701.jpg','2021-05-20 16:53:53','2021-06-08 10:28:43',1),(2,'4702','COXÃO DURO','牛外モモ','australia','1kg',1,'4702.jpg','2021-05-20 16:55:46','2021-06-08 10:28:43',1),(3,'4703','PATINHO','牛芯玉','australia','1kg',1,'4703.jpg','2021-05-20 16:57:36','2021-06-08 10:28:43',1),(4,'4704','COXÃO MOLE','牛内モモ','australia','1kg',1,'4704.jpg','2021-05-20 16:59:09','2021-06-08 10:28:43',1),(5,'4705','CONTRA FILÉ','牛ロース','australia','1kg',1,'4705.jpg','2021-05-20 17:01:40','2021-06-08 10:28:43',1),(6,'4706','PONTA DE PEITO','牛とうがらし','australia','1kg',1,'4706.jpg','2021-05-20 17:03:09','2021-06-08 10:28:43',1),(7,'4707','ACÉM','牛肩ロース','australia','1kg',1,'4707.jpg','2021-05-20 17:04:52','2021-06-08 10:28:43',1),(8,'4708','COSTELA DE BOI S/ OSSO','牛ばら','australia','1kg',1,'4708.jpg','2021-05-20 17:06:34','2021-06-08 10:28:43',1),(9,'4709','MÚSCULO DE BOI','牛スネ肉','australia','1kg',1,'4709.jpg','2021-05-20 17:07:46','2021-06-08 10:28:43',0),(10,'4710','FRALDINHA','牛ハラミ','australia','1kg',1,'4710.png','2021-05-20 17:11:32','2021-06-08 10:28:43',1),(11,'4711','CUPIM','牛チャッククレスト','australia','1kg',1,'4711.png','2021-05-20 18:13:32','2021-06-08 10:28:43',0),(12,'4712','MÚSCULO','牛スネ肉','australia','1kg',1,'4712.jpg','2021-05-20 18:20:30','2021-06-08 10:28:43',1),(13,'4714','BISTECA DE BOI C/ OSSO','牛Tボーンステーキ','australia','1kg',1,'4714.jpg','2021-05-20 18:22:38','2021-06-08 10:28:43',0),(14,'4718','COSTELA DE BOI C/ OSSO','牛ショットリーブ','usa','1kg',1,'4718.jpg','2021-05-20 18:37:01','2021-06-08 10:28:43',1),(15,'4719','PALETA','牛腕（肩三角）','australia','1kg',1,'4719.jpg','2021-05-20 18:57:50','2021-06-08 10:28:43',1),(16,'4720','BANANINHA','牛リブフィンガー','mexico','1kg',1,'4720.jpg','2021-05-20 19:01:38','2021-06-08 10:28:43',1),(18,'4724','PICANHA','牛いちぼ','takara','1kg',1,'4724.jpg','2021-06-11 10:16:59','2021-06-17 11:51:17',1),(19,'4730','MAMINHA','牛トモサンカク','takara','1kg',1,'4730.png','2021-06-21 18:24:37','2021-08-15 09:31:46',1),(20,'470201','LAGARTO','牛シキンボウ（ローストビーフ用）','takara','1kg',1,'470201.jpg','2021-06-27 10:19:16','2021-06-27 10:29:01',1);
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
-- Current Database: `digitalDisplay`
--

USE `digitalDisplay`;

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
/*!50013 DEFINER=`tj`@`%` SQL SECURITY DEFINER */
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

-- Dump completed on 2021-09-07 14:22:12
