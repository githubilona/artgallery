select * from artist;
select * from artwork;


drop table artist;
INSERT INTO artist (first_name, last_name, information) VALUES
					('Hanna','Nowak', 'Vestibulum consequat nisl id nisi finibus vestibulum. Suspendisse erat felis, rutrum a finibus vitae, malesuada vel neque. Duis sit amet mollis leo. Cras commodo in nulla eu porttitor. Proin semper orci sit amet magna mollis, non hendrerit lacus congue. Sed placerat, ipsum eget pulvinar euismod, libero leo rutrum eros, sed suscipit ex augue sed quam. Etiam quis lorem non mauris sagittis feugiat. '),
					('Tadeusz','Zielinski', 'Vestibulum consequat nisl id nisi finibus vestibulum. Suspendisse erat felis, rutrum a finibus vitae, malesuada vel neque. Duis sit amet mollis leo. Cras commodo in nulla eu porttitor. Proin semper orci sit amet magna mollis, non hendrerit lacus congue. Sed placerat, ipsum eget pulvinar euismod, libero leo rutrum eros, sed suscipit ex augue sed quam. Etiam quis lorem non mauris sagittis feugiat'),
					('Jan','Mrowka', 'Rutrum a finibus vitae, malesuada vel neque. Duis sit amet mollis leo. Cras commodo in nulla eu porttitor. Proin semper orci sit amet magna mollis, non hendrerit lacus congue. Sed placerat, ipsum eget pulvinar euismod, libero leo rutrum eros, sed suscipit ex augue sed quam. Etiam quis lorem non mauris sagittis feugiat');
                    
	
INSERT INTO artwork(id_artist, title, price, date_made, technique, colors, width, height, description, image) VALUES
					(1, 'Ogien', '300', '2010', 'farba', 'czarny, czerwony, zielony', '300', '300','nibus vestibulum. Suspendisse erat felis, rutrum a finibus', 'img/pink.jpg' ),
					(2, 'Ziemia', '270', '2015', 'farba', 'zielony, czerwony', '450', '300','Felis, rutrum a finibus nibus vestibulum. Suspendisse erat', 'img/green.jpg' ),
					(3, 'Slonce', '410', '2019', 'farba', 'pomaranczowy', '1000', '1200','nibus vestibum a finibus lum. Suspendisse erat felis, rutru', 'img/orange.jpg' );

INSERT INTO discount(type, value, requirements) VALUES 
					('normal', 0, 'Normal ticket'),
					('student', 0.40, 'up to 26 years old student ID card needed '),
					('kid', 0.50, '5-12 years old kids '),
					('senior', 0.60, 'ID card needed'),
					('veteran', 1.0, 'Veteran');
                    
INSERT INTO address (country, city, street, home_number, flat_number, post_code) VALUES
					('Polska', 'Gdynia', 'Dluga', 30, 2, '09-112'),
					('Polska', 'Krakow', 'Sloneczna', 1, 1, '00-343'),
					('Polska', 'Krakow', 'Zielona', 21, 6, '09-334'),
					('Polska', 'Warszawa', 'Srebrna', 10, 11, '01-509');
                    
INSERT INTO address (country, city, street, home_number, flat_number, post_code) VALUES
					('Polska', 'Gdynia', 'Dluga', 30, 2, '09-112'),
					('Polska', 'Krakow', 'Sloneczna', 1, 1, '00-343'),
					('Polska', 'Krakow', 'Zielona', 21, 6, '09-334'),
					('Polska', 'Warszawa', 'Srebrna', 10, 11, '01-509');
                    select * from exhibition;
                    
INSERT INTO exhibition (id_address, id_user, subject, description, start_date, end_date, ticket_price, image) VALUES
						(1, 1, 'Wystawa prac malarskich', 'Quam adipiscing vitae proin sagittis. Duis at tellus at urna condimentum. Ante in nibh mauris cursus. Fermentum dui faucibus in ornare quam.', '2019-05-05', '2019-07-01',50, 'img-exhibitions/exhibition1.jpg'),
						(3, 2, ' Habitant morbi tristique', 'Eleifend mi in nulla posuere sollicitudin aliquam ultrices sagittis orci. Lobortis elementum nibh tellus molestie nunc non blandit massa enim. Pretium nibh ipsum consequat nisl vel pretium lectus quam id. ', '2019-06-01', '2019-07-30', 70,'img-exhibitions/exhibition2.jpg'),
						(4, 1, ' Scelerisque mauris pellentesque', 'Quisque egestas diam in arcu. Congue mauris rhoncus aenean vel elit scelerisque mauris. Nunc sed blandit libero volutpat sed cras ornare. Eget nunc lobortis mattis aliquam faucibus purus in. Dictum varius duis at consectetur lorem donec massa. Erat velit scelerisque in dictum non.', '2019-01-14', '2019-03-31', 130, 'img-exhibitions/exhibition4.jpg');

INSERT INTO exhibition_images(id_exhibition, image) VALUES 
						      (1, 'img/swim.jpg'),		
						      (1, 'img/water.jpg'),	
						      (2, 'img/face.jpg'),		
						      (2, 'img/eye.jpg'),		
						      (3, 'img/street.jpg');	
                              
INSERT INTO address (country, city, street, home_number, flat_number, post_code) VALUES
					('Polska', 'Gdynia', 'Dluga', 30, 2, '09-112'),
					('Polska', 'Krakow', 'Sloneczna', 1, 1, '00-343'),
					('Polska', 'Krakow', 'Zielona', 21, 6, '09-334'),
					('Polska', 'Warszawa', 'Srebrna', 10, 11, '01-509');
INSERT INTO exhibition (id_address, subject, description, start_date, end_date, image) VALUES
						(1, 'Wystawa prac malarskich', 'Quam adipiscing vitae proin sagittis. Duis at tellus at urna condimentum. Ante in nibh mauris cursus. Fermentum dui faucibus in ornare quam.', '2019-05-05', '2019-07-01', 'img-exhibitions/exhibition1.jpg'),
						(3, ' Habitant morbi tristique', 'Eleifend mi in nulla posuere sollicitudin aliquam ultrices sagittis orci. Lobortis elementum nibh tellus molestie nunc non blandit massa enim. Pretium nibh ipsum consequat nisl vel pretium lectus quam id. ', '2019-06-01', '2019-07-30', 'img-exhibitions/exhibition2.jpg'),
						(4, ' Scelerisque mauris pellentesque', 'Quisque egestas diam in arcu. Congue mauris rhoncus aenean vel elit scelerisque mauris. Nunc sed blandit libero volutpat sed cras ornare. Eget nunc lobortis mattis aliquam faucibus purus in. Dictum varius duis at consectetur lorem donec massa. Erat velit scelerisque in dictum non.', '2019-01-14', '2019-03-31', 'img-exhibitions/exhibition4.jpg');

INSERT INTO exhibition_images(id_exhibition, image) VALUES 
						      (1, 'img/swim.jpg'),		
						      (1, 'img/water.jpg'),	
						      (2, 'img/face.jpg'),		
						      (2, 'img/eye.jpg'),		
						      (3, 'img/street.jpg');	
                                                           