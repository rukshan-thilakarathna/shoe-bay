-- MariaDB dump 10.19  Distrib 10.5.18-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: wine
-- ------------------------------------------------------
-- Server version	10.5.18-MariaDB

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
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admins` (
  `idz` int(11) NOT NULL AUTO_INCREMENT,
  `un` varchar(20) NOT NULL,
  `pw` varchar(255) NOT NULL,
  `emails` varchar(255) NOT NULL COMMENT 'emails to send orders',
  `az` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idz`),
  UNIQUE KEY `ez` (`un`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,'admin','$2y$10$zlpL2hkzvSOS4RNjcLlQH.xvIBwGB5fUu.LQ.VvjKO0Nm/WOs7Jpu','cellers.wine@gmail.com',1);
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `cn` varchar(100) NOT NULL COMMENT 'cat name',
  `cd` varchar(550) NOT NULL COMMENT 'cat desc',
  `od` tinyint(4) NOT NULL COMMENT 'display order on menu',
  `iz` varchar(50) NOT NULL COMMENT 'image',
  `mn` tinyint(4) NOT NULL COMMENT 'display on menu 0-no,1-yes',
  `mt` varchar(100) NOT NULL COMMENT 'meta title',
  `md` varchar(255) NOT NULL COMMENT 'meta desc',
  `uz` varchar(120) NOT NULL COMMENT 'pagename',
  `az` tinyint(4) NOT NULL COMMENT '0-not,1-active',
  PRIMARY KEY (`cid`),
  UNIQUE KEY `uz` (`uz`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Red Wine','Dinner, lunch, meeting someone special or family, taking a classy bottle of wine always has been the tradition. Here at Cellers we have a wide selection, including the best from the Old and New World, sparkling wines for a celebration and dessert wines fit for a special occasion.',1,'wine.jpg',1,'Red Wine','Red Wine','red-wine',1),(2,'Beer','Beers start out as an ale or a lager, and their specific styles and flavors continue to evolve from there. Under the broad ale category, there are numerous types of beer, including pale ales, India pale ales (IPA), porters, stouts, and wheat and Belgian styles. Lagers encompass a range of styles, including the pale Pilsners and German Helles and the darker American lagers.',2,'beer.jpg',1,'','','beer',1),(3,'Spirits','If you are someone who truly enjoys a spirit and love to talk about it to your friends & family, we got you covered. Whether you love gin, vodka, rum, Cognac or Tequila, we have all time favourites, new discoveries and everything in between.',3,'spirits.jpg',1,'','','spirits',1),(4,'Champagne','We have the bubbles all you need for a competitive price from easy drinking prosecco, elegant English sparkling wine to wide variety of most renowned names in the market.',4,'champagne.jpg',1,'','','champagne',1),(5,'Liqueurs & Mixers','We have them in flavours unimaginable. Liqueurs are the perfect excuse to treat yourself and others with a special bottle. ',5,'liquor.jpg',1,'','','liqueurs-mixers',1),(6,'Miniatures','Fancy trying something new but not too sure if you will like the change, miniatures are a great way to see if that transition works for you. This is a great way to find out, before buying a full size bottle.',6,'miniatures.jpg',1,'','','miniatures',1),(7,'Craft Beer','Craft Beer is individually brewed batches of beer - all made with the finest of ingredients, care, skill and knowledge of the process. Experimenting with different styles allows craft brewers to be versatile in style. Our shop has an always changing selection of craft beers for you to try.',7,'craft-beer.jpg',1,'','','craft-beer',1),(8,'White Wine','Dinner, lunch, meeting someone special or family, taking a classy bottle of wine always has been the tradition. Here at Cellers we have a wide selection, including the best from the Old and New World, sparkling wines for a celebration and dessert wines fit for a special occasion. ',1,'',1,'','','white-wine',1),(9,'Rose Wine','When a winemaker desires to impart more tannin and color to red wine, some of the pink juice from the must can be removed at an early stage in what is known as the Saignee (from French bleeding) method. The red wine remaining in the vats is intensified as a result of the bleeding, because the volume of juice in the must is reduced, and the must involved in the maceration becomes more concentrated. The pink juice that is removed can be fermented separately to produce rose',1,'',0,'','','rose-wine',1),(10,'Ales','Buy beer online from a beer shop that knows the beauty of a great brew. Choose from hundreds of delicious beers from around the world, with beer to suit all tastes and requirements. Can you really buy beer online? And can beer be delivered? You bet! Whether youâ€™re stocking up for the week or buying for a big gathering, come in to our shop and go through the selection or simply go through the list below to satisty your thirst.',1,'',0,'','','ales',1),(11,'Cider','When life gives you lemons, make lemonade. When life gives you apples, youâ€™re in business. The fermentation of 1 of your 5 a day leads to a beverage that has been at the forefront of the UK brewing scene for millennia. The UK consumes more cider per capita than any other country in the world and for good reason. Cider is an incredibly versatile product and when paired with perry and other such fruits, becomes one of the most sought after alcoholic drinks in the world. ',1,'',0,'','','cider',1),(12,'Port','Port is a sweet, red, fortified wine from Portugal. Port wine is most commonly enjoyed as a dessert wine because its richness. There are several styles of Port, including red, white, rosÃ©, and an aged style called Tawny Port.',1,'',0,'','','port',1),(17,'Beer (Multipacks)','',2,'',1,'','','beer-mulipacks',1);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `items` (
  `idz` int(11) NOT NULL AUTO_INCREMENT,
  `na` varchar(100) NOT NULL COMMENT 'name',
  `cd` varchar(100) DEFAULT NULL COMMENT 'code name',
  `ca` int(11) NOT NULL COMMENT 'cat id',
  `uz` varchar(120) DEFAULT NULL COMMENT 'page name',
  `iz` varchar(50) DEFAULT NULL COMMENT 'image',
  `ab` varchar(550) DEFAULT NULL COMMENT 'description',
  `pr` decimal(6,2) DEFAULT NULL COMMENT 'price',
  `vo` varchar(10) DEFAULT NULL COMMENT 'volume',
  `pe` varchar(10) DEFAULT NULL COMMENT 'percentage',
  `co` varchar(120) DEFAULT NULL COMMENT 'country/Speciality',
  `br` varchar(120) DEFAULT NULL COMMENT 'brand',
  `dt` date NOT NULL COMMENT 'datetime',
  `mt` varchar(100) DEFAULT NULL COMMENT 'meta title',
  `md` varchar(255) DEFAULT NULL COMMENT 'meta desc',
  `az` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0-no,1-active,2-out of stock',
  PRIMARY KEY (`idz`),
  UNIQUE KEY `uz` (`uz`)
) ENGINE=MyISAM AUTO_INCREMENT=111 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `items`
--

LOCK TABLES `items` WRITE;
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
INSERT INTO `items` VALUES (1,'Mendel Malbec','',1,'mendel-malbec','mendel-malbec.png','',23.99,'','','Argentinian','','2019-11-07','Mendel Malbec','Mendel Malbec',1),(2,'Don David','',1,'don-david','don-david.jpg',NULL,16.99,'','','Argentinian','Wine','2019-12-04','Don David','Don David',1),(3,'Penfolds 138',NULL,1,'penfolds-138','penfolds-138.jpg',NULL,29.99,NULL,NULL,'Australian','Wine','2019-12-04','Penfolds 138','Penfolds 138',1),(4,'Penfolds 2',NULL,1,'penfolds-2','penfolds-2.jpg',NULL,21.99,NULL,NULL,'Australian','Wine','2019-12-04','Penfolds 2','Penfolds 2',1),(5,'Turkey flat',NULL,1,'turkey-flat','turkey-flat.jpg',NULL,37.99,NULL,NULL,'Australian','Wine','2019-12-04','Turkey flat','Turkey flat',1),(6,'Domaine Druhain Piniot Noir',NULL,1,'domaine-druhain-piniot-noir','domaine-druhain-piniot-noir.jpg',NULL,24.99,NULL,NULL,'Californian','Wine','2019-12-04','Domaine Druhain Piniot Noir','Domaine Druhain Piniot Noir',1),(7,'Double Lariat Napa Valley',NULL,1,'double-lariat-napa-valley','double-lariat-napa-valley.jpg',NULL,41.99,NULL,NULL,'Californian','Wine','2019-12-04','Double Lariat Napa Valley','Double Lariat Napa Valley',1),(8,'Echeverria carmenere',NULL,1,'echeverria-carmenere','echeverria-carmenere.jpg',NULL,9.99,NULL,NULL,'Chilean','Wine','2019-12-04','Echeverria carmenere','Echeverria carmenere',1),(9,'Sutil Cabernet Sauvignon',NULL,1,'sutil-cabernet-sauvignon','sutil-cabernet-sauvignon.jpg',NULL,15.99,NULL,NULL,'Chilean','Wine','2019-12-04','Sutil Cabernet Sauvignon','Sutil Cabernet Sauvignon',1),(10,'Vosne Romanee',NULL,1,'vosne-romanee','vosne-romanee.jpg',NULL,69.99,NULL,NULL,'French','Wine','2019-12-04','Vosne Romanee','Vosne Romanee',1),(11,'Cote-rotie',NULL,1,'cote-rotie','cote-rotie.jpg',NULL,44.99,NULL,NULL,'French','Wine','2019-12-04','Cote-rotie','Cote-rotie',1),(12,'Barbera D asti',NULL,1,'barbera-d-asti','barbera-d-asti.jpg',NULL,16.99,NULL,NULL,'Italian','Wine','2019-12-04','Barbera D asti','Barbera D asti',1),(13,'Tiganello',NULL,1,'tiganello','tiganello.jpg',NULL,139.99,NULL,NULL,'Italian','Wine','2019-12-04','Tiganello','Tiganello',1),(14,'Kanonkop',NULL,1,'kanonkop','kanonkop.jpg',NULL,28.99,NULL,NULL,'South African','Wine','2019-12-04','Kanonkop','Kanonkop',1),(15,'Chocolate Block',NULL,1,'chocolate-block','chocolate-block.jpg',NULL,27.99,NULL,NULL,'South African','Wine','2019-12-04','Chocolate Block','Chocolate Block',1),(16,'Ribera del duero','',1,'ribera-del-duero','ribera-del-duero.png',NULL,15.99,'','','Spanish','Wine','2019-12-04','Ribera del duero','Ribera del duero',1),(17,'Muga Rioja',NULL,1,'muga-rioja-red','muga-rioja-red.jpg',NULL,19.99,NULL,NULL,'Spanish','Wine','2019-12-04','Muga Rioja','Muga Rioja',1),(18,'19 Crimes Chard',NULL,8,'19-crimes-chard','19-crimes-chard.jpg',NULL,8.99,NULL,NULL,'Australian','Wine','2019-12-04','19 Crimes Chard','19 Crimes Chard',1),(19,'Penfolds Koonunga Hill',NULL,8,'penfolds-koonunga-hill','penfolds-koonunga-hill.jpg',NULL,11.99,NULL,NULL,'Australian','Wine','2019-12-04','Penfolds Koonunga Hill','Penfolds Koonunga Hill',1),(20,'La Moussiere Sancerre',NULL,8,'la-moussiere-sancerre','la-moussiere-sancerre.jpg',NULL,21.99,NULL,NULL,'French','Wine','2019-12-04','La Moussiere Sancerre','La Moussiere Sancerre',1),(21,'Pouilly-Fuisse',NULL,8,'pouilly-fuisse','pouilly-fuisse.jpg',NULL,24.99,NULL,NULL,'French','Wine','2019-12-04','Pouilly-Fuisse','Pouilly-Fuisse',1),(22,'Ca Montini Pinot Grigio',NULL,8,'ca-montini-pinot-grigio','ca-montini-pinot-grigio.jpg',NULL,11.99,NULL,NULL,'Italian','Wine','2019-12-04','Ca Montini Pinot Grigio','Ca Montini Pinot Grigio',1),(23,'Frascati',NULL,8,'frascati','frascati.jpg',NULL,9.99,NULL,NULL,'Italian','Wine','2019-12-04','Frascati','Frascati',1),(24,'Cloudy Bay',NULL,8,'cloudy-bay','cloudy-bay.jpg',NULL,22.99,NULL,NULL,'New Zealand','Wine','2019-12-04','Cloudy Bay','Cloudy Bay',1),(25,'Babich sauvignon blanc',NULL,8,'babich-sauvignon-blanc','babich-sauvignon-blanc.jpg',NULL,15.99,NULL,NULL,'New Zealand','Wine','2019-12-04','Babich sauvignon blanc','Babich sauvignon blanc',1),(26,'Southern Right Sauvignon blanc',NULL,8,'southern-right-sauvignon-blanc','southern-right-sauvignon-blanc.jpg',NULL,13.99,NULL,NULL,'South African','Wine','2019-12-04','Southern Right Sauvignon blanc','Southern Right Sauvignon blanc',1),(27,'Muga Rioja',NULL,8,'muga-rioja-white','muga-rioja-white.jpg',NULL,13.99,NULL,NULL,'Spanish','Wine','2019-12-04','Muga Rioja','Muga Rioja',1),(28,'Delirium',NULL,2,'delirium','delirium.jpg',NULL,3.99,NULL,NULL,'Belgian','Beer','2019-12-04','Delirium','Delirium',1),(29,'St. Stefanus',NULL,2,'st-stefanus','st-stefanus.jpg',NULL,3.29,NULL,NULL,'Belgian','Beer','2019-12-04','St. Stefanus','St. Stefanus',1),(30,'Eggenberg',NULL,2,'eggenberg','eggenberg.jpg',NULL,2.49,NULL,NULL,'Larger','Beer','2019-12-04','Eggenberg','Eggenberg',1),(31,'Mahou',NULL,2,'mahou','mahou.jpg',NULL,1.49,NULL,NULL,'Larger','Beer','2019-12-04','Mahou','Mahou',1),(32,'Bobek Citra',NULL,7,'bobek-citra','bobek-citra.jpg',NULL,3.49,NULL,NULL,'','','2019-12-04','Bobek Citra','Bobek Citra',1),(33,'Guns n rose',NULL,7,'guns-n-rose','guns-n-rose.jpg',NULL,2.99,NULL,NULL,'','','2019-12-04','Guns n rose','Guns n rose',1),(34,'Dr. Raptor',NULL,7,'dr-raptor','dr-raptor.jpg',NULL,4.99,NULL,NULL,'','','2019-12-04','Dr. Raptor','Dr. Raptor',1),(35,'Four Roses',NULL,3,'four-roses','four-roses.jpg',NULL,36.99,NULL,NULL,'','Bourbon','2019-12-04','Four Roses','Four Roses',1),(36,'Elijah Craig',NULL,3,'elijah-craig','elijah-craig.jpg',NULL,59.99,NULL,NULL,'','Bourbon','2019-12-04','Elijah Craig','Elijah Craig',1),(37,'Hennessy XO',NULL,3,'hennessy-xo','hennessy-xo.jpg',NULL,149.99,NULL,NULL,'','Cognac','2019-12-04','Hennessy XO','Hennessy XO',1),(38,'Martell Xo',NULL,3,'martell-xo','martell-xo.jpg',NULL,129.99,NULL,NULL,'','Cognac','2019-12-04','Martell Xo','Martell Xo',1),(39,'Brockmans',NULL,3,'brockmans','brockmans.jpg',NULL,32.99,NULL,NULL,'','Gin','2019-12-04','Brockmans','Brockmans',1),(40,'Hendricks',NULL,3,'hendricks','hendricks.jpg',NULL,31.99,NULL,NULL,'','Gin','2019-12-04','Hendricks','Hendricks',1),(41,'Lambs Spiced Rum',NULL,3,'lambs-spiced-rum','lambs-spiced-rum.jpg',NULL,16.99,NULL,NULL,'','Rums','2019-12-04','Lambs Spiced Rum','Lambs Spiced Rum',1),(42,'Mount Gay',NULL,3,'mount-gay','mount-gay.jpg',NULL,16.99,NULL,NULL,'','Rums','2019-12-04','Mount Gay','Mount Gay',1),(43,'Casamigos mezcal',NULL,3,'casamigos-mezcal','casamigos-mezcal.jpg',NULL,65.99,NULL,NULL,'','Tequila','2019-12-04','Casamigos mezcal','Casamigos mezcal',1),(44,'Casamigos Blanco',NULL,3,'casamigos-blanco','casamigos-blanco.jpg',NULL,62.99,NULL,NULL,'','Tequila','2019-12-04','Casamigos Blanco','Casamigos Blanco',1),(45,'Ciroc',NULL,3,'ciroc','ciroc.jpg',NULL,31.99,NULL,NULL,'','Vodka','2019-12-04','Ciroc','Ciroc',1),(46,'Grey Goose',NULL,3,'grey-goose','grey-goose.jpg',NULL,36.99,NULL,NULL,'','Vodka','2019-12-04','Grey Goose','Grey Goose',1),(47,'Glenmorangie',NULL,3,'glenmorangie','glenmorangie.jpg',NULL,49.99,NULL,NULL,'','Whisky','2019-12-04','Glenmorangie','Glenmorangie',1),(48,'Yamazaki',NULL,3,'yamazaki','yamazaki.jpg',NULL,110.99,NULL,NULL,'','Whisky','2019-12-04','Yamazaki','Yamazaki',1),(49,'Dalmore',NULL,3,'dalmore','dalmore.jpg',NULL,49.99,NULL,NULL,'','Whisky','2019-12-04','Dalmore','Dalmore',1),(50,'St-Germain',NULL,5,'st-germain','st-germain.jpg',NULL,27.99,NULL,NULL,'','','2019-12-04','St-Germain','St-Germain',1),(51,'Chartreuse',NULL,5,'chartreuse','chartreuse.jpg',NULL,39.99,NULL,NULL,'','','2019-12-04','Chartreuse','Chartreuse',1),(52,'De Kyuper Apricot brandy',NULL,5,'de-kyuper-apricot-brandy','de-kyuper-apricot-brandy.jpg',NULL,42.99,NULL,NULL,'','','2019-12-04','De Kyuper Apricot brandy','De Kyuper Apricot brandy',1),(53,'Ciroc pineapple 5cl',NULL,6,'ciroc-pineapple-5cl','ciroc-pineapple-5cl.jpg',NULL,4.99,NULL,NULL,'','','2019-12-04','Ciroc pineapple 5cl','Ciroc pineapple 5cl',1),(54,'Kraken 5cl',NULL,6,'kraken-5cl','kraken-5cl.jpg',NULL,3.99,NULL,NULL,'','','2019-12-04','Kraken 5cl','Kraken 5cl',1),(55,'Billecart-Salmon Blanc de Blanc',NULL,4,'billecart-salmon-blanc-de-blanc','billecart-salmon-blanc-de-blanc.jpg',NULL,69.99,NULL,NULL,'Country','Brand','2019-12-04','Billecart-Salmon Blanc de Blanc','Billecart-Salmon Blanc de Blanc',1),(56,'Kernel Export india porter',NULL,10,'kernel-export-india-porter','kernel-export-india-porter.jpg',NULL,3.49,NULL,NULL,'','','2019-12-04','Kernel Export india porter','Kernel Export india porter',1),(57,'Betty Stogg',NULL,10,'betty-stogg','betty-stogg.jpg',NULL,2.69,NULL,NULL,'','','2019-12-04','Betty Stogg','Betty Stogg',1),(58,'Hawkes Red berry cider',NULL,11,'hawkes-red-berry-cider','hawkes-red-berry-cider.jpg',NULL,3.49,NULL,NULL,'','','2019-12-04','Hawkes Red berry cider','Hawkes Red berry cider',1),(59,'Hawkes Apple cider',NULL,11,'hawkes-apple-cider','hawkes-apple-cider.jpg',NULL,2.99,NULL,NULL,'','','2019-12-04','Hawkes Apple cider','Hawkes Apple cider',1),(60,'Otima 10 Port',NULL,12,'otima-10-port','otima-10-port.jpg',NULL,14.99,NULL,NULL,'','','2019-12-04','Otima 10 Port','Otima 10 Port',1),(61,'Grahams 20 Tawny port',NULL,12,'grahams-20-tawny-port','grahams-20-tawny-port.jpg',NULL,42.99,NULL,NULL,'','','2019-12-04','Grahams 20 Tawny port','Grahams 20 Tawny port',1),(62,'Dark Horse Rose',NULL,9,'dark-horse-rose','dark-horse-rose.jpg',NULL,8.99,NULL,NULL,'','','2019-12-04','Dark Horse Rose','Dark Horse Rose',1),(63,'Faustino V','',9,'faustino-v','faustino-v.jpg',NULL,10.99,'','','','','2019-12-04','Faustino V','Faustino V',1),(66,'Midleton very rare 2018','',3,'Midleton2018','Midleton2018.jpg',NULL,149.99,'70cl','40%','Ireland','Jameson','2020-01-15','Midleton very rare 2018','Midleton very rare 2018',1),(67,'Dom Perignon 1973 oenotheque','',4,'DomPerignonoenotheque1973','202001160708261560095400.png',NULL,2000.00,'70cl','12.5%','France','Dom Perignon-Moet&C','2020-01-16','Dom Perignon 1973 oenotheque','Dom Perignon-Moet&C',1),(68,'TIGNANELLO ','TIG-000',1,'tignanello','20200227072355149082878.png',NULL,139.99,'70cl','13%','Italy','','2020-02-27','TIGNANELLO ','',1),(69,'Peroni','',2,'peroni','',NULL,1.49,'330ml','','Italian','Beer','2020-04-25','Peroni','Peroni',1),(70,'Coors Light','',2,'coors-light','',NULL,1.25,'330ml','','American','Beer','2020-04-25','Coors Light','Coors Light',1),(71,'Bitburger','',2,'bitburger','',NULL,1.89,'330ml','','German','Beer','2020-04-25','Bitburger','Bitburger',1),(72,'Budweiser','',2,'budweiser','',NULL,1.25,'330ml','','American','Beer','2020-04-25','Budweiser','Budweiser',1),(73,'Birra Moretti','',2,'birra-moretti','',NULL,1.49,'330ml','','Italian','Beer','2020-04-25','Birra Moretti','Birra Moretti',1),(74,'Moosehead','',2,'moosehead','',NULL,2.25,'330ml','','Canadian','Beer','2020-04-25','Moosehead','Moosehead',1),(75,'Camden Hells','',2,'camden-hells','',NULL,2.25,'330ml','','English','Beer','2020-04-25','Camden Hells','Camden Hells',1),(76,'Brooklyn Lager','',2,'brooklyn-lager','',NULL,2.25,'330ml','','American','Beer','2020-04-25','Brooklyn Lager','Brooklyn Lager',1),(77,'Estrella','',2,'estrella','',NULL,1.49,'330ml','','Spanish','Beer','2020-04-25','Estrella','Estrella',1),(78,'Asahi','',2,'asahi','',NULL,1.49,'330ml','','Japanese','Beer','2020-04-25','Asahi','Asahi',1),(79,'Corona','',2,'corona','',NULL,1.25,'330ml','','Mexican','Beer','2020-04-25','Corona','Corona',1),(80,'Amstel','',2,'amstel','',NULL,1.25,'300ml','','Dutch','Beer','2020-04-25','Amstel','Amstel',1),(81,'Staropramen','',2,'staropramen','',NULL,1.25,'330ml','','','Beer','2020-04-25','Staropramen','Staropramen',1),(82,'Super Bock','',2,'super-bock','',NULL,1.49,'330ml','','Portuguese','Beer','2020-04-25','Super Bock','Super Bock',1),(83,'Sagres','',2,'sagres','',NULL,1.25,'330ml','','Portuguese','Beer','2020-04-25','Sagres','Sagres',1),(84,'Tsingtao','',2,'tsingtao','',NULL,1.25,'330ml','','Chinese','Beer','2020-04-25','Tsingtao','Tsingtao',1),(85,'EFES Draft','',2,'efes-draft','',NULL,2.25,'500ml','','Turkish','Beer','2020-04-25','EFES Draft','EFES Draft',1),(86,'Sierra Nevada','',2,'sierra-nevada','',NULL,2.25,'355ml','','American','Beer','2020-04-25','Sierra Nevada','Sierra Nevada',1),(87,'Goose IPA','',2,'goose-ipa','',NULL,2.25,'355ml','','American','Beer','2020-04-25','Goose IPA','Goose IPA',1),(88,'Banks','',2,'banks','',NULL,1.99,'330ml','','Carribbean','Beer','2020-04-25','Banks','Banks',1),(89,'Quilmes','',2,'quilmes','',NULL,1.99,'330ml','','Argentine','Beer','2020-04-25','Quilmes','Quilmes',1),(90,'Peroni (x24 Pack)','',17,'peroni-x24','',NULL,30.00,'330ml','','Italian','Beer','2020-04-25','Peroni (x24 Pack)','Peroni (x24 Pack)',1),(91,'Coors Light (x20 Pack)','',17,'coors-light-x20','',NULL,15.99,'330ml','','American','','2020-04-25','Coors Light (x20 Pack)','Coors Light (x20 Pack)',1),(92,'Bitburger (x12 Pack)','',17,'bitburger-x12','',NULL,20.00,'330ml','','German','','2020-04-25','Bitburger (x12 Pack)','Bitburger (x12 Pack)',1),(93,'Budweiser (x24 Pack)','',17,'budweiser-x24','',NULL,25.00,'330ml','','American','','2020-04-25','Budweiser (x24 Pack)','Budweiser (x24 Pack)',1),(94,'Birra Moretti (x24 Pack)','',17,'birra-moretti-x24','',NULL,30.00,'330ml','','Italian','','2020-04-25','Birra Moretti (x24 Pack)','Birra Moretti (x24 Pack)',1),(95,'Moosehead (x12 Pack)','',17,'moosehead-x12','',NULL,20.00,'330ml','','Canadian','','2020-04-25','Moosehead (x12 Pack)','Moosehead (x12 Pack)',1),(96,'Camden Hells (x24 Pack)','',17,'camden-hells-x24','',NULL,32.00,'330ml','','English','','2020-04-25','Camden Hells (x24 Pack)','Camden Hells (x24 Pack)',1),(97,'Brooklyn Lager (x24 Pack)','',17,'brooklyn-lager-x24','',NULL,45.00,'330ml','','American','','2020-04-25','Brooklyn Lager (x24 Pack)','Brooklyn Lager (x24 Pack)',1),(98,'Estrella (x24 Pack)','',17,'estrella-x24','',NULL,30.00,'330ml','','Spanish','','2020-04-25','Estrella (x24 Pack)','Estrella (x24 Pack)',1),(99,'Asahi (x24 Pack)','',17,'asahi-x24','',NULL,30.00,'330ml','','Japanese','','2020-04-25','Asahi (x24 Pack)','Asahi (x24 Pack)',1),(100,'Corona (x24 Pack)','',17,'corona-x24','',NULL,26.50,'330ml','','Mexican','','2020-04-25','Corona (x24 Pack)','Corona (x24 Pack)',1),(101,'Amstel (x24 Pack)','',17,'amstel-x24','',NULL,20.00,'300ml','','Dutch','','2020-04-25','Amstel (x24 Pack)','Amstel (x24 Pack)',1),(102,'Staropramen (x24 Pack)','',17,'staropramen-x24','',NULL,28.50,'330ml','','Czech','','2020-04-25','Staropramen (x24 Pack)','Staropramen (x24 Pack)',1),(103,'Super Bock (x24 Pack)','',17,'super-bock-x24','',NULL,30.00,'330ml','','Portuguese','','2020-04-25','Super Bock (x24 Pack)','Super Bock (x24 Pack)',1),(104,'Sagres (x24 Pack)','',17,'sagres-x24','',NULL,30.00,'330ml','','Mexican','','2020-04-25','Sagres (x24 Pack)','Sagres (x24 Pack)',1),(105,'Tsingtao (x24 Pack)','',17,'tsingtao-x24','',NULL,30.00,'330ml','','Chinese','','2020-04-25','Tsingtao (x24 Pack)','Tsingtao (x24 Pack)',1),(106,'EFES Draft (x12 Pack)','',17,'efes-draft-x12','',NULL,24.00,'500ml','','Turkish','','2020-04-25','EFES Draft (x12 Pack)','EFES Draft (x12 Pack)',1),(107,'Sierra Nevada (x12 Pack)','',17,'sierra-nevada-x12','',NULL,26.00,'355ml','','American','','2020-04-25','Sierra Nevada (x12 Pack)','Sierra Nevada (x12 Pack)',1),(108,'Goose IPA (x12 Pack)','',17,'goose-ipa-x12','',NULL,20.00,'355ml','','American','','2020-04-25','Goose IPA (x12 Pack)','Goose IPA (x12 Pack)',1),(109,'Banks (x24 Pack)','',17,'banks-x24','',NULL,35.00,'330ml','','Caribbean','','2020-04-25','Banks (x24 Pack)','Banks (x24 Pack)',1),(110,'Quilmes (x24 Pack)','',17,'quilmes-x24','',NULL,38.50,'330ml','','Argentine','','2020-04-25','Quilmes (x24 Pack)','Quilmes (x24 Pack)',1);
/*!40000 ALTER TABLE `items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orderitems`
--

DROP TABLE IF EXISTS `orderitems`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orderitems` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `oid` int(11) NOT NULL,
  `iid` int(11) NOT NULL,
  `ina` varchar(100) NOT NULL COMMENT 'item name',
  `ipr` decimal(6,2) NOT NULL COMMENT 'item price',
  `iqt` smallint(6) NOT NULL COMMENT 'quantity',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orderitems`
--

LOCK TABLES `orderitems` WRITE;
/*!40000 ALTER TABLE `orderitems` DISABLE KEYS */;
INSERT INTO `orderitems` VALUES (50,43,45,'Ciroc',31.99,1),(51,44,55,'Billecart-Salmon Blanc de Blanc',69.99,1),(52,45,51,'Chartreuse',39.99,1),(53,46,50,'St-Germain',27.99,1),(54,47,1,'Mendel Malbec',23.99,1),(55,48,63,'Faustino V',10.99,19),(56,49,50,'St-Germain',27.99,1);
/*!40000 ALTER TABLE `orderitems` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `oid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT 'customer',
  `bfn` varchar(100) NOT NULL,
  `bln` varchar(100) NOT NULL,
  `bad1` varchar(100) NOT NULL,
  `bad2` varchar(100) DEFAULT NULL,
  `bad3` varchar(100) DEFAULT NULL,
  `bpz` varchar(15) NOT NULL,
  `bzp` varchar(10) NOT NULL,
  `bct` varchar(120) NOT NULL,
  `bst` tinyint(4) NOT NULL,
  `bem` varchar(120) NOT NULL,
  `sfn` varchar(100) NOT NULL,
  `sln` varchar(100) NOT NULL,
  `sad1` varchar(100) NOT NULL,
  `sad2` varchar(100) DEFAULT NULL,
  `sad3` varchar(100) DEFAULT NULL,
  `spz` varchar(15) NOT NULL,
  `szp` varchar(10) NOT NULL,
  `sct` varchar(120) NOT NULL,
  `sst` tinyint(4) NOT NULL,
  `sem` varchar(120) NOT NULL,
  `dt` date NOT NULL,
  `tz` time NOT NULL,
  `tpr` decimal(6,2) NOT NULL COMMENT 'total price',
  `pay` tinyint(4) NOT NULL DEFAULT 0,
  `code` varchar(100) DEFAULT NULL COMMENT 'order code',
  PRIMARY KEY (`oid`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (43,1,'Michel','Jayasooriya','207/b','Siyane rd','Gampaha',' 94713530250','2541','Dest',107,'scandianz@gmail.com','Michel','Jayasooriya','207/b','Siyane rd','Gampaha',' 94713530250','2541','Dest',107,'scandianz@gmail.com','2020-01-21','21:10:54',31.99,1,'073e78a6-8f98-477d-bea3-fadf8f76dfef'),(44,1,'Michel','Jayasooriya','207/b','Siyane rd','Gampaha',' 94713530250','2541','Dest',107,'scandianz@gmail.com','Michel','Jayasooriya','207/b','Siyane rd','Gampaha',' 94713530250','2541','Dest',107,'scandianz@gmail.com','2020-01-21','21:11:36',69.99,1,'efed06c6-b80c-41d9-a795-b50f0884dee0'),(45,1,'Michel','Jayasooriya','207/b','Siyane rd','Gampaha',' 94713530250','2541','Dest',107,'scandianz@gmail.com','Michel','Jayasooriya','207/b','Siyane rd','Gampaha',' 94713530250','2541','Dest',107,'scandianz@gmail.com','2020-01-21','21:23:29',39.99,2,'cf5598d5-f3c3-4927-bab9-47bce82d6c55'),(46,4,'Sukee','Cellers','179 Western Road ','','','07575512556','CM12 9JD','Billericay',16,'celele4rs@gmail.com','Sukee','Cellers','179 Western Road ','','','07575512556','CM12 9JD','Billericay',16,'celele4rs@gmail.com','2020-02-19','17:14:48',27.99,1,'22de1e82-97e6-46ee-8aed-0ad3ec4af81c'),(47,4,'Sukee','Cellers','179 Western Road ','','','07575512556','CM12 9JD','Billericay',16,'celele4rs@gmail.com','Sukee','Cellers','179 Western Road ','','','07575512556','CM12 9JD','Billericay',16,'celele4rs@gmail.com','2020-02-27','15:18:22',23.99,1,'d2e15950-3a59-4431-a860-7a0f2b45acf3'),(48,4,'Sukee','Cellers','179 Western Road ','','','07575512556','CM12 9JD','Billericay',16,'celele4rs@gmail.com','Sukee','Cellers','179 Western Road ','','','07575512556','CM12 9JD','Billericay',16,'celele4rs@gmail.com','2020-02-27','15:27:53',208.81,1,'f51c4221-d5ef-4aa4-a3df-35ca5af8a0d6'),(49,1,'Michel','Jayasooriya','207/b','Siyane rd','Gampaha',' 94713530250','2541','Dest',107,'scandianz@gmail.com','Michel','Jayasooriya','207/b','Siyane rd','Gampaha',' 94713530250','2541','Dest',107,'scandianz@gmail.com','2020-03-01','11:16:06',27.99,1,'3e869936-9ed0-4be3-8248-1b020a32367b');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resetpassword`
--

DROP TABLE IF EXISTS `resetpassword`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `resetpassword` (
  `idz` int(11) NOT NULL AUTO_INCREMENT,
  `kz` varchar(18) NOT NULL,
  `ez` varchar(120) NOT NULL,
  `dt` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`idz`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resetpassword`
--

LOCK TABLES `resetpassword` WRITE;
/*!40000 ALTER TABLE `resetpassword` DISABLE KEYS */;
/*!40000 ALTER TABLE `resetpassword` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `slides`
--

DROP TABLE IF EXISTS `slides`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `slides` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `hd` varchar(160) NOT NULL COMMENT 'heading',
  `p1` varchar(500) NOT NULL COMMENT 'para1',
  `p2` varchar(500) NOT NULL COMMENT 'para2',
  `btxt` varchar(50) NOT NULL COMMENT 'button text',
  `burl` varchar(255) NOT NULL COMMENT 'button url',
  `od` tinyint(4) NOT NULL COMMENT 'order',
  `iz` varchar(50) NOT NULL COMMENT 'image',
  PRIMARY KEY (`sid`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `slides`
--

LOCK TABLES `slides` WRITE;
/*!40000 ALTER TABLE `slides` DISABLE KEYS */;
INSERT INTO `slides` VALUES (1,'Midleton very rare 2018','The 2018 release of Midleton Very Rare collection, the Midleton Very Rare 2018. The long awaited Irish blended whiskey is as luxurious and delicious as ever.','Nose :Hints of pears, oranges and citrus fruits give way to familiar pot still spice with just a hint of toasted oak.          Palate: Smooth and creamy upfront with touches of vanilla, dried citrus peel, cinnamon and cloves. The finish is warm and delicately spiced with subtle tannins.','Midleton very rare 2018','item/Midleton2018',1,'20200115054601709752152.jpg'),(2,'Dom Perignon oenotheque 1973','This champagne is one of the finest examples of subtly seductive, fresh maturity.','The golden rays of the summer sun of 1973 shine in the depths of this champagne. Aromas of dry leaves and hints of toast, brioche and ripe mirabelle plums make the bouquet especially elegant and appealing. On the palate, there is a unique balance of strength and vivacity. The finesse is sustained by a delightfully vibrant, structured nerviness. The flavour dances on the palate and finishes with a hint of lemon.  ','All Champagne','category/champagne',2,'202001160647231998258585.png'),(3,'Old Rip Van Winkle','bourbon whiskey is bottled at nearly barrel proof. Just a splash of Kentucky limestone water is added after a decade of aging. Rich, yet smooth, this bourbon takes a back seat to none.','A sweet vanilla nose with caramel, pecan and oak wood. Smooth, mellow flavour consisting of robust wheat, cherries and oak. Features a long, smoky wheat finish with hints of fruit, spice and oak tannins.','Spirits','category/Spirits',3,'20200116082031374927703.png');
/*!40000 ALTER TABLE `slides` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `fn` varchar(100) NOT NULL COMMENT 'first name',
  `ln` varchar(100) NOT NULL COMMENT 'last name',
  `ez` varchar(120) NOT NULL,
  `pw` varchar(255) NOT NULL,
  `pz` varchar(15) DEFAULT NULL COMMENT 'phone no',
  `ad1` varchar(100) DEFAULT NULL COMMENT 'address',
  `ad2` varchar(100) NOT NULL,
  `ad3` varchar(100) NOT NULL,
  `ct` varchar(120) DEFAULT NULL COMMENT 'city',
  `st` tinyint(4) DEFAULT NULL COMMENT 'state',
  `zp` varchar(10) DEFAULT NULL COMMENT 'zip code',
  `cn` varchar(100) DEFAULT NULL COMMENT 'name on card',
  `pt` tinyint(4) DEFAULT NULL COMMENT 'payment type 1-card,2-paypal',
  `no` varchar(100) DEFAULT NULL COMMENT 'credit card no',
  `cv` varchar(10) DEFAULT NULL COMMENT 'cvv',
  `yy` year(4) DEFAULT NULL COMMENT 'exp year',
  `mm` tinyint(4) DEFAULT NULL COMMENT 'exp month',
  `dt` date NOT NULL COMMENT 'reg date',
  `az` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0-N/A,1-active',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Michel','Jayasooriya','scandianz@gmail.com','$2y$10$Jl9VAU/AhOdqbgPbKmX2.OewZUsMmIeI55IfZN7M7XPtlypxzVSMS',' 94713530250','207/b','Siyane rd','Gampaha','Dest',107,'2541',NULL,NULL,NULL,NULL,NULL,NULL,'2019-12-13',1),(3,'Thiwanka','De Silva','ghostsagentx@gmail.com','$2y$10$1J4HYs22o.XZSpqGGRNu9eWiEZpdnftLojUgY5NlFfxAw/5i.Rfd6','07438156942','179 Western Road','','','Billericay',16,'CM12 9JD',NULL,NULL,NULL,NULL,NULL,NULL,'2019-12-27',0),(4,'Sukee','Cellers','celele4rs@gmail.com','$2y$10$3e6EzzVzQ9dpc7KKvOGlIudxklOziu9U.Tl4C6wjEMAyu5ikriGga','07575512556','179 Western Road ','','','Billericay',16,'CM12 9JD',NULL,NULL,NULL,NULL,NULL,NULL,'2019-12-28',1);
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

-- Dump completed on 2023-07-25  4:32:12
