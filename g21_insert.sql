-- Accounts
INSERT INTO account VALUES(1, 'joao@gmail.com','joao123');
INSERT INTO account VALUES(2, 'bernardo@gmail.com','bernardo123');
INSERT INTO account VALUES(3, 'jessica@gmail.com','jessica123');
INSERT INTO account VALUES(4, 'catarina@gmail.com','catarina123');
INSERT INTO account VALUES(5, 'shelter1@gmail.com','shelter1');
INSERT INTO account VALUES(6, 'shelter2@gmail.com','shelter1');


-- Location
INSERT INTO location VALUES(1, 'Amarante','Porto');
INSERT INTO location VALUES(2, 'Baião','Porto');
INSERT INTO location VALUES(3, 'Felgueiras','Porto');
INSERT INTO location VALUES(4, 'Gondomar','Porto');
INSERT INTO location VALUES(5, 'Lousada','Porto');
INSERT INTO location VALUES(6, 'Lousada','Abrantes');
INSERT INTO location VALUES(7, 'Lousada','Alcanena');
INSERT INTO location VALUES(8, 'Lousada','Almeirim');
INSERT INTO location VALUES(9, 'Lousada','Alpiarça');

-- Person
INSERT INTO person VALUES(1, 'João Vítor',1,2);
INSERT INTO person VALUES(2, 'Bernardo Ferreira',2,3);
INSERT INTO person VALUES(3, 'Jéssica Nascimento',3,4);
INSERT INTO person VALUES(4, 'Catarina Fernandes',4,5);

-- Shelter
INSERT INTO shelter VALUES(NULL,'Shelter One',5,3);
INSERT INTO shelter VALUES(NULL,'Shelter Two',6,4);

-- Breed
INSERT INTO breed VALUES(1,'Cão','Pastor-Alemão');
INSERT INTO breed VALUES(2,'Cão','Bulldogue');
INSERT INTO breed VALUES(3,'Cão','Labrador Retriever');
INSERT INTO breed VALUES(4,'Cão','Poodle');
INSERT INTO breed VALUES(5,'Gato','Persa');
INSERT INTO breed VALUES(6,'Gato','Siamês');
INSERT INTO breed VALUES(7,'Gato','Gato de pelo curto inglês');
INSERT INTO breed VALUES(8,'Gato','Maine Coon');

-- Pet
-- criar table gender/color?
-- weight(kg), height(cm)
INSERT INTO pet VALUES(1,'Abbie','female',2,35,'black',7,5,NULL);
INSERT INTO pet VALUES(2,'Bambi','male',10,105,'light brown',3,6,NULL);
INSERT INTO pet VALUES(3,'Cookie','male',4,54,'white',4,NULL,3);

-- Favourite
-- shelters can't have favourites
INSERT INTO favourite VALUES(1,1);
INSERT INTO favourite VALUES(3,3);
