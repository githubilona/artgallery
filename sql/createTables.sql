use art;
CREATE TABLE `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

CREATE TABLE `address` (
  `id_address` int(11) NOT NULL AUTO_INCREMENT,
  `country` varchar(45) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `street` varchar(45) DEFAULT NULL,
  `home_number` varchar(45) DEFAULT NULL,
  `flat_number` varchar(45) DEFAULT NULL,
  `post_code` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_address`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

CREATE TABLE `artist` (
  `id_artist` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `information` text,
  PRIMARY KEY (`id_artist`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;


CREATE TABLE `exhibition` (
  `id_exhibition` int(11) NOT NULL AUTO_INCREMENT,
  `id_address` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `subject` varchar(45) DEFAULT NULL,
  `description` text,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `ticket_price` decimal(6,2) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_exhibition`),
  KEY `exhibition_ibfk_1` (`id_address`),
  KEY `exhibition_ibfk_2` (`id_user`),
  CONSTRAINT `exhibition_ibfk_1` FOREIGN KEY (`id_address`) REFERENCES `address` (`id_address`) ON DELETE CASCADE,
  CONSTRAINT `exhibition_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

CREATE TABLE `exhibition_images` (
  `id_image` int(11) NOT NULL AUTO_INCREMENT,
  `id_exhibition` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_image`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

ALTER TABLE exhibition_images
ADD CONSTRAINT fk_exhibition 
FOREIGN KEY (id_exhibition) 
REFERENCES address (id_address) ON DELETE CASCADE ;

CREATE TABLE `artwork` (
  `id_artwork` int(11) NOT NULL AUTO_INCREMENT,
  `id_artist` int(11) DEFAULT NULL,
  `title` varchar(45) DEFAULT NULL,
  `price` decimal(10,0) DEFAULT NULL,
  `date_made` year(4) DEFAULT NULL,
  `technique` varchar(45) DEFAULT NULL,
  `colors` varchar(100) DEFAULT NULL,
  `width` varchar(45) DEFAULT NULL,
  `height` varchar(45) DEFAULT NULL,
  `description` text,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_artwork`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

ALTER TABLE artwork ADD FOREIGN KEY (id_artist) REFERENCES artist(id_artist)   ON DELETE CASCADE; 


CREATE TABLE `discount` (
  `id_discount` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(45) DEFAULT NULL,
  `value` decimal(3,2) DEFAULT NULL,
  `requirements` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_discount`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
  

CREATE TABLE `ticket_reservation` (
  `id_ticket_reservation` int(11) NOT NULL AUTO_INCREMENT,
  `id_exhibition` int(11) DEFAULT 0,
  `id_discount` int(11) DEFAULT NULL,
  `ticket_price` decimal(6,2) DEFAULT NULL,
  `discount_ticket_price` decimal(6,2) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `sum` decimal(6,2) DEFAULT NULL,
  PRIMARY KEY (`id_ticket_reservation`),
  KEY `id_exhibition` (`id_exhibition`),
  KEY `id_discount` (`id_discount`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `ticket_reservation_ibfk_1` FOREIGN KEY (`id_exhibition`) REFERENCES `exhibition` (`id_exhibition`) ON DELETE CASCADE,
  CONSTRAINT `ticket_reservation_ibfk_2` FOREIGN KEY (`id_discount`) REFERENCES `discount` (`id_discount`) ON DELETE CASCADE,
  CONSTRAINT `ticket_reservation_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
ALTER TABLE ticket_reservation ADD FOREIGN KEY (id_discount) REFERENCES discount(id_discount)  ON DELETE CASCADE;   
ALTER TABLE ticket_reservation ADD FOREIGN KEY (id_user) REFERENCES user(id_user)  ON DELETE CASCADE;   









select * from user;
select * from exhibition;
select * from ticket_reservation;