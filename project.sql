CREATE TABLE user(
  userID INTEGER PRIMARY KEY,
  email VARCHAR UNIQUE NOT NULL,
  username VARCHAR UNIQUE NOT NULL,
  password VARCHAR NOT NULL,
  name VARCHAR
);

CREATE TABLE rent(
    rentID INTEGER PRIMARY KEY,
    propertyID INTEGER REFERENCES property(propertyID),
    touristID INTEGER REFERENCES users(userID),  
    startDate DATE NOT NULL,
    endDate DATE  NOT NULL CHECK (endDate > startDate),
    cancelLimitDay DATE  NOT NULL,
    price FLOAT  NOT NULL
);

CREATE TABLE property(
    propertyID INTEGER PRIMARY KEY,
    ownerID INTEGER REFERENCES users(userID),
    address VARCHAR  NOT NULL,
    city VARCHAR NOT NULL,
    country VARCHAR NOT NULL,
    numQuartos INTEGER,
    description VARCHAR,
    price FLOAT  NOT NULL,
);

CREATE TABLE rating(
    rentID INTEGER PRIMARY KEY REFERENCES rent(rentID), 
    pontuaçao FLOAT,
    comentario TEXT 
);

CREATE TABLE image(
    imageID INTEGER  PRIMARY KEY,
    propertyID INTEGER REFERENCES property(propertyID),
    userID INTEGER REFERENCES user(userID),
    aproved BOOLEAN                                         
);