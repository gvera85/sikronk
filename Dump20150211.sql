CREATE DATABASE  IF NOT EXISTS `sikronk` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `sikronk`;
-- MySQL dump 10.13  Distrib 5.6.17, for Win32 (x86)
--
-- Host: localhost    Database: sikronk
-- ------------------------------------------------------
-- Server version	5.0.51b-community-nt-log

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
-- Not dumping tablespaces as no INFORMATION_SCHEMA.FILES table on this server
--

--
-- Table structure for table `chofer`
--

DROP TABLE IF EXISTS `chofer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chofer` (
  `id` int(19) NOT NULL auto_increment,
  `stamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) default NULL,
  `dni` int(9) default NULL,
  `telefono` varchar(45) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chofer`
--

LOCK TABLES `chofer` WRITE;
/*!40000 ALTER TABLE `chofer` DISABLE KEYS */;
INSERT INTO `chofer` VALUES (1,'2014-10-19 01:03:32','Juan','Perez',31650045,'1545785896'),(2,'2014-10-19 01:03:50','Pedro','Reyes',25361526,'1548568977'),(3,'2014-10-19 01:04:12','Juan','Flores',26445896,'0325695596');
/*!40000 ALTER TABLE `chofer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ci_sessions`
--

DROP TABLE IF EXISTS `ci_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL default '0',
  `ip_address` varchar(45) NOT NULL default '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL default '0',
  `user_data` text NOT NULL,
  PRIMARY KEY  (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ci_sessions`
--

LOCK TABLES `ci_sessions` WRITE;
/*!40000 ALTER TABLE `ci_sessions` DISABLE KEYS */;
INSERT INTO `ci_sessions` VALUES ('a70a459f835687c4561dbd626b3fa113','127.0.0.1','Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.111 Safari/537.36',1423612556,'a:11:{s:9:\"user_data\";s:0:\"\";s:6:\"titulo\";s:15:\"Planificaciones\";s:2:\"id\";s:1:\"8\";s:6:\"nombre\";s:12:\"Gonzalo Vera\";s:4:\"mail\";s:23:\"gonzalovera85@gmail.com\";s:10:\"isLoggedIn\";b:1;s:7:\"empresa\";s:1:\"1\";s:11:\"DescEmpresa\";s:10:\"Kronkis SA\";s:6:\"perfil\";s:1:\"3\";s:7:\"Usuario\";a:8:{s:2:\"id\";s:1:\"8\";s:5:\"stamp\";s:19:\"2014-11-01 18:03:06\";s:6:\"nombre\";s:7:\"Gonzalo\";s:8:\"apellido\";s:4:\"Vera\";s:4:\"mail\";s:23:\"gonzalovera85@gmail.com\";s:8:\"password\";s:20:\"UmYKaQI/BHpQYAU9Bm0=\";s:4:\"foto\";s:17:\"1d2c3-gonzalo.jpg\";s:15:\"id_tipo_empresa\";s:1:\"1\";}s:4:\"menu\";a:5:{i:0;a:5:{s:7:\"id_menu\";s:2:\"26\";s:11:\"descripcion\";s:15:\"Configuraciones\";s:10:\"path_icono\";s:21:\"configuracionAzul.png\";s:11:\"controlador\";N;s:10:\"cant_hijos\";s:1:\"5\";}i:1;a:5:{s:7:\"id_menu\";s:2:\"25\";s:11:\"descripcion\";s:20:\"Gestión de usuarios\";s:10:\"path_icono\";s:15:\"usuarioAzul.png\";s:11:\"controlador\";N;s:10:\"cant_hijos\";s:1:\"7\";}i:2;a:5:{s:7:\"id_menu\";s:2:\"27\";s:11:\"descripcion\";s:12:\"Productos...\";s:10:\"path_icono\";s:19:\"cajonFrutasAzul.png\";s:11:\"controlador\";N;s:10:\"cant_hijos\";s:1:\"2\";}i:3;a:5:{s:7:\"id_menu\";s:2:\"28\";s:11:\"descripcion\";s:9:\"Viajes...\";s:10:\"path_icono\";s:13:\"viajeAzul.png\";s:11:\"controlador\";N;s:10:\"cant_hijos\";s:1:\"4\";}i:4;a:5:{s:7:\"id_menu\";s:2:\"24\";s:11:\"descripcion\";s:8:\"Empresas\";s:10:\"path_icono\";s:16:\"empresasAzul.png\";s:11:\"controlador\";N;s:10:\"cant_hijos\";s:1:\"5\";}}}'),('a8ea8f8d02c950b234010474556006ca','127.0.0.1','Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.111 Safari/537.36',1423623774,'a:11:{s:9:\"user_data\";s:0:\"\";s:6:\"titulo\";s:15:\"Planificaciones\";s:2:\"id\";s:1:\"8\";s:6:\"nombre\";s:12:\"Gonzalo Vera\";s:4:\"mail\";s:23:\"gonzalovera85@gmail.com\";s:10:\"isLoggedIn\";b:1;s:7:\"empresa\";s:1:\"1\";s:11:\"DescEmpresa\";s:10:\"Kronkis SA\";s:6:\"perfil\";s:1:\"3\";s:7:\"Usuario\";a:8:{s:2:\"id\";s:1:\"8\";s:5:\"stamp\";s:19:\"2014-11-01 18:03:06\";s:6:\"nombre\";s:7:\"Gonzalo\";s:8:\"apellido\";s:4:\"Vera\";s:4:\"mail\";s:23:\"gonzalovera85@gmail.com\";s:8:\"password\";s:20:\"UmYKaQI/BHpQYAU9Bm0=\";s:4:\"foto\";s:17:\"1d2c3-gonzalo.jpg\";s:15:\"id_tipo_empresa\";s:1:\"1\";}s:4:\"menu\";a:5:{i:0;a:5:{s:7:\"id_menu\";s:2:\"26\";s:11:\"descripcion\";s:15:\"Configuraciones\";s:10:\"path_icono\";s:21:\"configuracionAzul.png\";s:11:\"controlador\";N;s:10:\"cant_hijos\";s:1:\"5\";}i:1;a:5:{s:7:\"id_menu\";s:2:\"25\";s:11:\"descripcion\";s:20:\"Gestión de usuarios\";s:10:\"path_icono\";s:15:\"usuarioAzul.png\";s:11:\"controlador\";N;s:10:\"cant_hijos\";s:1:\"7\";}i:2;a:5:{s:7:\"id_menu\";s:2:\"27\";s:11:\"descripcion\";s:12:\"Productos...\";s:10:\"path_icono\";s:19:\"cajonFrutasAzul.png\";s:11:\"controlador\";N;s:10:\"cant_hijos\";s:1:\"2\";}i:3;a:5:{s:7:\"id_menu\";s:2:\"28\";s:11:\"descripcion\";s:9:\"Viajes...\";s:10:\"path_icono\";s:13:\"viajeAzul.png\";s:11:\"controlador\";N;s:10:\"cant_hijos\";s:1:\"4\";}i:4;a:5:{s:7:\"id_menu\";s:2:\"24\";s:11:\"descripcion\";s:8:\"Empresas\";s:10:\"path_icono\";s:16:\"empresasAzul.png\";s:11:\"controlador\";N;s:10:\"cant_hijos\";s:1:\"5\";}}}');
/*!40000 ALTER TABLE `ci_sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cliente` (
  `id` int(19) NOT NULL auto_increment,
  `stamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `razon_social` varchar(256) NOT NULL,
  `cuit` bigint(11) default NULL,
  `direccion_comercial` varchar(256) default NULL,
  `direccion_descarga` varchar(256) default NULL,
  `localidad` varchar(256) default NULL,
  `mercado` varchar(256) default NULL,
  `id_tipo_iva` int(19) default NULL,
  `id_provincia` int(19) default NULL,
  `codigo_postal` varchar(10) default NULL,
  `telefono1` varchar(20) default NULL,
  `telefono2` varchar(20) default NULL,
  `mail` varchar(100) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COMMENT='Tabla que contiene los clientes';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` VALUES (1,'2014-09-13 23:57:26','Verduleria el álamo',2147483647,NULL,NULL,NULL,'A',NULL,NULL,'1757',NULL,NULL,NULL),(2,'2014-09-13 23:57:50','Mercado FRP',20316500456,NULL,NULL,NULL,NULL,NULL,2,NULL,NULL,NULL,NULL),(3,'2014-09-27 13:55:01','COTO Cicsa',2147483646,NULL,NULL,NULL,NULL,2,2,NULL,'46989023','4',NULL),(4,'2014-10-03 03:12:39','Juan Ríos',2147483647,'Cazon 5995',NULL,NULL,NULL,NULL,3,NULL,NULL,NULL,NULL),(5,'2014-12-05 00:02:51','Mercado de frutas 1',2045586744,'Cazon 4785',NULL,'Tapiales',NULL,2,1,'1758',NULL,NULL,NULL),(6,'2014-12-05 00:03:23','Jorge Gonzalo',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL),(7,'2014-12-05 00:03:40','Wallmart',NULL,NULL,NULL,NULL,NULL,NULL,3,NULL,NULL,NULL,NULL),(8,'2014-12-05 00:03:52','SuperChino 2',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(9,'2014-12-05 00:04:10','Pedro Gonzalez',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(10,'2014-12-05 00:07:41','Carrefour',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(11,'2014-12-05 00:08:00','Disco',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(12,'2014-12-05 00:08:16','Jumbo',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(13,'2014-12-05 00:08:30','Argenchino',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(14,'2014-12-05 00:08:39','Coco',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(15,'2014-12-05 00:08:58','Cristina Ramirez',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(16,'2014-12-05 00:09:06','Fernando Ramirez',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(17,'2014-12-05 00:09:17','Gonzalo Vera',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `distribuidor`
--

DROP TABLE IF EXISTS `distribuidor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `distribuidor` (
  `id` int(19) NOT NULL auto_increment,
  `stamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `razon_social` varchar(256) NOT NULL,
  `cuit` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='Tabla que contiene los distribuidores';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `distribuidor`
--

LOCK TABLES `distribuidor` WRITE;
/*!40000 ALTER TABLE `distribuidor` DISABLE KEYS */;
INSERT INTO `distribuidor` VALUES (1,'2014-09-13 23:38:55','Kronkis SA',2147483647),(2,'2014-10-16 01:34:24','Distri',145525885);
/*!40000 ALTER TABLE `distribuidor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estado`
--

DROP TABLE IF EXISTS `estado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estado` (
  `id` bigint(19) NOT NULL auto_increment,
  `stamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `descripcion` varchar(256) NOT NULL,
  `id_tipo_estado` bigint(19) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado`
--

LOCK TABLES `estado` WRITE;
/*!40000 ALTER TABLE `estado` DISABLE KEYS */;
INSERT INTO `estado` VALUES (1,'2015-01-08 00:38:23','Pendiente',1),(2,'2015-01-08 00:38:35','Planificando el reparto',1),(3,'2015-01-08 00:38:52','Reparto planificado',1),(4,'2015-01-29 01:19:33','Arribado a destino',1),(5,'2015-01-29 01:19:48','Stock confirmado',1),(6,'2015-01-29 01:22:47','Reparto confirmado',1),(7,'2015-01-29 01:22:58','Precio acordado',1);
/*!40000 ALTER TABLE `estado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu` (
  `id` int(19) NOT NULL auto_increment,
  `stamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `descripcion` varchar(256) NOT NULL,
  `path_icono` varchar(512) default NULL,
  `id_menu_padre` int(19) default NULL,
  `controlador` varchar(256) default NULL,
  `solo_administrador` int(1) default '0',
  PRIMARY KEY  (`id`),
  KEY `FK_MENU_PADRE_idx` (`id_menu_padre`),
  CONSTRAINT `FK_MENU_PADRE` FOREIGN KEY (`id_menu_padre`) REFERENCES `menu` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` VALUES (1,'2014-10-11 01:30:13','Usuarios','../../assets/img/UsuarioAzul.png',25,'usuario',0),(2,'2014-10-11 01:31:28','Proveedores','../../assets/img/ProveedorAzul.png',24,'proveedor',0),(4,'2014-10-11 01:37:43','Tipos de empresas','../../assets/img/TipoEmpresaAzul.png',24,'tipo_empresa',1),(5,'2014-10-11 01:38:06','Clientes','../../assets/img/clienteAzul.png',24,'cliente',0),(7,'2014-10-11 01:38:27','Productos','../../assets/img/cajonFrutasAzul.png',27,'producto',0),(8,'2014-10-11 01:38:37','Perfiles de proveedores','../../assets/img/perfilProveedorAzul.png',25,'perfil_proveedor',0),(9,'2014-10-11 01:38:46','Perfiles de clientes','../../assets/img/perfilClienteAzul.png',25,'perfil_cliente',0),(10,'2014-10-11 01:38:54','Perfiles de distribuidores','../../assets/img/perfilDistribuidorAzul.png',25,'perfil_distribuidor',0),(11,'2014-10-11 01:39:07','UPP','../../assets/img/UsuarioperfilProveedorAzul.png',25,'usuario_perfil_proveedor',1),(12,'2014-10-11 01:39:15','UPC','../../assets/img/UsuarioperfilClienteAzul.png',25,'usuario_perfil_cliente',1),(13,'2014-10-11 01:39:24','UPD','../../assets/img/UsuarioperfilDistribuidorAzul.png',25,'usuario_perfil_distribuidor',1),(14,'2014-10-11 01:39:31','Creación','../../assets/img/ViajeAzul.png',28,'viaje',0),(15,'2014-10-11 01:39:40','Viajes/VL','../../assets/img/viajeProductoAzul.png',28,'viajeVL',1),(16,'2014-10-11 01:39:47','Menu','../../assets/img/menuAzul.png',26,'menu',1),(17,'2014-10-16 01:32:41','Distribuidores','../../assets/img/distribuidorAzul.png',24,'distribuidor',1),(18,'2014-10-16 23:27:08','Provincias','../../assets/img/provinciaAzul.png',26,'provincia',1),(19,'2014-10-17 00:27:57','Tipos de IVA','../../assets/img/ivaAzul.png',26,'tipo_iva',1),(20,'2014-10-17 02:54:22','Transportistas','../../assets/img/transportistaAzul.png',24,'Transportista',0),(21,'2014-10-19 00:52:16','Choferes','../../assets/img/choferAzul.png',26,'chofer',0),(22,'2014-11-03 23:57:16','Planificación de repartos','../../assets/img/repartoAzul.png',28,'Reparto',0),(23,'2014-11-11 00:12:47','Tipos de envases','../../assets/img/envaseAzul.png',27,'Tipo_envase',0),(24,'2015-01-07 01:12:18','Empresas','empresasAzul.png',NULL,NULL,0),(25,'2015-01-07 01:28:53','Gestión de usuarios','usuarioAzul.png',NULL,NULL,0),(26,'2015-01-07 02:04:02','Configuraciones','configuracionAzul.png',NULL,NULL,0),(27,'2015-01-07 02:12:31','Productos...','cajonFrutasAzul.png',NULL,NULL,0),(28,'2015-01-07 02:18:00','Viajes...','viajeAzul.png',NULL,NULL,0),(29,'2015-01-08 00:32:26','Estados','estadoAzul.png',32,'estado',1),(30,'2015-01-10 23:46:39','Transiciones de estados','transicionAzul.png',32,'transicionesPosibles',1),(31,'2015-01-11 05:35:13','Tipos de estados','tipoEstadoAzul.png',32,'tipoEstado',0),(32,'2015-01-11 05:38:04','Estados...','estadoAzul.png',26,NULL,0),(33,'2015-02-06 02:41:15','Confirmar viajes','confirmarViaje.png',28,'ConfirmarViaje',0);
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_cliente`
--

DROP TABLE IF EXISTS `menu_cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_cliente` (
  `id` int(19) NOT NULL auto_increment,
  `stamp` timestamp NULL default CURRENT_TIMESTAMP,
  `id_menu` int(19) NOT NULL,
  `id_perfil_cliente` int(19) NOT NULL,
  `orden` int(3) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_menu_cliente_menu_idx` (`id_menu`),
  KEY `fk_menu_cliente_cliente_idx` (`id_perfil_cliente`),
  KEY `UK_menu_cliente` (`id_menu`,`id_perfil_cliente`),
  CONSTRAINT `fk_menu_cliente_menu` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_menu_cliente_proveedor` FOREIGN KEY (`id_perfil_cliente`) REFERENCES `perfil_cliente` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_cliente`
--

LOCK TABLES `menu_cliente` WRITE;
/*!40000 ALTER TABLE `menu_cliente` DISABLE KEYS */;
INSERT INTO `menu_cliente` VALUES (1,'2014-10-11 04:30:36',9,3,0),(3,'2014-10-11 04:30:44',9,1,0),(4,'2014-11-11 12:50:00',21,2,0),(5,'2014-11-11 12:50:00',22,2,1);
/*!40000 ALTER TABLE `menu_cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_distribuidor`
--

DROP TABLE IF EXISTS `menu_distribuidor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_distribuidor` (
  `id` int(19) NOT NULL auto_increment,
  `stamp` timestamp NULL default CURRENT_TIMESTAMP,
  `id_menu` int(19) NOT NULL,
  `id_perfil_distribuidor` int(19) NOT NULL,
  `orden` int(3) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_menu_distribuidor_menu_idx` (`id_menu`),
  KEY `fk_menu_distribuidor_distribuidor_idx` (`id_perfil_distribuidor`),
  KEY `UK_menu_distribuidor` (`id_menu`,`id_perfil_distribuidor`),
  CONSTRAINT `fk_menu_distribuidor_distribuidor` FOREIGN KEY (`id_perfil_distribuidor`) REFERENCES `perfil_distribuidor` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_menu_distribuidor_menu` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_distribuidor`
--

LOCK TABLES `menu_distribuidor` WRITE;
/*!40000 ALTER TABLE `menu_distribuidor` DISABLE KEYS */;
INSERT INTO `menu_distribuidor` VALUES (3,'2014-10-11 04:25:46',9,1,9),(4,'2014-10-11 04:27:44',5,2,0),(5,'2014-10-11 04:27:45',9,2,1),(7,'2014-10-11 20:49:00',5,1,2),(9,'2014-10-11 20:49:00',10,1,7),(10,'2014-10-11 20:49:00',8,1,8),(11,'2014-10-11 20:49:00',7,1,6),(12,'2014-10-11 20:49:00',2,1,3),(15,'2014-10-11 20:49:00',1,1,0),(19,'2014-10-11 20:49:00',14,1,10),(21,'2014-10-16 01:33:53',17,1,1),(24,'2014-10-17 02:59:36',20,1,5),(25,'2014-10-19 01:02:48',21,1,4),(26,'2014-10-19 02:00:43',21,3,11),(27,'2014-10-19 02:00:43',5,3,12),(28,'2014-10-19 02:00:43',17,3,13),(29,'2014-10-19 02:00:43',16,3,16),(30,'2014-10-19 02:00:43',9,3,17),(31,'2014-10-19 02:00:43',10,3,18),(32,'2014-10-19 02:00:43',8,3,19),(33,'2014-10-19 02:00:43',7,3,20),(34,'2014-10-19 02:00:43',2,3,21),(35,'2014-10-19 02:00:43',18,3,22),(36,'2014-10-19 02:00:43',4,3,23),(37,'2014-10-19 02:00:43',19,3,24),(38,'2014-10-19 02:00:43',20,3,25),(39,'2014-10-19 02:00:43',12,3,26),(40,'2014-10-19 02:00:43',13,3,27),(41,'2014-10-19 02:00:43',11,3,28),(42,'2014-10-19 02:00:43',1,3,29),(43,'2014-10-19 02:00:43',14,3,0),(45,'2014-11-03 23:58:03',22,3,10),(46,'2014-11-11 00:13:33',23,3,15),(47,'2015-01-07 01:16:23',24,3,9),(48,'2015-01-07 02:21:42',26,3,5),(49,'2015-01-07 02:21:42',25,3,6),(50,'2015-01-07 02:21:42',27,3,7),(51,'2015-01-07 02:21:42',28,3,8),(52,'2015-01-08 00:32:43',29,3,4),(53,'2015-01-10 23:47:01',30,3,3),(54,'2015-01-11 05:35:36',31,3,2),(55,'2015-01-11 05:38:20',32,3,1),(56,'2015-02-06 02:43:23',33,3,14);
/*!40000 ALTER TABLE `menu_distribuidor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_proveedor`
--

DROP TABLE IF EXISTS `menu_proveedor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_proveedor` (
  `id` int(19) NOT NULL auto_increment,
  `stamp` timestamp NULL default CURRENT_TIMESTAMP,
  `id_menu` int(19) NOT NULL,
  `id_perfil_proveedor` int(19) NOT NULL,
  `orden` int(3) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_menu_proveedor_menu_idx` (`id_menu`),
  KEY `fk_menu_proveedor_proveedor_idx` (`id_perfil_proveedor`),
  KEY `UK_menu_proveedor` (`id_menu`,`id_perfil_proveedor`),
  CONSTRAINT `fk_menu_proveedor_menu` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_menu_proveedor_proveedor` FOREIGN KEY (`id_perfil_proveedor`) REFERENCES `proveedor` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_proveedor`
--

LOCK TABLES `menu_proveedor` WRITE;
/*!40000 ALTER TABLE `menu_proveedor` DISABLE KEYS */;
INSERT INTO `menu_proveedor` VALUES (2,'2014-10-11 03:58:59',5,1,0),(3,'2014-10-11 03:59:00',16,1,1),(5,'2014-10-11 04:01:26',9,3,0),(7,'2014-10-11 04:01:26',8,3,2),(8,'2014-10-11 04:01:26',5,3,3),(9,'2014-10-11 04:01:26',16,3,4);
/*!40000 ALTER TABLE `menu_proveedor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modo_pago`
--

DROP TABLE IF EXISTS `modo_pago`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modo_pago` (
  `id` int(19) NOT NULL auto_increment COMMENT 'Id de la tabla',
  `stamp` datetime NOT NULL COMMENT 'Fecha de creacion del registro',
  `descripcion` varchar(512) NOT NULL COMMENT 'Descripcion del modo de pago',
  `acreditacion_inmediata` int(1) NOT NULL COMMENT 'Flag que indica si el modo de pago se acredita de inmediato o hay que especificar fecha de acreditacion',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabla que contiene las diferentes formas de pago';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modo_pago`
--

LOCK TABLES `modo_pago` WRITE;
/*!40000 ALTER TABLE `modo_pago` DISABLE KEYS */;
/*!40000 ALTER TABLE `modo_pago` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `movimientos`
--

DROP TABLE IF EXISTS `movimientos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `movimientos` (
  `id` bigint(19) NOT NULL auto_increment,
  `stamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `id_cabecera` bigint(19) NOT NULL,
  `id_estado` bigint(19) NOT NULL,
  `id_usuario` bigint(19) default NULL,
  `observaciones` varchar(512) default NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_movimiento_estado_idx` (`id_estado`),
  CONSTRAINT `fk_movimiento_estado` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movimientos`
--

LOCK TABLES `movimientos` WRITE;
/*!40000 ALTER TABLE `movimientos` DISABLE KEYS */;
INSERT INTO `movimientos` VALUES (1,'2015-01-18 18:50:35',5,2,8,''),(2,'2015-01-20 04:25:49',5,1,8,NULL),(5,'2015-01-20 04:31:33',35,1,8,NULL),(6,'2015-01-29 03:07:17',7,2,8,NULL),(7,'2015-01-29 03:13:10',6,2,8,NULL),(8,'2015-01-30 02:06:19',2,2,8,NULL),(9,'2015-01-30 02:14:20',2,2,8,NULL),(10,'2015-01-30 02:14:38',2,2,8,NULL),(11,'2015-01-30 02:20:04',2,2,8,NULL),(12,'2015-01-30 02:22:20',2,2,8,NULL),(13,'2015-01-30 02:30:40',2,2,8,NULL),(14,'2015-01-30 02:31:08',2,2,8,NULL),(15,'2015-01-30 02:32:30',2,2,8,NULL),(16,'2015-01-30 02:58:35',2,2,8,NULL),(17,'2015-01-30 03:00:43',2,2,8,NULL),(18,'2015-01-30 03:09:04',2,2,8,NULL),(19,'2015-01-30 03:29:07',2,2,8,NULL),(20,'2015-01-30 03:41:35',2,2,8,NULL),(21,'2015-01-30 03:44:04',2,2,8,NULL),(22,'2015-01-30 03:45:10',2,2,8,NULL),(23,'2015-01-30 03:47:15',2,2,8,NULL),(24,'2015-01-30 03:49:37',2,2,8,NULL),(25,'2015-01-30 03:51:08',2,2,8,NULL),(26,'2015-01-30 03:51:51',2,2,8,NULL),(27,'2015-01-30 03:52:06',2,2,8,NULL),(28,'2015-02-02 17:21:24',2,2,8,NULL),(29,'2015-02-02 17:22:26',2,2,8,NULL),(30,'2015-02-02 17:31:13',2,2,8,NULL),(31,'2015-02-02 17:32:22',2,2,8,NULL),(32,'2015-02-02 17:32:44',2,2,8,NULL),(33,'2015-02-02 17:34:53',2,2,8,NULL),(34,'2015-02-02 18:28:50',2,2,8,NULL),(35,'2015-02-02 18:37:35',2,3,8,NULL),(36,'2015-02-10 12:13:53',3,3,8,NULL),(37,'2015-02-10 12:15:49',3,3,8,NULL),(38,'2015-02-10 13:44:31',7,3,8,NULL),(39,'2015-02-10 13:47:46',4,3,8,NULL),(40,'2015-02-10 14:26:30',4,2,8,NULL),(41,'2015-02-10 14:28:00',4,2,8,NULL),(42,'2015-02-10 14:34:24',4,2,8,NULL);
/*!40000 ALTER TABLE `movimientos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pago_cliente`
--

DROP TABLE IF EXISTS `pago_cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pago_cliente` (
  `id` int(19) NOT NULL auto_increment COMMENT 'Id de la tabla',
  `stamp` datetime NOT NULL COMMENT 'Fecha de creacion del registro',
  `id_reparto` int(19) NOT NULL COMMENT 'Id del reparto al que pertenece el pago',
  `monto` decimal(19,2) NOT NULL COMMENT 'Monto que abona el cliente al distribuidor',
  `id_modo_pago` int(19) NOT NULL COMMENT 'Id del modo de pago elegido por el cliente (FK con modo_pago)',
  `fecha_pago` date NOT NULL COMMENT 'Fecha en que el cliente le pago al distribuidor',
  `fecha_acreditacion` varchar(45) NOT NULL COMMENT 'Fecha en que el pago se debe acreditar',
  `acreditado` int(1) NOT NULL COMMENT 'Flag que indica si el pago se acredito',
  PRIMARY KEY  (`id`),
  KEY `fk_pago_cliente_reparto_idx` (`id_reparto`),
  KEY `fk_pago_cliente_modo_pago_idx` (`id_modo_pago`),
  CONSTRAINT `fk_pago_cliente_modo_pago` FOREIGN KEY (`id_modo_pago`) REFERENCES `modo_pago` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_pago_cliente_reparto` FOREIGN KEY (`id_reparto`) REFERENCES `reparto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabla que contiene los repartos que va pagando el cliente';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pago_cliente`
--

LOCK TABLES `pago_cliente` WRITE;
/*!40000 ALTER TABLE `pago_cliente` DISABLE KEYS */;
/*!40000 ALTER TABLE `pago_cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pago_proveedor`
--

DROP TABLE IF EXISTS `pago_proveedor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pago_proveedor` (
  `id` int(19) NOT NULL auto_increment,
  `stamp` datetime NOT NULL,
  `id_proveedor` int(19) default NULL,
  `id_pago_cliente` int(19) NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `fecha_pago` date NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_pago_proveedor_proveedor_idx` (`id_proveedor`),
  KEY `fk_pago_proveedor_pago_cliente_idx` (`id_pago_cliente`),
  CONSTRAINT `fk_pago_proveedor_pago_cliente` FOREIGN KEY (`id_pago_cliente`) REFERENCES `pago_cliente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_pago_proveedor_proveedor` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Los pagos de los clientes son distribuidos para pagar a los ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pago_proveedor`
--

LOCK TABLES `pago_proveedor` WRITE;
/*!40000 ALTER TABLE `pago_proveedor` DISABLE KEYS */;
/*!40000 ALTER TABLE `pago_proveedor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perfil_cliente`
--

DROP TABLE IF EXISTS `perfil_cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `perfil_cliente` (
  `id` int(19) NOT NULL auto_increment,
  `stamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `descripcion` varchar(256) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perfil_cliente`
--

LOCK TABLES `perfil_cliente` WRITE;
/*!40000 ALTER TABLE `perfil_cliente` DISABLE KEYS */;
INSERT INTO `perfil_cliente` VALUES (1,'2014-10-07 00:29:19','Dueño de la compañía'),(2,'2014-10-07 00:29:26','Comprador'),(3,'2014-10-11 04:30:36','WE');
/*!40000 ALTER TABLE `perfil_cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perfil_distribuidor`
--

DROP TABLE IF EXISTS `perfil_distribuidor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `perfil_distribuidor` (
  `id` int(19) NOT NULL auto_increment,
  `stamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `descripcion` varchar(256) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perfil_distribuidor`
--

LOCK TABLES `perfil_distribuidor` WRITE;
/*!40000 ALTER TABLE `perfil_distribuidor` DISABLE KEYS */;
INSERT INTO `perfil_distribuidor` VALUES (1,'2014-10-07 00:29:55','Dueño de la compañía'),(2,'2014-10-07 00:30:07','Empleado'),(3,'2014-10-19 02:00:43','Administrador del sistema');
/*!40000 ALTER TABLE `perfil_distribuidor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perfil_proveedor`
--

DROP TABLE IF EXISTS `perfil_proveedor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `perfil_proveedor` (
  `id` int(19) NOT NULL auto_increment,
  `stamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `descripcion` varchar(256) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perfil_proveedor`
--

LOCK TABLES `perfil_proveedor` WRITE;
/*!40000 ALTER TABLE `perfil_proveedor` DISABLE KEYS */;
INSERT INTO `perfil_proveedor` VALUES (1,'2014-10-07 00:28:49','Dueño de la compañía'),(3,'2014-10-11 04:01:26','Vendedor');
/*!40000 ALTER TABLE `perfil_proveedor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permiso`
--

DROP TABLE IF EXISTS `permiso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permiso` (
  `id` int(19) NOT NULL auto_increment COMMENT 'Id de la tabla',
  `stamp` timestamp NOT NULL default CURRENT_TIMESTAMP COMMENT 'Fecha de creación del registro',
  `descripcion` varchar(256) NOT NULL COMMENT 'Descripcion del permiso (nombre)',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permiso`
--

LOCK TABLES `permiso` WRITE;
/*!40000 ALTER TABLE `permiso` DISABLE KEYS */;
INSERT INTO `permiso` VALUES (1,'2014-09-14 19:45:02','Usuarios'),(2,'2014-09-14 19:48:38','Perfiles');
/*!40000 ALTER TABLE `permiso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `planificacion_reparto`
--

DROP TABLE IF EXISTS `planificacion_reparto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `planificacion_reparto` (
  `id` int(19) NOT NULL auto_increment,
  `stamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `id_viaje` int(19) NOT NULL,
  `id_cliente` int(19) NOT NULL,
  `id_producto` int(19) NOT NULL,
  `id_vl` int(19) NOT NULL,
  `cant_bultos` int(10) NOT NULL,
  `cant_pallets` int(10) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `UK_REPARTO` (`id_viaje`,`id_cliente`,`id_producto`,`id_vl`)
) ENGINE=InnoDB AUTO_INCREMENT=153 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `planificacion_reparto`
--

LOCK TABLES `planificacion_reparto` WRITE;
/*!40000 ALTER TABLE `planificacion_reparto` DISABLE KEYS */;
INSERT INTO `planificacion_reparto` VALUES (17,'2014-12-04 19:28:10',5,2,10,31,47,4),(45,'2014-12-12 00:44:24',8,8,4,3,15,0),(46,'2014-12-12 00:44:24',8,4,4,3,20,1),(47,'2014-12-12 00:44:24',8,6,4,3,72,1),(48,'2014-12-12 00:44:24',8,7,4,3,15,1),(57,'2015-01-29 03:13:10',6,3,1,8,15,1),(58,'2015-01-29 03:13:10',6,4,1,8,15,1),(59,'2015-01-29 03:13:10',6,3,3,2,5,1),(60,'2015-01-29 03:13:10',6,7,3,2,2,1),(61,'2015-01-29 03:13:10',6,1,8,27,1,5),(62,'2015-01-29 03:13:10',6,3,8,27,50,3),(63,'2015-01-29 03:13:10',6,4,8,27,600,30),(120,'2015-02-02 18:37:35',2,1,6,12,10,1),(121,'2015-02-02 18:37:35',2,3,6,12,7,7),(122,'2015-02-02 18:37:35',2,5,6,14,2,2),(123,'2015-02-02 18:37:35',2,6,6,14,7,4),(124,'2015-02-02 18:37:35',2,2,9,30,7,7),(125,'2015-02-02 18:37:35',2,3,9,30,7,7),(126,'2015-02-02 18:37:35',2,4,9,30,555,555),(129,'2015-02-10 12:15:49',3,6,5,7,10,3),(130,'2015-02-10 12:15:49',3,1,5,7,1,1),(131,'2015-02-10 12:15:49',3,4,8,28,10,50),(132,'2015-02-10 13:44:31',7,4,2,20,1,1),(148,'2015-02-10 14:34:24',4,2,6,14,40,0),(149,'2015-02-10 14:34:24',4,4,6,14,40,0),(150,'2015-02-10 14:34:24',4,4,7,13,250,0),(151,'2015-02-10 14:34:24',4,5,7,13,250,0),(152,'2015-02-10 14:34:24',4,2,9,30,49,0);
/*!40000 ALTER TABLE `planificacion_reparto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `producto`
--

DROP TABLE IF EXISTS `producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `producto` (
  `id` int(19) NOT NULL auto_increment COMMENT 'Id del producto',
  `stamp` datetime NOT NULL,
  `descripcion` varchar(512) NOT NULL,
  `marca` varchar(45) default NULL,
  `calidad` varchar(45) default NULL,
  `requiere_vencimiento` int(1) NOT NULL,
  `foto` varchar(512) default NULL,
  `id_proveedor` int(19) NOT NULL,
  `origen` varchar(256) default NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_producto_proveedor_idx` (`id_proveedor`),
  CONSTRAINT `fk_producto_proveedor` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='Tabla con los productos comercializables';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `producto`
--

LOCK TABLES `producto` WRITE;
/*!40000 ALTER TABLE `producto` DISABLE KEYS */;
INSERT INTO `producto` VALUES (1,'0000-00-00 00:00:00','Durazno LA','Durin','Alta',0,'d47a6-durazno.jpg',4,NULL),(2,'0000-00-00 00:00:00','Durazno especial LA',NULL,NULL,0,'6d0aa-durazno2.jpg',2,NULL),(3,'0000-00-00 00:00:00','Limón la chacra',NULL,NULL,0,'7a699-limon_turquia.jpg',4,NULL),(4,'0000-00-00 00:00:00','Lima marca puma',NULL,NULL,0,'60f09-limon_turquia.jpg',1,NULL),(5,'0000-00-00 00:00:00','Naranja tucuman',NULL,NULL,0,'156e2-naranja.jpg',4,NULL),(6,'0000-00-00 00:00:00','FL Futilla',NULL,NULL,0,'511c3-frutilla2.jpg',5,NULL),(7,'0000-00-00 00:00:00','FL Cereza',NULL,NULL,0,'64572-cerezas-(1).jpg',5,NULL),(8,'0000-00-00 00:00:00','Kiwi','Australian','Media',0,'32638-kiwi.jpg',4,'Sidney, Australia'),(9,'0000-00-00 00:00:00','Pera','Sim','Buena',0,'1f451-images.jpg',5,'Granja correntina'),(10,'0000-00-00 00:00:00','Naranja del litoral','Litoraleña','Alta',0,NULL,3,'Entre Ríos'),(11,'0000-00-00 00:00:00','Limon','Independencia','Elegido',0,'33979-47045.jpeg',1,'Tucuman');
/*!40000 ALTER TABLE `producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productos_viaje`
--

DROP TABLE IF EXISTS `productos_viaje`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `productos_viaje` (
  `id` int(19) NOT NULL auto_increment,
  `stamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `id_viaje` int(19) NOT NULL COMMENT 'Id del viaje al que corresponden todos estos productos',
  `id_producto` int(19) NOT NULL,
  `id_variable_logistica` int(19) default NULL,
  `cantidad_bultos` int(10) NOT NULL,
  `cantidad_pallets` int(10) default NULL,
  `cant_real_bultos` int(10) default NULL,
  `cant_real_pallets` int(10) default NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_productos_viaje_viaje_idx` (`id_viaje`),
  KEY `fk_productos_viaje_vl_idx` (`id_producto`),
  CONSTRAINT `viaje_productos_producto` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `viaje_productos_viaje` FOREIGN KEY (`id_viaje`) REFERENCES `viaje` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8 COMMENT='Tabla que contiene los productos que lleva un viaje';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos_viaje`
--

LOCK TABLES `productos_viaje` WRITE;
/*!40000 ALTER TABLE `productos_viaje` DISABLE KEYS */;
INSERT INTO `productos_viaje` VALUES (30,'2014-12-04 13:52:40',7,2,20,1000,21,2,2),(31,'2014-12-04 13:53:08',3,1,9,800,10,NULL,NULL),(32,'2014-12-04 13:53:19',3,8,28,100,7,NULL,NULL),(33,'2014-12-04 13:54:19',3,5,7,30,8,NULL,NULL),(34,'2014-12-04 13:55:05',2,6,12,74,7,NULL,NULL),(35,'2014-12-04 13:55:27',2,6,14,80,4,NULL,NULL),(36,'2014-12-04 13:55:44',2,9,30,120,5,NULL,NULL),(37,'2014-12-04 13:56:14',4,9,30,49,3,25,1),(38,'2014-12-04 13:56:26',4,6,14,80,4,40,2),(39,'2014-12-04 13:56:37',4,7,13,500,16,250,8),(41,'2014-12-04 13:57:33',6,8,27,650,33,NULL,NULL),(42,'2014-12-04 13:57:52',6,1,8,30,1,NULL,NULL),(43,'2014-12-04 13:58:04',6,3,2,7,2,NULL,NULL),(44,'2014-12-12 00:39:56',8,4,3,121,1,NULL,NULL);
/*!40000 ALTER TABLE `productos_viaje` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proveedor`
--

DROP TABLE IF EXISTS `proveedor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proveedor` (
  `id` int(19) NOT NULL auto_increment,
  `stamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `razon_social` varchar(256) NOT NULL,
  `cuit` bigint(11) default NULL,
  `direccion_comercial` varchar(256) default NULL,
  `direccion_carga` varchar(256) default NULL,
  `localidad` varchar(256) default NULL,
  `mercado` varchar(256) default NULL,
  `id_tipo_iva` int(19) default NULL,
  `id_provincia` int(19) default NULL,
  `codigo_postal` varchar(10) default NULL,
  `telefono1` varchar(20) default NULL,
  `telefono2` varchar(20) default NULL,
  `mail` varchar(100) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='Tabla que contiene los proveedores';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proveedor`
--

LOCK TABLES `proveedor` WRITE;
/*!40000 ALTER TABLE `proveedor` DISABLE KEYS */;
INSERT INTO `proveedor` VALUES (1,'2014-09-13 23:58:51','Limones tucumanos SA',2147483647,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,'2014-09-13 23:59:05','Duraznos del norte',2147483647,NULL,NULL,'Laferrere',NULL,2,2,NULL,NULL,NULL,NULL),(3,'2014-09-13 23:59:25','Naranjas litoral SA',2147483647,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,'2014-09-27 13:55:55','Favorita SA',2147483647,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'gonzalovera85@gmail.com.ar'),(5,'2014-10-17 02:18:49','FrutiLoop',2147483647,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL),(6,'2014-11-08 16:52:01','prueba',2147483647,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `proveedor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `provincia`
--

DROP TABLE IF EXISTS `provincia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `provincia` (
  `id` int(19) NOT NULL auto_increment,
  `stamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `descripcion` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `provincia`
--

LOCK TABLES `provincia` WRITE;
/*!40000 ALTER TABLE `provincia` DISABLE KEYS */;
INSERT INTO `provincia` VALUES (1,'2014-10-16 23:35:49','Buenos Aires'),(2,'2014-10-16 23:35:59','Catamarca'),(3,'2014-10-16 23:36:10','Entre Ríos'),(4,'2014-10-17 03:05:45','Tucumán'),(5,'2014-10-17 03:05:54','Misiones'),(6,'2014-10-17 03:06:10','Corrientes'),(7,'2014-10-17 03:06:17','Santa Cruz'),(8,'2014-10-17 03:06:25','Tierra del Fuego'),(9,'2014-10-17 03:06:37','Neuquen');
/*!40000 ALTER TABLE `provincia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reparto`
--

DROP TABLE IF EXISTS `reparto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reparto` (
  `id` int(19) NOT NULL auto_increment,
  `stamp` datetime NOT NULL,
  `id_viaje` int(19) NOT NULL,
  `id_cliente` int(19) NOT NULL,
  `fecha_reparto` date NOT NULL,
  `nro_remito` int(12) default NULL,
  `cantidad` int(8) NOT NULL,
  `id_producto` int(19) NOT NULL,
  `codigo_vl` int(19) NOT NULL,
  `precio_caja` decimal(8,2) default NULL,
  `porcentaje_ganancia` decimal(5,2) default NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_reparto_cliente_idx` (`id_cliente`),
  KEY `fk_reparto_cliente_viaje_idx` (`id_viaje`),
  KEY `fk_reparto_cliente_vl_idx` (`id_producto`,`codigo_vl`),
  CONSTRAINT `fk_reparto_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_reparto_viaje` FOREIGN KEY (`id_viaje`) REFERENCES `viaje` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_reparto_vl` FOREIGN KEY (`id_producto`, `codigo_vl`) REFERENCES `variable_logistica` (`id_producto`, `codigo_vl`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Un viaje es repartido a N clientes, esta tabla registra esos';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reparto`
--

LOCK TABLES `reparto` WRITE;
/*!40000 ALTER TABLE `reparto` DISABLE KEYS */;
/*!40000 ALTER TABLE `reparto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_empresa`
--

DROP TABLE IF EXISTS `tipo_empresa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_empresa` (
  `id` int(19) NOT NULL auto_increment COMMENT 'Id de la tabla',
  `stamp` timestamp NOT NULL default CURRENT_TIMESTAMP COMMENT 'Fecha de creacion del registro',
  `descripcion` varchar(256) NOT NULL COMMENT 'Descripcion del tipo de empresa',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_empresa`
--

LOCK TABLES `tipo_empresa` WRITE;
/*!40000 ALTER TABLE `tipo_empresa` DISABLE KEYS */;
INSERT INTO `tipo_empresa` VALUES (1,'2014-09-13 03:52:38','Distribuidor'),(2,'2014-09-13 03:52:51','Cliente'),(3,'2014-09-13 03:53:04','Proveedor');
/*!40000 ALTER TABLE `tipo_empresa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_envase`
--

DROP TABLE IF EXISTS `tipo_envase`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_envase` (
  `id` bigint(19) NOT NULL auto_increment,
  `stamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `descripcion` varchar(256) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_envase`
--

LOCK TABLES `tipo_envase` WRITE;
/*!40000 ALTER TABLE `tipo_envase` DISABLE KEYS */;
INSERT INTO `tipo_envase` VALUES (1,'2014-11-11 00:15:06','Cajón'),(2,'2014-11-11 00:15:14','Bolsa'),(3,'2014-11-11 00:15:23','Caja plastica'),(4,'2014-11-11 00:15:33','Caja de cartón'),(5,'2014-11-15 00:41:16','Bolsa de red');
/*!40000 ALTER TABLE `tipo_envase` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_estado`
--

DROP TABLE IF EXISTS `tipo_estado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_estado` (
  `id` bigint(19) NOT NULL auto_increment,
  `stamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `nombre_tabla` varchar(256) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_estado`
--

LOCK TABLES `tipo_estado` WRITE;
/*!40000 ALTER TABLE `tipo_estado` DISABLE KEYS */;
INSERT INTO `tipo_estado` VALUES (1,'2015-01-08 00:15:53','viaje');
/*!40000 ALTER TABLE `tipo_estado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_iva`
--

DROP TABLE IF EXISTS `tipo_iva`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_iva` (
  `id` int(19) NOT NULL auto_increment,
  `stamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `descripcion` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_iva`
--

LOCK TABLES `tipo_iva` WRITE;
/*!40000 ALTER TABLE `tipo_iva` DISABLE KEYS */;
INSERT INTO `tipo_iva` VALUES (1,'2014-10-17 00:34:10','Excento'),(2,'2014-10-17 00:34:32','Inscripto'),(3,'2014-10-17 00:34:44','No inscripto');
/*!40000 ALTER TABLE `tipo_iva` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transiciones_posibles`
--

DROP TABLE IF EXISTS `transiciones_posibles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transiciones_posibles` (
  `id` bigint(19) NOT NULL auto_increment,
  `stamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `id_tipo_estado` bigint(19) NOT NULL,
  `id_estado_actual` bigint(19) NOT NULL,
  `id_estado_futuro` bigint(19) NOT NULL,
  `funcion_transicion` varchar(256) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transiciones_posibles`
--

LOCK TABLES `transiciones_posibles` WRITE;
/*!40000 ALTER TABLE `transiciones_posibles` DISABLE KEYS */;
INSERT INTO `transiciones_posibles` VALUES (1,'2015-01-11 00:35:19',1,1,2,'funcion_1'),(2,'2015-02-02 17:32:03',1,2,3,'f2');
/*!40000 ALTER TABLE `transiciones_posibles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transportista`
--

DROP TABLE IF EXISTS `transportista`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transportista` (
  `id` int(19) NOT NULL auto_increment,
  `stamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `razon_social` varchar(256) NOT NULL,
  `cuit` int(11) default NULL,
  `direccion` varchar(256) default NULL,
  `localidad` varchar(256) default NULL,
  `id_provincia` int(19) default NULL,
  `codigo_postal` varchar(10) default NULL,
  `telefono1` varchar(20) default NULL,
  `telefono2` varchar(20) default NULL,
  `mail` varchar(100) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transportista`
--

LOCK TABLES `transportista` WRITE;
/*!40000 ALTER TABLE `transportista` DISABLE KEYS */;
INSERT INTO `transportista` VALUES (1,'2014-10-17 03:01:19','Transfeder',205515818,'Greta 450','Rio turbio',2,NULL,NULL,NULL,NULL),(2,'2014-10-17 03:01:54','Edar SA',2147483647,NULL,'Monte Grande',1,NULL,NULL,NULL,'edar@edar.com');
/*!40000 ALTER TABLE `transportista` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `id` int(19) NOT NULL auto_increment COMMENT 'Id del usuario',
  `stamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `nombre` varchar(256) NOT NULL COMMENT 'Nombre del usuario',
  `apellido` varchar(256) NOT NULL COMMENT 'Apellido del usuario',
  `mail` varchar(100) NOT NULL,
  `password` varchar(512) NOT NULL COMMENT 'Contraseña del usuario',
  `foto` varchar(512) default NULL,
  `id_tipo_empresa` int(19) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `mail_UNIQUE` (`mail`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='Tabla con los usuarios del sistema';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (8,'2014-11-01 21:03:06','Gonzalo','Vera','gonzalovera85@gmail.com','UmYKaQI/BHpQYAU9Bm0=','1d2c3-gonzalo.jpg',1),(9,'2014-11-11 21:43:03','Alejandro','Szpack','kronkis@gmail.com','UmBbOwE3BGoAMAw2VjYMIwJv',NULL,1);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario_perfil_cliente`
--

DROP TABLE IF EXISTS `usuario_perfil_cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario_perfil_cliente` (
  `id` int(19) NOT NULL auto_increment,
  `id_usuario` int(19) NOT NULL,
  `id_perfil_cliente` int(19) NOT NULL,
  `id_cliente` int(19) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `UK_usuario_perfil_cliente` (`id_usuario`,`id_perfil_cliente`,`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario_perfil_cliente`
--

LOCK TABLES `usuario_perfil_cliente` WRITE;
/*!40000 ALTER TABLE `usuario_perfil_cliente` DISABLE KEYS */;
INSERT INTO `usuario_perfil_cliente` VALUES (2,1,1,3),(4,2,1,1),(1,2,1,3),(3,2,2,3),(5,4,2,3);
/*!40000 ALTER TABLE `usuario_perfil_cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario_perfil_distribuidor`
--

DROP TABLE IF EXISTS `usuario_perfil_distribuidor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario_perfil_distribuidor` (
  `id_usuario` int(19) NOT NULL,
  `id_perfil_distribuidor` int(19) NOT NULL,
  `id_distribuidor` int(19) NOT NULL,
  `id` int(19) NOT NULL auto_increment,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `UK_USUARIO_PERFIL_DISTRIBUIDOR` (`id_usuario`,`id_perfil_distribuidor`,`id_distribuidor`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario_perfil_distribuidor`
--

LOCK TABLES `usuario_perfil_distribuidor` WRITE;
/*!40000 ALTER TABLE `usuario_perfil_distribuidor` DISABLE KEYS */;
INSERT INTO `usuario_perfil_distribuidor` VALUES (1,2,1,3),(1,3,1,2),(1,3,2,4),(2,2,1,1),(5,1,1,5),(5,2,1,6),(8,3,1,7),(9,1,1,8);
/*!40000 ALTER TABLE `usuario_perfil_distribuidor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario_perfil_proveedor`
--

DROP TABLE IF EXISTS `usuario_perfil_proveedor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario_perfil_proveedor` (
  `id` int(19) NOT NULL auto_increment,
  `id_usuario` int(19) NOT NULL,
  `id_perfil_proveedor` int(19) NOT NULL,
  `id_proveedor` int(19) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `UK_usuario_perfil_proveedor` (`id_usuario`,`id_perfil_proveedor`,`id_proveedor`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario_perfil_proveedor`
--

LOCK TABLES `usuario_perfil_proveedor` WRITE;
/*!40000 ALTER TABLE `usuario_perfil_proveedor` DISABLE KEYS */;
INSERT INTO `usuario_perfil_proveedor` VALUES (4,1,2,1),(1,2,1,2),(3,2,2,4),(5,3,2,2);
/*!40000 ALTER TABLE `usuario_perfil_proveedor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `variable_logistica`
--

DROP TABLE IF EXISTS `variable_logistica`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `variable_logistica` (
  `id` int(19) NOT NULL auto_increment,
  `stamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `id_producto` int(19) NOT NULL COMMENT 'Id del producto al que se le definiran sus variables logisticas',
  `codigo_vl` int(19) NOT NULL COMMENT 'Codigo que distinguira a la VL',
  `descripcion` varchar(512) NOT NULL COMMENT 'Descripcion de la VL',
  `peso` decimal(10,2) NOT NULL COMMENT 'Peso de la VL',
  `base_pallet` int(3) NOT NULL COMMENT 'Cuantas cajas de base tendra un pallet ideal de esta VL',
  `altura_pallet` int(3) NOT NULL COMMENT 'Cuantas cajas de altura tendra un pallet ideal de esta VL',
  `activa` tinyint(4) NOT NULL COMMENT '1- VL activa',
  `id_tipo_envase` bigint(19) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `UK_CODIGO_PROD` (`id_producto`,`codigo_vl`),
  KEY `fk_tipo_envase_producto_idx` (`id_tipo_envase`),
  CONSTRAINT `fk_tipo_envase_producto` FOREIGN KEY (`id_tipo_envase`) REFERENCES `tipo_envase` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_variable_logistica_producto` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COMMENT='Tabla que contiene las defirentes presentaciones con las que';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `variable_logistica`
--

LOCK TABLES `variable_logistica` WRITE;
/*!40000 ALTER TABLE `variable_logistica` DISABLE KEYS */;
INSERT INTO `variable_logistica` VALUES (1,'2014-10-07 14:35:48',3,1,'VL limon',1.00,1,1,1,NULL),(2,'2014-10-07 14:36:04',3,2,'vl2',45.00,2,2,0,NULL),(3,'2014-10-07 22:26:42',4,1,'Lima1',11.00,11,11,1,NULL),(5,'2014-10-07 22:27:13',4,3,'Lima3',33.00,33,33,1,NULL),(6,'2014-10-07 22:55:25',5,1,'VlNaranjaTucu1',1.00,1,1,1,NULL),(7,'2014-10-07 22:55:37',5,2,'narantucu2',2.00,2,2,0,NULL),(8,'2014-10-07 22:56:11',1,1,'Cajones chicos',20.00,6,5,1,1),(9,'2014-10-07 22:56:20',1,2,'Pallets tucumanos',20.00,10,8,1,1),(10,'2014-10-07 22:56:40',2,1,'duraznoespecial1',1.00,1,1,1,NULL),(11,'2014-10-07 22:56:51',2,2,'duraznoespecial2',2.00,2,2,1,NULL),(12,'2014-10-31 02:24:04',6,1,'Frutilla en balde',18.00,2,6,1,NULL),(13,'2014-10-31 02:43:07',7,1,'Cereza en cajon',20.00,8,4,1,NULL),(14,'2014-10-31 02:45:37',6,2,'Frutilla en cajon',30.00,4,5,1,NULL),(20,'2014-11-11 03:15:12',2,0,'7',7.00,7,7,1,1),(24,'2014-11-11 12:04:34',1,3,'WS',3.00,3,3,1,3),(25,'2014-11-11 12:04:49',1,4,'4',5.00,6,7,1,3),(26,'2014-11-11 12:08:22',1,5,'DER',78.00,4,5,1,3),(27,'2014-11-11 12:09:06',8,1,'GTY',8.00,4,5,1,3),(28,'2014-11-11 12:09:25',8,2,'DRF',40.00,4,4,0,4),(29,'2014-11-11 21:49:07',9,1,'Pequeñas y jugosas',40.00,5,4,1,5),(30,'2014-11-11 21:50:29',9,2,'Perita dulce',25.00,4,6,1,3),(31,'2014-12-04 11:47:33',10,1,'Cajón de naranjas',80.00,10,5,1,1),(32,'2014-12-12 00:35:22',9,3,'Cajon pequeño',20.00,6,7,1,1),(33,'2014-12-12 01:27:57',11,1,'A',12.00,5,6,1,2);
/*!40000 ALTER TABLE `variable_logistica` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `viaje`
--

DROP TABLE IF EXISTS `viaje`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `viaje` (
  `id` int(19) NOT NULL auto_increment COMMENT 'Id de la tabla',
  `stamp` timestamp NOT NULL default CURRENT_TIMESTAMP COMMENT 'Fecha de creacion del registro',
  `id_proveedor` int(19) NOT NULL COMMENT 'Id del proveedor que envia el viaje',
  `id_distribuidor` int(19) NOT NULL COMMENT 'Id del distribuidor que recibe el viaje',
  `fecha_estimada_salida` timestamp NULL default NULL,
  `fecha_estimada_llegada` timestamp NULL default NULL,
  `patente_semi` varchar(6) default NULL,
  `patente_camion` varchar(6) default NULL,
  `id_chofer` int(19) default NULL,
  `id_empresa_transportista` int(19) default NULL,
  `numero_de_viaje` int(19) default NULL,
  `id_estado` int(10) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `uk_numero_de_viaje` (`numero_de_viaje`,`id_proveedor`),
  KEY `fk_viaje_distribuidor_idx` (`id_distribuidor`),
  KEY `fk_viaje_proveedor_idx` (`id_proveedor`),
  KEY `fk_viaje_chofer_idx` (`id_chofer`),
  CONSTRAINT `fk_viaje_chofer` FOREIGN KEY (`id_chofer`) REFERENCES `chofer` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_viaje_proveedor` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COMMENT='Tabla que contiene los viajes que se generan desde un provee';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `viaje`
--

LOCK TABLES `viaje` WRITE;
/*!40000 ALTER TABLE `viaje` DISABLE KEYS */;
INSERT INTO `viaje` VALUES (2,'2014-11-05 03:47:40',5,1,NULL,NULL,NULL,NULL,NULL,NULL,1,3),(3,'2014-11-05 03:47:57',4,1,NULL,NULL,NULL,NULL,NULL,NULL,1,3),(4,'2014-11-05 03:48:05',5,1,NULL,NULL,NULL,NULL,NULL,NULL,2,2),(6,'2014-11-15 00:47:56',4,1,'2014-11-12 15:00:00','2014-11-13 15:00:00','DSR845',NULL,2,2,2,2),(7,'2014-12-04 12:15:34',2,1,'2014-12-04 15:00:00','2014-12-12 15:00:00',NULL,NULL,2,1,1,3),(8,'2014-12-12 00:37:21',1,1,'2014-12-12 15:00:00','2014-12-15 15:00:00','HUY455',NULL,3,2,1,3),(35,'2015-01-20 04:31:33',6,1,'2015-01-21 15:00:00',NULL,NULL,NULL,NULL,NULL,1,1);
/*!40000 ALTER TABLE `viaje` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-02-11  0:23:11
