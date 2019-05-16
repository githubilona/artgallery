create schema artgallery;
use artgallery;



select * from artist;
select * from artwork;

SELECT * FROM artwork q INNER JOIN artist w on q.id_artist= w.id_artist WHERE w.id_artist=1;
SELECT * FROM artwork q  JOIN artist w WHERE w.id_artist=1;
SELECT * FROM artwork q  LEFT JOIN artist w ON  w.id_artist = w.id_artist  WHERE w.id_artist=1;

/* add id_exhibition to the artist table, id artist doesn't have any- set id_exhibition ot null*/
CREATE TABLE artist (
  id_artist INT NOT NULL AUTO_INCREMENT,
  first_name VARCHAR(45),
  last_name VARCHAR(45),
  information TEXT,
  PRIMARY KEY (id_artist)
  );

CREATE TABLE artists (
  idArtist INT NOT NULL AUTO_INCREMENT,
  firstName VARCHAR(45) NULL,
  lastName VARCHAR(45) NULL,
  birthDate VARCHAR(45) NULL,
  PRIMARY KEY (idArtist));

select * from artist;
select * from artwork;

SELECT first_Name FROM artist INNER JOIN artwork ON artist.id_artist = artwork.id_artwork;

/* dodoac miejece obraz unp .pokoj 320 */
/*dodad ograniczanie typu not null, itd*/



CREATE TABLE artwork (
  id_artwork INT(11) NOT NULL AUTO_INCREMENT,
  id_artist INT(11) NOT NULL,
  title VARCHAR(45),
  date_made YEAR,
  technique VARCHAR(45),
  colors VARCHAR(100),
  width VARCHAR(45),
  height VARCHAR(45),
  description TEXT,
  image VARCHAR(255),
  PRIMARY KEY (id_artwork)
);
ALTER TABLE artwork ADD FOREIGN KEY (id_artist) REFERENCES artist(id_artist); 

use artgallery;
select * from artwork;
/* password field should have enough lenght becouse it's stored in hashed form*/
CREATE TABLE user (
	id_user INT NOT NULL AUTO_INCREMENT,
    username VARCHAR(45),
    password VARCHAR(255),
    email VARCHAR(45),
    creation_date DATETIME NOT NULL,
	PRIMARY KEY (id_user)
);

select * from user;


drop table exhibition;

CREATE TABLE exhibition (
  id_exhibition INT NOT NULL AUTO_INCREMENT,
  id_address  INT(11) NOT NULL,
  subject VARCHAR(45) NULL DEFAULT NULL,
  description TEXT NULL DEFAULT NULL,
  start_date DATE NULL DEFAULT NULL,
  end_date DATE NULL DEFAULT NULL,
  image VARCHAR(255),
  PRIMARY KEY (id_exhibition)
  );
ALTER TABLE exhibition ADD FOREIGN KEY (id_address) REFERENCES address(id_address);   
  
truncate table exhibition;

  INSERT INTO exhibition (subject, id_address, description, start_date, end_date, image) VALUES
  ('Spring', null,'Lorem ipsum doleor sir mameij tn rn ddkejnf jwnejf jwe dwjjke f', '2019-09-11', '2019-11-01', 'img/5cd49707867070.12247832-1 2uRQQyR92M6PUKJRH81U_w.jpeg' ),
  ('Winter', null,'Loe fner  ejr fej rfjw erfjwb efjw3fj 3wf jsum doleor sir mameij tn rn ddkejnf jwnejf jwe dwjjke f', '2018-01-01', '2019-04-01', 'img/5cd5a2f3c831b8.65568298-Cylindrical_Prism_Wave_24x24_6cb81fcc-a7d2-44f9-b81b-a91acccbb262_1024x1024.jpg' ),
  ('Autumn', null,' gvhgvj jghvuv  efjw3fj 3wf jsum doleor sir mameij thhvgvhe f', '2018-12-09', '2020-03-01','img/5cd5a3ff69e9a6.40736119-Bandurka_PouringPeppermint-1024x770.jpg' );


select * from exhibition;


use artgallery;    
    CREATE TABLE IF NOT EXISTS `artgallery`.`address` (
  `id_address` INT(11) NOT NULL AUTO_INCREMENT,
  `country` VARCHAR(45) NULL DEFAULT NULL,
  `city` VARCHAR(45) NULL DEFAULT NULL,
  `street` VARCHAR(45) NULL DEFAULT NULL,
  `home_number` VARCHAR(45) NULL DEFAULT NULL,
  `flat_number` VARCHAR(45) NULL DEFAULT NULL,
  `post_code` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id_address`));

select * from address;
INSERT INTO address (country, city, street, home_number, flat_number, post_code) VALUES
					('Polska', 'Warszawa', 'Piekna', '40', '11', '00-110'),
					('Polska', 'Gdynia', 'Prosta', '5', '1', '40-147'),
					('Polska', 'Krakow', 'Dluga', '10', '1', '09-454');