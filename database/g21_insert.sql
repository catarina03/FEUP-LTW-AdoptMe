-- Accounts
INSERT INTO account VALUES(1, 'joao@gmail.com','$2y$10$SVZOR.5kl6CvrwDQAEZVdOn0LVh5bn.DF08TMzB/gFHLJpY4npD1S', 'I love animals');
INSERT INTO account VALUES(2, 'bernardo@gmail.com','$2y$10$mA1y5LJBd.DGIiRcvrc8M.8h6o3GF5qclEchKYcl5K9P9Nb8EdP46', 'I have 5 dogs and want more');
INSERT INTO account VALUES(3, 'jessica@gmail.com','$2y$10$IVXii4AvLsAWa/V.2I4z6.HCd2WYmLbtoF6yuzL3.yFmN6oiv3AGi', 'I live in porto and like cats');
INSERT INTO account VALUES(4, 'catarina@gmail.com','$2y$10$0zOivbKsrAog2wlrvdis/.vQHOGu2utx9wUVVNORX6mhYOAYkM6zO', 'I have many pets for adoption, check them out');
INSERT INTO account VALUES(5, 'shelter1@gmail.com','$2y$10$l/TK8G73nD58vtqTUX4R8erpZ.iEZzu5OGtYahzzfoRrXuTjPqaDa', 'We are a shelter of portugal');
INSERT INTO account VALUES(6, 'shelter2@gmail.com','$2y$10$8Bz.zczsKk6gwLW3C9.bMOaCfqRJqyIWMx4mGypHBScQfK5hXDaHO', 'We are a great shelter');
INSERT INTO account VALUES(7, 'worker1@gmail.com','$2y$10$rPd4uc4C9RC2uX8v8ZWgfePAxcfPEPsmK97LWp7GovGuHs2PMgTAO', 'I work in a shelter');
INSERT INTO account VALUES(8, 'worker2@gmail.com','$2y$10$Tw9s9/.VwAjUck1RddDG8OKDuoK2tDBUSB0kdVVnknanfZ0hfKThq', 'I work in a shelter and love animals');

-- Location
INSERT INTO location VALUES(1, 'Amarante','Porto');
INSERT INTO location VALUES(2, 'Baião','Porto');
INSERT INTO location VALUES(3, 'Felgueiras','Porto');
INSERT INTO location VALUES(4, 'Gondomar','Porto');
INSERT INTO location VALUES(5, 'Lousada','Porto');
INSERT INTO location VALUES(6, 'Abrantes','Santarém');
INSERT INTO location VALUES(7, 'Alcanena','Santarém');
INSERT INTO location VALUES(8, 'Almeirim','Santarém');
INSERT INTO location VALUES(9, 'Alpiarça','Santarém');

-- Shelter
INSERT INTO shelter VALUES(1,'Shelter One',5,3);
INSERT INTO shelter VALUES(2,'Shelter Two',6,4);

-- Person
INSERT INTO person VALUES(1, 'João Vítor',1,2,NULL);
INSERT INTO person VALUES(2, 'Bernardo Ferreira',2,3,NULL);
INSERT INTO person VALUES(3, 'Jéssica Nascimento',3,4,NULL);
INSERT INTO person VALUES(4, 'Catarina Fernandes',4,5,NULL);
INSERT INTO person VALUES(5, 'Worker 1',7,3,1);
INSERT INTO person VALUES(6, 'Worker 2',8,4,2);

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
INSERT INTO pet VALUES(1,'Abbie', 'Im a friendly black dog', 'female',2,35,'black',7,5,NULL);
INSERT INTO pet VALUES(2,'Bambi', 'My name is Bambi and I want to be adopted', 'male',10,105,'light brown',3,6,NULL);
INSERT INTO pet VALUES(3,'Cookie', 'Hello, Im cookie', 'male',4,54,'white',4,NULL,3);
INSERT INTO pet VALUES(4,'Bobi', 'I am a black dog that enjoying playing outside', 'female',3,50,'black',7,1,NULL);

-- Favourite
INSERT INTO favourite VALUES(1,1);
INSERT INTO favourite VALUES(3,3);

-- Questions
INSERT INTO questions VALUES(
    NULL,
    'Is this a question?',
    'This is an answer',
    '2020-11-30 15:44:12.000',
    '2020-11-30 15:47:01.000',
    1,2,2
);

INSERT INTO questions VALUES(
    NULL,
    'Another question?',
    'Another answer',
    '2020-11-30 16:44:12.000',
    '2020-11-30 16:57:55.000',
    1,2,2
);


INSERT INTO proposal VALUES(NULL,1,'2020-11-29 11:42:13.123',1,1,5);