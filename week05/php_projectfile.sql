-- MySQL dump 10.13  Distrib 5.6.28, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: php_project
-- ------------------------------------------------------
-- Server version	5.6.28-0ubuntu0.15.04.1

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
-- Table structure for table `deliveries`
--

DROP TABLE IF EXISTS `deliveries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `deliveries` (
  `id` int(11) NOT NULL,
  `pick_up_location` varchar(100) DEFAULT NULL,
  `drop_off_location` varchar(100) DEFAULT NULL,
  `pick_up_time` datetime DEFAULT NULL,
  `drop_off_time` datetime DEFAULT NULL,
  `priority_level` int(11) DEFAULT NULL,
  `org_id` int(11) DEFAULT NULL,
  `billing_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_deliveries_org_id_idx` (`org_id`),
  CONSTRAINT `fk_deliveries_org_id` FOREIGN KEY (`org_id`) REFERENCES `organizations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deliveries`
--

LOCK TABLES `deliveries` WRITE;
/*!40000 ALTER TABLE `deliveries` DISABLE KEYS */;
INSERT INTO `deliveries` VALUES (0,'123 Treefoil Lane, Santa Barbara, CA','6591 Expo Way, Santa Barbara, CA','2016-02-04 13:23:15','2016-02-05 16:00:00',1,2,'2016-02-04');
/*!40000 ALTER TABLE `deliveries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `organizations`
--

DROP TABLE IF EXISTS `organizations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `organizations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `billing_address` varchar(100) DEFAULT NULL,
  `company_rate` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `organizations`
--

LOCK TABLES `organizations` WRITE;
/*!40000 ALTER TABLE `organizations` DISABLE KEYS */;
INSERT INTO `organizations` VALUES (1,'Planet Express','123 Industrial Way Suite #3','1050 Billing Way',2.5),(2,'Dave\'s Donuts','2678 Baker Street','2678 Baker Street',3.5),(3,'Bob\'s Burgers','5612 Seaview Lane','5612 Seaview Lane',4.45),(4,'NASA','300 E Street SW Washington D.C.','300 E Street SW Billing Dept Washington D.C.',4);
/*!40000 ALTER TABLE `organizations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `account_creation_date` datetime DEFAULT NULL,
  `account_last_login` datetime DEFAULT NULL,
  `org_id` int(11) DEFAULT NULL,
  `is_admin` tinyint(4) NOT NULL,
  `firstname` varchar(25) NOT NULL,
  `lastname` varchar(25) NOT NULL,
  `phone_number` varchar(25) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_users_org_id_idx` (`org_id`),
  CONSTRAINT `fk_users_org_id` FOREIGN KEY (`org_id`) REFERENCES `organizations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (2,'Kevin','foo','2016-01-01 01:01:01','2016-02-05 14:50:06',1,1,'Kevin','Andres','555-123-9090'),(3,'jfk1234','p4ssw0rD1','2016-02-04 13:06:29','2016-02-04 13:06:29',2,0,'John','Kennedy','539-192-1231'),(4,'Bob','ILoveHamburgers','2016-02-04 13:17:04','2016-02-04 13:17:04',3,0,'Bob','Belcher','555-321-1211'),(5,'Buzzy','IamBuzzAldrin1930120','2016-02-04 13:18:13','2016-02-04 13:18:13',4,0,'Buzz','Aldrin','912-912-0012'),(6,'LeeroyJenkins','PassWord','2016-02-05 14:52:22',NULL,1,1,'Leeroy','Jenkins','912-913-3312');
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

-- Dump completed on 2016-02-05 22:43:21
