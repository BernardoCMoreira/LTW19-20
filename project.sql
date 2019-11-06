CREATE TABLE user(
  userID INTEGER PRIMARY KEY,
  email VARCHAR UNIQUE NOT NULL,
  username VARCHAR UNIQUE NOT NULL,
  password VARCHAR NOT NULL,
  name VARCHAR
);

CREATE TABLE rent(
    propertyID INTEGER REFERENCES property(propertyID),
    touristID INTEGER REFERENCES users(userID),  
    startDate DATE NOT NULL,
    endDate DATE  NOT NULL CHECK (endDate > startDate),
    cancelLimitDay DATE  NOT NULL,
    PRIMARY KEY (propertyID, touristID)
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

CREATE TABLE rating{
    propertyID INTEGER REFERENCES property(propertyID),
    touristID INTEGER REFERENCES users(userID),  
    pontuaçao FLOAT,
    PRIMARY KEY (propertyID, touristID)
}

CREATE TABLE image{
    imageID INTEGER NOT PRIMARY KEY,
    propertyID INTEGER REFERENCES property(propertyID),
}