drop table if exists user;
CREATE TABLE user(
  userID INTEGER PRIMARY KEY,
  email VARCHAR UNIQUE NOT NULL,
  username VARCHAR UNIQUE NOT NULL,
  password VARCHAR NOT NULL,
  name VARCHAR,
  description VARCHAR
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
    pontuacao FLOAT,
    comentario TEXT
);

drop table if exists image;
CREATE TABLE image (
    imageID INTEGER  PRIMARY KEY,
    propertyID INTEGER REFERENCES property(propertyID),
    userID INTEGER REFERENCES user(userID),
    name STRING DEFAULT "default_user.jpg",
    type STRING DEFAULT "jpg",
    aproved BOOLEAN      
);

drop table if exists extra;
CREATE TABLE extra (
    name NOT NULL,
    propertyID INTEGER REFERENCES property(propertyID)
);

INSERT INTO user (userID, email, username, password, name) VALUES ( 1, "up201605240@fe.up.pt", "201605240", "$2y$12$$2y$12$KQR5YVLnxAhmxiuj2lOwLefZHGliWZSXGs5/42x5.XM/./QmuoSai", "Ana Rita Fonseca Santos");
INSERT INTO user (userID, email, username, password, name) VALUES ( 2, "up201206097@fe.up.pt", "201206097", "$2y$12$$2y$12$KQR5YVLnxAhmxiuj2lOwLefZHGliWZSXGs5/42x5.XM/./QmuoSai", "Artur Correia Alves");
INSERT INTO user (userID, email, username, password, name) VALUES ( 3, "up201604014@fe.up.pt", "201604014", "$2y$12$$2y$12$KQR5YVLnxAhmxiuj2lOwLefZHGliWZSXGs5/42x5.XM/./QmuoSai", "Bernardo Costa Moreira");
INSERT INTO user (userID, email, username, password, name) VALUES ( 4, "up201404616@fe.up.pt", "201404616", "$2y$12$$2y$12$KQR5YVLnxAhmxiuj2lOwLefZHGliWZSXGs5/42x5.XM/./QmuoSai", "Carlos Manuel Pires Bras");
INSERT INTO user (userID, email, username, password, name) VALUES ( 5, "up201706828@fe.up.pt", "201706828", "$2y$12$$2y$12$KQR5YVLnxAhmxiuj2lOwLefZHGliWZSXGs5/42x5.XM/./QmuoSai", "César Alves Nogueira");
INSERT INTO user (userID, email, username, password, name) VALUES ( 6, "up201700127@fe.up.pt", "201700127", "$2y$12$$2y$12$KQR5YVLnxAhmxiuj2lOwLefZHGliWZSXGs5/42x5.XM/./QmuoSai", "Fellipe Ranheri de Souza");
INSERT INTO user (userID, email, username, password, name) VALUES ( 7, "up201708999@fe.up.pt", "201708999", "$2y$12$$2y$12$KQR5YVLnxAhmxiuj2lOwLefZHGliWZSXGs5/42x5.XM/./QmuoSai", "Filipe Reis Almeida");
INSERT INTO user (userID, email, username, password, name) VALUES ( 8, "up201704700@fe.up.pt", "201704700", "$2y$12$$2y$12$KQR5YVLnxAhmxiuj2lOwLefZHGliWZSXGs5/42x5.XM/./QmuoSai", "Gaspar Santos Pinheiro");
INSERT INTO user (userID, email, username, password, name) VALUES ( 9, "up201604506@fe.up.pt", "201604506", "$2y$12$$2y$12$KQR5YVLnxAhmxiuj2lOwLefZHGliWZSXGs5/42x5.XM/./QmuoSai", "Gonçalo António de Jesus Xavier");
INSERT INTO user (userID, email, username, password, name) VALUES (10, "up201705072@fe.up.pt", "201705072", "$2y$12$$2y$12$KQR5YVLnxAhmxiuj2lOwLefZHGliWZSXGs5/42x5.XM/./QmuoSai", "Gustavo Nunes Ribeiro de Magalhaes");
INSERT INTO user (userID, email, username, password, name) VALUES (11, "up201604450@fe.up.pt", "201604450", "$2y$12$$2y$12$KQR5YVLnxAhmxiuj2lOwLefZHGliWZSXGs5/42x5.XM/./QmuoSai", "In Young Jang");
INSERT INTO user (userID, email, username, password, name) VALUES (12, "up201705573@fe.up.pt", "201705573", "$2y$12$$2y$12$KQR5YVLnxAhmxiuj2lOwLefZHGliWZSXGs5/42x5.XM/./QmuoSai", "João Francisco de Pinho Brandão");
INSERT INTO user (userID, email, username, password, name) VALUES (13, "up201704851@fe.up.pt", "201704851", "$2y$12$$2y$12$KQR5YVLnxAhmxiuj2lOwLefZHGliWZSXGs5/42x5.XM/./QmuoSai", "João Pedro da Costa Ribeiro");
INSERT INTO user (userID, email, username, password, name) VALUES (14, "up201604343@fe.up.pt", "201604343", "$2y$12$$2y$12$KQR5YVLnxAhmxiuj2lOwLefZHGliWZSXGs5/42x5.XM/./QmuoSai", "Luís Miguel Pedrosa de Moura Oliveira Henriques");
INSERT INTO user (userID, email, username, password, name) VALUES (15, "up201604835@fe.up.pt", "201604835", "$2y$12$$2y$12$KQR5YVLnxAhmxiuj2lOwLefZHGliWZSXGs5/42x5.XM/./QmuoSai", "Luís Ricardo Matos Mendes");
INSERT INTO user (userID, email, username, password, name) VALUES (16, "up201604530@fe.up.pt", "201604530", "$2y$12$$2y$12$KQR5YVLnxAhmxiuj2lOwLefZHGliWZSXGs5/42x5.XM/./QmuoSai", "Maria Marta Nunes Andrade Lobo dos Santos");
INSERT INTO user (userID, email, username, password, name) VALUES (17, "up201700132@fe.up.pt", "201700132", "$2y$12$$2y$12$KQR5YVLnxAhmxiuj2lOwLefZHGliWZSXGs5/42x5.XM/./QmuoSai", "Muriel de Araújo Pinho");
INSERT INTO user (userID, email, username, password, name) VALUES (18, "up201405687@fe.up.pt", "201405687", "$2y$12$$2y$12$KQR5YVLnxAhmxiuj2lOwLefZHGliWZSXGs5/42x5.XM/./QmuoSai", "Nuno Miguel Rodrigues Gomes");
INSERT INTO user (userID, email, username, password, name) VALUES (29, "up201604686@fe.up.pt", "201604686", "$2y$12$$2y$12$KQR5YVLnxAhmxiuj2lOwLefZHGliWZSXGs5/42x5.XM/./QmuoSai", "Ricardo França Domingues Cardoso");
INSERT INTO user (userID, email, username, password, name) VALUES (20, "up201506561@fe.up.pt", "201506561", "$2y$12$$2y$12$KQR5YVLnxAhmxiuj2lOwLefZHGliWZSXGs5/42x5.XM/./QmuoSai", "Rodrigo Melo Abrantes");
INSERT INTO user (userID, email, username, password, name) VALUES (21, "up201903179@fe.up.pt", "201903179", "$2y$12$$2y$12$KQR5YVLnxAhmxiuj2lOwLefZHGliWZSXGs5/42x5.XM/./QmuoSai", "Sara Maza Hernández");
INSERT INTO user (userID, email, username, password, name) VALUES (22, "up201704733@fe.up.pt", "201704733", "$2y$12$$2y$12$KQR5YVLnxAhmxiuj2lOwLefZHGliWZSXGs5/42x5.XM/./QmuoSai", "Tiago Miguel Barbosa Marques");

INSERT INTO property VALUES (1, 1, "Rua Dr. Roberto Frias, s/n 4200-465", "Porto", "Portugal", 3, "Casa agradável", 500);
INSERT INTO property VALUES (2, 3, "Largo de Ramos 1861","Vila Nova de Gaia", "Portugal", 2, "Casa também agradavel", 450);
INSERT INTO property VALUES (3, 2, "Largo dos Aviadores ","Vila Nova de Gaia", "Portugal", 4, "Casa apropriada para familias", 350);
INSERT INTO property VALUES (4, 4, "Rua de São Pedro ","Alvalade", "Portugal", 2, "Casa apropriada para familias", 400);
INSERT INTO property VALUES (5, 7, "Rua do Jardim","Mealhada", "Portugal", 1, "Desfrute de umas férias cheias de leitão", 150);
INSERT INTO property VALUES (6, 7, "Rua António Martins Soares Leite ","Santa Maria da Feira", "Portugal", 3, "Casa acolhedora com vista para o castelo", 200);
INSERT INTO property VALUES (7, 3, "Rua Fonte da Ribeira","Ovar", "Portugal", 4, "Casa moderna, estrategicamente localizada entre um ginásio e a melhor pastelaria de pão de ló", 170);
INSERT INTO property VALUES (8, 7, "Rua Dom Afonso Henriques ","Arouca", "Portugal", 3, "Casa com vista para o monte. Excelente para desfrutar de umas férias sossegadas", 250);

INSERT INTO image VALUES ( 1, 1, null, "7BF6199D41E67C66C9BFE3CBBFB61244",".jpg", 1);
INSERT INTO image VALUES ( 2, 1, null, "013EA8850B658F7BDA89F86DAA99626E",".jpg", 1);
INSERT INTO image VALUES ( 3, 1, null, "7176F86F8B73DB63C51FC35CB412BB51",".jpg", 1);
INSERT INTO image VALUES (34, 1, null, "46395CD8F8700371593B6E531E08DA36",".jpg", 1);
INSERT INTO image VALUES ( 4, 1, null, "53784065A9FFFE381A751727B2CB61AD",".jpg", 1);
INSERT INTO image VALUES ( 5, 2, null, "4D6E0517A8166CAEE8BA1D94F1036FEB",".jpg", 1);
INSERT INTO image VALUES ( 6, 2, null, "8E9804A565309164AEAE80C331D82883",".jpg", 1);
INSERT INTO image VALUES ( 7, 2, null, "A0BCA8C99613C1DB104A0326943169DA",".jpg", 1);
INSERT INTO image VALUES ( 8, 2, null, "CF292A496DE604278C097B7BA4216285",".jpg", 1);
INSERT INTO image VALUES ( 9, 3, null, "1D477FF3AD03BE5E22D0C3970BD42A13",".jpg", 1);
INSERT INTO image VALUES (10, 3, null, "86FF5EE90AC00BD3825849D0C513FD89",".jpg", 1);
INSERT INTO image VALUES (11, 3, null, "B0D9C55116B23E321636C160B651CB25",".jpg", 1);
INSERT INTO image VALUES (12, 3, null, "DD94C6E208E5A46FECB663897BD8554D",".jpg", 1);
INSERT INTO image VALUES (13, 4, null, "96D55E2C06F6C8842B9986BE73984F97",".jpg", 1);
INSERT INTO image VALUES (14, 4, null, "A2A65275B6F04A64CA7296478327A70F",".jpg", 1);
INSERT INTO image VALUES (15, 4, null, "DBD7E471DB2333ED5EBFFAB5963E8C3B",".jpg", 1);
INSERT INTO image VALUES (16, 4, null, "E3E70406367F3485A9DDE3D11779E8C4",".jpg", 1);
INSERT INTO image VALUES (35, 4, null, "E4ED98EE930C943E3870210C09D165E4",".jpg", 1);
INSERT INTO image VALUES (17, 5, null, "1C6D6389609A8F7479A2837923ABD755",".jpg", 1);
INSERT INTO image VALUES (18, 5, null, "3B841DA617BCD3021D34A832C19155FE",".jpg", 1);
INSERT INTO image VALUES (19, 5, null, "54BBAA9799F541E2B9B4FEE93316FF29",".jpg", 1);
INSERT INTO image VALUES (20, 5, null, "FCE80100D323E0B980B9083B01B54B07",".jpg", 1);
INSERT INTO image VALUES (21, 6, null, "1E63A105449E951F8B352EA668B0BEED",".jpg", 1);
INSERT INTO image VALUES (22, 6, null, "6BB5045AFE1113A599140E3A41D05A6B",".jpg", 1);
INSERT INTO image VALUES (23, 6, null, "9F58F13D61AB35610A025EFA45F7BD1D",".jpg", 1);
INSERT INTO image VALUES (24, 6, null, "CDB91D388F5E93248252856E764A43AB",".jpg", 1);
INSERT INTO image VALUES (25, 7, null, "4A5AA0F0A0757EC53D56CA2583E5146A",".jpg", 1);
INSERT INTO image VALUES (26, 7, null, "47CBE8704ED5CFC28B4840BA51131271",".jpg", 1);
INSERT INTO image VALUES (27, 7, null, "249C654B9E854E41A6C13AAB2888CFBC",".jpg", 1);
INSERT INTO image VALUES (28, 7, null, "B38D607F5DCCF209BDF796B19BB2C435",".jpg", 1);
INSERT INTO image VALUES (29, 7, null, "B28015568B52D5F9EE48F992B99AB9D5",".jpg", 1);
INSERT INTO image VALUES (30, 8, null, "25F4119FF4807938326934FC2CD20FD5",".jpg", 1);
INSERT INTO image VALUES (31, 8, null, "541394C618D969A4EE4E3A77C95B9979",".jpg", 1);
INSERT INTO image VALUES (32, 8, null, "A0AE29BA9A65787B63642716A5D66F70",".jpg", 1);
INSERT INTO image VALUES (33, 8, null, "C2A3D4A106A71E29EB41578461BB5245",".jpg", 1);

INSERT INTO rent VALUES (1, 1, 2, "2019-12-20", "2019-12-31", "2019-12-18", 400);
INSERT INTO rent VALUES (2, 2, 4, "2020-01-01", "2020-01-31", "2019-12-01", 425);
INSERT INTO rent VALUES (3, 2, 1, "2019-10-01", "2019-10-31", "2019-09-30", 300);
INSERT INTO rent VALUES (4, 7, 7, "2019-10-01", "2019-10-11", "2019-09-30", 1700);
INSERT INTO rent VALUES (5, 5, 9, "2020-03-15", "2020-04-01", "2020-03-10", 2000);
INSERT INTO rent VALUES (6, 5, 1, "2020-03-01", "2020-03-02", "2020-02-29", 200);

INSERT INTO rating VALUES (1, 4.5, "Realmente bastante agradável");
INSERT INTO rating VALUES (3, 5, "Realmente bastante agradável");
INSERT INTO rating VALUES (5, 1, "Nunca vi tantas centopeias e aranhas na minha vida. Estado lastimável!");

INSERT INTO extra VALUES ( "Wi-Fi", 1);
INSERT INTO extra VALUES ( "TV", 1);
INSERT INTO extra VALUES ( "Kitchen", 1);
INSERT INTO extra VALUES ( "Wi-Fi", 2);
INSERT INTO extra VALUES ( "TV", 2);
INSERT INTO extra VALUES ( "Two Kitchens", 2);

CREATE TRIGGER rattingValidation
BEFORE INSERT on rating
For Each Row
When (SELECT rent.endDate FROM rating, rent WHERE new.ratingID = rent.rentID AND rent.endDate > date('now'))
Begin
    SELECT raise(rollback, 'Impossivel de inserir rating se o aluguer não tiver terminado');
End;
