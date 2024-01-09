-- CREATION DE LA BASE ET DES TABLES
CREATE DATABASE lowtech;
\c lowtech;

CREATE TABLE Users(id SERIAL PRIMARY KEY, username VARCHAR(50), password VARCHAR(50), email VARCHAR(50), activites TEXT, profile_picture VARCHAR(500), bio TEXT);
CREATE TABLE Particuliers(id_user int, FOREIGN KEY(id_user) REFERENCES Users(id));
CREATE TABLE Modérateurs(id_user int, FOREIGN KEY(id_user) REFERENCES Users(id));
CREATE TABLE Admins(id_user int, FOREIGN KEY(id_user) REFERENCES Users(id));
CREATE TABLE Annonces(id SERIAL PRIMARY KEY, titre VARCHAR(50), description TEXT, id_user int, date TIMESTAMP, id_annonce_mere int, image VARCHAR(500), nb_likes int, FOREIGN KEY(id_user) REFERENCES Users(id), FOREIGN KEY(id_annonce_mere) REFERENCES Annonces(id), pinned BOOLEAN);
CREATE TABLE Recherche(id_annonce int, FOREIGN KEY(id_annonce) REFERENCES Annonces(id));
CREATE TABLE Avancees(id_annonce int, FOREIGN KEY(id_annonce) REFERENCES Annonces(id));
CREATE TABLE Dispos(id_annonce int, FOREIGN KEY(id_annonce) REFERENCES Annonces(id));

-- AJOUT DE LIGNES

INSERT INTO Users (username) VALUES ('utilisateur introuvable');

INSERT INTO Users (username, password, email, profile_picture) VALUES
('John Doe', 'D35k3Hhxq', 'john.doe@email.com', '.\public\images\defaultPfp.png');

INSERT INTO Admins (id_user) VALUES (2);

INSERT INTO Users (username, password, email, profile_picture) VALUES
('Alice Smith', '6acEn65z8', 'alice.smith@email.com', '.\public\images\defaultPfp.png'),
('Natalie Brady', 'usC8453XT', 'alex_23@email.com', '.\public\images\defaultPfp.png');

INSERT INTO Modérateurs (id_user) VALUES (3), (4);

INSERT INTO Users (username, password, email, activites, bio, profile_picture) VALUES
('Alex Bassot', 'P@ssword1', 'alex.bassot@email.com', 'Charpenterie;Electricite;Carrelage;Peinture', 'Salut ! Je suis Alex, amateur de bricolage passionne par l''apprentissage constant. J''aime explorer de nouvelles competences et partager mes experiences avec d''autres esprits creatifs.', '.\public\images\defaultPfp.png'),
('Lily Delafosse', 'Q2J7yPU83', 'lily.delafosse@email.com', 'Verrerie;Peinture', 'Salutations ! Lily ici, convaincu que la collaboration peut conduire a des resultats exceptionnels. Mon interet pour la construction communautaire va au-dela des projets physiques. Passionne par la connexion des gens, des idees et des talents pour creer quelque chose de significatif.', '.\public\images\defaultPfp.png'),
('Max Auguste', 'P@ssw0rd45', 'max.auguste@email.com', 'Electricite;Isolation;Plomberie', 'Hey ! Je suis Max, defenseur de projets verts et passionne par l''impact positif sur notre planete. Mon engagement envers des initiatives durables se reflete dans chaque action que je prends. Toujours ouvert a discuter de solutions ecologiques et a partager des idees inspirantes.', '.\public\images\defaultPfp.png'),
('Teddy Morton', 'E42H4svEj', 'teddy.morton@email.com', 'Electricite;Mecanique;Soudure', 'Hello World ! Je suis un passionne de technologie et de gadgets. Que ce soit les derniers smartphones, les ordinateurs portables ou les innovations futuristes, je suis toujours au top de l''actualite tech.', '.\public\images\defaultPfp.png');

INSERT INTO Particuliers (id_user) VALUES (5), (6), (7), (8);


INSERT INTO Annonces (titre, description, id_user, nb_likes, pinned, date) VALUES
('Recherche plombier', 'Bonjour, nous recherchons actuellement un plombier pour installer les systemes de plomberie, dont a tres genereusement fait don l''entreprise EauPro Solutions Plomberie, dans la tiny house.', 3, 4, true, NOW()),
('Recherche don de charpente', 'Bonjour, nous recherchons une entreprise ou un particulier qui aurait la capacite et la generosite de nous faire un don de bois qui servira a la structure du toit de la tiny house.', 4, 2, false, NOW());

INSERT INTO Recherche (id_annonce) VALUES (1), (2);

INSERT INTO Annonces (titre, description, id_user, nb_likes, pinned, date) VALUES
('Merci a EauPro Solutions Plomberie', 'Nous remercions tres chaleureusement EauPro Solutions Plomberie pour leur don genereux de systemes de plomberie.', 3, 4, true, NOW()),
('Recherche don de charpente', 'Bonjour, nous recherchons une entreprise ou un particulier qui aurait la capacite et la generosite de nous faire un don de bois qui servira a la structure du toit de la tiny house.', 4, 2, false, NOW());

INSERT INTO Avancees (id_annonce) VALUES (3), (4);

INSERT INTO Annonces (titre, description, id_user, nb_likes, pinned, date) VALUES
('Je cherche un mentor de soudure :)', 'Bonjour, j''aimerais avoir l''opportunite d''apprendre a faire de la soudure pour un projet perso. Je suis dispos les 4 prochains weekends. Merci a celui ou celle qui serait en capacite d''etre mon mentor pour quelques heures ;)', 7, 1, false, NOW()),
('Peintre dispo', 'Bonjour, je suis peintre professionelle, et j''aimerais pouvoir participer au chantier. N''hesitez pas a me contacter si vous etes interesses. Bonne journee.', 6, 3, false, NOW());

INSERT INTO Dispos (id_annonce) VALUES (5), (6);

INSERT INTO Annonces (description, id_user, id_annonce_mere, date) VALUES
('Bonjour, j''ai ete plombier il y a quelques annees. J''aimerais participer.', 7, 1, NOW()),
('Bonjour, est-il possible que vous me contactiez en prive ? Je voudrais en connaitre plus sur ce dont vous avez besoin. J''ai des contacts dans une entreprise de charpenterie.', 5, 2, NOW());