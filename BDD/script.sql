-- Table definitions
CREATE TABLE Message (
id INTEGER NOT NULL,
transmitter User,
ipTransmitter VARCHAR(200),
content VARCHAR(200),
date Date,
wasSent boolean,
PRIMARY KEY (id)
);CREATE TABLE Page (
id INTEGER NOT NULL,
name VARCHAR(200),
path VARCHAR(200),
subPages ArrayList<Page>,
PRIMARY KEY (id)
);CREATE TABLE Canal (
id INTEGER NOT NULL,
name VARCHAR(200),
users ArrayList<User>,
messages ArrayList<Message>,
dateCreated Date,
PRIMARY KEY (id)
);CREATE TABLE User (
id INTEGER NOT NULL,
pseudo VARCHAR(200),
mail VARCHAR(200),
phoneNumber VARCHAR(200),
birth Date,
avatar VARCHAR(200),
inscription Date,
isOnline boolean,
reputation INTEGER,
lastMessage Date,
lastConnexion Date,
PRIMARY KEY (id)
);CREATE TABLE Administrator (
id INTEGER NOT NULL,
statut INTEGER,
ableGetMessage boolean,
ableGetProfil boolean,
ableSetup boolean,
ableRootPriivilege boolean,
PRIMARY KEY (id)
);-- Foreign key definitions
