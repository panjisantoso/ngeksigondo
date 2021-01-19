/*
SQLyog Ultimate v12.4.3 (64 bit)
MySQL - 10.1.36-MariaDB : Database - db_ngeksigondo
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_ngeksigondo` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `db_ngeksigondo`;

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `sessions` */

DROP TABLE IF EXISTS `sessions`;

CREATE TABLE `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `sessions` */

insert  into `sessions`(`id`,`user_id`,`ip_address`,`user_agent`,`payload`,`last_activity`) values 
('BHop6W13OCU7aYFD2sl7Q9GMO4BTKFjXezOpw4ok',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiYXBPaHpiV09PUktab1Q0VEVObVVYRzBoZnl6czNLdGpiakw1WElCRSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9yZWdpc3RlciI7fX0=',1611054102),
('lKox1FnvkCLTVfWHAJqTri8ZlMbUXXKHfVxnhvkX',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiRjdnQXg1Sm5zSXc1QW0xclVQSkEzTkF6Q2loV2lXRmNjT0VhelRlcSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9iZXJpdGEiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo4MDtzOjE3OiJwYXNzd29yZF9oYXNoX3dlYiI7czo2MDoiJDJ5JDEwJEZxWUswdXZHaHBLRndYLkhEb09LTy5FbVRIb3ZFZnBTdG4yNmg2VWtIQVB5M3hvaFdKbnhxIjt9',1611052168);

/*Table structure for table `tb_berita` */

DROP TABLE IF EXISTS `tb_berita`;

CREATE TABLE `tb_berita` (
  `id_berita` bigint(20) NOT NULL AUTO_INCREMENT,
  `judul_berita` varchar(255) DEFAULT NULL,
  `isi_berita` text,
  `tanggal_berita` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `id_user` bigint(20) DEFAULT NULL,
  `status` enum('1','0') DEFAULT NULL,
  PRIMARY KEY (`id_berita`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_berita` */

/*Table structure for table `tb_dokumentasi_kegiatan` */

DROP TABLE IF EXISTS `tb_dokumentasi_kegiatan`;

CREATE TABLE `tb_dokumentasi_kegiatan` (
  `id_dokumentasi` bigint(20) NOT NULL AUTO_INCREMENT,
  `foto` varchar(100) DEFAULT NULL,
  `caption` varchar(100) DEFAULT NULL,
  `id_kegiatan` bigint(20) DEFAULT NULL,
  `status` enum('1','0') DEFAULT NULL,
  PRIMARY KEY (`id_dokumentasi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_dokumentasi_kegiatan` */

/*Table structure for table `tb_jenis_layanan` */

DROP TABLE IF EXISTS `tb_jenis_layanan`;

CREATE TABLE `tb_jenis_layanan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_layanan` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_jenis_layanan` */

/*Table structure for table `tb_kabupaten` */

DROP TABLE IF EXISTS `tb_kabupaten`;

CREATE TABLE `tb_kabupaten` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kabupaten` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `tb_kabupaten` */

insert  into `tb_kabupaten`(`id`,`nama_kabupaten`,`status`) values 
(1,'Badung',1),
(2,'Bangli',1),
(3,'Buleleng',1),
(4,'Denpasar',1),
(5,'Gianyar',1),
(6,'Jembrana',1),
(7,'Karangasem',1),
(8,'Klungkung',1),
(9,'Tabanan',1),
(10,'tes',0),
(11,'Badungs',0);

/*Table structure for table `tb_kecamatan` */

DROP TABLE IF EXISTS `tb_kecamatan`;

CREATE TABLE `tb_kecamatan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kecamatan` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `id_kabupaten` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_kabupaten` (`id_kabupaten`),
  CONSTRAINT `tb_kecamatan_ibfk_1` FOREIGN KEY (`id_kabupaten`) REFERENCES `tb_kabupaten` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;

/*Data for the table `tb_kecamatan` */

insert  into `tb_kecamatan`(`id`,`nama_kecamatan`,`id_kabupaten`) values 
(1,'Abiansemal',1),
(2,'Kuta',1),
(3,'Kuta Selatan',1),
(4,'Kuta Utara',1),
(5,'Mengwi',1),
(6,'Petang',1),
(7,'Bangli',2),
(8,'Kintamani',2),
(9,'Susut',2),
(10,'Tembuku',2),
(11,'Banjar',3),
(12,'Buleleng',3),
(13,'Busungbiu',3),
(14,'Gerokgak',3),
(15,'Kubutambahan',3),
(16,'Sawan',3),
(17,'Seririt',3),
(18,'Sukasada',3),
(19,'Tejakula',3),
(20,'Denpasar Barat',4),
(21,'Denpasar Selatan',4),
(22,'Denpasar Timur',4),
(23,'Denpasar Utara',4),
(24,'Blahbatuh',5),
(25,'Gianyar',5),
(26,'Payangan',5),
(27,'Sukawati',5),
(28,'Tampaksiring',5),
(29,'Tegallalang',5),
(30,'Ubud',5),
(31,'Jembrana',6),
(32,'Melaya',6),
(33,'Mendoyo',6),
(34,'Negara',6),
(35,'Pekutatan',6),
(36,'Abang',7),
(37,'Bebandem',7),
(38,'Karangasem',7),
(39,'Kubu',7),
(40,'Manggis',7),
(41,'Rendang',7),
(42,'Selat',7),
(43,'Sidemen',7),
(44,'Banjarangkan',8),
(45,'Dawan',8),
(46,'Klungkung',8),
(47,'Nusapenida',8),
(48,'Baturiti',9),
(49,'Kediri',9),
(50,'Kerambitan',9),
(51,'Marga',9),
(52,'Penebel',9),
(53,'Pupuan',9),
(54,'Selemadeg',9),
(55,'Selemadeg Barat',9),
(56,'Selemadeg Timur',9),
(57,'Tabanan',9);

/*Table structure for table `tb_kegiatan` */

DROP TABLE IF EXISTS `tb_kegiatan`;

CREATE TABLE `tb_kegiatan` (
  `id_kegiatan` int(11) NOT NULL AUTO_INCREMENT,
  `acara` varchar(200) DEFAULT NULL,
  `tempat` varchar(200) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `jammulai` time DEFAULT NULL,
  `jamselesai` time DEFAULT NULL,
  PRIMARY KEY (`id_kegiatan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_kegiatan` */

/*Table structure for table `tb_kelurahan` */

DROP TABLE IF EXISTS `tb_kelurahan`;

CREATE TABLE `tb_kelurahan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kelurahan` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `id_kecamatan` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_kecamatan` (`id_kecamatan`),
  CONSTRAINT `tb_kelurahan_ibfk_1` FOREIGN KEY (`id_kecamatan`) REFERENCES `tb_kecamatan` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=713 DEFAULT CHARSET=latin1;

/*Data for the table `tb_kelurahan` */

insert  into `tb_kelurahan`(`id`,`nama_kelurahan`,`id_kecamatan`) values 
(1,'Abiansemal',1),
(2,'Angantaka',1),
(3,'Ayunan',1),
(4,'Blahkiuh',1),
(5,'Bongkasa',1),
(6,'Bongkasa Pertiwi',1),
(7,'Darmasaba',1),
(8,'Dauh Yeh Cani',1),
(9,'Jagapati',1),
(10,'Mambal',1),
(11,'Mekar Bhuwana',1),
(12,'Punggul',1),
(13,'Sangeh',1),
(14,'Sedang',1),
(15,'Selat',1),
(16,'Sibang Gede',1),
(17,'Sibang Kaja',1),
(18,'Taman',1),
(19,'Kedonganan',2),
(20,'Kuta',2),
(21,'Legian',2),
(22,'Seminyak',2),
(23,'Tuban',2),
(24,'Benoa',3),
(25,'Jimbaran',3),
(26,'Kutuh',3),
(27,'Pecatu',3),
(28,'Tanjung Benoa',3),
(29,'Ungasan',3),
(30,'Canggu',4),
(31,'Dalung',4),
(32,'Kerobokan',4),
(33,'Kerobokan Kaja',4),
(34,'Kerobokan Kelod',4),
(35,'Tibubeneng',4),
(36,'Abianbase',5),
(37,'Baha',5),
(38,'Buduk',5),
(39,'Cemagi',5),
(40,'Gulingan',5),
(41,'Kapal',5),
(42,'Kekeran',5),
(43,'Kuwum',5),
(44,'Lukluk',5),
(45,'Mengwi',5),
(46,'Mengwitani',5),
(47,'Munggu',5),
(48,'Penarungan',5),
(49,'Pererenan',5),
(50,'Sading',5),
(51,'Sembung',5),
(52,'Sempidi',5),
(53,'Sobangan',5),
(54,'Tumbak Bayuh',5),
(55,'Werdi Bhuwana',5),
(56,'Belok',6),
(57,'Carangsari',6),
(58,'Getasan',6),
(59,'Pangsan',6),
(60,'Pelaga',6),
(61,'Petang',6),
(62,'Sulangai',6),
(63,'Bebalang',7),
(64,'Bunutin',7),
(65,'Cempaga',7),
(66,'Kawan',7),
(67,'Kayubihi',7),
(68,'Kubu',7),
(69,'Landih',7),
(70,'Pengotan',7),
(71,'Taman Bali',7),
(72,'Abang Batu Dinding',8),
(73,'Abang Songan',8),
(74,'Abuan',8),
(75,'Awan',8),
(76,'Bantang',8),
(77,'Banua',8),
(78,'Batukaang',8),
(79,'Batur Selatan',8),
(80,'Batur Tengah',8),
(81,'Batur Utara',8),
(82,'Bayungcerik',8),
(83,'Bayunggede',8),
(84,'Belancan',8),
(85,'Belandingan',8),
(86,'Belanga',8),
(87,'Belantih',8),
(88,'Binyan',8),
(89,'Bonyoh',8),
(90,'Buahan',8),
(91,'Bunutin',8),
(92,'Catur',8),
(93,'Daup',8),
(94,'Dausa',8),
(95,'Gunungbau',8),
(96,'Katung',8),
(97,'Kedisan',8),
(98,'Kintamani',8),
(99,'Kutuh',8),
(100,'Langgahan',8),
(101,'Lembean',8),
(102,'Mangguh',8),
(103,'Manikliyu',8),
(104,'Mengani',8),
(105,'Pengejaran',8),
(106,'Pinggan',8),
(107,'Satra',8),
(108,'Sekaan',8),
(109,'Sekardadi',8),
(110,'Selulung',8),
(111,'Serahi',8),
(112,'Siyakin',8),
(113,'Songan A',8),
(114,'Songan B',8),
(115,'Subaya',8),
(116,'Sukawana',8),
(117,'Suter',8),
(118,'Terunyan',8),
(119,'Ulian',8),
(120,'Abuan',9),
(121,'Apuan',9),
(122,'Demulih',9),
(123,'Pengiangan',9),
(124,'Penglumbaran',9),
(125,'Selat',9),
(126,'Sulahan',9),
(127,'Susut',9),
(128,'Tiga',9),
(129,'Bangbang',10),
(130,'Jehem',10),
(131,'Peninjoan',10),
(132,'Tembuku',10),
(133,'Undisan',10),
(134,'Yangapi',10),
(135,'Banjar',11),
(136,'Banjar Tegeha',11),
(137,'Banyuatis',11),
(138,'Banyusri',11),
(139,'Cempaga',11),
(140,'Dencarik',11),
(141,'Gesing',11),
(142,'Gobleg',11),
(143,'Kaliasem',11),
(144,'Kayuputih',11),
(145,'Munduk',11),
(146,'Pedawa',11),
(147,'Sidetapa',11),
(148,'Tampekan',11),
(149,'Temukus',11),
(150,'Tigawasa',11),
(151,'Tirtasari',11),
(152,'Alasangker',12),
(153,'Anturan',12),
(154,'Astina',12),
(155,'Baktiseraga',12),
(156,'Banjar Bali',12),
(157,'Banjar Jawa',12),
(158,'Banjar Tegal',12),
(159,'Banyuasri',12),
(160,'Banyuning',12),
(161,'Beratan',12),
(162,'Jinengdalem',12),
(163,'Kaliuntu',12),
(164,'Kampung Anyar',12),
(165,'Kampung Baru',12),
(166,'Kampung Bugis',12),
(167,'Kampung Kajanan',12),
(168,'Kampung Singaraja',12),
(169,'Kendran',12),
(170,'Liligundi',12),
(171,'Nagasepaha',12),
(172,'Paket Agung',12),
(173,'Pemaron',12),
(174,'Penarukan',12),
(175,'Penglatan',12),
(176,'Petandakan',12),
(177,'Poh Bergong',12),
(178,'Sari Mekar',12),
(179,'Tukadmungga',12),
(180,'Bengkel',13),
(181,'Bongancina',13),
(182,'Busungbiu',13),
(183,'Kedis',13),
(184,'Kekeran',13),
(185,'Pelapuan',13),
(186,'Pucaksari',13),
(187,'Sepang',13),
(188,'Sepang Kelod',13),
(189,'Subuk',13),
(190,'Telaga',13),
(191,'Tinggarsari',13),
(192,'Tista',13),
(193,'Titab',13),
(194,'Umejero',13),
(195,'Banyupoh',14),
(196,'Celukan Bawang',14),
(197,'Gerokgak',14),
(198,'Musi',14),
(199,'Patas',14),
(200,'Pejarakan',14),
(201,'Pemuteran',14),
(202,'Pengulon',14),
(203,'Penyabangan',14),
(204,'Sanggalangit',14),
(205,'Sumber Klampok',14),
(206,'Sumberkima',14),
(207,'Tinga Tinga',14),
(208,'Tukad Sumaga',14),
(209,'Bengkala',15),
(210,'Bila',15),
(211,'Bontihing',15),
(212,'Bukti',15),
(213,'Bulian',15),
(214,'Depeha',15),
(215,'Kubutambahan',15),
(216,'Mengening',15),
(217,'Pakisan',15),
(218,'Tajun',15),
(219,'Tambakan',15),
(220,'Tamblang',15),
(221,'Tunjung',15),
(222,'Bebetin',16),
(223,'Bungkulan',16),
(224,'Galungan',16),
(225,'Giri Emas',16),
(226,'Jagaraga',16),
(227,'Kerobokan',16),
(228,'Lemukih',16),
(229,'Menyali',16),
(230,'Sangsit',16),
(231,'Sawan',16),
(232,'Sekumpul',16),
(233,'Sinabun',16),
(234,'Sudaji',16),
(235,'Suwug',16),
(236,'Banjar Asem',17),
(237,'Bestala',17),
(238,'Bubunan',17),
(239,'Gunungsari',17),
(240,'Joanyar',17),
(241,'Kalianget',17),
(242,'Kalisada',17),
(243,'Lokapaksa',17),
(244,'Mayong',17),
(245,'Munduk Bestala',17),
(246,'Pangkungparuk',17),
(247,'Patemon',17),
(248,'Pengastulan',17),
(249,'Rangdu',17),
(250,'Ringdikit',17),
(251,'Seririt',17),
(252,'Sulanyah',17),
(253,'Tangguwisia',17),
(254,'Ularan',17),
(255,'Umeanyar',17),
(256,'Unggahan',17),
(257,'Ambengan',18),
(258,'Gitgit',18),
(259,'Kayuputih',18),
(260,'Padangbulia',18),
(261,'Pancasari',18),
(262,'Panji',18),
(263,'Panji Anom',18),
(264,'Pegadungan',18),
(265,'Pegayaman',18),
(266,'Sambangan',18),
(267,'Selat',18),
(268,'Silangjana',18),
(269,'Sukasada',18),
(270,'Tegal Linggah',18),
(271,'Wanagiri',18),
(272,'Bondalem',19),
(273,'Julah',19),
(274,'Les',19),
(275,'Madenan',19),
(276,'Pacung',19),
(277,'Penuktukan',19),
(278,'Sambirenteng',19),
(279,'Sembiran',19),
(280,'Tejakula',19),
(281,'Tembok',19),
(282,'Dauh Puri',20),
(283,'Dauh Puri Kangin',20),
(284,'Dauh Puri Kauh',20),
(285,'Dauh Puri Klod',20),
(286,'Padangsambian',20),
(287,'Padangsambian Kaja',20),
(288,'Padangsambian Klod',20),
(289,'Pemecutan',20),
(290,'Pemecutan Klod',20),
(291,'Tegal Harum',20),
(292,'Tegal Kertha',20),
(293,'Panjer',21),
(294,'Pedungan',21),
(295,'Pemogan',21),
(296,'Renon',21),
(297,'Sanur',21),
(298,'Sanur Kaja',21),
(299,'Sanur Kauh',21),
(300,'Serangan',21),
(301,'Sesetan',21),
(302,'Sidakarya',21),
(303,'Dangin Puri',22),
(304,'Dangin Puri Klod',22),
(305,'Kesiman',22),
(306,'Kesiman Kertalangu',22),
(307,'Kesiman Petilan',22),
(308,'Penatih',22),
(309,'Penatih Dangin Puri',22),
(310,'Sumerta',22),
(311,'Sumerta Kaja',22),
(312,'Sumerta Kauh',22),
(313,'Sumerta Kelod',22),
(314,'Dangin Puri Kaja',23),
(315,'Dangin Puri Kangin',23),
(316,'Dangin Puri Kauh',23),
(317,'Dauh Puri Kaja',23),
(318,'Peguyangan',23),
(319,'Peguyangan Kaja',23),
(320,'Peguyangan Kangin',23),
(321,'Pemecutan Kaja',23),
(322,'Tonja',23),
(323,'Ubung',23),
(324,'Ubung Kaja',23),
(325,'Bedulu',24),
(326,'Belega',24),
(327,'Blahbatuh',24),
(328,'Bona',24),
(329,'Buruan',24),
(330,'Keramas',24),
(331,'Medahan',24),
(332,'Pering',24),
(333,'Saba',24),
(334,'Abianbase',25),
(335,'Bakbakan',25),
(336,'Beng',25),
(337,'Bitera',25),
(338,'Gianyar',25),
(339,'Lebih',25),
(340,'Petak',25),
(341,'Petak Kaja',25),
(342,'Samplangan',25),
(343,'Serongga',25),
(344,'Siangan',25),
(345,'Sidan',25),
(346,'Sumita',25),
(347,'Suwat',25),
(348,'Tegal Tugu',25),
(349,'Temesi',25),
(350,'Tulikup',25),
(351,'Beresela',26),
(352,'Buahan',26),
(353,'Buahan Kaja',26),
(354,'Bukian',26),
(355,'Kelusa',26),
(356,'Kerta',26),
(357,'Melinggih',26),
(358,'Melinggih Kelod',26),
(359,'Puhu',26),
(360,'Batuan',27),
(361,'Batuan Kaler',27),
(362,'Batubulan',27),
(363,'Batubulan Kangin',27),
(364,'Celuk',27),
(365,'Guwang',27),
(366,'Kemenuh',27),
(367,'Ketewel',27),
(368,'Singapadu',27),
(369,'Singapadu Kaler',27),
(370,'Singapadu Tengah',27),
(371,'Sukawati',27),
(372,'Manukaya',28),
(373,'Pejeng',28),
(374,'Pejeng Kaja',28),
(375,'Pejeng Kangin',28),
(376,'Pejeng Kawan',28),
(377,'Pejeng Kelod',28),
(378,'Sanding',28),
(379,'Tampaksiring',28),
(380,'Kedisan',29),
(381,'Keliki',29),
(382,'Kenderan',29),
(383,'Pupuan',29),
(384,'Sebatu',29),
(385,'Taro',29),
(386,'Tegallalang',29),
(387,'Kedewatan',30),
(388,'Lodtunduh',30),
(389,'Mas',30),
(390,'Peliatan',30),
(391,'Petulu',30),
(392,'Sayan',30),
(393,'Singekerta',30),
(394,'Ubud',30),
(395,'Air Kuning',31),
(396,'Batuagung',31),
(397,'Budeng',31),
(398,'Dangin Tukadaya',31),
(399,'Dauhwaru',31),
(400,'Loloan TImur',31),
(401,'Pendem',31),
(402,'Perancak',31),
(403,'Sangkaragung',31),
(404,'Yeh Kuning',31),
(405,'Blimbingsari',32),
(406,'Candikusuma',32),
(407,'Ekasari',32),
(408,'Gilimanuk',32),
(409,'Manistutu',32),
(410,'Melaya',32),
(411,'Nusa Sari',32),
(412,'Tukadaya',32),
(413,'Tuwed',32),
(414,'Warnasari',32),
(415,'Yeh Embang Kauh',33),
(416,'Delod Berawah',33),
(417,'Mendoyo Dangin Tukad',33),
(418,'Mendoyo Dauh Tukad',33),
(419,'Penyaringan',33),
(420,'Pergung',33),
(421,'Pohsanten',33),
(422,'Tegal Cangkring',33),
(423,'Yeh Embang',33),
(424,'Yeh Embang Kangin',33),
(425,'Yeh Sumbul',33),
(426,'Baler Bale Agung',34),
(427,'Baluk',34),
(428,'Banjar Tengah',34),
(429,'Banyubiru',34),
(430,'Berangbang',34),
(431,'Cupel',34),
(432,'Kaliakah',34),
(433,'Lelateng',34),
(434,'Loloan Barat',34),
(435,'Pengambengan',34),
(436,'Tegal Badeng Barat',34),
(437,'Tegal Badeng Timur',34),
(438,'Asahduren',35),
(439,'Gumbrih',35),
(440,'Manggissari',35),
(441,'Medewi',35),
(442,'Pangyangan',35),
(443,'Pekutatan',35),
(444,'Pengeragoan',35),
(445,'Pulukan',35),
(446,'Ababi',36),
(447,'Abang',36),
(448,'Bunutan',36),
(449,'Culik',36),
(450,'Datah',36),
(451,'Kerta Mandala',36),
(452,'Kesimpar',36),
(453,'Laba Sari',36),
(454,'Nawakerti',36),
(455,'Pidpid',36),
(456,'Purwakerti',36),
(457,'Tista',36),
(458,'Tiyingtali',36),
(459,'Tri Buana',36),
(460,'Bebandem',37),
(461,'Bhuana Giri',37),
(462,'Budakeling',37),
(463,'Bungaya',37),
(464,'Bungaya Kangin',37),
(465,'Jungutan',37),
(466,'Macang',37),
(467,'Sibetan',37),
(468,'Bugbug',38),
(469,'Bukit',38),
(470,'Karangasem',38),
(471,'Padang Kerta',38),
(472,'Pertima',38),
(473,'Seraya',38),
(474,'Seraya Barat',38),
(475,'Seraya Timur',38),
(476,'Subagan',38),
(477,'Tegallinggah',38),
(478,'Tumbu',38),
(479,'Ban',39),
(480,'Baturinggit',39),
(481,'Dukuh',39),
(482,'Kubu',39),
(483,'Sukadana',39),
(484,'Tianyar',39),
(485,'Tianyar Barat',39),
(486,'Tianyar Tengah',39),
(487,'Tulamben',39),
(488,'Antiga',40),
(489,'Antiga Kelod',40),
(490,'Gegelang',40),
(491,'Manggis',40),
(492,'Ngis',40),
(493,'Nyuh Tebel',40),
(494,'Padangbai',40),
(495,'Pesedahan',40),
(496,'Selumbung',40),
(497,'Sengkidu',40),
(498,'Tenganan',40),
(499,'Ulakan',40),
(500,'Besakih',41),
(501,'Menanga',41),
(502,'Nongan',41),
(503,'Pempatan',41),
(504,'Pesaban',41),
(505,'Rendang',41),
(506,'Amerta Bhuana',42),
(507,'Duda',42),
(508,'Duda Timur',42),
(509,'Duda Utara',42),
(510,'Muncan',42),
(511,'Pering Sari',42),
(512,'Sebudi',42),
(513,'Selat',42),
(514,'Kertha Buana',43),
(515,'Loka Sari',43),
(516,'Sangkan Gunung',43),
(517,'Sidemen',43),
(518,'Sindu Wati',43),
(519,'Talibeng',43),
(520,'Tangkup',43),
(521,'Telaga Tawang',43),
(522,'Tri Eka Buana',43),
(523,'Wisma Kerta',43),
(524,'Bakas',44),
(525,'Banjarangkan',44),
(526,'Getakan',44),
(527,'Negari',44),
(528,'Nyalian',44),
(529,'Takmung',44),
(530,'Tihingan',44),
(531,'Tusan',44),
(532,'Aan',45),
(533,'Bungbungan',45),
(534,'Nyanglan',45),
(535,'Timuhun',45),
(536,'Tohpati',45),
(537,'Besan',45),
(538,'Dawan Kaler',45),
(539,'Dawan Klod',45),
(540,'Gunaksa',45),
(541,'Kampung Kusamba',45),
(542,'Kusamba',45),
(543,'Paksebali',45),
(544,'Pesinggahan',45),
(545,'Pikat',45),
(546,'Sampalan Klod',45),
(547,'Sampalan Tengah',45),
(548,'Sulang',45),
(549,'Akah',46),
(550,'Gelgel',46),
(551,'Jumpai',46),
(552,'Kamasan',46),
(553,'Kampung Gelgel',46),
(554,'Manduang',46),
(555,'Satra',46),
(556,'Selat',46),
(557,'Selisihan',46),
(558,'Semarapura Kaja',46),
(559,'Semarapura Kangin',46),
(560,'Semarapura Kauh',46),
(561,'Semarapura Kelod',46),
(562,'Semarapura Kelod Kangin',46),
(563,'Semarapura Tengah',46),
(564,'Tangkas',46),
(565,'Tegak',46),
(566,'Tojan',46),
(567,'Batukandik',47),
(568,'Batumadeg',47),
(569,'Batununggul',47),
(570,'Bunga Mekar',47),
(571,'Jungutbatu',47),
(572,'Kampung Toyapakeh',47),
(573,'Klumpu',47),
(574,'Kutampi',47),
(575,'Kutampi Kaler',47),
(576,'Lembongan',47),
(577,'Ped',47),
(578,'Pejukutan',47),
(579,'Sakti',47),
(580,'Sekartaji',47),
(581,'Suana',47),
(582,'Tanglad',47),
(583,'Angseri',48),
(584,'Antapan',48),
(585,'Apuan',48),
(586,'Bangli',48),
(587,'Batunya',48),
(588,'Baturiti',48),
(589,'Candikuning',48),
(590,'Luwus',48),
(591,'Mekarsari',48),
(592,'Perean',48),
(593,'Perean Kangin',48),
(594,'Perean Tengah',48),
(595,'Abian Tuwung',49),
(596,'Banjar Anyar',49),
(597,'Belalang',49),
(598,'Bengkel',49),
(599,'Beraban',49),
(600,'Cepaka',49),
(601,'Kaba-kaba',49),
(602,'Kediri',49),
(603,'Nyambu',49),
(604,'Nyitdah',49),
(605,'Pandak Bandung',49),
(606,'Pandak Gede',49),
(607,'Pangkung Tibah',49),
(608,'Pejaten',49),
(609,'Batuaji',50),
(610,'Baturiti',50),
(611,'Belumbang',50),
(612,'Kelating',50),
(613,'Kerambitan',50),
(614,'Kesiut',50),
(615,'Kukuh',50),
(616,'Meliling',50),
(617,'Pangkung Karung',50),
(618,'Penarukan',50),
(619,'Samsam',50),
(620,'Sembung Gede',50),
(621,'Tibubiyu',50),
(622,'Timpag',50),
(623,'Tista',50),
(624,'Batannyuh',51),
(625,'Beringkit',51),
(626,'Caubelayu',51),
(627,'Dajan Puri',51),
(628,'Dauh Puri',51),
(629,'Geluntung',51),
(630,'Kukuh',51),
(631,'Kuwum',51),
(632,'Marga',51),
(633,'Payangan',51),
(634,'Peken Belayu',51),
(635,'Petiga',51),
(636,'Selanbawak',51),
(637,'Tegaljadi',51),
(638,'Tua',51),
(639,'Babahan',52),
(640,'Biaung',52),
(641,'Buruan',52),
(642,'Jatiluwih',52),
(643,'Jegu',52),
(644,'Mengeste',52),
(645,'Penatahan',52),
(646,'Penebel',52),
(647,'Pesagi',52),
(648,'Pitra',52),
(649,'Rejasa',52),
(650,'Riang Gede',52),
(651,'Sangketan',52),
(652,'Senganan',52),
(653,'Tajen',52),
(654,'Tegalinggah',52),
(655,'Tengkudak',52),
(656,'Wongaya Gede',52),
(657,'Bantiran',53),
(658,'Batungsel',53),
(659,'Belatungan',53),
(660,'Belimbing',53),
(661,'Jelijih Punggang',53),
(662,'Karya Sari',53),
(663,'Kebon Padangan',53),
(664,'Munduk Temu',53),
(665,'Padangan',53),
(666,'Pajahan',53),
(667,'Pujungan',53),
(668,'Pupuan',53),
(669,'Sanda',53),
(670,'Antap',54),
(671,'Bajera',54),
(672,'Bajera Utara',54),
(673,'Berembeng',54),
(674,'Manikyang',54),
(675,'Pupuan Sawah',54),
(676,'Selemadeg',54),
(677,'Serampingan',54),
(678,'Wanagiri',54),
(679,'Wanagiri Kauh',54),
(680,'Angkah',55),
(681,'Antosari',55),
(682,'Bengkel Sari',55),
(683,'Lalang Linggah',55),
(684,'Lumbung',55),
(685,'Lumbung Kauh',55),
(686,'Mundeh',55),
(687,'Mundeh Kangin',55),
(688,'Mundeh Kauh',55),
(689,'Selabih',55),
(690,'Tiying Gading',55),
(691,'Bantas',56),
(692,'Beraban',56),
(693,'Dalang',56),
(694,'Gadung Sari',56),
(695,'Gadungan',56),
(696,'Gunung Salak',56),
(697,'Mambang',56),
(698,'Megati',56),
(699,'Tangguntiti',56),
(700,'Tegal Mengkeb',56),
(701,'Bongan',57),
(702,'Buahan',57),
(703,'Dajan Peken',57),
(704,'Dauh Peken',57),
(705,'Delod Peken',57),
(706,'Denbantas',57),
(707,'Gubug',57),
(708,'Sesandan',57),
(709,'Subamia',57),
(710,'Sudimara',57),
(711,'Tunjuk',57),
(712,'Wanasari',57);

/*Table structure for table `tb_pengumuman` */

DROP TABLE IF EXISTS `tb_pengumuman`;

CREATE TABLE `tb_pengumuman` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `tgl_mulai` date DEFAULT NULL,
  `tgl_akhir` date DEFAULT NULL,
  `isi` text,
  `gambar1` varchar(100) DEFAULT NULL,
  `gambar2` varchar(100) DEFAULT NULL,
  `gambar3` varchar(100) DEFAULT NULL,
  `download` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_pengumuman` */

/*Table structure for table `tb_profil` */

DROP TABLE IF EXISTS `tb_profil`;

CREATE TABLE `tb_profil` (
  `id_profil` bigint(20) NOT NULL AUTO_INCREMENT,
  `nama_ketua` varchar(255) DEFAULT NULL,
  `sambutan_ketua` text,
  `stuktur_organisasi` varchar(255) DEFAULT NULL,
  `sejarah` time DEFAULT NULL,
  PRIMARY KEY (`id_profil`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_profil` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nik` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `no_hp` int(11) DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint(20) unsigned DEFAULT NULL,
  `profile_photo_path` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`nik`,`email`,`tempat_lahir`,`tgl_lahir`,`no_hp`,`jenis_kelamin`,`email_verified_at`,`is_admin`,`password`,`remember_token`,`current_team_id`,`profile_photo_path`,`created_at`,`updated_at`,`status`) values 
(80,'Panji Wiratama','5171042003990003','panjisantoso201@gmail.com','Denpasar','1999-03-20',2147483647,'Laki-laki',NULL,0,'$2y$10$FqYK0uvGhpKFwX.HDoOKO.EmTHovEfpStn26h6UkHAPy3xohWJnxq',NULL,NULL,NULL,'2021-01-16 11:57:04','2021-01-16 11:57:04',1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;