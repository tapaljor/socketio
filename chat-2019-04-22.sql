-- MySQL dump 10.13  Distrib 5.7.25, for Linux (x86_64)
--
-- Host: localhost    Database: chat
-- ------------------------------------------------------
-- Server version	5.7.25-0ubuntu0.18.04.2

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
-- Table structure for table `chat`
--

DROP TABLE IF EXISTS `chat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time` int(64) DEFAULT NULL,
  `source` int(11) DEFAULT NULL,
  `destination` int(11) DEFAULT NULL,
  `message` text,
  `status` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1258 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chat`
--

LOCK TABLES `chat` WRITE;
/*!40000 ALTER TABLE `chat` DISABLE KEYS */;
INSERT INTO `chat` VALUES (1194,1554951133,300,299,'one',2),(1195,1554951138,299,300,'two',2),(1196,1554951141,300,299,'three',2),(1197,1554951143,299,300,'four',2),(1198,1554951215,301,299,'five',2),(1199,1554951221,299,301,'six',2),(1200,1554951225,301,299,'seven',0),(1201,1554951227,299,301,'eight',2),(1202,1555020064,299,300,'five',2),(1203,1555020072,300,299,'six',2),(1204,1555020073,300,299,'seven',2),(1205,1555020075,299,300,'eight',2),(1206,1555020080,299,300,'nine',2),(1207,1555020082,300,299,'ten',2),(1208,1555032011,301,300,'hello',2),(1209,1555032019,300,301,'Ohh I how are you doing?',2),(1210,1555032023,301,300,'I am doing fine',2),(1211,1555032024,301,300,'thank you',2),(1212,1555032031,301,300,'what can I do for you?',2),(1213,1555032035,300,301,'You can do noting?',2),(1214,1555032047,301,300,'well done',2),(1215,1555032050,300,301,'good',2),(1216,1555032082,301,300,'Khepar mepa',2),(1217,1555032092,300,301,'well good to konw that',2),(1218,1555032095,300,301,'good for you',2),(1219,1555032100,301,300,'yeah thatnk you so much for that',2),(1220,1555032831,301,300,'Good lord',2),(1221,1555032843,300,301,'What the hell',2),(1222,1555033475,300,301,'good lord',2),(1223,1555033485,301,300,'have you gone through that?',2),(1224,1555033490,300,301,'I did go through',2),(1225,1555033502,301,300,'good bye',2),(1226,1555033565,301,300,'good bye',0),(1227,1555033569,300,301,'see ya',2),(1228,1555207198,296,301,'Hello man Dhoni',2),(1229,1555207200,296,301,'How are you?',2),(1230,1555207209,301,296,'Hey man I am good thank you',2),(1231,1555207211,301,296,'how about you?',2),(1232,1555207220,296,301,'thanks for asking, I am pretty good here',2),(1233,1555207223,296,301,'what can I do for ya?',2),(1234,1555207230,301,296,'Just keepon enjoying',2),(1235,1555207231,301,296,'good for ya',2),(1236,1555261812,296,301,'Hey killer',2),(1237,1555261815,296,301,'how are you OIN',2),(1238,1555261824,301,296,'I am going good thank you',2),(1239,1555261829,296,301,'Ohh thats great',2),(1240,1555261830,296,301,'good luck then',2),(1241,1555261833,301,296,'Yap',2),(1242,1555262101,296,301,'good for ya',2),(1243,1555262119,296,301,'what else can you say?',2),(1244,1555262125,296,301,'what?',2),(1245,1555262401,296,301,'Mr Dhoni la',2),(1246,1555262405,296,301,'what?',2),(1247,1555262626,296,301,'hell',2),(1248,1555262629,296,301,'sadfh',2),(1249,1555262639,296,301,'com on',2),(1250,1555262768,301,296,'hwen',2),(1251,1555262773,301,296,'what you wish for?',2),(1252,1555262788,296,301,'Killer',2),(1253,1555262889,296,301,'where is that?',2),(1254,1555263092,296,301,'helll yes',2),(1255,1555263098,296,301,'hell yes',2),(1256,1555263113,301,296,'wat are you talking about?',0),(1257,1555263116,296,301,'noting',0);
/*!40000 ALTER TABLE `chat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gender`
--

DROP TABLE IF EXISTS `gender`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gender` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gendername` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gender`
--

LOCK TABLES `gender` WRITE;
/*!40000 ALTER TABLE `gender` DISABLE KEYS */;
INSERT INTO `gender` VALUES (1,'Male'),(2,'Female');
/*!40000 ALTER TABLE `gender` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `likedislike`
--

DROP TABLE IF EXISTS `likedislike`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `likedislike` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `loginid` int(11) DEFAULT NULL,
  `likerid` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=157 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `likedislike`
--

LOCK TABLES `likedislike` WRITE;
/*!40000 ALTER TABLE `likedislike` DISABLE KEYS */;
INSERT INTO `likedislike` VALUES (155,301,300,0),(156,294,300,0);
/*!40000 ALTER TABLE `likedislike` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `listcalendar`
--

DROP TABLE IF EXISTS `listcalendar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `listcalendar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `listcalendar`
--

LOCK TABLES `listcalendar` WRITE;
/*!40000 ALTER TABLE `listcalendar` DISABLE KEYS */;
INSERT INTO `listcalendar` VALUES (1,'Fire Female Mice'),(2,'Earth Male Dragon'),(3,'Earth Female Snake'),(4,'Iron Male Horse'),(5,'Iron Female Sheep'),(6,'Water Male Monkey'),(7,'Water Female Bird'),(8,'Wood Male Dog'),(9,'Wood Female Pig'),(10,'Fire Male Mice'),(11,'Fire Female Ox'),(12,'Earth Male Tiger'),(13,'Earth Female Rabbit'),(14,'Iron Male Dragon'),(15,'Iron Female Snake'),(16,'Water Male Horse'),(17,'Water Female Sheep'),(18,'Wood Male Monkey'),(19,'Wood Female Bird'),(20,'Fire Male Dog'),(21,'Fire Female Pig'),(22,'Earth Male Mice'),(23,'Earth Female Ox'),(24,'Iron Male Tiger'),(25,'Iron Female Rabbit'),(26,'Water Male Dragon'),(27,'Water Female Snake'),(28,'Wood Male Horse'),(29,'Wood Female Sheep'),(30,'Fire Male Monkey'),(31,'Fire Female Bird'),(32,'Earth Male Dog'),(33,'Earth Female Pig'),(34,'Iron Male Mice'),(35,'Iron Female Ox'),(36,'Water Male Tiger'),(37,'Water Female Rabbit'),(38,'Wood Male Dragon'),(39,'Wood Female Snake'),(40,'Fire Male Horse'),(41,'Fire Female Sheep'),(42,'Earth Male Monkey'),(43,'Earth Female Bird'),(44,'Iron Male Dog'),(45,'Iron Female Pig'),(46,'Water Male Mice'),(47,'Water Female Ox'),(48,'Wood Male Tiger'),(49,'Wood Female Rabbit'),(50,'Fire Male Dragon'),(51,'Fire Female Snake'),(52,'Earth Male Horse'),(53,'Earth Female Sheep'),(54,'Iron Male Monkey'),(55,'Iron Female Bird'),(56,'Water Male Dog'),(57,'Water Female Pig'),(58,'Wood Male Mice'),(59,'Wood Female Ox'),(60,'Fire Male Tiger');
/*!40000 ALTER TABLE `listcalendar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `listcountry`
--

DROP TABLE IF EXISTS `listcountry`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `listcountry` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(5) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=248 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `listcountry`
--

LOCK TABLES `listcountry` WRITE;
/*!40000 ALTER TABLE `listcountry` DISABLE KEYS */;
INSERT INTO `listcountry` VALUES (4,'AS','Austria'),(7,'AI','Anguilla'),(8,'AQ','Antarctica'),(9,'AG','Antigua and Barbuda'),(10,'AR','Argentina'),(11,'AM','Armenia'),(12,'AW','Aruba'),(13,'AU','Australia'),(14,'AS','Austria'),(21,'BE','Belgium'),(25,'BT','Bhutan'),(26,'BO','Bolivia'),(27,'BA','Bosnia & Herzegovina'),(28,'BW','Botswana'),(29,'BV','Bouvet Island'),(30,'BR','Brazil'),(31,'IO','British Indian Ocean'),(32,'BN','Brunei Darussalam'),(33,'BG','Bulgaria'),(34,'BF','Burkina Faso'),(35,'BI','Burundi'),(36,'KH','Cambodia'),(37,'CM','Cameroon'),(38,'CA','Canada'),(39,'CV','Cape Verde'),(40,'KY','Cayman Islands'),(41,'CF','Central Africa Rep'),(42,'TD','Chad'),(43,'CL','Chile'),(44,'CN','China'),(45,'CX','Christmas Island'),(46,'CC','Cocos'),(47,'CO','Colombia'),(48,'KM','Comoros'),(49,'CG','Congo'),(50,'CK','Cook Islands'),(51,'CR','Costa Rica'),(52,'CI','Ivory Coast'),(53,'HR','Croatia'),(54,'CU','Cuba'),(55,'CY','Cyprus'),(56,'CZ','Czech Republic'),(57,'DK','Denmark'),(58,'DJ','Djibouti'),(59,'DM','Dominica'),(60,'DO','Dominican Republic'),(61,'TP','East Timor'),(62,'EC','Ecuador'),(63,'EG','Egypt'),(64,'SV','El Salvador'),(65,'GQ','Equatorial Guinea'),(66,'ER','Eritrea'),(67,'EE','Estonia'),(68,'ET','Ethiopia'),(69,'FK','Falkland Islands'),(70,'FO','Faroe Islands'),(71,'FJ','Fiji'),(72,'FI','Finland'),(73,'FR','France'),(74,'FX','France, Metropolitan'),(75,'GF','French Guiana'),(76,'PF','French Polynesia'),(77,'TF','French Southern'),(78,'GA','Gabon'),(79,'GM','Gambia'),(80,'GE','Georgia'),(81,'DE','Germany'),(82,'GH','Ghana'),(83,'GI','Gibraltar'),(84,'GR','Greece'),(85,'GL','Greenland'),(86,'GD','Grenada'),(87,'GP','Guadeloupe'),(88,'GU','Guam'),(89,'GT','Guatemala'),(90,'GN','Guinea'),(91,'GW','Guinea-Bissau'),(92,'GY','Guyana'),(93,'HT','Haiti'),(94,'HM','Heard & McDonald'),(95,'HN','Honduras'),(96,'HK','Hong Kong'),(97,'HU','Hungary'),(98,'IS','Iceland'),(99,'IN','India'),(100,'ID','Indonesia'),(101,'IR','Iran'),(102,'IQ','Iraq'),(103,'IE','Ireland'),(104,'IL','Israel'),(105,'IT','Italy'),(106,'JM','Jamaica'),(107,'JP','Japan'),(108,'JO','Jordan'),(109,'KZ','Kazakhstan'),(110,'KE','Kenya'),(111,'KI','Kiribati'),(112,'KP','Korea (North)'),(113,'KR','Korea (South)'),(114,'KW','Kuwait'),(115,'KG','Kyrgyzstan'),(116,'LA','Laos'),(117,'LV','Latvia'),(118,'LB','Lebanon'),(119,'LS','Lesotho'),(120,'LR','Liberia'),(121,'LY','Libya'),(122,'LI','Liechtenstein'),(123,'LT','Lithuania'),(124,'LU','Luxembourg'),(125,'MO','Macau'),(126,'MK','Macedonia'),(127,'MG','Madagascar'),(128,'MW','Malawi'),(129,'MY','Malaysia'),(130,'MV','Maldives'),(131,'ML','Mali'),(132,'MT','Malta'),(133,'MH','Marshall Islands'),(134,'MQ','Martinique'),(135,'MR','Mauritania'),(136,'MU','Mauritius'),(137,'YT','Mayotte'),(138,'MX','Mexico'),(139,'FM','Micronesia'),(140,'MD','Moldova'),(141,'MC','Monaco'),(142,'MN','Mongolia'),(143,'MS','Montserrat'),(144,'MA','Morocco'),(145,'MZ','Mozambique'),(146,'MM','Myanmar'),(147,'NA','Namibia'),(148,'NR','Nauru'),(149,'NP','Nepal'),(150,'NL','Netherlands'),(151,'AN','Netherlands Anti'),(152,'NC','New Caledonia'),(153,'NZ','New Zealand'),(154,'NI','Nicaragua'),(155,'NE','Niger'),(156,'NG','Nigeria'),(157,'NU','Niue'),(158,'NF','Norfolk Island'),(159,'MP','Northern Mariana'),(160,'NO','Norway'),(161,'OM','Oman'),(162,'PK','Pakistan'),(163,'PW','Palau'),(164,'PA','Panama'),(165,'PG','Papua Guinea'),(166,'PY','Paraguay'),(167,'PE','Peru'),(168,'PH','Philippines'),(169,'PN','Pitcairn'),(170,'PL','Poland'),(171,'PT','Portugal'),(172,'PR','Puerto Rico'),(173,'QA','Qatar'),(174,'RE','Reunion'),(175,'RO','Romania'),(176,'RU','Russian Federation'),(177,'RW','Rwanda'),(178,'KN','Saint Kitts'),(179,'LC','Saint Lucia'),(180,'VC','Saint Vincent'),(181,'WS','Samoa'),(182,'SM','San Marino'),(183,'ST','Sao Tome'),(184,'SA','Saudi Arabia'),(185,'SN','Senegal'),(186,'SC','Seychelles'),(187,'SL','Sierra Leone'),(188,'SG','Singapore'),(189,'SK','Slovak Republic'),(190,'SI','Slovenia'),(191,'SB','Solomon Islands'),(192,'SO','Somalia'),(193,'ZA','South Africa'),(194,'GS','S. Georgia'),(195,'SP','Spain'),(196,'LK','Sri Lanka'),(197,'SH','St. Helena'),(198,'PM','St. Pierre'),(199,'SD','Sudan'),(200,'SR','Suriname'),(202,'SZ','Swaziland'),(203,'SE','Sweden'),(204,'CH','Switzerland'),(206,'TW','Taiwan'),(208,'TZ','Tanzania'),(209,'TH','Thailand'),(210,'TG','Togo'),(211,'TK','Tokelau'),(212,'TO','Tonga'),(213,'TT','Trinidad & Tobago'),(215,'TR','Turkey'),(219,'UG','Uganda'),(220,'UA','Ukraine'),(222,'GB','Great Britain'),(223,'US','United States of America'),(224,'UM','US Minor Outlying'),(225,'UY','Uruguay'),(228,'VA','Vatican City State'),(229,'VE','Venezuela'),(230,'VN','Viet Nam'),(232,'VI','Virgin Is(US)'),(236,'YU','Yugoslavia'),(237,'ZR','Zaire'),(240,'TB','Tibet');
/*!40000 ALTER TABLE `listcountry` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `listhobby`
--

DROP TABLE IF EXISTS `listhobby`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `listhobby` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(18) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `listhobby`
--

LOCK TABLES `listhobby` WRITE;
/*!40000 ALTER TABLE `listhobby` DISABLE KEYS */;
INSERT INTO `listhobby` VALUES (1,'Reading'),(2,'Watching TV'),(3,'Family Time'),(4,'Going to Movies'),(5,'Fishing'),(6,'Computer'),(7,'Gardening'),(8,'Renting Movies'),(9,'Walking'),(10,'Exercise'),(11,'Listening to Music'),(12,'Entertaining'),(13,'Hunting'),(14,'Team Sports'),(15,'Shopping'),(16,'Traveling'),(17,'Sleeping'),(18,'Socializing'),(19,'Sewing'),(20,'Golf'),(21,'Church Activities'),(22,'Relaxing'),(23,'Playing Music'),(24,'Housework'),(25,'Crafts'),(26,'Watching Sports'),(27,'Bicycling'),(28,'Playing Cards'),(29,'Hiking'),(30,'Cooking'),(31,'Eating Out'),(32,'Dating Online'),(33,'Swimming'),(34,'Camping'),(35,'Skiing'),(36,'Working on Cars'),(37,'Writing'),(38,'Boating'),(39,'Motorcycling'),(40,'Animal Care'),(41,'Bowling'),(42,'Painting'),(43,'Running'),(44,'Dancing'),(45,'Horseback Riding'),(46,'Tennis'),(47,'Theater'),(48,'Billiards'),(49,'Beach'),(50,'Volunteer Work'),(51,'Football'),(52,'Body Building');
/*!40000 ALTER TABLE `listhobby` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `listregion`
--

DROP TABLE IF EXISTS `listregion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `listregion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `countrycode` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=174 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `listregion`
--

LOCK TABLES `listregion` WRITE;
/*!40000 ALTER TABLE `listregion` DISABLE KEYS */;
INSERT INTO `listregion` VALUES (1,'Aargau','CH'),(2,'Alberta','CA'),(3,'Albuquerque','US'),(4,'Atlanta','US'),(5,'Austin','US'),(6,'Australia','AU'),(7,'Bangalore','IN'),(8,'Basel','CH'),(9,'Brussels','BE'),(10,'Bern','CH'),(11,'Bhandara','IN'),(12,'Bhodgarnang','BT'),(13,'Bhopal','IN'),(14,'BTS, Bir','IN'),(15,'Dege, Bir','IN'),(16,'Bodh Gaya','IN'),(17,'Bomdila','IN'),(18,'Boston','US'),(19,'Boudha','NP'),(20,'Boulder','US'),(21,'British Columbia','CA'),(22,'Bumthang','BT'),(23,'Chakrata','IN'),(24,'Charlottesville','US'),(25,'Chauntra','IN'),(26,'Chicago','US'),(27,'Clement Town','IN'),(28,'Colorado','US'),(29,'Connecticut','US'),(30,'Dalhousie','IN'),(31,'Darjeeling','IN'),(32,'Dekyiling','IN'),(33,'Delhi','IN'),(34,'Deutschland','DE'),(35,'Dharamsala','IN'),(36,'Dhorpatan','NP'),(37,'Bylakuppe','IN'),(38,'Dimapur','IN'),(39,'Dolanji','IN'),(40,'Flawil','CH'),(41,'Gangtok','IN'),(42,'Geneva','CH'),(43,'Glarus','CH'),(44,'Herbertpur','IN'),(45,'Hongtso','BT'),(46,'Horgen','CH'),(47,'Hungary','HU'),(48,'Hunsur','IN'),(49,'Idaho','US'),(50,'Italy','IT'),(51,'Ithaca','US'),(52,'Jaigaon','IN'),(53,'Jalpaiguri','IN'),(54,'Jampaling','NP'),(55,'Jawalakhel','NP'),(56,'Jigmenang','BT'),(57,'jorpati','NP'),(58,'Kalimpong','IN'),(59,'Kamrao','IN'),(60,'karche','BT'),(61,'Kathmandu City','NP'),(62,'Khasakha','BT'),(63,'Kolkata','IN'),(64,'Kollegal','IN'),(65,'Kullu Manali','IN'),(66,'Ladakh Jangthang','IN'),(67,'Landquart','CH'),(68,'Leh','IN'),(69,'Liechtenstein','LI'),(70,'Lindsay','CA'),(71,'London','GB'),(72,'Lotserok','NP'),(172,'Dickyiling','IN'),(74,'Luzern','CH'),(75,'Madison','US'),(76,'Maine','US'),(77,'Mainpat','IN'),(78,'Manang','NP'),(79,'Mandu Wala','IN'),(80,'Massachusetts','US'),(81,'Miao','IN'),(82,'Michigan','US'),(83,'Minnesota','US'),(84,'Missoula','US'),(85,'Montana','US'),(86,'Moscow','RU'),(87,'Muenchwilen','CH'),(88,'Mundgod','IN'),(89,'Mussoorie','IN'),(90,'Nainital','IN'),(91,'New York & New Jersey','US'),(92,'North California','US'),(93,'Nubri','NP'),(94,'Oetwil','CH'),(95,'Ontario','CA'),(96,'Odisha','IN'),(97,'Pado','BT'),(98,'Paljorling','NP'),(99,'Pandoh','IN'),(100,'Paonta Sahib','IN'),(101,'Paris','FR'),(102,'Pema Tsal','NP'),(103,'Pennsylvania','US'),(104,'Philadelphia','US'),(105,'Poland','PL'),(106,'Portland','US'),(107,'Pretoria','ZA'),(108,'Puruwala','IN'),(109,'Quebec','CA'),(110,'Rajpur','IN'),(111,'Rapperswil & Jona','CH'),(112,'So Wa Ra','NP'),(113,'Ravangla','IN'),(114,'Rikon','CH'),(115,'Rongshar','NP'),(116,'Ruti','CH'),(117,'Saharanpur','IN'),(118,'Salt Lake City','US'),(119,'Salugara','IN'),(120,'Santa Fe','US'),(121,'Sataun','IN'),(122,'Schaffhausen','CH'),(123,'Seattle','US'),(124,'Shillong','IN'),(125,'Shimla','IN'),(126,'Solothurn','CH'),(127,'Solu Khumbu','NP'),(128,'Sonada','IN'),(129,'Srinagar','IN'),(130,'Swayambhu','NP'),(131,'Switzerland','CH'),(132,'Taiwan','TW'),(133,'Tashi Gang','NP'),(134,'Tashi Jong','IN'),(135,'Tashi Ling','NP'),(136,'Tashi Palkhiel','NP'),(137,'Tenzin Gang','IN'),(138,'Texas','US'),(139,'Tezu','IN'),(140,'Thimphu','BT'),(141,'Tokyo','JP'),(142,'Toronto','CA'),(143,'Tuggen','CH'),(144,'Turbenthal','CH'),(145,'Tuting','IN'),(146,'Utah','US'),(147,'Uznach','CH'),(148,'Varanasi','IN'),(149,'Vermont','US'),(150,'Virginia','US'),(151,'Wadenswil','CH'),(152,'Walung','NP'),(153,'Washington','US'),(154,'Wattwil','CH'),(155,'Zurich','CH'),(156,'South California','US'),(157,'Norway','NO'),(158,'Austria','AS'),(159,'Mandi','IN'),(160,'Tso Pema','IN'),(161,'Tawang','IN'),(162,'Indiana','US'),(171,'Sikkim','IN'),(164,'Capitol Area','US'),(165,'Lausanne','CH'),(166,'Trogen','CH'),(167,'Washington DC','US'),(173,'NIL','TB');
/*!40000 ALTER TABLE `listregion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `listword`
--

DROP TABLE IF EXISTS `listword`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `listword` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `listword`
--

LOCK TABLES `listword` WRITE;
/*!40000 ALTER TABLE `listword` DISABLE KEYS */;
INSERT INTO `listword` VALUES (1,'mother fucker'),(2,'fuck'),(3,'nigger'),(4,'nigro'),(5,'vagina'),(6,'dick'),(7,'cock'),(8,'chicken'),(9,'sex'),(10,'Whore');
/*!40000 ALTER TABLE `listword` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log`
--

DROP TABLE IF EXISTS `log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `which` varchar(50) DEFAULT NULL,
  `time` int(64) DEFAULT NULL,
  `logouttime` int(64) DEFAULT NULL,
  `user` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log`
--

LOCK TABLES `log` WRITE;
/*!40000 ALTER TABLE `log` DISABLE KEYS */;
/*!40000 ALTER TABLE `log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `registerdate` int(64) DEFAULT NULL,
  `username` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `salt` varchar(200) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `gender` int(1) DEFAULT NULL,
  `country` varchar(5) DEFAULT NULL,
  `region` int(11) DEFAULT NULL,
  `hobby` int(11) DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=306 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login`
--

LOCK TABLES `login` WRITE;
/*!40000 ALTER TABLE `login` DISABLE KEYS */;
INSERT INTO `login` VALUES (271,1501426164,'tomcruise','55f1aad7173ba14a19be4327d43b5d7a','f94dced2475f3741605b381b1043762c',2,1,'US',83,14,'9fc5e9fa295a25832133bfc6611c21c0'),(272,1501427268,'sharppen','2cd27965c7409970d3b0218e8033134c','a691948ea1144ee36ea464938b26f978',2,2,'IN',17,15,'bfbf7dd7a2eab7f0d13f4db59d7f033d'),(273,1501512374,'m4','6439122144943bfde64efca80e0a469b','3eaee145af5d8be98d5334517f3edb18',0,2,'NP',98,NULL,NULL),(276,1501513815,'m5','381f1d3dff1b0efad63e22488c39f0e7','fee20739570a572477a20aef6b6490cf',2,2,'IN',68,NULL,NULL),(277,1503209350,'test','582b5ad0c9695a2916376dfff247e9d9','b3f748aa5c7b09130f39d6557bc8e1a5',0,2,'IN',25,NULL,NULL),(278,1505995254,'m10','4774e4ed24fe48910c5021be8a1c4998','689f3e2965d715f21013073e82a8aa32',2,2,'IN',15,NULL,NULL),(279,1506592307,'tashi','588b594f8095c145539c86146d55573d','57bccbf025e974885e96df8ad3e73ce6',2,1,'IN',15,NULL,'f3f30ca3e22a920fb41831edbf97fe7c'),(280,1506592402,'chozom','db7a87d555b7dfd3d9e53941d2f6493a','222657e22c45fa31e9157cb32b95d6ea',2,2,'IN',7,44,'805f1935995d5533dbcd1986d5a12efe'),(281,1506592445,'chotso','ed561f89f02a89ef823d1f7c17d40dc0','f81d93bf162ef3dc21adf526d49da336',2,2,'IN',81,20,'58085f161f89f8ed518c80f0b20f8ea1'),(282,1508497751,'dhompa','4716342987197dd1b4e223f7341efb07','6c1bb3feebc5866157f5211a39b41e40',2,2,'IN',27,15,'bde49efbe24c2c98f28e81a396b54af3'),(283,1508498009,'killer','843380c9f713aeec9740c4bfe985c268','57eb868b48b1f1ed28367137e5e1f9fc',2,1,'IN',16,13,'145301dafa31ca0f0c78109f91d37055'),(284,1512886946,'zebra','00ba2763424f91c28c420350412384d3','a8e844ad6532fcac7827062a90222f44',2,1,'IN',16,10,'dfcaf7b9056f92365dbadbb7966fca8c'),(285,1512966517,'sunil','51cf247a806664e1d3bc30740e3994c0','71970ae361e126b2ea1ae6a34fa74b71',2,1,'IN',15,5,'b6cca2489afea4f87784feeba7bb159d'),(286,1512969175,'king','3122c9b34567930f77d05c2be6e82ddb','30213dfe231773e9048784bdff21133d',2,1,'BE',9,2,'5381e034deed7a9c16d504af63253512'),(287,1512974916,'denish boy','9f01f682b80ddab021bfda5716866db2','d4400cc1231aa36fe1bee7414b4a4c18',2,1,'NL',1,14,'21cd15e14b74828e9a47b0905287f5bc'),(288,1512977373,'toxic','539f61433842f9605314db3db8221670','06647ff624694464851426487663961c',2,2,'AU',6,17,'64703a13bda1fc7e7db7dab8505b9f51'),(289,1512990209,'forty','53d6fc1bcec3157c5ee454ac856df1d2','1e682c24f1535edfa8423c9a61acd21a',2,2,'IN',14,4,'3d8a68f63f687feace0ed913e05359d9'),(290,1513140316,'aish','6d12cd49e0df76e04283c9b5f3533b9c','606adc9d4d2ca8aa3f21bb1dc5603792',2,2,'AI',1,11,'8bebeb6776e17e2e226b8447b71b7b05'),(291,1513140350,'tiger','9ebbd261494d04fcc28f8201b5a64e87','cc2a2df6305866e3dba83f275c589376',2,2,'BE',9,5,NULL),(292,1513140415,'m9','ee3013dbd462bb7c75aa02c53a49843f','2c0b9d6f36cf2f2de08bcb4c55997e52',0,1,'US',20,4,NULL),(293,1528363886,'priety','4875ed98f6d6e2f44c1363c3d3d088d6','9c9483ced585b1bcdf2e156eb3a2da1b',2,1,'IN',148,2,'4f927fa446aa33bc432a24db1e0fac16'),(294,1553572162,'shahrukh','f30628a1ed929db96af83536c611937e','7b6fd19b235c298189dccab570c0b5a2',2,1,'CA',21,7,'93248c5bd0517ca57ea2798d7c38237d'),(295,1553572694,'dollar','afd645b634af55d8ddb358b4ed30ec38','c0fa13fc699c1de58e682afd46e5095e',2,1,'CA',95,2,'d86a5fc5309cfb4c89f1402a117612e7'),(296,1553572870,'train','06298c625a20cc3bd3a4b85fe2dcaab3','59230ca07d70a53a533fdb957e73a2db',0,1,'CA',95,39,'5dee3d16ac6aed011510b3e03e56dae5'),(297,1553572912,'india','e21888eb454cfc486f6847c585ce4d47','e6ad0d04bc58bc6b8f5e76201eed700a',2,1,'DK',1,2,'1ae169943909462bd398103ea55f9f85'),(298,1553572963,'m25','38d5b4385b93cc01e3e252271763de06','1d11b530341cf59a053d0758daae2d04',2,1,'CA',70,2,NULL),(299,1553644149,'tapaljor','c3fcfea06f5852184bd8f8592a604ae5','0461609598168e990bf503a055289187',0,1,'CA',95,3,'7d620990c87cc78a7086a7466e0ab8ae'),(300,1553744402,'tatpachozom','12b6e55440e2de2a7d32f2ff9acf114c','c26b425cc1d5fee4b5ef30d0087ed341',0,2,'IN',7,4,'eb7aa12ad470ae8923793c5c0c848775'),(301,1553744543,'dhoni','7b640e255d1e71861527b9d7a9b89f22','0918b581efd3b241cfe3a7cd94e621a4',0,1,'CA',95,5,'e39807cd984aeaa71ab3eddc30150f79'),(302,1553744596,'terminator','5d6e43f326699f181383297d5e19f6de','64e3cc1400b8682a75111528a29d2ee2',0,1,'CA',142,5,'a605201079976ad0b7b332c5bd1623fa'),(304,1554847089,'salman','1c31d1e626af611bf51dc017e4297a63','56ba96e99f8299f36e987cc93bf7d1bb',0,2,'US',24,4,'4b443b448fc0235af9e4deb9bd2a730c'),(305,1554861432,'terminator22','958e549fa4495a08f735d3f65158dc13','2804373f3fcf7180a4677d3705d99dcc',2,1,'IN',14,6,NULL);
/*!40000 ALTER TABLE `login` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-04-22 20:49:14
