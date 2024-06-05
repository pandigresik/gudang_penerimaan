-- MySQL dump 10.13  Distrib 8.0.36, for Linux (x86_64)
--
-- Host: localhost    Database: gudang
-- ------------------------------------------------------
-- Server version	8.0.36-0ubuntu0.22.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `activity_log`
--

DROP TABLE IF EXISTS `activity_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `activity_log` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `log_name` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb3_unicode_ci NOT NULL,
  `subject_type` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `subject_id` bigint unsigned DEFAULT NULL,
  `causer_type` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `causer_id` bigint unsigned DEFAULT NULL,
  `properties` text COLLATE utf8mb3_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subject` (`subject_type`,`subject_id`),
  KEY `causer` (`causer_type`,`causer_id`),
  KEY `activity_log_log_name_index` (`log_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity_log`
--

LOCK TABLES `activity_log` WRITE;
/*!40000 ALTER TABLE `activity_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `activity_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auto_numbers`
--

DROP TABLE IF EXISTS `auto_numbers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `auto_numbers` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) COLLATE utf8mb3_unicode_ci NOT NULL,
  `number` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auto_numbers`
--

LOCK TABLES `auto_numbers` WRITE;
/*!40000 ALTER TABLE `auto_numbers` DISABLE KEYS */;
/*!40000 ALTER TABLE `auto_numbers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb3_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb3_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb3_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb3_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `good_receipt_item_classifications`
--

DROP TABLE IF EXISTS `good_receipt_item_classifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `good_receipt_item_classifications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `good_receipt_item_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `weight` decimal(8,1) unsigned NOT NULL,
  `reference` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `good_receipt_item_classifications_good_receipt_item_id_foreign` (`good_receipt_item_id`),
  KEY `good_receipt_item_classifications_product_id_foreign` (`product_id`),
  KEY `good_receipt_item_weight_reference` (`reference`),
  CONSTRAINT `good_receipt_item_classifications_good_receipt_item_id_foreign` FOREIGN KEY (`good_receipt_item_id`) REFERENCES `good_receipt_items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `good_receipt_item_classifications_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `good_receipt_item_weight_reference` FOREIGN KEY (`reference`) REFERENCES `good_receipt_item_weights` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `good_receipt_item_classifications`
--

LOCK TABLES `good_receipt_item_classifications` WRITE;
/*!40000 ALTER TABLE `good_receipt_item_classifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `good_receipt_item_classifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `good_receipt_item_weights`
--

DROP TABLE IF EXISTS `good_receipt_item_weights`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `good_receipt_item_weights` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `good_receipt_item_id` bigint unsigned NOT NULL,
  `quantity` smallint unsigned NOT NULL,
  `weight` decimal(8,1) unsigned NOT NULL,
  `is_sampling` tinyint(1) NOT NULL DEFAULT '0',
  `state` enum('classification','done') COLLATE utf8mb3_unicode_ci DEFAULT 'classification',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `good_receipt_item_weights_good_receipt_item_id_foreign` (`good_receipt_item_id`),
  CONSTRAINT `good_receipt_item_weights_good_receipt_item_id_foreign` FOREIGN KEY (`good_receipt_item_id`) REFERENCES `good_receipt_items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `good_receipt_item_weights`
--

LOCK TABLES `good_receipt_item_weights` WRITE;
/*!40000 ALTER TABLE `good_receipt_item_weights` DISABLE KEYS */;
/*!40000 ALTER TABLE `good_receipt_item_weights` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `good_receipt_items`
--

DROP TABLE IF EXISTS `good_receipt_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `good_receipt_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `good_receipt_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `good_receipt_items_product_id_foreign` (`product_id`),
  KEY `good_receipt_items_good_receipt_id_foreign` (`good_receipt_id`),
  CONSTRAINT `good_receipt_items_good_receipt_id_foreign` FOREIGN KEY (`good_receipt_id`) REFERENCES `good_receipts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `good_receipt_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `good_receipt_items`
--

LOCK TABLES `good_receipt_items` WRITE;
/*!40000 ALTER TABLE `good_receipt_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `good_receipt_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `good_receipts`
--

DROP TABLE IF EXISTS `good_receipts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `good_receipts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `partner_id` bigint unsigned NOT NULL,
  `receipt_date` date NOT NULL,
  `state` enum('weighing','classification','done') COLLATE utf8mb3_unicode_ci DEFAULT 'weighing',
  `description` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL COMMENT 'as note',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `good_receipts_partner_id_foreign` (`partner_id`),
  CONSTRAINT `good_receipts_partner_id_foreign` FOREIGN KEY (`partner_id`) REFERENCES `partners` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `good_receipts`
--

LOCK TABLES `good_receipts` WRITE;
/*!40000 ALTER TABLE `good_receipts` DISABLE KEYS */;
/*!40000 ALTER TABLE `good_receipts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_permissions`
--

DROP TABLE IF EXISTS `menu_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menu_permissions` (
  `menu_id` bigint unsigned NOT NULL,
  `permission_id` bigint unsigned NOT NULL,
  `status` char(1) COLLATE utf8mb3_unicode_ci DEFAULT '1',
  PRIMARY KEY (`menu_id`,`permission_id`),
  KEY `fk_menu_permission_permissions` (`permission_id`),
  CONSTRAINT `fk_menu_permission_menus` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`),
  CONSTRAINT `fk_menu_permission_permissions` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_permissions`
--

LOCK TABLES `menu_permissions` WRITE;
/*!40000 ALTER TABLE `menu_permissions` DISABLE KEYS */;
INSERT INTO `menu_permissions` VALUES (4,1,'1'),(5,5,'1'),(6,9,'1'),(7,13,'1'),(8,17,'1'),(9,21,'1'),(11,38,'1'),(12,41,'1'),(13,37,'1'),(14,26,'1');
/*!40000 ALTER TABLE `menu_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menus` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb3_unicode_ci NOT NULL,
  `description` varchar(100) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `status` char(1) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `icon` varchar(50) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `route` varchar(100) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `parent_id` int DEFAULT NULL,
  `_lft` int unsigned DEFAULT NULL,
  `_rgt` int unsigned DEFAULT NULL,
  `seq_number` tinyint DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES (1,'Master Data','Header menu master','1','2021-08-09 08:10:07','2024-05-23 08:36:56','cil-address-book',NULL,NULL,9,24,1),(4,'Menu','Manage menu','1','2021-08-09 08:10:07','2024-05-23 08:36:56','cil-address-book','base/menus',1,16,17,1),(5,'User','Manage users','1','2021-08-09 08:10:07','2024-05-23 08:36:56','cil-address-book','base/users',1,18,19,2),(6,'Role','Manage role','1','2021-08-09 08:10:07','2024-05-23 08:36:56','cil-address-book','base/roles',1,20,21,3),(7,'Permission','Manage permissions','1','2021-08-09 08:10:07','2024-05-23 08:36:56','cil-address-book','base/permissions',1,22,23,1),(8,'Kategori Produk','Kategori produk','1','2024-05-23 08:27:24','2024-05-23 08:36:56','cil-object-group','base/productCategories',1,14,15,5),(9,'Produk','Produk','1','2024-05-23 08:28:49','2024-05-23 08:36:56','cil-gift','base/products',1,12,13,6),(10,'Gudang Bahan Baku','Header gudang','1','2024-05-23 08:29:26','2024-05-23 08:37:07','cil-building',NULL,NULL,1,8,2),(11,'Penerimaan Bahan Baku','penerimaan bahan baku mentah','1','2024-05-23 08:30:40','2024-05-23 08:36:56','cil-recycle','warehouse/goodReceipts/create',10,6,7,1),(12,'Supplier - Konsumen','Supplier dan konsumen','1','2024-05-23 08:31:56','2024-05-23 08:36:56','cil-user','base/partners',1,10,11,7),(13,'Laporan Penerimaan Barang','laporan penerimaan','1','2024-05-23 08:36:07','2024-05-23 08:36:56','cil-file','warehouse/goodReceipts',10,4,5,3),(14,'Penimbangan Sample','Penimbangan sample','1','2024-05-23 08:36:56','2024-05-23 08:36:56','cil-balance-scale','warehouse/sampleClassifications/create',10,2,3,2);
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=134 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (115,'2014_10_12_000000_create_users_table',1),(116,'2014_10_12_100000_create_password_resets_table',1),(117,'2017_08_03_055212_create_auto_numbers',1),(118,'2019_08_19_000000_create_failed_jobs_table',1),(119,'2019_12_14_000001_create_personal_access_tokens_table',1),(120,'2021_07_07_080836_create_permission_tables',1),(121,'2021_08_06_225424_create_menus_table',1),(122,'2021_08_06_225434_create_menu_permissions_table',1),(123,'2021_09_08_054823_create_activity_log_table',1),(124,'2021_09_09_152314_alter_user_add_deleted_at',1),(125,'2022_11_28_095714_create_product_categories',1),(126,'2022_11_28_095723_create_products',1),(127,'2024_05_13_060916_create_partner',1),(128,'2024_05_13_072247_create_good_receipt',1),(129,'2024_05_13_072258_create_good_receipt_item',1),(130,'2024_05_13_072307_create_good_receipt_item_weight',1),(131,'2024_05_13_072328_create_good_receipt_item_classification',1),(132,'2024_05_15_053452_add_partners_softdelete',1),(133,'2024_05_20_074458_add_references_goodreceiptclassification',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES (1,'App\\Models\\Base\\User',1);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `partner`
--

DROP TABLE IF EXISTS `partner`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `partner` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8mb3_unicode_ci DEFAULT NULL COMMENT 'internal code from company, maybe existing code in other application',
  `name` varchar(50) COLLATE utf8mb3_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb3_unicode_ci,
  `active` tinyint(1) DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `additional_info` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `partner`
--

LOCK TABLES `partner` WRITE;
/*!40000 ALTER TABLE `partner` DISABLE KEYS */;
/*!40000 ALTER TABLE `partner` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `partners`
--

DROP TABLE IF EXISTS `partners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `partners` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8mb3_unicode_ci DEFAULT NULL COMMENT 'internal code from company, maybe existing code in other application',
  `name` varchar(50) COLLATE utf8mb3_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb3_unicode_ci,
  `active` tinyint(1) DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `additional_info` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `partners`
--

LOCK TABLES `partners` WRITE;
/*!40000 ALTER TABLE `partners` DISABLE KEYS */;
INSERT INTO `partners` VALUES (1,'SUPP1','Supplier 1','data supplier',1,'-','-','supplier@ok.com','-','-','-','2024-05-23 01:34:36','2024-05-23 01:34:36',1,NULL,NULL);
/*!40000 ALTER TABLE `partners` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'menus-index','web',NULL,NULL),(2,'menus-create','web',NULL,NULL),(3,'menus-update','web',NULL,NULL),(4,'menus-delete','web',NULL,NULL),(5,'users-index','web',NULL,NULL),(6,'users-create','web',NULL,NULL),(7,'users-update','web',NULL,NULL),(8,'users-delete','web',NULL,NULL),(9,'roles-index','web',NULL,NULL),(10,'roles-create','web',NULL,NULL),(11,'roles-update','web',NULL,NULL),(12,'roles-delete','web',NULL,NULL),(13,'permissions-index','web',NULL,NULL),(14,'permissions-create','web',NULL,NULL),(15,'permissions-update','web',NULL,NULL),(16,'permissions-delete','web',NULL,NULL),(17,'product_categories-index','web','2024-05-23 01:10:52','2024-05-23 01:10:52'),(18,'product_categories-create','web','2024-05-23 01:10:52','2024-05-23 01:10:52'),(19,'product_categories-update','web','2024-05-23 01:10:52','2024-05-23 01:10:52'),(20,'product_categories-delete','web','2024-05-23 01:10:52','2024-05-23 01:10:52'),(21,'products-index','web','2024-05-23 01:10:52','2024-05-23 01:10:52'),(22,'products-create','web','2024-05-23 01:10:52','2024-05-23 01:10:52'),(23,'products-update','web','2024-05-23 01:10:52','2024-05-23 01:10:52'),(24,'products-delete','web','2024-05-23 01:10:52','2024-05-23 01:10:52'),(25,'good_receipt_item_classifications-index','web','2024-05-23 01:10:52','2024-05-23 01:10:52'),(26,'good_receipt_item_classifications-create','web','2024-05-23 01:10:52','2024-05-23 01:10:52'),(27,'good_receipt_item_classifications-update','web','2024-05-23 01:10:52','2024-05-23 01:10:52'),(28,'good_receipt_item_classifications-delete','web','2024-05-23 01:10:52','2024-05-23 01:10:52'),(29,'good_receipt_item_weights-index','web','2024-05-23 01:10:52','2024-05-23 01:10:52'),(30,'good_receipt_item_weights-create','web','2024-05-23 01:10:52','2024-05-23 01:10:52'),(31,'good_receipt_item_weights-update','web','2024-05-23 01:10:52','2024-05-23 01:10:52'),(32,'good_receipt_item_weights-delete','web','2024-05-23 01:10:52','2024-05-23 01:10:52'),(33,'good_receipt_items-index','web','2024-05-23 01:10:52','2024-05-23 01:10:52'),(34,'good_receipt_items-create','web','2024-05-23 01:10:52','2024-05-23 01:10:52'),(35,'good_receipt_items-update','web','2024-05-23 01:10:52','2024-05-23 01:10:52'),(36,'good_receipt_items-delete','web','2024-05-23 01:10:52','2024-05-23 01:10:52'),(37,'good_receipts-index','web','2024-05-23 01:10:52','2024-05-23 01:10:52'),(38,'good_receipts-create','web','2024-05-23 01:10:52','2024-05-23 01:10:52'),(39,'good_receipts-update','web','2024-05-23 01:10:52','2024-05-23 01:10:52'),(40,'good_receipts-delete','web','2024-05-23 01:10:52','2024-05-23 01:10:52'),(41,'partners-index','web','2024-05-23 01:32:09','2024-05-23 01:32:09'),(42,'partners-create','web','2024-05-23 01:32:09','2024-05-23 01:32:09'),(43,'partners-update','web','2024-05-23 01:32:09','2024-05-23 01:32:09'),(44,'partners-delete','web','2024-05-23 01:32:09','2024-05-23 01:32:09');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb3_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_categories`
--

DROP TABLE IF EXISTS `product_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8mb3_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb3_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_categories_code_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_categories`
--

LOCK TABLES `product_categories` WRITE;
/*!40000 ALTER TABLE `product_categories` DISABLE KEYS */;
INSERT INTO `product_categories` VALUES (1,'RMM','Bahan Baku Mentah','Bahan baku berasal dari supplier',NULL,NULL,NULL,NULL,NULL),(2,'RMG','Bahan Baku','Bahan baku untuk produksi',NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `product_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8mb3_unicode_ci DEFAULT NULL COMMENT 'internal code from company, maybe existing code in other application',
  `name` varchar(50) COLLATE utf8mb3_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb3_unicode_ci,
  `product_category_id` bigint unsigned NOT NULL,
  `image` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_product_category_id_foreign` (`product_category_id`),
  CONSTRAINT `products_product_category_id_foreign` FOREIGN KEY (`product_category_id`) REFERENCES `product_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'RMPRS-001','PRESS PUTIH','PRESS PUTIH',1,NULL,NULL,NULL,NULL,NULL,NULL),(2,'RMPRS-005','PRESS BT','PRESS BT',1,NULL,NULL,NULL,NULL,NULL,NULL),(3,'RMPRS-006','PRESS BT + HJ','PRESS BT + HJ',1,NULL,NULL,NULL,NULL,NULL,NULL),(4,'RMPRS-008','PRESS PROTOLAN','PRESS PROTOLAN',1,NULL,NULL,NULL,NULL,NULL,NULL),(5,'RMPRS-009','PRESS KW 2 LARUTAN','PRESS KW 2 LARUTAN',1,NULL,NULL,NULL,NULL,NULL,NULL),(6,'RMPRS-010','PRESS KW 2 TOPLES','PRESS KW 2 TOPLES',1,NULL,NULL,NULL,NULL,NULL,NULL),(7,'RMPRS-015','PRESS KW 2 + KECAP PUTIH','PRESS KW 2 + KECAP PUTIH',1,NULL,NULL,NULL,NULL,NULL,NULL),(8,'RMPRS-016','PRESS KECAP PUTIH','PRESS KECAP PUTIH',1,NULL,NULL,NULL,NULL,NULL,NULL),(9,'RMPRS-017','PRESS BM','PRESS BM',1,NULL,NULL,NULL,NULL,NULL,NULL),(10,'RMPRS-018','PRESS BOTOL IMPORT','PRESS BOTOL IMPORT',1,NULL,NULL,NULL,NULL,NULL,NULL),(11,'RMPRS-020','PRESS PUTIH JELEK','PRESS PUTIH JELEK',1,NULL,NULL,NULL,NULL,NULL,NULL),(12,'RMPRS-021','PRESS PET TEMBOK','PRESS PET TEMBOK',1,NULL,NULL,NULL,NULL,NULL,NULL),(13,'RMPRS-025','PRESS KECAP WARNA','PRESS KECAP WARNA',1,NULL,NULL,NULL,NULL,NULL,NULL),(14,'RMPRS-029','PRESS LARUTAN + KECAP PUTIH','PRESS LARUTAN + KECAP PUTIH',1,NULL,NULL,NULL,NULL,NULL,NULL),(15,'RMPRS-044','PRESS PET GALON BM','PRESS PET GALON BM',1,NULL,NULL,NULL,NULL,NULL,NULL),(16,'RMPRS-048','PRESS LARUTAN+KW2','PRESS LARUTAN+KW2',1,NULL,NULL,NULL,NULL,NULL,NULL),(17,'PMFLO-002','Flokulan Dexfloc A 1307','Flokulan Dexfloc A 1307',2,NULL,NULL,NULL,NULL,NULL,NULL),(18,'RMBTL-001','BOTOL AFAL','BOTOL AFAL',2,NULL,NULL,NULL,NULL,NULL,NULL),(19,'RMBTL-002','BOTOL RETUR A','BOTOL RETUR A',2,NULL,NULL,NULL,NULL,NULL,NULL),(20,'RMBTL-003','BOTOL RETUR B','BOTOL RETUR B',2,NULL,NULL,NULL,NULL,NULL,NULL),(21,'RMBTL-005','BOTOL MINYAK','BOTOL MINYAK',2,NULL,NULL,NULL,NULL,NULL,NULL),(22,'RMBTL-006','BOTOL KW 2 LARUTAN','BOTOL KW 2 LARUTAN',2,NULL,NULL,NULL,NULL,NULL,NULL),(23,'RMBTL-007','BOTOL MONY','BOTOL MONY',2,NULL,NULL,NULL,NULL,NULL,NULL),(24,'RMBTL-010','BOTOL PET BM','BOTOL PET BM',2,NULL,NULL,NULL,NULL,NULL,NULL),(25,'RMBTL-011','BOTOL PET BT 1','BOTOL PET BT 1',2,NULL,NULL,NULL,NULL,NULL,NULL),(26,'RMBTL-012','BOTOL PET BT 2','BOTOL PET BT 2',2,NULL,NULL,NULL,NULL,NULL,NULL),(27,'RMBTL-015','BOTOL PET HJ 1','BOTOL PET HJ 1',2,NULL,NULL,NULL,NULL,NULL,NULL),(28,'RMBTL-016','BOTOL PET HJ 2','BOTOL PET HJ 2',2,NULL,NULL,NULL,NULL,NULL,NULL),(29,'RMBTL-017','BOTOL PET KECAP PUTIH','BOTOL PET KECAP PUTIH',2,NULL,NULL,NULL,NULL,NULL,NULL),(30,'RMBTL-018','BOTOL PET KOTOR','BOTOL PET KOTOR',2,NULL,NULL,NULL,NULL,NULL,NULL),(31,'RMBTL-020','BOTOL PET KW1','BOTOL PET KW1',2,NULL,NULL,NULL,NULL,NULL,NULL),(32,'RMBTL-021','BOTOL PET KW2','BOTOL PET KW2',2,NULL,NULL,NULL,NULL,NULL,NULL),(33,'RMBTL-024','BOTOL PET TEMBOK A','BOTOL PET TEMBOK A',2,NULL,NULL,NULL,NULL,NULL,NULL),(34,'RMBTL-025','BOTOL PET TEMBOK B','BOTOL PET TEMBOK B',2,NULL,NULL,NULL,NULL,NULL,NULL),(35,'RMBTL-026','BOTOL PET WARNA','BOTOL PET WARNA',2,NULL,NULL,NULL,NULL,NULL,NULL),(36,'RMBTL-029','BOTOL PET WARNA WARNI','BOTOL PET WARNA WARNI',2,NULL,NULL,NULL,NULL,NULL,NULL),(37,'RMBTL-031','BOTOL PREFORM PUTIH','BOTOL PREFORM PUTIH',2,NULL,NULL,NULL,NULL,NULL,NULL),(38,'RMBTL-032','BOTOL PVC','BOTOL PVC',2,NULL,NULL,NULL,NULL,NULL,NULL),(39,'RMBTL-033','BOTOL TOPLES','BOTOL TOPLES',2,NULL,NULL,NULL,NULL,NULL,NULL),(40,'RMBTL-034','BOTOL WIPOL','BOTOL WIPOL',2,NULL,NULL,NULL,NULL,NULL,NULL),(41,'RMBTL-035','BOTOL AFAL PREFORM PUTIH UTUH','BOTOL AFAL PREFORM PUTIH UTUH',2,NULL,NULL,NULL,NULL,NULL,NULL),(42,'RMBTL-036','BOTOL AFAL PREFORM BM UTUH','BOTOL AFAL PREFORM BM UTUH',2,NULL,NULL,NULL,NULL,NULL,NULL),(43,'RMBTL-043','BOTOL IMPORT','BOTOL IMPORT',2,NULL,NULL,NULL,NULL,NULL,NULL),(44,'RMBTL-044','BOTOL PET KW1 BODONG','BOTOL PET KW1 BODONG',2,NULL,NULL,NULL,NULL,NULL,NULL),(45,'RMBTL-045','BOTOL PET KW2 BODONG','BOTOL PET KW2 BODONG',2,NULL,NULL,NULL,NULL,NULL,NULL),(46,'RMBTL-047','BOTOL PET BT 1 BODONG','BOTOL PET BT 1 BODONG',2,NULL,NULL,NULL,NULL,NULL,NULL),(47,'RMBTL-048','BOTOL PET BT 2 BODONG','BOTOL PET BT 2 BODONG',2,NULL,NULL,NULL,NULL,NULL,NULL),(48,'RMBTL-049','BOTOL PET HJ 1 BODONG','BOTOL PET HJ 1 BODONG',2,NULL,NULL,NULL,NULL,NULL,NULL),(49,'RMBTL-050','BOTOL PET KECAP WARNA BODONG','BOTOL PET KECAP WARNA BODONG',2,NULL,NULL,NULL,NULL,NULL,NULL),(50,'RMBTL-051','BOTOL PET BM BODONG','BOTOL PET BM BODONG',2,NULL,NULL,NULL,NULL,NULL,NULL),(51,'RMBTL-052','BOTOL PET TEMBOK A BODONG','BOTOL PET TEMBOK A BODONG',2,NULL,NULL,NULL,NULL,NULL,NULL),(52,'RMBTL-053','BOTOL PET TEMBOK B BODONG','BOTOL PET TEMBOK B BODONG',2,NULL,NULL,NULL,NULL,NULL,NULL),(53,'RMBTL-054','BOTOL RETUR A BODONG','BOTOL RETUR A BODONG',2,NULL,NULL,NULL,NULL,NULL,NULL),(54,'RMBTL-055','BOTOL RETUR B BODONG','BOTOL RETUR B BODONG',2,NULL,NULL,NULL,NULL,NULL,NULL),(55,'RMBTL-056','BOTOL PVC BODONG','BOTOL PVC BODONG',2,NULL,NULL,NULL,NULL,NULL,NULL),(56,'RMBTL-057','LAIN - LAIN BODONG','LAIN - LAIN BODONG',2,NULL,NULL,NULL,NULL,NULL,NULL),(57,'RMBTL-058','PET DAUN BODONG','PET DAUN BODONG',2,NULL,NULL,NULL,NULL,NULL,NULL),(58,'RMBTL-059','GELAS KOTOR (HD) BODONG','GELAS KOTOR (HD) BODONG',2,NULL,NULL,NULL,NULL,NULL,NULL),(59,'RMBTL-060','GELAS BERSIH ( HD ) BODONG','GELAS BERSIH ( HD ) BODONG',2,NULL,NULL,NULL,NULL,NULL,NULL),(60,'RMBTL-061','BOTOL MONY BODONG','BOTOL MONY BODONG',2,NULL,NULL,NULL,NULL,NULL,NULL),(61,'RMBTL-062','GALON PET BODONG','GALON PET BODONG',2,NULL,NULL,NULL,NULL,NULL,NULL),(62,'RMBTL-063','PC GALON BODONG','PC GALON BODONG',2,NULL,NULL,NULL,NULL,NULL,NULL),(63,'RMBTL-066','BOTOL PET KW 2 LARUTAN BODONG','BOTOL PET KW 2 LARUTAN BODONG',2,NULL,NULL,NULL,NULL,NULL,NULL),(64,'RMBTL-067','BOTOL PET HJ 2 BODONG','BOTOL PET HJ 2 BODONG',2,NULL,NULL,NULL,NULL,NULL,NULL),(65,'RMBTL-068','SAMPAH BODONG','SAMPAH BODONG',2,NULL,NULL,NULL,NULL,NULL,NULL),(66,'RMBTL-074','BOTOL PET KECAP PUTIH BODONG','BOTOL PET KECAP PUTIH BODONG',2,NULL,NULL,NULL,NULL,NULL,NULL),(67,'RMBTL-075','BOTOL IMPORT BODONG','BOTOL IMPORT BODONG',2,NULL,NULL,NULL,NULL,NULL,NULL),(68,'RMBTL-077','BOTOL AFAL PUTIH','BOTOL AFAL PUTIH',2,NULL,NULL,NULL,NULL,NULL,NULL),(69,'RMBTL-078','BOTOL AFAL BM','BOTOL AFAL BM',2,NULL,NULL,NULL,NULL,NULL,NULL),(70,'RMBTL-079','BOTOL ISI TANAH BODONG','BOTOL ISI TANAH BODONG',2,NULL,NULL,NULL,NULL,NULL,NULL),(71,'RMBTL-080','BOTOL ISI TANAH','BOTOL ISI TANAH',2,NULL,NULL,NULL,NULL,NULL,NULL),(72,'RMBTL-081','AIR BODONG','AIR BODONG',2,NULL,NULL,NULL,NULL,NULL,NULL),(73,'RMBTL-082','AIR','AIR',2,NULL,NULL,NULL,NULL,NULL,NULL),(74,'RMBTL-083','KW2 IMPOR BODONG','KW2 IMPOR BODONG',2,NULL,NULL,NULL,NULL,NULL,NULL),(75,'RMBTL-086','BOTOL MIX BM PUTIH','BOTOL MIX BM PUTIH',2,NULL,NULL,NULL,NULL,NULL,NULL),(76,'RMBTL-087','BOTOL PREFORM PET TEMBOK','BOTOL PREFORM PET TEMBOK',2,NULL,NULL,NULL,NULL,NULL,NULL),(77,'RMBTL-089','BOTOL MIX BM PUTIH BODONG','BOTOL MIX BM PUTIH BODONG',2,NULL,NULL,NULL,NULL,NULL,NULL),(78,'RMBTL-090','Botol Toples Bodong','Botol Toples Bodong',2,NULL,NULL,NULL,NULL,NULL,NULL),(79,'RMBTL-091','BOTOL PET VAKUM','BOTOL PET VAKUM',2,NULL,NULL,NULL,NULL,NULL,NULL),(80,'RMGAL-001','GALON PET BM','GALON PET BM',2,NULL,NULL,NULL,NULL,NULL,NULL),(81,'RMGAL-002','GALON LE MINERAL BODONG','GALON LE MINERAL BODONG',2,NULL,NULL,NULL,NULL,NULL,NULL),(82,'RMGAL-003','GALON LE MINERAL','GALON LE MINERAL',2,NULL,NULL,NULL,NULL,NULL,NULL),(83,'RMGAL-004','GALON PET PUTIH','GALON PET PUTIH',2,NULL,NULL,NULL,NULL,NULL,NULL),(84,'RMGLS-001','GELAS BERSIH (HD)','GELAS BERSIH (HD)',2,NULL,NULL,NULL,NULL,NULL,NULL),(85,'RMGLS-002','GELAS KOTOR (HD)','GELAS KOTOR (HD)',2,NULL,NULL,NULL,NULL,NULL,NULL),(86,'RMKAL-001','KALENG','KALENG',2,NULL,NULL,NULL,NULL,NULL,NULL),(87,'RMKAR-001','KARDUS','KARDUS',2,NULL,NULL,NULL,NULL,NULL,NULL),(88,'RMKAW-001','KAWAT','KAWAT',2,NULL,NULL,NULL,NULL,NULL,NULL),(89,'RMLAI-001','LAIN - LAIN','LAIN - LAIN',2,NULL,NULL,NULL,NULL,NULL,NULL),(90,'RMPC-001','PC GALON (HD)','PC GALON (HD)',2,NULL,NULL,NULL,NULL,NULL,NULL),(91,'RMPET-001','PET DAUN','PET DAUN',2,NULL,NULL,NULL,NULL,NULL,NULL),(92,'RMSAM-001','SAMPAH','SAMPAH',2,NULL,NULL,NULL,NULL,NULL,NULL),(93,'RMTAL-001','KARUNG','KARUNG',2,NULL,NULL,NULL,NULL,NULL,NULL),(94,'RMTAL-002','TALI + KARDUS','TALI + KARDUS',2,NULL,NULL,NULL,NULL,NULL,NULL),(95,'RMTAL-003','TALI + KARUNG + KARDUS','TALI + KARUNG + KARDUS',2,NULL,NULL,NULL,NULL,NULL,NULL),(96,'RMTAL-010','TALI','TALI',2,NULL,NULL,NULL,NULL,NULL,NULL),(97,'RMTTP-001','HDA TUTUP SEMBUR','HDA TUTUP SEMBUR',2,NULL,NULL,NULL,NULL,NULL,NULL),(98,'RMTTP-002','TUTUP GALON','TUTUP GALON',2,NULL,NULL,NULL,NULL,NULL,NULL),(99,'RMTTP-004','HDA TUTUP SEMBUR BODONG','HDA TUTUP SEMBUR BODONG',2,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),(8,1),(9,1),(10,1),(11,1),(12,1),(13,1),(14,1),(15,1),(16,1),(17,1),(18,1),(19,1),(20,1),(21,1),(22,1),(23,1),(24,1),(25,1),(26,1),(27,1),(28,1),(29,1),(30,1),(31,1),(32,1),(33,1),(34,1),(35,1),(36,1),(37,1),(38,1),(39,1),(40,1),(41,1),(42,1),(43,1),(44,1);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'administrator','web','2021-10-26 15:21:21','2021-10-26 15:21:21');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Administrator','admin@admin.com','2024-05-23 00:40:41','$2y$10$GDqulaUwsZa3lsok3l/JWuwts.m9h7uWfU5m3yhQoiOdXXGW7C3IW',NULL,'2024-05-23 00:40:41','2024-05-23 00:40:41',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'gudang'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-05-23  8:48:16
