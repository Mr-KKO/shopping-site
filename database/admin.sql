-- MySQL dump 10.17  Distrib 10.3.11-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: shop
-- ------------------------------------------------------
-- Server version	10.3.11-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Dumping data for table `admin_menu`
--

LOCK TABLES `admin_menu` WRITE;
/*!40000 ALTER TABLE `admin_menu` DISABLE KEYS */;
INSERT INTO `admin_menu` VALUES (1,0,1,'Dashboard','fa-bar-chart','/',NULL,NULL,NULL),(2,0,7,'Admin','fa-tasks','',NULL,NULL,'2019-07-05 09:44:31'),(3,2,8,'Users','fa-users','auth/users',NULL,NULL,'2019-07-05 09:44:31'),(4,2,9,'Roles','fa-user','auth/roles',NULL,NULL,'2019-07-05 09:44:31'),(5,2,10,'Permission','fa-ban','auth/permissions',NULL,NULL,'2019-07-05 09:44:31'),(6,2,11,'Menu','fa-bars','auth/menu',NULL,NULL,'2019-07-05 09:44:31'),(7,2,12,'Operation log','fa-history','auth/logs',NULL,NULL,'2019-07-05 09:44:31'),(8,0,2,'Accounts','fa-users','users',NULL,'2019-06-20 07:08:30','2019-06-21 03:02:20'),(9,0,3,'Goods','fa-diamond','/products',NULL,'2019-06-21 03:01:40','2019-06-21 03:02:20'),(10,0,6,'test','fa-tablet','/tests',NULL,'2019-06-27 06:51:31','2019-07-05 09:44:31'),(11,0,4,'Orders','fa-first-order','/orders',NULL,'2019-07-05 02:42:29','2019-07-05 03:57:28'),(12,0,5,'Coupons','fa-tags','/coupon_codes',NULL,'2019-07-05 09:44:24','2019-07-05 09:44:31');
/*!40000 ALTER TABLE `admin_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `admin_permissions`
--

LOCK TABLES `admin_permissions` WRITE;
/*!40000 ALTER TABLE `admin_permissions` DISABLE KEYS */;
INSERT INTO `admin_permissions` VALUES (1,'All permission','*','','*',NULL,NULL),(2,'Dashboard','dashboard','GET','/',NULL,NULL),(3,'Login','auth.login','','/auth/login\r\n/auth/logout',NULL,NULL),(4,'User setting','auth.setting','GET,PUT','/auth/setting',NULL,NULL),(5,'Auth management','auth.management','','/auth/roles\r\n/auth/permissions\r\n/auth/menu\r\n/auth/logs',NULL,NULL),(6,'用户管理','users','','/users*','2019-06-20 07:50:16','2019-06-20 07:50:16'),(7,'商品管理','products','','/products*','2019-07-08 09:01:01','2019-07-08 09:01:01'),(8,'优惠券管理','coupon_codes','','/coupon_codes*','2019-07-08 09:01:43','2019-07-08 09:01:43'),(9,'订单管理','orders','','/orders*','2019-07-08 09:02:13','2019-07-08 09:02:13');
/*!40000 ALTER TABLE `admin_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `admin_role_menu`
--

LOCK TABLES `admin_role_menu` WRITE;
/*!40000 ALTER TABLE `admin_role_menu` DISABLE KEYS */;
INSERT INTO `admin_role_menu` VALUES (1,2,NULL,NULL);
/*!40000 ALTER TABLE `admin_role_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `admin_role_permissions`
--

LOCK TABLES `admin_role_permissions` WRITE;
/*!40000 ALTER TABLE `admin_role_permissions` DISABLE KEYS */;
INSERT INTO `admin_role_permissions` VALUES (1,1,NULL,NULL),(2,6,NULL,NULL),(3,2,NULL,NULL),(3,3,NULL,NULL),(3,4,NULL,NULL),(3,6,NULL,NULL),(3,7,NULL,NULL),(3,8,NULL,NULL),(3,9,NULL,NULL);
/*!40000 ALTER TABLE `admin_role_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `admin_role_users`
--

LOCK TABLES `admin_role_users` WRITE;
/*!40000 ALTER TABLE `admin_role_users` DISABLE KEYS */;
INSERT INTO `admin_role_users` VALUES (1,1,NULL,NULL),(2,2,NULL,NULL),(3,3,NULL,NULL);
/*!40000 ALTER TABLE `admin_role_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `admin_roles`
--

LOCK TABLES `admin_roles` WRITE;
/*!40000 ALTER TABLE `admin_roles` DISABLE KEYS */;
INSERT INTO `admin_roles` VALUES (1,'Administrator','administrator','2019-06-20 06:04:31','2019-06-20 06:04:31'),(2,'账号管理员','account_handler','2019-06-20 07:54:35','2019-06-20 07:54:35'),(3,'运营','operator','2019-07-08 09:03:52','2019-07-08 09:03:52');
/*!40000 ALTER TABLE `admin_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `admin_user_permissions`
--

LOCK TABLES `admin_user_permissions` WRITE;
/*!40000 ALTER TABLE `admin_user_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin_user_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `admin_users`
--

LOCK TABLES `admin_users` WRITE;
/*!40000 ALTER TABLE `admin_users` DISABLE KEYS */;
INSERT INTO `admin_users` VALUES (1,'admin','$2y$10$nY3OvMPYGwUGKtXEHQX0ZulYqxKEeficiH.9hLIwigvIo9Ceuq4za','Administrator',NULL,'OEQjRCckRistWOfhr9ulrrLSmB0lfTfBMZmaDFlomHv4mwjTryKm9BnOYG3S','2019-06-20 06:04:30','2019-06-20 06:22:50'),(2,'account_handler','$2y$10$9aw7VZSfY5gR38OnWqJbJuoZyY9Pc9FuIsd4EijV0pcKc2T6WR976','账号管理员','images/26ed195281334ba4b1752394b60eb29a.jpeg','rHpBYCqzX5FX5KYJZfqPKB84GBYIzWfn7mpMpk5wlWckkxiUsfxqCmtrCiIo','2019-06-20 07:59:39','2019-06-20 07:59:39'),(3,'operator','$2y$10$WOSeYvhoXoA0674zQGkAh.fn0q8PDAwdoqKeKA5lVPmxu/jyxxDCa','运营','images/logo_108x108.png','l5LYhPYO5JOOJDtpATIk5PmXQVucmUa05vERzriSxZAkgjIcP2ktry6A5JAW','2019-07-08 09:06:27','2019-07-08 09:06:51');
/*!40000 ALTER TABLE `admin_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-07-08 17:23:36
