-- MySQL dump 10.13  Distrib 8.0.31, for Linux (x86_64)
--
-- Host: localhost    Database: booking_hotel
-- ------------------------------------------------------
-- Server version	8.0.31-0ubuntu0.20.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
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
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admins` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `avatar` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `birthday` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `gender` tinyint NOT NULL,
  `indetity_cart` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `phone_number` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `email_verified_at` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `level` int NOT NULL,
  `status` tinyint NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,'166601871420221017215834py80OCoYZ9cM9kehwttT77uCHzg64Kty1dUMh1kd.jpg','Khách sạn Gia Huy','2022-10-16 12:44:53',1,'9999','19008198','Ha Noi','admin@gmail.com',NULL,'$2y$10$4edleQ7FIcS8PthADtoE.uiy3SBXgEcRg0cNNLMbJKRudJkVsRMC2',1,1,'ZP3x2nYdOhXj00vCARZqkD7m3QlnAtaMq3QiFg5qIJAATWxSLcGalm7fsBbO','2022-10-16 05:44:53','2022-10-16 05:44:53');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `sort_id` tinyint NOT NULL DEFAULT '0',
  `thumbnail` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `description` mediumtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Master',1,'166601814920221017214909V4zwjOskVVpCmml3od9FMVZXwHR3GGauNJXPTCCv.png','master','Master','2019-05-25 09:50:50','2022-11-05 12:23:03');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reservations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `room_id` int unsigned NOT NULL,
  `phone` varchar(11) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `check_in_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `check_out_at` timestamp NOT NULL DEFAULT '1999-12-31 17:00:00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT '1',
  `user_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `reservations_room_no_foreign` (`room_id`),
  KEY `reservations_users_id_foreign` (`user_id`),
  CONSTRAINT `reservations_room_no_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE,
  CONSTRAINT `reservations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservations`
--

LOCK TABLES `reservations` WRITE;
/*!40000 ALTER TABLE `reservations` DISABLE KEYS */;
INSERT INTO `reservations` VALUES (6,1,'0981248920','Hoàng','2022-11-07 12:20:00','2022-11-08 02:45:00','2022-11-05 12:21:14','2022-11-05 12:21:14','1',1),(7,1,'0981248920','Hoàng','2022-11-18 07:25:00','2022-11-18 16:25:00','2022-11-05 12:22:22','2022-11-05 12:22:22','1',1);
/*!40000 ALTER TABLE `reservations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rooms`
--

DROP TABLE IF EXISTS `rooms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rooms` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `thumbnail` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `content` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `category_id` int unsigned NOT NULL,
  `qty` int NOT NULL DEFAULT '0',
  `avaiable` int NOT NULL DEFAULT '1',
  `booked` int NOT NULL DEFAULT '0',
  `no_bed` int NOT NULL DEFAULT '1',
  `bed_type` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `facility` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `price` int NOT NULL DEFAULT '0',
  `view_count` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `posts_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rooms`
--

LOCK TABLES `rooms` WRITE;
/*!40000 ALTER TABLE `rooms` DISABLE KEYS */;
INSERT INTO `rooms` VALUES (1,'Vinpearl Resort Nha Trang','1666024240202210172330403PyUDbaUpepC1awlD5p25FoWkzKxXbEafz6H0Txm.jpg','Đỗ xe và Wi-Fi luôn miễn phí, vì vậy quý khách có thể giữ liên lạc, đến và đi tùy ý. Nằm ở vị trí trung tâm tại Hòn Tre của Nha Trang, chỗ nghỉ này đặt quý khách ở gần các điểm thu hút và tùy chọn ăn uống thú vị. Đừng rời đi trước khi ghé thăm Vinpearl Land Nha Trang nổi tiếng. Được xếp hạng 5 sao, chỗ nghỉ chất lượng cao này cho phép khách nghỉ sử dụng mát-xa, bể bơi ngoài trời và bồn tắm nước nóng ngay trong khuôn viên.','<div>Dịch vụ tiện &iacute;ch :</div>\r\n\r\n<p>Miễn ph&iacute; 2 suất ăn s&aacute;ng</p>\r\n\r\n<p>V&eacute; c&ocirc;ng vi&ecirc;n giải tr&iacute;, B&atilde;i đậu xe, Nước uống ch&agrave;o đ&oacute;n, C&agrave; ph&ecirc; &amp; tr&agrave;, WiFi miễn ph&iacute;, Nước uống, Ph&ograve;ng tập</p>\r\n\r\n<p>Miễn ph&iacute; hủy trước 19 th&aacute;ng mười 2022</p>','vinpearl-resort-nha-ok',1,0,1,0,4,'Giường đôi','Bàn tiếp tân [24 giờ]\r\n\r\nĐưa đón sân bay\r\n\r\nThuê xe đạp\r\n\r\nBãi đỗ xe có nhân viên\r\n\r\nCLB trẻ em\r\n\r\nPhòng tập\r\n\r\nDịch vụ đưa đón\r\n\r\nWi-Fi miễn phí trong tất cả các phòng!',2556789,0,'2022-10-17 16:30:40','2022-11-05 12:23:24'),(6,'Vinpearl Resort Nha Trang','1666024240202210172330403PyUDbaUpepC1awlD5p25FoWkzKxXbEafz6H0Txm.jpg','Đỗ xe và Wi-Fi luôn miễn phí, vì vậy quý khách có thể giữ liên lạc, đến và đi tùy ý. Nằm ở vị trí trung tâm tại Hòn Tre của Nha Trang, chỗ nghỉ này đặt quý khách ở gần các điểm thu hút và tùy chọn ăn uống thú vị. Đừng rời đi trước khi ghé thăm Vinpearl Land Nha Trang nổi tiếng. Được xếp hạng 5 sao, chỗ nghỉ chất lượng cao này cho phép khách nghỉ sử dụng mát-xa, bể bơi ngoài trời và bồn tắm nước nóng ngay trong khuôn viên.','<p>Dịch vụ tiện &iacute;ch:</p>\r\n\r\n<p>Miễn ph&iacute; 2 suất ăn s&aacute;ng</p>\r\n\r\n<p>V&eacute; c&ocirc;ng vi&ecirc;n giải tr&iacute;, B&atilde;i đậu xe, Nước uống ch&agrave;o đ&oacute;n, C&agrave; ph&ecirc; &amp; tr&agrave;, WiFi miễn ph&iacute;, Nước uống, Ph&ograve;ng tập</p>\r\n\r\n<p>Miễn ph&iacute; hủy trước 19 th&aacute;ng mười 2022</p>\r\n\r\n<div class=\"ddict_btn\" style=\"left:1623px; top:19px\"><img src=\"chrome-extension://bpggmmljdiliancllaapiggllnkbjocb/logo/48.png\" /></div>','vinpearl-resort-nha-trang',1,0,1,0,4,'Giường đôi','Bàn tiếp tân [24 giờ]\r\n\r\nĐưa đón sân bay\r\n\r\nThuê xe đạp\r\n\r\nBãi đỗ xe có nhân viên\r\n\r\nCLB trẻ em\r\n\r\nPhòng tập\r\n\r\nDịch vụ đưa đón\r\n\r\nWi-Fi miễn phí trong tất cả các phòng!',2556789,0,'2022-10-17 16:30:40','2022-11-05 04:10:17');
/*!40000 ALTER TABLE `rooms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `password` varchar(2000) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `status` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Hoàng','0981248920','$2y$10$gJIE9kO5FycFzegdmYP5r.ZX7FQuIl4hEpsY9xZJifHoUgTkQ/2M6',NULL,1,'2022-10-29 10:58:49','2022-10-29 10:58:49','xnul5SLnHlz69uqYuhKGLI1qjOSXCeaXHEFA9oI3RXsxvxNBbR17LLH0PfLP'),(2,'Tú','0981248922','$2y$10$jg6jqKvCFbBQ9spPUlJYsueccj272DWTqeteD8hC6cHY0LuOk4NRy',NULL,1,'2022-10-29 11:01:15','2022-10-29 11:01:15',NULL),(3,'Trần Văn Minh','0981248999','$2y$10$v6u4hEVJAaQ4urpMSAxFB.1/1SFITTZzaw7Ty3vPaU89xXBof183i',NULL,1,'2022-10-29 11:18:52','2022-10-29 11:18:52','hfrKpQe9aO3Qwjc0MjLMFDYo7uKwxNuBB3lBBfnn3vac0Dwrf4iNK1h0x0Xx');
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

-- Dump completed on 2022-11-05 19:31:03
