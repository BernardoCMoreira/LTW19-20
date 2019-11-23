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

CREATE TRIGGER rattingValidation
BEFORE INSERT on rating
For Each Row
When (SELECT rent.endDate FROM rating, rent WHERE new.ratingID = rent.rentID AND rent.endDate < date('now'))
Begin
    SELECT raise(rollback, 'Impossivel de inserir rating se o aluguer não tiver terminado');
End;