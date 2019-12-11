drop table if exists user;
CREATE TABLE user(
  userID INTEGER PRIMARY KEY,
  email VARCHAR UNIQUE NOT NULL,
  username VARCHAR UNIQUE NOT NULL,
  password VARCHAR NOT NULL,
  name VARCHAR,
  description VARCHAR,
  photo STRING DEFAULT "default_user.jpg"
);

drop table if exists property;
CREATE TABLE property (
    propertyID INTEGER PRIMARY KEY,
    ownerID INTEGER REFERENCES users(userID),
    address VARCHAR  NOT NULL,
    city VARCHAR NOT NULL,
    country VARCHAR NOT NULL,
    numQuartos INTEGER NOT NULL,
    description VARCHAR,
    price FLOAT NOT NULL
);

drop table if exists rent;
CREATE TABLE rent(
    rentID INTEGER PRIMARY KEY,
    propertyID INTEGER REFERENCES property(propertyID),
    touristID INTEGER REFERENCES users(userID),  
    startDate DATE NOT NULL,
    endDate DATE NOT NULL CHECK (endDate > startDate),
    cancelLimitDay DATE NOT NULL CHECK (cancelLimitDay < startDate),
    price FLOAT  NOT NULL
);

drop table if exists rating;
CREATE TABLE rating(
    ratingID INTEGER PRIMARY KEY REFERENCES rent(rentID),
    pontuaçao FLOAT,
    comentario TEXT
);

drop table if exists image;
CREATE TABLE image (
    imageID INTEGER  PRIMARY KEY,
    propertyID INTEGER REFERENCES property(propertyID),
    userID INTEGER REFERENCES user(userID),
    type STRING NOT NULL,
    aproved BOOLEAN      
);


INSERT INTO user (userID, email, username, password, name) VALUES ( 1, "andreMORestivo@gmail.com", "andreRestivo", "1234", "Andre Restivo");
INSERT INTO user (userID, email, username, password, name) VALUES ( 2, "josealves@gmail.com", "Jose001", "DrPbs74JYQQd9Jy", "Jose Alves");
INSERT INTO user (userID, email, username, password, name) VALUES ( 3, "rita1998@gmail.com", "rita_23", "reileao10", "Ana Rita Santos");
INSERT INTO user (userID, email, username, password, name) VALUES ( 4, "sergioNunes@gmail.com", "sergioNunes", "1234", "Sergio Sobral Nunes");
INSERT INTO user (userID, email, username, password, name) VALUES ( 5, "up201605240@fe.up.pt", "201605240", "$2y$12$KQR5YVLnxAhmxiuj2lOwLefZHGliWZSXGs5/42x5.XM/./QmuoSai", "Ana Rita Fonseca Santos");
INSERT INTO user (userID, email, username, password, name) VALUES ( 6, "up201206097@fe.up.pt", "201206097", "$2y$12$KQR5YVLnxAhmxiuj2lOwLefZHGliWZSXGs5/42x5.XM/./QmuoSai", "Artur Correia Alves");
INSERT INTO user (userID, email, username, password, name) VALUES ( 7, "up201604014@fe.up.pt", "201604014", "$2y$12$KQR5YVLnxAhmxiuj2lOwLefZHGliWZSXGs5/42x5.XM/./QmuoSai", "Bernardo Costa Moreira");
INSERT INTO user (userID, email, username, password, name) VALUES ( 8, "up201404616@fe.up.pt", "201404616", "$2y$12$KQR5YVLnxAhmxiuj2lOwLefZHGliWZSXGs5/42x5.XM/./QmuoSai", "Carlos Manuel Pires Bras");
INSERT INTO user (userID, email, username, password, name) VALUES ( 9, "up201706828@fe.up.pt", "201706828", "$2y$12$KQR5YVLnxAhmxiuj2lOwLefZHGliWZSXGs5/42x5.XM/./QmuoSai", "César Alves Nogueira");
INSERT INTO user (userID, email, username, password, name) VALUES (10, "up201700127@fe.up.pt", "201700127", "$2y$12$KQR5YVLnxAhmxiuj2lOwLefZHGliWZSXGs5/42x5.XM/./QmuoSai", "Fellipe Ranheri de Souza");
INSERT INTO user (userID, email, username, password, name) VALUES (11, "up201708999@fe.up.pt", "201708999", "$2y$12$KQR5YVLnxAhmxiuj2lOwLefZHGliWZSXGs5/42x5.XM/./QmuoSai", "Filipe Reis Almeida");
INSERT INTO user (userID, email, username, password, name) VALUES (12, "up201704700@fe.up.pt", "201704700", "$2y$12$KQR5YVLnxAhmxiuj2lOwLefZHGliWZSXGs5/42x5.XM/./QmuoSai", "Gaspar Santos Pinheiro");
INSERT INTO user (userID, email, username, password, name) VALUES (13, "up201604506@fe.up.pt", "201604506", "$2y$12$KQR5YVLnxAhmxiuj2lOwLefZHGliWZSXGs5/42x5.XM/./QmuoSai", "Gonçalo António de Jesus Xavier");
INSERT INTO user (userID, email, username, password, name) VALUES (14, "up201705072@fe.up.pt", "201705072", "$2y$12$KQR5YVLnxAhmxiuj2lOwLefZHGliWZSXGs5/42x5.XM/./QmuoSai", "Gustavo Nunes Ribeiro de Magalhaes");
INSERT INTO user (userID, email, username, password, name) VALUES (15, "up201604450@fe.up.pt", "201604450", "$2y$12$KQR5YVLnxAhmxiuj2lOwLefZHGliWZSXGs5/42x5.XM/./QmuoSai", "In Young Jang");
INSERT INTO user (userID, email, username, password, name) VALUES (16, "up201705573@fe.up.pt", "201705573", "$2y$12$KQR5YVLnxAhmxiuj2lOwLefZHGliWZSXGs5/42x5.XM/./QmuoSai", "João Francisco de Pinho Brandão");
INSERT INTO user (userID, email, username, password, name) VALUES (17, "up201704851@fe.up.pt", "201704851", "$2y$12$KQR5YVLnxAhmxiuj2lOwLefZHGliWZSXGs5/42x5.XM/./QmuoSai", "João Pedro da Costa Ribeiro");
INSERT INTO user (userID, email, username, password, name) VALUES (18, "up201604343@fe.up.pt", "201604343", "$2y$12$KQR5YVLnxAhmxiuj2lOwLefZHGliWZSXGs5/42x5.XM/./QmuoSai", "Luís Miguel Pedrosa de Moura Oliveira Henriques");
INSERT INTO user (userID, email, username, password, name) VALUES (19, "up201604835@fe.up.pt", "201604835", "$2y$12$KQR5YVLnxAhmxiuj2lOwLefZHGliWZSXGs5/42x5.XM/./QmuoSai", "Luís Ricardo Matos Mendes");
INSERT INTO user (userID, email, username, password, name) VALUES (20, "up201604530@fe.up.pt", "201604530", "$2y$12$KQR5YVLnxAhmxiuj2lOwLefZHGliWZSXGs5/42x5.XM/./QmuoSai", "Maria Marta Nunes Andrade Lobo dos Santos");
INSERT INTO user (userID, email, username, password, name) VALUES (21, "up201700132@fe.up.pt", "201700132", "$2y$12$KQR5YVLnxAhmxiuj2lOwLefZHGliWZSXGs5/42x5.XM/./QmuoSai", "Muriel de Araújo Pinho");
INSERT INTO user (userID, email, username, password, name) VALUES (22, "up201405687@fe.up.pt", "201405687", "$2y$12$KQR5YVLnxAhmxiuj2lOwLefZHGliWZSXGs5/42x5.XM/./QmuoSai", "Nuno Miguel Rodrigues Gomes");
INSERT INTO user (userID, email, username, password, name) VALUES (23, "up201604686@fe.up.pt", "201604686", "$2y$12$KQR5YVLnxAhmxiuj2lOwLefZHGliWZSXGs5/42x5.XM/./QmuoSai", "Ricardo França Domingues Cardoso");
INSERT INTO user (userID, email, username, password, name) VALUES (24, "up201506561@fe.up.pt", "201506561", "$2y$12$KQR5YVLnxAhmxiuj2lOwLefZHGliWZSXGs5/42x5.XM/./QmuoSai", "Rodrigo Melo Abrantes");
INSERT INTO user (userID, email, username, password, name) VALUES (25, "up201903179@fe.up.pt", "201903179", "$2y$12$KQR5YVLnxAhmxiuj2lOwLefZHGliWZSXGs5/42x5.XM/./QmuoSai", "Sara Maza Hernández");
INSERT INTO user (userID, email, username, password, name) VALUES (26, "up201704733@fe.up.pt", "201704733", "$2y$12$KQR5YVLnxAhmxiuj2lOwLefZHGliWZSXGs5/42x5.XM/./QmuoSai", "Tiago Miguel Barbosa Marques");

INSERT INTO property VALUES (1, 1, "Rua Dr. Roberto Frias, s/n 4200-465", "Porto", "Portugal", 3, "Casa agradável", 500);
INSERT INTO property VALUES (2, 3, "Largo de Ramos 1861","Vila Nova de Gaia", "Portugal", 2, "Casa também agradavel", 450);
INSERT INTO property VALUES (3, 2, "Largo dos Aviadores ","Vila Nova de Gaia", "Portugal", 4, "Casa apropriada para familias", 350);
INSERT INTO property VALUES (4, 4, "Rua de São Pedro ","Alvalade", "Portugal", 2, "Casa apropriada para familias", 400);
INSERT INTO property VALUES (5, 7, "Rua do Jardim","Mealhada", "Portugal", 1, "Desfrute de umas férias cheias de leitão", 150);
INSERT INTO property VALUES (6, 7, "Rua António Martins Soares Leite ","Santa Maria da Feira", "Portugal", 3, "Casa acolhedora com vista para o castelo", 200);
INSERT INTO property VALUES (7, 3, "Rua Fonte da Ribeira","Ovar", "Portugal", 4, "Casa moderna, estrategicamente localizada entre um ginásio e a melhor pastelaria de pão de ló", 170);
INSERT INTO property VALUES (8, 7, "Rua Dom Afonso Henriques ","Arouca", "Portugal", 3, "Casa com vista para o monte. Excelente para desfrutar de umas férias sossegadas", 250);

INSERT INTO rent VALUES (1, 1, 2, "2019-12-20", "2019-12-31", "2019-12-18", 400);
INSERT INTO rent VALUES (2, 2, 4, "2020-01-01", "2020-01-31", "2019-12-01", 425);
INSERT INTO rent VALUES (3, 2, 1, "2019-10-01", "2019-10-31", "2019-09-30", 300);
INSERT INTO rent VALUES (4, 7, 7, "2019-10-01", "2019-10-11", "2019-09-30", 1700);
INSERT INTO rent VALUES (5, 5, 9, "2020-03-15", "2020-04-01", "2020-03-10", 2000);
INSERT INTO rent VALUES (6, 5, 1, "2020-03-01", "2020-03-02", "2020-02-29", 200);

INSERT INTO rating VALUES (1, 4.5, "Realmente bastante agradável");
INSERT INTO rating VALUES (3, 5, "Realmente bastante agradável");
INSERT INTO rating VALUES (5, 1, "Nunca vi tantas centopeias e aranhas na minha vida. Estado lastimável!");

INSERT INTO image VALUES ( 1, 1, 1, ".jpg", 1);
INSERT INTO image VALUES ( 2, 2, 3, ".jpg", 1);

CREATE TRIGGER rattingValidation
BEFORE INSERT on rating
For Each Row
When (SELECT rent.endDate FROM rating, rent WHERE new.ratingID = rent.rentID AND rent.endDate < date('now'))
Begin
    SELECT raise(rollback, 'Impossivel de inserir rating se o aluguer não tiver terminado');
End;