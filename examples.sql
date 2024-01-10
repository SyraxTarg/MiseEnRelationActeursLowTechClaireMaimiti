-- REQUÊTES D'EXEMPLES D'UTILISATION DU SITE

START TRANSACTION;

-- AJOUT DE LIGNES D'EXEMPLE DANS LA TABLE USERS

INSERT INTO Users (username, password, email, profile_picture) VALUES
('Alice Smith', '6acEn65z8', 'alice.smith@email.com', '.\public\images\defaultPfp.png'),
('Natalie Brady', 'usC8453XT', 'alex_23@email.com', '.\public\images\defaultPfp.png');

INSERT INTO Modérateurs (id_user) VALUES (3), (4);

INSERT INTO Users (username, password, email, activites, bio, profile_picture) VALUES
('Alex Bassot', 'P@ssword1', 'alex.bassot@email.com', 'Charpenterie;Electricite;Carrelage;Peinture', 'Salut ! Je suis Alex, amateur de bricolage passionne par l''apprentissage constant. J''aime explorer de nouvelles competences et partager mes experiences avec d''autres esprits creatifs.', '.\public\images\defaultPfp.png'),
('Lily Delafosse', 'Q2J7yPU83', 'lily.delafosse@email.com', 'Verrerie;Peinture', 'Salutations ! Lily ici, convaincu que la collaboration peut conduire a des resultats exceptionnels. Mon interet pour la construction communautaire va au-dela des projets physiques. Passionne par la connexion des gens, des idees et des talents pour creer quelque chose de significatif.', '.\public\images\defaultPfp.png'),
('Max Auguste', 'P@ssw0rd45', 'max.auguste@email.com', 'Electricite;Isolation;Plomberie', 'Hey ! Je suis Max, defenseur de projets verts et passionne par l''impact positif sur notre planete. Mon engagement envers des initiatives durables se reflete dans chaque action que je prends. Toujours ouvert a discuter de solutions ecologiques et a partager des idees inspirantes.', '.\public\images\defaultPfp.png'),
('Teddy Morton', 'E42H4svEj', 'teddy.morton@email.com', 'Electricite;Mecanique;Soudure', 'Hello World ! Je suis un passionne de technologie et de gadgets. Que ce soit les derniers smartphones, les ordinateurs portables ou les innovations futuristes, je suis toujours au top de l''actualite tech.', '.\public\images\defaultPfp.png'),
('Jean-Yves Laporte', '4suRb95DX', 'jean-yves.laporte@email.com', 'Charpenterie;Soudure', ';)', '.\public\images\defaultPfp.png'),
('Laurine Beauvau', 'tv257Sy56', 'laurine.beauveau@email.com', 'Siderurgie', '', '.\public\images\defaultPfp.png'),
('Felix Delaplace', '7ePvu63P3', 'felix.delaplace@email.com', 'Mecanique;Soudure;Electricite', '', '.\public\images\defaultPfp.png'),
('Theodore Caillat', 'u86Bc6Npb', 'theodore.caillat@email.com', 'Peinture;Carrelage;Plomberie', '', '.\public\images\defaultPfp.png'),
('Alexandra Gaudreau', 'u8FMt884x', 'alexandra.gaudreau@email.com', 'Maconnerie;Chauffage', '', '.\public\images\defaultPfp.png'),
('Celine Pierrat', '99B2Fu2fs', 'celine.pierrat@email.com', 'Verrerie;Isolation', '', '.\public\images\defaultPfp.png'),
('Gregoire Astier', 'HfTf285Wz', 'gregoire.astier@email.com', 'Verrerie;Isolation;Plomberie', '', '.\public\images\defaultPfp.png');

INSERT INTO Particuliers (id_user) VALUES (5), (6), (7), (8), (9), (10), (11), (12), (13), (14), (15);


-- AJOUT DE LIGNES D'EXEMPLE DANS LA TABLE ANNONCES

INSERT INTO Annonces (titre, description, id_user, nb_likes, pinned, date) VALUES
('Recherche plombier', 'Bonjour, nous recherchons actuellement un plombier pour installer les systemes de plomberie, dont a tres genereusement fait don l''entreprise EauPro Solutions Plomberie, dans la tiny house.', 3, 4, true, NOW()),
('Recherche don de charpente', 'Bonjour, nous recherchons une entreprise ou un particulier qui aurait la capacite et la generosite de nous faire un don de bois qui servira a la structure du toit de la tiny house.', 4, 2, false, NOW());

INSERT INTO Recherche (id_annonce) VALUES (1), (2);

INSERT INTO Annonces (titre, description, id_user, nb_likes, pinned, date) VALUES
('Merci a EauPro Solutions Plomberie', 'Nous remercions tres chaleureusement EauPro Solutions Plomberie pour leur don genereux de systemes de plomberie.', 3, 4, true, NOW()),
('Bientot notre tiny house n''aura plus froid', 'Max travaille actuellement sur l''isolation de la tiny house. Merci a lui pour sa participation active sur le chantier. L''isolation devrait etre terminee d''ici quelques jours.', 4, 5, false, NOW());

INSERT INTO Avancees (id_annonce) VALUES (3), (4);

INSERT INTO Annonces (titre, description, id_user, nb_likes, pinned, date) VALUES
('Je cherche un mentor de soudure :)', 'Bonjour, j''aimerais avoir l''opportunite d''apprendre a faire de la soudure pour un projet perso. Je suis dispos les 4 prochains weekends. Merci a celui ou celle qui serait en capacite d''etre mon mentor pour quelques heures ;)', 7, 1, false, NOW()),
('Peintre dispo', 'Bonjour, je suis peintre professionelle, et j''aimerais pouvoir participer au chantier. N''hesitez pas a me contacter si vous etes interesses. Bonne journee.', 6, 3, false, NOW());

INSERT INTO Dispos (id_annonce) VALUES (5), (6);

INSERT INTO Annonces (titre, description, id_user, nb_likes, pinned, date) VALUES
('Recherche don de fenetres', 'Bonjour, nous recherchons en avance une entreprise ou un particulier qui serait en capacite de nous faire un don de 2 fenetres standards 700 * 650mm. Bonne journee :)', 3, 6, false, NOW()),
('Recherche don de carrelage', 'Bonjour, nous recherchons une entreprise ou un particulier qui serait en mesure de nous fournir du carrelage. Bonne journee.', 3, 3, false, NOW());

INSERT INTO Recherche (id_annonce) VALUES (7), (8);

INSERT INTO Annonces (titre, description, id_user, nb_likes, pinned, date) VALUES
('Recherche carreleur', 'Bonjour, nous recherchons un carreleur qui serait disponible la semaine du 5 au 11 fevrier. Contactez-nous !', 4, 1, false, NOW()),
('Recherche pose de fenetres', 'Bonjour, nous recherchons une personne qui pourrait poser les fenetres qui nous ont ete fournies. Si vous etes disponible la semaine du 12 au 18 fevrier, vous etes les bienvenus !', 4, 0, false, NOW());

INSERT INTO Recherche (id_annonce) VALUES (9), (10);

INSERT INTO Annonces (titre, description, id_user, nb_likes, pinned, date) VALUES
('La tiny house a la lumiere !', 'Nous vous informons que la tiny house est maintenant dotee d''electricite. Ses soirees d''hiver ne seront desormais plus aussi sombres :)', 4, 5, true, NOW());

INSERT INTO Avancees (id_annonce) VALUES (11);


INSERT INTO Annonces (description, id_user, id_annonce_mere, date) VALUES
('Bonjour, j''ai ete plombier il y a quelques annees. J''aimerais participer.', 7, 1, NOW()),
('Bonjour, est-il possible que vous me contactiez en prive ? Je voudrais en connaitre plus sur ce dont vous avez besoin. J''ai des contacts dans une entreprise de charpenterie.', 5, 2, NOW()),
('Bonjour, je vous contacte de la part d''un ami plombier. Si vous etes interesses, vous pouvez le contacter a cette adresse : xavier.micheaux@mail.com. Bonne journee.', 8, 1, NOW()),
('Bonjour, je suis interesse ! Je suis debutant, j''aimerais qu''un professionnel puisse m''accompagner aussi.', 15, 1, NOW()),
('Bonjour, je suis interesse aussi. Je suis partant pour accompagner Gregoire aussi :)', 12, 1, NOW());

COMMIT;
