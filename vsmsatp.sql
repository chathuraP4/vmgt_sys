CREATE TABLE `vehicle_brand` (
  `auto_no` INT(11) NOT NULL AUTO_INCREMENT,
  `id` INT(11) NOT NULL,
  `brand` VARCHAR(20) NOT NULL,
  `type` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `auto_no` (`auto_no`),
  KEY `type` (`type`),
  CONSTRAINT `vehicle_brand_ibfk_1` FOREIGN KEY (`type`) REFERENCES `vehicle_type` (`id`)
) ENGINE=INNODB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `vehicle_brand` */

INSERT  INTO `vehicle_brand`(`auto_no`,`id`,`brand`,`type`) VALUES (1,1,'Honda',1),(2,2,'Nissan',1);

/*Table structure for table `vehicle_model` */