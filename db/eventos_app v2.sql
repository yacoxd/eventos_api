CREATE DATABASE  IF NOT EXISTS `eventos_app` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `eventos_app`;
-- MySQL dump 10.13  Distrib 5.6.17, for Win32 (x86)
--
-- Host: localhost    Database: eventos_app
-- ------------------------------------------------------
-- Server version	5.6.20

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
-- Table structure for table `ev_event`
--

DROP TABLE IF EXISTS `ev_event`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ev_event` (
  `ev_id` int(11) NOT NULL AUTO_INCREMENT,
  `ev_title` varchar(250) NOT NULL,
  `ev_description` longtext NOT NULL,
  `ev_date_time` datetime DEFAULT NULL,
  `ev_user_created` varchar(250) DEFAULT NULL,
  `ev_date_created` datetime DEFAULT NULL,
  `ev_user_modified` varchar(250) DEFAULT NULL,
  `ev_date_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`ev_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ev_event`
--

LOCK TABLES `ev_event` WRITE;
/*!40000 ALTER TABLE `ev_event` DISABLE KEYS */;
INSERT INTO `ev_event` VALUES (1,'Evento 1','Descripcion 1','2016-10-12 00:00:00',NULL,NULL,NULL,NULL),(2,'Evento 2','Descripcion 2','2016-10-12 00:00:00',NULL,NULL,NULL,NULL),(3,'Evento 3','Descripcion 3','2016-10-12 00:00:00',NULL,NULL,NULL,NULL),(4,'Evento 4','Descripcion 4','2016-10-12 00:00:00',NULL,NULL,NULL,NULL),(5,'Evento 5','Descripcion 5','2016-10-12 00:00:00',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `ev_event` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ev_option`
--

DROP TABLE IF EXISTS `ev_option`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ev_option` (
  `op_id` int(11) NOT NULL AUTO_INCREMENT,
  `op_title` text NOT NULL,
  `op_user_created` varchar(250) DEFAULT NULL,
  `op_date_created` datetime DEFAULT NULL,
  `op_user_modified` varchar(250) DEFAULT NULL,
  `op_date_modified` datetime DEFAULT NULL,
  `op_question` int(11) NOT NULL,
  PRIMARY KEY (`op_id`),
  KEY `fk_option_question_idx` (`op_question`),
  CONSTRAINT `fk_option_question` FOREIGN KEY (`op_question`) REFERENCES `ev_question` (`qu_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ev_option`
--

LOCK TABLES `ev_option` WRITE;
/*!40000 ALTER TABLE `ev_option` DISABLE KEYS */;
INSERT INTO `ev_option` VALUES (1,'Gallo',NULL,NULL,NULL,NULL,1),(2,'Modelo',NULL,NULL,NULL,NULL,1),(3,'Corona',NULL,NULL,NULL,NULL,1),(4,'Nachos',NULL,NULL,NULL,NULL,2),(5,'Alitas',NULL,NULL,NULL,NULL,2),(6,'Queso fundido',NULL,NULL,NULL,NULL,2),(7,'Futbol ',NULL,NULL,NULL,NULL,3),(8,'Basquetbol',NULL,NULL,NULL,NULL,3),(9,'Baseball',NULL,NULL,NULL,NULL,3);
/*!40000 ALTER TABLE `ev_option` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ev_question`
--

DROP TABLE IF EXISTS `ev_question`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ev_question` (
  `qu_id` int(11) NOT NULL AUTO_INCREMENT,
  `qu_title` varchar(250) NOT NULL,
  `qu_description` longtext,
  `qu_user_created` varchar(250) DEFAULT NULL,
  `qu_date_created` datetime DEFAULT NULL,
  `qu_user_modified` varchar(250) DEFAULT NULL,
  `qu_date_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`qu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ev_question`
--

LOCK TABLES `ev_question` WRITE;
/*!40000 ALTER TABLE `ev_question` DISABLE KEYS */;
INSERT INTO `ev_question` VALUES (1,'Cerveza Prerida','Que cerveza te gusta más',NULL,NULL,NULL,NULL),(2,'Aperitivo','Que aperitivo te gusta más',NULL,NULL,NULL,NULL),(3,'Deporte','Que deporte te gusta más',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `ev_question` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ev_result_user_question`
--

DROP TABLE IF EXISTS `ev_result_user_question`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ev_result_user_question` (
  `ru_id` int(11) NOT NULL AUTO_INCREMENT,
  `ru_option` int(11) NOT NULL,
  `ru_user` int(11) NOT NULL,
  `ru_date_answer` datetime NOT NULL,
  PRIMARY KEY (`ru_id`),
  KEY `fk_result_user_option_idx` (`ru_option`),
  KEY `fk_result_user_user_idx` (`ru_user`),
  CONSTRAINT `fk_result_user_option` FOREIGN KEY (`ru_option`) REFERENCES `ev_option` (`op_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_result_user_user` FOREIGN KEY (`ru_user`) REFERENCES `ev_user` (`us_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ev_result_user_question`
--

LOCK TABLES `ev_result_user_question` WRITE;
/*!40000 ALTER TABLE `ev_result_user_question` DISABLE KEYS */;
INSERT INTO `ev_result_user_question` VALUES (1,1,1,'2016-01-31 20:55:45'),(2,2,1,'2016-01-31 20:55:59');
/*!40000 ALTER TABLE `ev_result_user_question` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ev_user`
--

DROP TABLE IF EXISTS `ev_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ev_user` (
  `us_id` int(11) NOT NULL AUTO_INCREMENT,
  `us_username` varchar(50) NOT NULL,
  `us_email` varchar(250) NOT NULL,
  `us_first_name` varchar(250) DEFAULT NULL,
  `us_last_name` varchar(250) DEFAULT NULL,
  `us_password` text,
  `us_gender` varchar(50) DEFAULT NULL,
  `us_dob` date DEFAULT NULL,
  `us_avatar` varchar(250) DEFAULT NULL,
  `us_user_created` varchar(250) DEFAULT NULL,
  `us_date_created` datetime DEFAULT NULL,
  `us_user_modified` varchar(250) DEFAULT NULL,
  `us_date_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`us_id`),
  UNIQUE KEY `us_username_UNIQUE` (`us_username`),
  UNIQUE KEY `us_email_UNIQUE` (`us_email`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ev_user`
--

LOCK TABLES `ev_user` WRITE;
/*!40000 ALTER TABLE `ev_user` DISABLE KEYS */;
INSERT INTO `ev_user` VALUES (1,'yacoxd','atellezsazo@gmail.com','Abner','Tellez','ac785d6fd8e6a6820365d4de2703b389',NULL,'1990-12-30','profile_picture_11454268707.jpg',NULL,NULL,'yacoxd','2016-01-31 20:31:49'),(2,'emonzon','emonzon@gmail.com','Edgar ','Monzon','ac785d6fd8e6a6820365d4de2703b389',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,'wale','wale@gmail.com','Waleska','Arana','ac785d6fd8e6a6820365d4de2703b389',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,'sam','sam@gmail.com','Sam','-','ac785d6fd8e6a6820365d4de2703b389',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(5,'yesee','yesee@gmail.com','Yesee','Portillo','ac785d6fd8e6a6820365d4de2703b389',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(6,'vivi','vivi@gmail.com','Vivian','Raquel','ac785d6fd8e6a6820365d4de2703b389',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(7,'register','register@gmail.com','Registro ','Registro','ac785d6fd8e6a6820365d4de2703b389',NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `ev_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ev_user_event`
--

DROP TABLE IF EXISTS `ev_user_event`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ev_user_event` (
  `ue_id` int(11) NOT NULL AUTO_INCREMENT,
  `ue_event` int(11) NOT NULL,
  `ue_user` int(11) NOT NULL,
  `ue_cant` int(11) NOT NULL,
  `ue_date` datetime DEFAULT NULL,
  PRIMARY KEY (`ue_id`,`ue_event`,`ue_user`),
  KEY `fk_user_event_user_idx` (`ue_id`),
  KEY `fk_user_event_event` (`ue_event`),
  KEY `fk_user_event_user` (`ue_user`),
  CONSTRAINT `fk_user_event_event` FOREIGN KEY (`ue_event`) REFERENCES `ev_event` (`ev_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_user_event_user` FOREIGN KEY (`ue_user`) REFERENCES `ev_user` (`us_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ev_user_event`
--

LOCK TABLES `ev_user_event` WRITE;
/*!40000 ALTER TABLE `ev_user_event` DISABLE KEYS */;
INSERT INTO `ev_user_event` VALUES (1,1,4,1,'2016-01-31 19:39:48'),(2,1,4,1,'2016-01-31 19:40:09');
/*!40000 ALTER TABLE `ev_user_event` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-01-31 14:52:43
