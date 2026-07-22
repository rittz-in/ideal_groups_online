-- MySQL dump 10.13  Distrib 5.7.23-23, for Linux (x86_64)
--
-- Host: localhost    Database: idealgro_web
-- ------------------------------------------------------
-- Server version	5.7.23-23

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
/*!50717 SELECT COUNT(*) INTO @rocksdb_has_p_s_session_variables FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'performance_schema' AND TABLE_NAME = 'session_variables' */;
/*!50717 SET @rocksdb_get_is_supported = IF (@rocksdb_has_p_s_session_variables, 'SELECT COUNT(*) INTO @rocksdb_is_supported FROM performance_schema.session_variables WHERE VARIABLE_NAME=\'rocksdb_bulk_load\'', 'SELECT 0') */;
/*!50717 PREPARE s FROM @rocksdb_get_is_supported */;
/*!50717 EXECUTE s */;
/*!50717 DEALLOCATE PREPARE s */;
/*!50717 SET @rocksdb_enable_bulk_load = IF (@rocksdb_is_supported, 'SET SESSION rocksdb_bulk_load = 1', 'SET @rocksdb_dummy_bulk_load = 0') */;
/*!50717 PREPARE s FROM @rocksdb_enable_bulk_load */;
/*!50717 EXECUTE s */;
/*!50717 DEALLOCATE PREPARE s */;

--
-- Table structure for table `about_bridge_network`
--

DROP TABLE IF EXISTS `about_bridge_network`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `about_bridge_network` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `main_title` varchar(100) NOT NULL,
  `sub_title` varchar(100) NOT NULL,
  `description` longtext NOT NULL,
  `image` varchar(250) NOT NULL,
  `button_name` varchar(100) NOT NULL,
  `url` varchar(100) NOT NULL,
  `is_active` enum('active','inactive') NOT NULL,
  `is_deleted` enum('yes','no') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `about_bridge_network`
--

LOCK TABLES `about_bridge_network` WRITE;
/*!40000 ALTER TABLE `about_bridge_network` DISABLE KEYS */;
INSERT INTO `about_bridge_network` VALUES (1,'ABOUT','BRIDGE NETWORKS','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>','1668001619aboutimg.jpg','Give now','#','active','no');
/*!40000 ALTER TABLE `about_bridge_network` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_links`
--

DROP TABLE IF EXISTS `admin_links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `link` varchar(200) DEFAULT NULL,
  `order_no` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_links`
--

LOCK TABLES `admin_links` WRITE;
/*!40000 ALTER TABLE `admin_links` DISABLE KEYS */;
INSERT INTO `admin_links` VALUES (1,'Dashboard','dashboard',NULL,NULL),(2,'User','user',NULL,NULL),(3,'User Add','user_add',NULL,10),(4,'User Edit','user_edit',NULL,10),(5,'User Delete','user_delete',NULL,10),(6,'Home Banners','home_banners',NULL,NULL),(7,'Home Banner Add','home_banner_add',NULL,6),(8,'Home Banner Edit','home_banner_edit',NULL,6),(9,'Home Banner Delete','home_banner_delete',NULL,6),(10,'Banners','banners',NULL,NULL),(11,'Banner Add','banner_add',NULL,10),(12,'Banner Edit','banner_edit',NULL,10),(13,'Banner Delete','banner_delete',NULL,10),(14,'Settings','settings',NULL,NULL),(15,'Events','events',NULL,NULL),(16,'Event Add','event_add',NULL,15),(17,'Event Edit','event_edit',NULL,15),(18,'Event Delete','event_delete',NULL,15),(19,'Member Services','member_services',NULL,NULL),(20,'Member Service Add','member_service_add',NULL,19),(21,'Member Service Edit','member_service_edit\r\n',NULL,19),(22,'Member Service Delete','member_service_delete\r\n',NULL,19),(23,'Gallery Categories','gallery_categories',NULL,NULL),(24,'Gallery Category Add','gallery_category_add\r\n',NULL,23),(25,'Gallery Category Edit','gallery_category_edit\r\n',NULL,23),(26,'Gallery Category Delete','gallery_category_delete\r\n',NULL,23),(27,'Gallery Images','gallery_images',NULL,NULL),(28,'Gallery Image Add','gallery_image_add\r\n',NULL,27),(29,'Gallery Image Edit','gallery_image_edit\r\n',NULL,27),(30,'Gallery Image Delete','gallery_image_delete\r\n',NULL,27),(31,'Ministries','ministries',NULL,NULL),(32,'Ministry Add','ministry_add',NULL,31),(33,'Ministry Edit','ministry_edit',NULL,31),(34,'Ministry Delete','ministry_delete',NULL,31);
/*!40000 ALTER TABLE `admin_links` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_user`
--

DROP TABLE IF EXISTS `admin_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(200) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `is_client` varchar(225) NOT NULL DEFAULT 'no',
  `first_name` text CHARACTER SET utf8,
  `last_name` text CHARACTER SET utf8,
  `gender` varchar(10) DEFAULT NULL COMMENT 'Male, Female, Other',
  `dob` date DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `mobile2` varchar(20) DEFAULT NULL,
  `join_date` varchar(20) DEFAULT NULL,
  `profile_pic` varchar(150) DEFAULT NULL,
  `admin_user_type` varchar(20) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `address` varchar(500) DEFAULT NULL,
  `country` varchar(200) DEFAULT NULL,
  `region` varchar(200) DEFAULT NULL,
  `city` varchar(200) DEFAULT NULL,
  `residential_address` text,
  `business_address` text,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0- Inactive, 1- Active',
  `isApprove` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0- Inactive, 1- Active',
  `role` int(11) DEFAULT NULL,
  `encryption_admin_user_id` text,
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no',
  `role_resources` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_user`
--

LOCK TABLES `admin_user` WRITE;
/*!40000 ALTER TABLE `admin_user` DISABLE KEYS */;
INSERT INTO `admin_user` VALUES (1,'+Zo3JqaeUctFQop7pRUQZg==','info@newfaithfgfc.org','yes','Project','Pvt','Male','2020-02-05',NULL,'8866168594',NULL,NULL,'','2022-11-18 09:31:29','Ahm','India','Gujarat','Ahm',NULL,NULL,1,1,1,NULL,'no',NULL),(14,'+Zo3JqaeUctFQop7pRUQZg==','admin@gmail.com','no','KMS','Pvt','Male','2020-02-05',NULL,'',NULL,NULL,'','2024-01-05 14:30:30','','','','',NULL,NULL,1,1,1,NULL,'no',NULL);
/*!40000 ALTER TABLE `admin_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `banners`
--

DROP TABLE IF EXISTS `banners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `banners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(225) DEFAULT NULL,
  `button_text` varchar(225) DEFAULT NULL,
  `button_link` varchar(225) DEFAULT NULL,
  `slug_url` varchar(225) DEFAULT NULL,
  `sub_title` varchar(100) NOT NULL,
  `is_page` int(110) NOT NULL DEFAULT '0',
  `order_by` varchar(10) NOT NULL,
  `image` text,
  `page` varchar(255) DEFAULT NULL,
  `banner_start` varchar(100) NOT NULL,
  `banner_end` varchar(100) NOT NULL,
  `is_active` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banners`
--

LOCK TABLES `banners` WRITE;
/*!40000 ALTER TABLE `banners` DISABLE KEYS */;
INSERT INTO `banners` VALUES (19,'dsa',NULL,NULL,'dsa','',0,'6','1670233390img7.png','home','','','active','2022-12-05 03:43:19','2024-01-08 12:16:08',NULL,'yes'),(20,'Complete Branding Solution',NULL,NULL,'complete-branding-solution','',0,'','1719561322header-bg1.jpg','home','','','active','2024-06-28 02:55:22','2024-06-28 02:55:22',NULL,'no');
/*!40000 ALTER TABLE `banners` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `slug_url` varchar(100) NOT NULL,
  `image` varchar(250) NOT NULL,
  `cat_img` varchar(250) NOT NULL,
  `quality` varchar(250) NOT NULL,
  `qty` varchar(250) NOT NULL,
  `price` varchar(250) NOT NULL,
  `is_active` enum('active','inactive') NOT NULL,
  `is_deleted` enum('yes','no') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (12,'Logo Designing','logo-designing','1669975615logodesign.png','','','','','active','no'),(13,'Flyers Design and Printing','flyers-design-and-printing','1669975639flyerdesign.png','16720583961666414461mainbanner.jpg','','','','active','no'),(14,'Brochere Design and Printing','brochere-design-and-printing','1669975656brocherdesign.png','','','','','active','no'),(15,'Banners Design and Printing','banners-design-and-printing','1669975667bannerdesign.png','','','','','active','no'),(16,'Visitting Cards Design and printing','visitting-cards-design-and-printing','1669975682visitingcard.png','','','','','active','no'),(17,'LED Office Board making','led-office-board-making','1669975699ledboard.png','','','','','active','no'),(18,'Stationery Printing Work','stationery-printing-work','1669975717stationaryicon.png','','','','','active','no'),(19,'Complete Office Branding','complete-office-branding','1669975736officebranding.png','','','','','active','no'),(20,'I\'d Card Making','id-card-making','1669975771makingcard.png','','','','','active','no'),(21,'Social Media Marketing','social-media-marketing','1669975781socialmedia.png','','','','','active','no'),(22,'Website Development','website-development','1669975805website.png','','','','','active','no'),(24,'Testing Category','testing-category','16722971741669975615logodesign.png','1672062003download4.png','NT Card (Plastic Card),Matt + Uv Embossed,NT Card (Plastic Card)','10,100,300','20,34,435','active','no');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `catlog_information`
--

DROP TABLE IF EXISTS `catlog_information`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `catlog_information` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` varchar(100) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `quality` varchar(100) NOT NULL,
  `qty` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `catlog_information`
--

LOCK TABLES `catlog_information` WRITE;
/*!40000 ALTER TABLE `catlog_information` DISABLE KEYS */;
INSERT INTO `catlog_information` VALUES (13,'23','Vipul','prajapati','9374508191','vcprajapati.mscit@gmail.com','Matt + Uv Embossed','20'),(14,'23','Vipul','Prajapati','1234567890','shivamgoswami2357@gmail.com','Matt + Uv Embossed','10'),(15,'13','shivam','asd222','1234567890','shiv@gmail.com','testing','10'),(16,'23','Rajesh bhai','Patel','9374508191','vcprajapati.mscit@gmail.com','Matt + Uv Embossed','10'),(17,'13','Vipul','','9374508191','shiv@gmail.com','testing','10'),(18,'24','MyName','','MyName','cpsjrmzz@testing-your-form.info','NT Card (Plastic Card)','Alice'),(19,'24','John','','Hello','ayglxbrv@testing-your-form.info','NT Card (Plastic Card)','John');
/*!40000 ALTER TABLE `catlog_information` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `slug_url` varchar(100) NOT NULL,
  `image` varchar(250) NOT NULL,
  `is_active` enum('active','inactive') NOT NULL,
  `is_deleted` enum('yes','no') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` VALUES (3,'Advance Step','advance-step','166998736928.jpg','active','no'),(4,'Arya','arya','1669987378logo1.jpg','active','no'),(5,'Gets By Cusion','gets-by-cusion','1669987420logo2.jpg','active','no'),(6,'Life Style','life-style','1669987447logo3.jpg','active','no'),(7,'Nancy','nancy','1669987457logo4.jpg','active','no'),(8,'3D Crue','3d-crue','1669987481logo5.jpg','active','no'),(9,'Orthos One','orthos-one','1669987491logo6.jpg','active','no'),(10,'Meldic','meldic','1669987502logo7.jpg','active','no'),(11,'Techno','techno','1669987514logo8.jpg','active','no'),(12,'Fit Bytes','fit-bytes','1669987530logo9.jpg','active','no'),(13,'Barodian Bidz','barodian-bidz','1669987545logo10.jpg','active','no'),(14,'Puroga','puroga','1669987555logo11.jpg','active','no'),(15,'Parasmani','parasmani','1669987566logo12.jpg','active','no'),(16,'Prak','prak','1669987576logo13.jpg','active','no'),(17,'janan','janan','1669987587logo14.jpg','active','no'),(18,'Adcuesta','adcuesta','1669987597logo15.jpg','active','no'),(19,'Tribe Society','tribe-society','1669987632logo16.jpg','active','no'),(20,'KC','kc','1669987641logo17.jpg','active','no'),(21,'Mitro','mitro','1669987648logo18.jpg','active','no'),(22,'Naksha','naksha','1669987679logo19.jpg','active','no'),(23,'Rathod','rathod','1669987690logo20.jpg','active','no'),(24,'Mayur','mayur','1669987700logo21.jpg','active','no'),(25,'Shivam','shivam','1669987710logo22.jpg','active','no'),(26,'Krishna','krishna','1669987719logo23.jpg','active','no'),(27,'Smart Investor','smart-investor','1669987734logo24.jpg','active','no'),(28,'YBCI','ybci','1669987743logo25.jpg','active','no'),(29,'OM','om','1669987751logo26.jpg','active','no'),(30,'Kanha','kanha','1669987779logo27.jpg','active','no'),(31,'fdsfdfs_Vipul','fdsfdfs_vipul','1669988113logo23.jpg','active','yes'),(32,'5 Guys Wholesale','5-guys-wholesale','1677317202Logo-01.jpg','active','no'),(33,'The Maharaja Sayajirao University','the-maharaja-sayajirao-university','1719552386Logo.jpg','active','no');
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `message` varchar(250) NOT NULL,
  `is_active` enum('active','inactive') NOT NULL,
  `is_deleted` enum('yes','no') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts`
--

LOCK TABLES `contacts` WRITE;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
INSERT INTO `contacts` VALUES (1,'shivam','shivamgoswami2357@gmail.com','9374508191','xvx','active','no'),(2,'Vipul','shiv@gmail.com','9374508191','Testing ','active','no'),(3,'Vipul','nigefaciha@mailinator.com','9374508191','xvx','active','no'),(4,'Vipul','vcprajapati.mscit@gmail.com','9374508191','Testing','active','no'),(5,'vipul','vcprajapati.mscit@gmail.com','9374508191','Testing message','active','no'),(6,'Vipul Prajapati','vcprajapati.mscit@gmail.com','9374508191','Testing message','inactive','no'),(7,'shivam','shiv@gmail.com','9374508191','Testing Message','inactive','no'),(8,'Iyla','ikVvmi.dbjmttb@wheelry.boats','961-209-39-47','Roland Rice','inactive','no'),(9,'James P.','pat@aneesho.com','3128780396','Do you need help with graphic design - brochures, banners, flyers, advertisements, social media posts, logos etc? \r\n\r\nWe charge a low fixed monthly fee. Let me know if you\'re interested and would like to see our portfolio.\r\n','inactive','no'),(10,'Darshan Jain','idealinfosoft21@gmail.com','8460753102','hi','inactive','no'),(11,'VincentEneld','shanihill@hotmail.com','81981367573','Join forces with https://SellAccs.net and thrive in the booming market of online account transactions! As a partner, you\'ll gain access to a cutting-edge platform designed for seamless buying and selling experiences. Benefit from competitive commissi','inactive','no'),(12,'JosephZes','mjkwgmz85fgkc3i@tempmail.us.com','85654477883','ToMyAccount.com is dedicated to providing high-quality, verified PVA accounts for all your social media needs. Our accounts are created using unique server IPs to ensure they work effectively and securely. Shop with us for a hassle-free experience an','inactive','no'),(13,'Amandatiervec','amandaCHIZCALMc@gmail.com','84524284352','Just thinking about you gives me chills… come closer  -  https://rb.gy/es66fc?chiple','inactive','no'),(14,'Jaydeep Mistry','jaydeep.m@leons-group.com','8000118085','We need corporate brochure design service of our products. please connect with us for more information. ','inactive','no'),(15,'Jaydeep Mistry','jaydeep.m@leons-group.com','8000118085','We need corporate brochure design service of our products. please connect with us for more information. ','inactive','no'),(16,'Kalpesh Patel','hr.mgr@expelprosys.com','9898891147','Subject: Request for Quotation –Corporate Employees  ID Card with RFID, Holder & Lanyard (60 Nos.)\r\nDear M/s.  Ideal Group,\r\nGreetings from Expel Prosys Private Limited.\r\nWe are looking to print employee ID cards with RFID functionality. Please find ','inactive','no'),(17,'Steffen Burbidge','steffen.burbidge@outlook.com','8220943727','Google is killing your traffic — and no one is coming to help.\r\n\r\nLet me say it upfront:\r\n\r\n-- This might look like spam… but it might also save your website. --\r\n\r\nIf your traffic has been mysteriously dropping, and your once-thriving content isn’t ','inactive','no'),(18,'Eva Barksdale','barksdale.eva@gmail.com','544674895','I’m going to show you how to harness our AI engine to churn out viral, pro‑quality videos fast while avoiding manual editing headaches, pricey freelancers and clunky software, and you’re guaranteed to start seeing results in seconds.\r\n\r\nBecause...\r\n\r','inactive','no'),(19,'Georgia Dawbin','dawbin.georgia@gmail.com','9615245396','The world\'s first Autoresponder to send unlimited Emails to Unlimited suscribers by Instantly cloning any URL, Website, Store, or Landing Page, Forever with no monthly Fees. !!\r\n\r\nUnlock unlimited email sends with Free SMTP & instantly clone any emai','inactive','no'),(20,'Layne Heathershaw','heathershaw.layne@yahoo.com','7066825261','How you can wake up with an additional $1.000 - $ 5.000 in your Bank account every single day.\r\n\r\n... without needing to create your own product, websites, or personally sell anything yourself.\r\n\r\nInside this free training, you will discover:\r\n\r\n- Th','inactive','no'),(21,'DerekGew','tqtxnkcmj5gvab1@tempmail.us.com','81197256867','https://ToMyAccount.com offers verified PVA accounts in bulk for all your social media needs. Our accounts are secure, reliable, and created using unique server IPs to ensure they function perfectly. Trust us for fast delivery and exceptional service','inactive','no'),(22,'Domenic Mercier','mercier.domenic65@gmail.com','7756190059','Rank higher on Google Maps with keyword tracking, listing protection, and customer engagement.\r\n\r\nWant to rank higher on Google Maps without dealing with the boring SEO grind?\r\n\r\nYou need a solution that automates the busywork, so you can boost visib','inactive','no'),(23,'Magaret Culp','magaret.culp46@hotmail.com','353497781','The end of Guessing. \r\n\r\nThe start of Scaling.\r\n\r\nThe first AI platform that engineers Facebook ad winners instead of gambling with guesswork (in minutes, not hours)\r\n\r\n2025 has been the toughest year for paid ads. Every advertiser feels it. Few talk','inactive','no'),(24,'Bhavini chasia','chasiabhavu13@gmail.com','7016123646','Could you please share the details of your design packages, including pricing and what’s included in each?','inactive','no'),(25,'TommyTrait','urbmocyvyooz7m4@tempmail.us.com','83116161266','For secure verified accounts, look no further than https://AccStores.com. We provide a variety of PVA accounts that are perfect for marketing, personal use, or business growth. With fast delivery and a wide selection, https://AccStores.com is your tr','inactive','no'),(26,'OliviaImace','oliviaClailm358@hotmail.com','81771545345','Hey, I just stumbled onto your site… are you always this good at catching attention, or did you make it just for me? Write to me on this website ---  rb.gy/3pma6x?Imace  ---  my username is the same, I\'ll be waiting.','inactive','no'),(27,'OliviaImace','isabellaClailm221@yahoo.com','82912463857','Hey, I just stumbled onto your site… are you always this good at catching attention, or did you make it just for me? Write to me on this website ---  rb.gy/ydlgvk?Imace  ---  my username is the same, I\'ll be waiting.','inactive','no'),(28,'IsabellaImace','oliviaClailm964@hotmail.com','87529232939',' We noticed that your website hasn\'t been receiving much traffic lately. As a friendly reminder, we offer exclusive advertising packages that can greatly boost your online presence and attract new visitors to your site.  --- rb.gy/ydlgvk?Imace ','inactive','no'),(29,'mzrlegpdsw','nnfhuvgw@testform.xyz','+1-116-012-4719','rizxrzgpnjzenkjvfyufflnilropnr','inactive','no'),(30,'Nick','hello@aeroleads.com','+1 (628) 282 4380','Hi Ideal Groups team,\r\n\r\nI\'m the developer of AeroLeads (https://aeroleads.com). I have built a free Chrome plugin that helps you find emails and phone numbers directly from LinkedIn.\r\n\r\nYou can also download contacts, do company research, and manage','inactive','no'),(31,'AvaImace','emmaClailm826@hotmail.com','87331244319',' \r\nIf you\'re looking to expand your audience and connect with like-minded individuals, consider promoting your site on our popular dating platform, --- rb.gy/34p7i3?Imace. With millions of active users worldwide, it\'s the perfect place to find meanin','inactive','no'),(32,'NARTYTRYUT3045817NEYHRTGE','tjyxhbwy@polosmail.com','81737441464','METYUTYJ3045817MAMYJRTH','inactive','no'),(33,'AmeliaImace1648','ameliapoeva159699@gmail.com','88361126852',' \"Barely legal nymph wants to sin.\"  Here  --  https://rb.gy/8rrwju?Triarce ','inactive','no'),(34,'Shashank Gupta','dy3921569@gmail.com','7065040985','Hello Team,\r\nWe specialize in helping businesses grow through SMS marketing, lead generation, verified business owner databases, and WhatsApp Business API solutions.\r\nIf you are looking to reach more customers and boost your sales, we’d love to help.','inactive','no'),(35,'IsabellaImace3346','oliviapoeva257066@hotmail.com','85915296616',' \r\n\"Gorgeous nymphomaniac yearns for release.\"  Here --  https://rb.gy/8rrwju?Triarce ','inactive','no'),(36,'IsabellaImace1619','isabellapoeva699965@hotmail.com','88368858176',' \"Barely legal nymph wants to sin.\"  Here  --   rb.gy/8rrwju?Imace ','inactive','no'),(37,'AvaImace8658','avapoeva168747@yahoo.com','84764167171',' \"Naughty vixen eager to share her nude pics.\" Here  --  https://rb.gy/8rrwju?Triarce ','inactive','no'),(38,'biasoussy','f2hu4v1e@yahoo.com','89179642241','Photos for my escort application are uploaded.   \r\nLet me know if the quality is good.   \r\nPreview: https://tinyurl.com/4hhsd77e','inactive','no'),(39,'EmmaImace5652','avapoeva295399@yahoo.com','82296523877',' \r\nSeduction queen wants to strip and post her nudes. Here  --   rb.gy/8rrwju?Imace ','inactive','no'),(40,'biasoussy','fckm82e7@yahoo.com','84627544722','Photos for my escort application are uploaded.   \r\nLet me know if the quality is good.   \r\nPreview: https://tinyurl.com/yc59s2y8','inactive','no'),(41,'OliviaImace3522','isabellapoeva465669@hotmail.com','87174229142',' \r\nInsatiable minx desires to upload racy photos. Here  --   rb.gy/8rrwju?Imace ','inactive','no'),(42,'biasoussy','fvxlztxk@gmail.com','89454217692','Photos for my escort application are uploaded.   \r\nLet me know if the quality is good.   \r\nPreview: https://tinyurl.com/y3df4m2z','inactive','no'),(43,'biasoussy','ykz9jmte@yahoo.com','82798349281','Photos for my escort application are uploaded.   \r\nLet me know if the quality is good.   \r\nPreview: https://tinyurl.com/3r2fhxrr','inactive','no'),(44,'EmmaImace6035','ameliapoeva391398@gmail.com','84891211667',' “Barely-legal seductress hungers for forbidden pleasure.”  Here  --   rb.gy/3fy54w?Imace ','inactive','no'),(45,'EmmaImace7170','ameliapoeva95431@yahoo.com','81765232937',' \r\n “Sensual adult nymph seeks a rush of ecstatic desire.”  Here --  rb.gy/3fy54w?Imace  ','inactive','no'),(46,'OliviaImace4719','oliviapoeva301822@yahoo.com','85731236145','  \r\n \"Carnal temptress demands irresistible passion.\"  Here  -- rb.gy/3fy54w?Imace ','inactive','no'),(47,'biasoussy','19lk5ga6@hotmail.com','81917467169','Photos for my escort application are uploaded.   \r\nLet me know if the quality is good.   \r\nPreview: https://tinyurl.com/yc33t622','inactive','no'),(48,'EmmaImace5026','ameliapoeva168675@yahoo.com','86531691568','  \r\n \"Sensual vixen longs for tantalizing ecstasy.\"  Here  -- rb.gy/3fy54w?Imace ','inactive','no'),(49,'AmeliaImace5155','oliviapoeva704258@yahoo.com','85695319618','  \r\n \"Erotic minx desires to explore her carnal desires.\"  Here  -- https://rb.gy/3fy54w?Triarce ','inactive','no'),(50,'AmeliaImace6493','emmapoeva392489@yahoo.com','81624739963','  \r\n \"Carnal temptress demands irresistible passion.\"  Here  -- https://girlsfun.short.gy/UbzVKx?Triarce ','inactive','no'),(51,'EmmaImace939','emmapoeva25343@yahoo.com','86839665536','  \r\n \"Carnal temptress demands irresistible passion.\"  Here  -- https://Kj3fz2f.short.gy/ueeSek?Triarce ','inactive','no'),(52,'EmmaImace5353','isabellapoeva285052@gmail.com','84967369242',' \"Enchanting nymphomaniac seeks steamy indulgence.\"  Here  --   Kj3fz2f.short.gy/ueeSek?Imace ','inactive','no'),(53,'AvaImace1567','emmapoeva616768@gmail.com','87365962447','  \r\n \"Exotic siren craves the thrill of forbidden temptation.\"  Here --  https://Kj3fz2f.short.gy/ueeSek?Triarce','inactive','no'),(54,'biasoussy','1k2exzf7@gmail.com','85545511298','Photos for my escort application are uploaded.   \r\nLet me know if the quality is good.   \r\nPreview: https://tinyurl.com/mpwk987d','inactive','no'),(55,'AmeliaImace1958','emmapoeva286672@gmail.com','83346594158','  \r\n \"Can you help me unleash the wild side I\'ve been keeping inside?\"    -  Kj3fz2f.short.gy/ueeSek?Imace ','inactive','no'),(56,'biasoussy','gmb27rdi@icloud.com','88959885348','Photos for my escort application are uploaded.   \r\nLet me know if the quality is good.   \r\nPreview: https://tinyurl.com/3a83v5f7','inactive','no'),(57,'biasoussy','a52qmkxm@yahoo.com','81858964425','Photos for my escort application are uploaded.   \r\nLet me know if the quality is good.   \r\nPreview: https://tinyurl.com/2zkmh7tx','inactive','no'),(58,'AmeliaImace9005','avapoeva54172@gmail.com','85117119516','I promise this night will be spectacular   -  Kj3fz2f.short.gy/ueeSek?Imace','inactive','no'),(59,'biasoussy','nu40vzth@yahoo.com','89586685465','Photos for my escort application are uploaded.   \r\nLet me know if the quality is good.   \r\nPreview: https://tinyurl.com/3kamj29z','inactive','no'),(60,'biasoussy','9ni10yqj@hotmail.com','87623959293','Photos for my escort application are uploaded.   \r\nLet me know if the quality is good.   \r\nPreview: https://tinyurl.com/3ef344sv','inactive','no'),(61,'EmmaImace469','oliviapoeva277597@yahoo.com','86837622541','Come over and we\'ll lose ourselves in pleasure   -   https://nMm5id.short.gy/u2GPx3?Triarce ','inactive','no'),(62,'AmeliaImace6706','isabellapoeva782678@gmail.com','89456973716','IвЂ™m longing for your intimate touch   -   https://nMm5id.short.gy/u2GPx3?Triarce ','inactive','no'),(63,'AmeliaImace9004','ameliapoeva32443@hotmail.com','82255483695','I\'m aching to be close to you again   -    nMm5id.short.gy/u2GPx3?Imace','inactive','no'),(64,'Nick','hello@aeroleads.com','+1 (628) 282 4380','Hi Ideal Groups team,\r\n\r\nI\'m the developer of AeroLeads (https://aeroleads.com). I have built a free Chrome plugin that helps you find emails and phone numbers directly from LinkedIn.\r\n\r\nYou can also download contacts, do company research, and manage','inactive','no'),(65,'AvaImace8491','emmapoeva514062@gmail.com','88463896832','IвЂ™m in the mood for some real fun, come play with me.   -  Los12c1f.short.gy/zNHDEZ?Imace ','inactive','no'),(66,'EmmaImace5069','avapoeva271854@gmail.com','87823284676','Just took some photos that are way too hot for Instagram.   -  https://telegra.ph/Enter-01-31?Triarce ','inactive','no'),(67,'EmmaImace6415','oliviapoeva61946@gmail.com','89954574969','Feeling so needy tonight, come see what I\'m doing in private.   -  https://telegra.ph/Enter-01-31?Triarce ','inactive','no'),(68,'votowupxlu','kunrytow@checkyourform.xyz','+1-615-713-0935','mfhlpldsfeuwhttiezuwnpjklugnsm','inactive','no'),(69,'biasoussy','gpurlb56@icloud.com','85936148883','Depressed mood dragging you down? You\'re not alone вЂ” and you don\'t have to stay stuck. Reliable solutions for better days ahead, delivered quietly to your door. Secure, affordable, no hassle. See what\'s available today. \r\nhttps://tinyurl.com/32b5fc','inactive','no'),(70,'biasoussy','q1vpsc62@gmail.com','81163463815','Photos for my escort application are uploaded.   \r\nLet me know if the quality is good.   \r\nPreview: https://tinyurl.com/tnmnc4mr','inactive','no'),(71,'Salim vahora','dagwssb@gmail.com','7567774077','Want to print menu','inactive','no'),(72,'NARTYTRYUT1049491NEYHRTGE','obalfnqq@polosmail.com','88762647559','MERYTRH1049491MARETRYTR','inactive','no'),(73,'NARYTHY390292NEYRTHYT','alcislll@polosmail.com','88154864626','MERTHYTJTJ390292MAMYJRTH','inactive','no'),(74,'NARETGR225500NEHTYHYHTR','ybfremui@polosmail.com','83221894914','MEKYUJTYJ225500MARETRYTR','inactive','no'),(75,'biasoussy','bbi9vet6@yahoo.com','89152882191','Photos for my escort application are uploaded.   \r\nLet me know if the quality is good.   \r\nPreview: https://tinyurl.com/ypwcbh5a','inactive','no'),(76,'vqmiudpweo','jjksptkd@immenseignite.info','+1-669-189-3430','ehxfeinexovmwjyvpjkvuojnrsgdyz','inactive','no'),(77,'grgsstosnw','sthnvhsu@immenseignite.info','+1-169-532-3231','vqjwynnugwelfzmwgojkqypnsitdwd','inactive','no'),(78,'NARYTHY1083274NERTHRTYHR','burrell63215@lettersboxmail.com','86973791363','MERTYHRTHYHT1083274MARETRYTR','inactive','no');
