drop table if exists user;
CREATE TABLE user(
  userID INTEGER PRIMARY KEY,
  email VARCHAR UNIQUE NOT NULL,
  username VARCHAR UNIQUE NOT NULL,
  password VARCHAR NOT NULL,
  name VARCHAR
);

drop table if exists property;
CREATE TABLE property (
    propertyID INTEGER PRIMARY KEY,
    ownerID INTEGER REFERENCES users(userID),
    address VARCHAR  NOT NULL,
    city VARCHAR NOT NULL,
    country VARCHAR NOT NULL,
    numQuartos INTEGER,
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
    aproved BOOLEAN      
);


INSERT INTO user VALUES (1, "andreMORestivo@gmail.com", "andreRestivo", "1234", "Andre Restivo");
INSERT INTO user VALUES (2, "josealves@gmail.com", "Jose001", "DrPbs74JYQQd9Jy", "Jose Alves");
INSERT INTO user VALUES (3, "rita1998@gmail.com", "rita_23", "reileao10", "Ana Rita Santos");
INSERT INTO user VALUES (4, "sergioNunes@gmail.com", "sergioNunes", "1234", "Sergio Sobral Nunes");

INSERT INTO property VALUES (1, 1, "Rua Dr. Roberto Frias, s/n 4200-465", "Porto", "Portugal", 3, "Casa agradável", 500);
INSERT INTO property VALUES (2, 3, "Largo de Ramos 1861","Vila Nova de Gaia", "Portugal", 2, "Casa também agradavel", 450);

INSERT INTO rent VALUES (1, 1, 2, "2019-12-20", "2019-12-31", "2019-12-18", 400);
INSERT INTO rent VALUES (2, 2, 4, "2020-01-01", "2020-01-31", "2019-12-01", 425);
INSERT INTO rent VALUES (3, 2, 1, "2019-10-01", "2019-10-31", "2019-09-30", 300);

INSERT INTO rating VALUES (1, 4.5, "Realmente bastante agradável");
INSERT INTO rating VALUES (3, 5, "Realmente bastante agradável");

INSERT INTO image VALUES ( 1, 1, 1, 1);
INSERT INTO image VALUES ( 2, 2, 3, 1);


CREATE TRIGGER rattingValidation
BEFORE INSERT on rating
For Each Row
When (SELECT rent.endDate FROM rating, rent WHERE new.ratingID = rent.rentID AND rent.endDate < date('now'))
Begin
    SELECT raise(rollback, 'Impossivel de inserir rating se o aluguer não tiver terminado');
End;