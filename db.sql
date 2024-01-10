-- DEBUT DES REQUÊTES INDISPENSABLES AU BON FONCTIONNEMENT DU SITE

-- CREATION DE LA BASE ET DES TABLES
CREATE DATABASE lowtech;
\c lowtech;

START TRANSACTION;

CREATE TABLE Users(id SERIAL PRIMARY KEY, username VARCHAR(50), password VARCHAR(50), email VARCHAR(50), activites TEXT, profile_picture VARCHAR(500), bio TEXT);
CREATE TABLE Particuliers(id_user int, FOREIGN KEY(id_user) REFERENCES Users(id));
CREATE TABLE Modérateurs(id_user int, FOREIGN KEY(id_user) REFERENCES Users(id));
CREATE TABLE Admins(id_user int, FOREIGN KEY(id_user) REFERENCES Users(id));
CREATE TABLE Annonces(id SERIAL PRIMARY KEY, titre VARCHAR(50), description TEXT, id_user int, date TIMESTAMP, id_annonce_mere int, image VARCHAR(500), nb_likes int, FOREIGN KEY(id_user) REFERENCES Users(id), FOREIGN KEY(id_annonce_mere) REFERENCES Annonces(id), pinned BOOLEAN);
CREATE TABLE Recherche(id_annonce int, FOREIGN KEY(id_annonce) REFERENCES Annonces(id));
CREATE TABLE Avancees(id_annonce int, FOREIGN KEY(id_annonce) REFERENCES Annonces(id));
CREATE TABLE Dispos(id_annonce int, FOREIGN KEY(id_annonce) REFERENCES Annonces(id));

-- AJOUT DES LIGNES INDISPENSABLES DANS LA TABLE USERS

INSERT INTO Users (username) VALUES ('utilisateur introuvable');

INSERT INTO Users (username, password, email, profile_picture) VALUES
('Admin', 'D35k3Hhxq', 'admin@email.com', '.\public\images\defaultPfp.png');

INSERT INTO Admins (id_user) VALUES (2);

COMMIT;
