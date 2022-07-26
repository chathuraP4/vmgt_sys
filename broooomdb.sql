/*
SQLyog Ultimate v9.63 
MySQL - 5.5.5-10.1.29-MariaDB : Database - broooomdb
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`broooomdb` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `broooomdb`;

/*Table structure for table `bidder_list` */

DROP TABLE IF EXISTS `bidder_list`;

CREATE TABLE `bidder_list` (
  `id` int(11) NOT NULL,
  `bidder_uid` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `bid_amount` decimal(12,2) NOT NULL DEFAULT '0.00',
  `bid_date` datetime NOT NULL,
  `start_bid_amo` decimal(12,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `bidder_list` */

insert  into `bidder_list`(`id`,`bidder_uid`,`vehicle_id`,`bid_amount`,`bid_date`,`start_bid_amo`) values (1,1,26,'1000.00','2022-07-24 00:00:00','500.00'),(2,1,26,'800.00','2022-07-24 00:00:00','500.00'),(3,1,26,'2000.00','2022-07-25 00:00:00','500.00'),(4,1,26,'2500.00','2022-07-25 00:00:00','500.00');

/*Table structure for table `customer` */

DROP TABLE IF EXISTS `customer`;

CREATE TABLE `customer` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `cf_name` varchar(100) NOT NULL,
  `cl_name` varchar(100) NOT NULL,
  `c_email` varchar(100) NOT NULL,
  `c_mobile` varchar(100) NOT NULL,
  `nid` varchar(100) DEFAULT NULL,
  `w_start` date NOT NULL,
  `w_end` date NOT NULL,
  `payment_type` varchar(100) NOT NULL,
  `invoice_id` varchar(100) DEFAULT NULL,
  `c_address` varchar(400) DEFAULT NULL,
  `c_pass` varchar(30) NOT NULL,
  `extra` varchar(300) DEFAULT NULL,
  `vehicle_id` int(11) NOT NULL,
  PRIMARY KEY (`c_id`),
  UNIQUE KEY `c_id` (`c_id`),
  UNIQUE KEY `invoice_id` (`invoice_id`),
  KEY `c_id_2` (`c_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

/*Data for the table `customer` */

insert  into `customer`(`c_id`,`cf_name`,`cl_name`,`c_email`,`c_mobile`,`nid`,`w_start`,`w_end`,`payment_type`,`invoice_id`,`c_address`,`c_pass`,`extra`,`vehicle_id`) values (3,'Soykot','gasd','asdas@asdfasdf.co','5556416556',NULL,'2016-12-29','2017-01-25','Cash',NULL,NULL,'1234',NULL,8),(13,'Foujia','Akter','asdasd@asdas.com','23',NULL,'2016-12-29','0022-02-02','Cash',NULL,NULL,'1234',NULL,9),(14,'Soyket','Chowdhury','dranger2011@gmail.com','3133388055',NULL,'2016-12-29','2016-11-30','Cash',NULL,NULL,'1234',NULL,0),(15,'asdasd','asdas','asdasd@gmail.com','6546546',NULL,'2022-07-24','2023-01-18','Cash',NULL,NULL,'1234',NULL,17),(16,'asdasd','fgdfg','asdasd@gmail.com','6546546',NULL,'2022-07-24','2023-01-18','Cash',NULL,NULL,'1234',NULL,24);

/*Table structure for table `lease_rate` */

DROP TABLE IF EXISTS `lease_rate`;

CREATE TABLE `lease_rate` (
  `auto_id` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) NOT NULL,
  `rate` decimal(5,2) NOT NULL DEFAULT '0.00',
  `reg_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1 = Register , 0 = Unregisterd',
  `conditions` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1 = Brand New , 0 = Recondition',
  `v_type` int(11) NOT NULL,
  `v_brand` int(11) NOT NULL,
  `v_model` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `auto_id` (`auto_id`),
  KEY `register` (`reg_status`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;

/*Data for the table `lease_rate` */

insert  into `lease_rate`(`auto_id`,`id`,`rate`,`reg_status`,`conditions`,`v_type`,`v_brand`,`v_model`) values (21,0,'0.00',1,1,1,1,1),(1,1,'2.00',1,0,1,1,1),(2,2,'3.00',0,1,1,1,1),(3,3,'4.00',0,0,1,1,1),(4,4,'5.00',1,1,1,1,1),(5,5,'2.00',1,0,1,2,2),(6,6,'3.00',0,1,1,2,2),(7,7,'4.00',0,0,1,2,2),(8,8,'5.00',1,1,1,2,2),(9,9,'2.00',1,0,1,3,3),(10,10,'3.00',0,1,1,3,3),(11,11,'4.00',0,0,1,3,3),(12,12,'5.00',1,1,1,3,3),(13,13,'2.00',1,0,1,4,4),(14,14,'3.00',0,1,1,4,4),(15,15,'4.00',0,0,1,4,4),(16,16,'5.00',1,1,1,4,4),(17,17,'2.00',1,0,1,5,5),(18,18,'3.00',0,1,1,5,5),(19,19,'4.00',0,0,1,5,5),(20,20,'5.00',1,1,1,5,5),(22,21,'0.00',1,1,1,1,1),(23,22,'0.00',1,1,1,1,1),(24,23,'0.00',1,1,1,1,1),(25,24,'2.00',1,1,1,1,1);

/*Table structure for table `manufacturers` */

DROP TABLE IF EXISTS `manufacturers`;

CREATE TABLE `manufacturers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `manufacturer_name` varchar(255) NOT NULL,
  `manufacturer_logo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

/*Data for the table `manufacturers` */

insert  into `manufacturers`(`id`,`manufacturer_name`,`manufacturer_logo`) values (1,'Honda',''),(2,'Nissan ',''),(3,'Mitsubishi',''),(4,'Kia Georgia',''),(5,'Ford',''),(23,'Zuzuki','');

/*Table structure for table `message` */

DROP TABLE IF EXISTS `message`;

CREATE TABLE `message` (
  `auto_id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `subject` varchar(50) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  KEY `auto_id` (`auto_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `message` */

insert  into `message`(`auto_id`,`fname`,`email`,`subject`,`message`) values (1,'ertertertert ert ertert ret','admin@admin.com','ertertreter','retertretreter r tertert ert ert re'),(2,'kl;kl;lk','sdfs@fsdfs','hjkhjk','hjkhjk');

/*Table structure for table `models` */

DROP TABLE IF EXISTS `models`;

CREATE TABLE `models` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `manufacturer_id` int(11) NOT NULL,
  `model_name` varchar(255) NOT NULL,
  `model_description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Data for the table `models` */

insert  into `models`(`id`,`manufacturer_id`,`model_name`,`model_description`) values (9,16,'Giulia','An emotional, hot-blooded Italian car like the Giulia is sure get pulses racing in the usual entry-luxury crowd. A 280-hp 2.0-liter turbo four with an eight-speed automatic and rear-wheel drive are standard; all-wheel drive is optional. Leather seats, a dual exhaust, and a sporty flat-bottomed steering wheel with integrated push-button start also come standard. A 6.5-inch or optional 8.8-inch touchscreen provide connectivity; high-tech features like adaptive cruise control are also available.'),(10,19,'Bugatti Veyron','The Bugatti Veyron EB 16.4 is a mid-engined sports car, designed and developed in Germany by the Volkswagen Group and manufactured in Molsheim, France, by Bugatti Automobiles S.A.S.\r\n\r\nThe original version has a top speed of 407 km/h (253 mph).[4][5] It was named Car of the Decade and best car award (2000–2009) by the BBC television programme Top Gear. The standard Bugatti Veyron also won Top Gear\'s Best Car Driven All Year award in 2005.\r\n\r\nThe Super Sport version of the Veyron is recognised by Guinness World Records as the fastest street-legal production car in the world, with a top speed of 431.072 km/h (268 mph),[6] and the roadster Veyron Grand Sport Vitesse version is the fastest roadster in the world, reaching an averaged top speed of 408.84 km/h (254.04 mph) in a test on 6 April 2013.[7][8]\r\n\r\nThe Veyron\'s chief designer was Hartmut Warkuss, and the exterior was designed by Jozef Kabaň of Volkswagen, with much of the engineering work being conducted under the guidance of engineering chief Wolfgang Schreiber.\r\n\r\nSeveral special variants have been produced. In December 2010, Bugatti began offering prospective buyers the ability to customise exterior and interior colours by using the Veyron 16.4 Configurator application on the marque\'s official website. The Bugatti Veyron was discontinued in late 2014.[9][10]'),(11,16,'fgjhbjk','yuguihjihi');

/*Table structure for table `regusers` */

DROP TABLE IF EXISTS `regusers`;

CREATE TABLE `regusers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `nic` varchar(15) NOT NULL,
  `uname` varchar(255) NOT NULL,
  `bdate` date NOT NULL,
  `email` varchar(40) NOT NULL,
  `address` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4;

/*Data for the table `regusers` */

insert  into `regusers`(`id`,`fname`,`lname`,`nic`,`uname`,`bdate`,`email`,`address`,`password`,`gender`) values (1,'aaaa','aaaa','33333333','sssss','2022-07-22','asdas@dsdas.com','asdasdasda','40bd001563085fc35165329ea1ff5c5ecbdbbeef',''),(2,'ABC','DEF','234567678v','ADDSS','2022-07-04','ABC@GMAIL.COM','SHHGFD','40bd001563085fc','male'),(3,'abc','def','2345677','sdf','2021-10-12','abcd@gmail.com','asd','7110eda4d09e062','female'),(4,'asd','efg','23456v','def','2018-06-05','abcgh@gmail.com','asghh','7110eda4d09e062','male'),(5,'abc','dada','456677V','asdf','2013-06-11','asdfg@gmail.com','sdfff','8cb2237d0679ca8','male'),(6,'abcd','efgh','234567v','asdf','2019-06-19','adfg@gmail.com','dsdd','7110eda4d09e062','male'),(7,'adaasdasd','sadasd','545454','dasdasd','2022-07-12','asdas@HKHK.COM','DSADASD','93de563db164d4d','male'),(8,'ASASA','asdasd','345345435','zczxczx','2022-07-22','dsdas@erewre.d','sdf','9c969ddf454079e','male'),(9,'asdasda','asdas','234234','asdas','2022-07-14','asdas@werer.fdg','asdas','bf9661defa3daec','male'),(10,'sdfsdf','sdfsd','sdfsd','sdfsd','2022-07-20','sdfsd@sdfsd.dgdfg','sdasda','bf9661defa3daec','male'),(11,'asdasda','asdasd','asdas','asdasda','2022-07-14','sdsad@serew.dd','sdfsd','bf9661defa3daec','male'),(12,'asasas','asdasd','q23423434','asdas','2022-07-13','asdas@dffdds.ccc','asdas','bf9661defa3daec','male'),(13,'asdasd','asdasd','324234234','asdas','2022-07-22','asdas@ersf.dsfsd','asdas','bf9661defa3daec','male'),(14,'asdasdasd','asdasda','56546456','asdasd','2022-07-12','asdasd@dfdsfsd.dfd','asdasd','bf9661defa3daec','male'),(15,'asas','asas','121212','1weq32','2022-07-22','asdas@sdfsd.com','sdasdasd','c50267b906a652f','male'),(16,'asdasda','asdas','asdasdas','asdas','2022-07-13','dsada@dfd.dfd','sdas','bf9661defa3daec','male'),(17,'asdasd','asdasd','asdasda','asdasd','2022-07-28','asdasdas@dsfsd.dgdf','fsdfsd','bf9661defa3daec','male'),(18,'asas','sas','34324234','sdsds','2022-07-20','asdas@sdsdsa.vv','asdas','bf9661defa3daec','male'),(19,'ghjk','vhjj','235677765','dfg','2022-07-01','dghj@gmail.com','saddf','7110eda4d09e062','male'),(20,'abc','asss','45666','xxcxz','2022-07-12','adsfg@gmail.com','sdadd','7110eda4d09e062','male'),(21,'asd','vdds','233333V','ssffs','2021-06-15','asfgg@gmail.com','asghjj','40bd001563085fc','male'),(22,'asas','sdsd','344353','sfsf','2022-07-11','sdsds@gmail.com','sfsffsdf','7110eda4d09e062','male'),(23,'asfsdf','sdfsdf','asasas','asasa','2022-07-23','asd@gmail.com','dfaacc','7110eda4d09e062','male'),(24,'asss','ddad','4678899V','sddsdd','2022-02-14','dsada@gmail.com','dadad','7110eda4d09e062','male'),(25,'asd','adda','243355V','addaf','2021-06-14','asfgh@gmail.com','saddda','7110eda4d09e062','male'),(26,'aaaa','dada','224423V','adad','2022-01-03','adsd@gmail.com','asdadaff','7110eda4d09e062','male'),(27,'dadd','fsf','2432425V','dfsdgg','2022-07-03','szfsf@gmail.com','addsadd','7110eda4d09e062','male'),(28,'asdff','adsdd','342434v','fffg','2021-10-11','sfafag@gmail.com','adaeff','0ec09ef9836da03','male'),(29,'adaad','fffvd','435435','fdvfgg','2022-07-03','zczs@gmail.com','asafafa','d2f75e8204fedf2','male'),(30,'asd','asda','2344777V','dadd','2022-07-04','dsD@gmail.com','ahhjk','bfc896e1ecd35d3','male'),(31,'zXx','sdsd','23334445V','sddd','2022-07-05','asdf@gmail.com','asdfvvd','f2231d2871e690a','male'),(32,'saj','fer','22344455v','sf','2022-03-08','sfer@gmail.com','col','cce4229d3a446c6','male'),(33,'test','test2','23456678V','testA','2022-01-04','test@gmail.com','stuv','40bd001563085fc35165329ea1ff5c5ecbdbbeef','male'),(34,'abcd','klr','3456789V','dsdsf','2015-02-10','klm@gmail.com','sdfvveee','f2231d2871e690a2995704f7a297bd7bc64be720','male'),(35,'kamal','perera','56788999V','kamal4','2020-10-13','kamal@gmail.com','colombo','6c85a950488515313357cccac87f341234af7190','male'),(36,'asd','dfd','3345555','fgghh','2022-07-13','abs@gmail.com','asgggg','7c4a8d09ca3762af61e59520943dc26494f8941b','male');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `su` int(11) DEFAULT '0',
  `type` varchar(15) NOT NULL,
  `position` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(40) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `birthday` date NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `address` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`id`,`su`,`type`,`position`,`email`,`password`,`first_name`,`last_name`,`gender`,`birthday`,`mobile`,`address`) values (6,1,'admin','Super Admin','admin@admin.com','21232f297a57a5a743894a0e4a801fc3','Tech_Masters','Group','male','2016-12-27','15245645646','asdfsdafasd'),(7,1,'employee','Employee Super','employee@employee.com','fa5473530e4d1a5a1e1eb53d2fedb10c','EMPLOYEE','Emp 01','male','2015-11-30','2323','qwsdasd');

/*Table structure for table `vehicle_brand` */

DROP TABLE IF EXISTS `vehicle_brand`;

CREATE TABLE `vehicle_brand` (
  `auto_no` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) NOT NULL,
  `brand` varchar(20) NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `auto_no` (`auto_no`),
  KEY `type` (`type`),
  CONSTRAINT `vehicle_brand_ibfk_1` FOREIGN KEY (`type`) REFERENCES `vehicle_type` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

/*Data for the table `vehicle_brand` */

insert  into `vehicle_brand`(`auto_no`,`id`,`brand`,`type`) values (1,1,'Honda',1),(2,2,'Nissan',1),(3,3,'Mitzubizi',1),(4,4,'Kia',1),(7,5,'Ford',1),(42,6,'Hiace',2);

/*Table structure for table `vehicle_model` */

DROP TABLE IF EXISTS `vehicle_model`;

CREATE TABLE `vehicle_model` (
  `auto_no` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) NOT NULL,
  `model` varchar(20) NOT NULL,
  `brand` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `auto_no` (`auto_no`),
  KEY `brand` (`brand`),
  CONSTRAINT `vehicle_model_ibfk_1` FOREIGN KEY (`brand`) REFERENCES `vehicle_brand` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

/*Data for the table `vehicle_model` */

insert  into `vehicle_model`(`auto_no`,`id`,`model`,`brand`) values (1,1,'City',1),(6,2,'Leaf',2),(10,3,'Lancer',3),(14,4,'Optima',4),(16,5,'Escort',5);

/*Table structure for table `vehicle_reg` */

DROP TABLE IF EXISTS `vehicle_reg`;

CREATE TABLE `vehicle_reg` (
  `auto_no` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) NOT NULL,
  `register` varchar(20) NOT NULL,
  `condition` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `auto_no` (`auto_no`),
  KEY `condition` (`condition`),
  CONSTRAINT `vehicle_reg_ibfk_1` FOREIGN KEY (`condition`) REFERENCES `vehicle_condition` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;

/*Data for the table `vehicle_reg` */

insert  into `vehicle_reg`(`auto_no`,`id`,`register`,`condition`) values (1,1,'registed',1),(2,2,'Unregisted',1),(3,3,'registed',2),(4,4,'Unregisted',2),(5,5,'registed',3),(6,6,'Unregisted',3),(7,7,'registed',4),(8,8,'Unregisted',4),(9,9,'registed',5),(10,10,'Unregisted',5),(11,11,'registed',6),(12,12,'Unregisted',6),(13,13,'registed',7),(14,14,'Unregisted',7),(15,15,'registed',8),(16,16,'Unregisted',8),(17,17,'registed',9),(18,18,'Unregisted',9),(19,19,'registed',10),(20,20,'Unregisted',10);

/*Table structure for table `vehicle_type` */

DROP TABLE IF EXISTS `vehicle_type`;

CREATE TABLE `vehicle_type` (
  `auto_no` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) NOT NULL,
  `type` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `auto_no` (`auto_no`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `vehicle_type` */

insert  into `vehicle_type`(`auto_no`,`id`,`type`) values (1,1,'Car'),(2,2,'Van'),(3,3,'Suv'),(4,4,'Jeep'),(5,5,'Cab');

/*Table structure for table `vehicles` */

DROP TABLE IF EXISTS `vehicles`;

CREATE TABLE `vehicles` (
  `vehicle_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `model_id` int(11) NOT NULL,
  `category` varchar(30) DEFAULT NULL,
  `manufacturer_id` int(11) NOT NULL,
  `fuel_type` varchar(30) NOT NULL,
  `buying_price` decimal(12,2) NOT NULL,
  `selling_price` decimal(12,2) DEFAULT NULL,
  `mileage` int(11) NOT NULL,
  `color` varchar(15) NOT NULL,
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sold_date` datetime DEFAULT NULL,
  `status` varchar(40) NOT NULL DEFAULT 'available',
  `registration_year` int(4) NOT NULL,
  `insurance_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `gear` varchar(15) NOT NULL,
  `doors` int(11) NOT NULL,
  `seats` int(11) NOT NULL,
  `tank` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `engine_no` int(11) NOT NULL,
  `chesis_no` int(11) NOT NULL,
  `featured` int(11) DEFAULT '0',
  `top_speed` int(11) NOT NULL,
  PRIMARY KEY (`vehicle_id`),
  KEY `vehicle_id` (`vehicle_id`),
  KEY `brand_id` (`brand_id`),
  KEY `model_id` (`model_id`),
  KEY `type_id` (`type_id`),
  CONSTRAINT `vehicles_ibfk_2` FOREIGN KEY (`brand_id`) REFERENCES `vehicle_brand` (`id`),
  CONSTRAINT `vehicles_ibfk_3` FOREIGN KEY (`model_id`) REFERENCES `vehicle_model` (`id`),
  CONSTRAINT `vehicles_ibfk_4` FOREIGN KEY (`type_id`) REFERENCES `vehicle_type` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `vehicles` */

insert  into `vehicles`(`vehicle_id`,`type_id`,`brand_id`,`model_id`,`category`,`manufacturer_id`,`fuel_type`,`buying_price`,`selling_price`,`mileage`,`color`,`add_date`,`sold_date`,`status`,`registration_year`,`insurance_id`,`user_id`,`gear`,`doors`,`seats`,`tank`,`image`,`engine_no`,`chesis_no`,`featured`,`top_speed`) values (18,1,1,1,'Compact',0,'Petrol','64564545.00','64564545.00',4564645,'yellow','2022-07-24 00:00:00',NULL,'available',2022,54645,NULL,'auto',5,5,5,'http://localhost/vmgt_sys/uploads/vehicles/59458620210b0dc8f2645cff51e2b3a8.jpg',45645,454,0,0),(19,1,2,2,'Mid-size',0,'Electric','456456.00','456456.00',45645,'yellow','2022-07-24 00:00:00',NULL,'available',2022,456456,NULL,'auto',5,5646,5,'http://localhost/vmgt_sys/uploads/vehicles/80f8a4366fc4c3178b61dcc344594092.jpg',45645,45645,0,0),(20,1,2,2,'Mid-size',0,'Electric','456456.00','456456.00',45645,'yellow','2022-07-24 00:00:00',NULL,'available',2022,456456,NULL,'auto',5,5646,5,'http://localhost/vmgt_sys/uploads/vehicles/390f74348af70fcc5bfa3ae6be93ecf2.jpg',45645,45645,0,0),(21,1,2,2,'Mid-size',0,'Electric','456456.00','456456.00',45645,'yellow','2022-07-24 00:00:00',NULL,'available',2022,456456,NULL,'auto',5,5646,5,'http://localhost/vmgt_sys/uploads/vehicles/bd2ba478e5870eb21533e64bba46d5a1.jpg',45645,45645,0,0),(22,1,3,3,'Subcompact',0,'Petrol','45645.00','45645.00',45654,'cvcxv','2022-07-24 00:00:00',NULL,'available',2022,45654,NULL,'auto',5,5,5,'http://localhost/vmgt_sys/uploads/vehicles/d21a54c516b9bd5916ba2f3ea656896c.jpg',4564,45645,0,0),(23,1,1,1,'Subcompact',0,'Petrol','4564.00','4564.00',45645,'red','2022-07-24 00:00:00',NULL,'available',2022,456546,NULL,'auto',5,5,45,'http://localhost/vmgt_sys/uploads/vehicles/994b403f769d1646de7ad12b307c89e7.jpg',45646,45654,0,0),(24,1,1,1,'Subcompact',0,'Petrol','1231.00','1231.00',312312,'red','2022-07-24 00:00:00',NULL,'available',2022,1341563,NULL,'auto',2,2,2,'http://localhost/vmgt_sys/uploads/vehicles/184ab8cbf0987e537addf2401d96fe20.jpg',123213,12312,0,0),(25,1,1,1,'Compact',0,'Petrol','456.00','456.00',1354,'cvcxv','2022-07-24 00:00:00',NULL,'available',2022,45654,NULL,'auto',5,5,45,'http://localhost/vmgt_sys/uploads/vehicles/c8c6867ab5983c0cf5ae14ea0048f874.jpg',456,45645,0,0),(26,1,2,2,'Subcompact',0,'Petrol','4564.00','4564.00',45645,'red','2022-07-24 00:00:00',NULL,'not available',2022,45645,NULL,'auto',5,5,5,'http://localhost/vmgt_sys/uploads/vehicles/f954387b023542de29eab75f6496f399.jpg',456,4564,0,0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
