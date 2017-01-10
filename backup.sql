/* RollBack */

DROP DATABASE IF EXISTS bizarts_gendar_t;

/*Etape 2 : encodage choisi : utf8 et sa collation car ca englobe la majorite des characteres et des langages.*/

CREATE DATABASE bizarts_gendar_t CHARACTER SET utf8 COLLATE utf8_general_ci;

/* Cree l'utilisateur admin */

GRANT USAGE ON *.* TO 'admin'@'localhost';
DROP USER 'admin'@'localhost';
CREATE USER 'admin'@'localhost' IDENTIFIED BY 'admin'; GRANT ALL PRIVILEGES ON *.* TO 'admin'@'localhost' WITH GRANT OPTION;

/*Etape 3*/

USE bizarts_gendar_t;

CREATE TABLE Commentaires
(
	ID INT(6) PRIMARY KEY NOT NULL AUTO_INCREMENT,
	Note INT(2),
	Avis VARCHAR(200),
	Nom_user VARCHAR(200),
	Prenom_user VARCHAR(200),
	ID_produit INT(6)
);

CREATE TABLE News
(
	ID INT(6) PRIMARY KEY NOT NULL AUTO_INCREMENT,
	Image VARCHAR(200),
	Lien VARCHAR(200)
);

CREATE TABLE Rôle
(
	ID INT(6) PRIMARY KEY NOT NULL AUTO_INCREMENT,
	Libelle VARCHAR(200),
	Description VARCHAR(500),
	Date_creation DATE,
	Date_modification DATE
);

CREATE TABLE Ventes
(
	ID_produit INT(6) NOT NULL,
	Url VARCHAR(200)
);

CREATE TABLE Partenaires
(
	ID INT(6) AUTO_INCREMENT PRIMARY KEY NOT NULL,
	Url VARCHAR(200),
	Nom VARCHAR(40)
);

CREATE TABLE Categories
(
        ID INT(6) PRIMARY KEY NOT NULL AUTO_INCREMENT,
        Libelle VARCHAR(200),
        Description VARCHAR(500),
        Date_creation DATE,
        Date_modification DATE
);

CREATE TABLE Sous_categories
(
        ID INT(6) PRIMARY KEY NULL AUTO_INCREMENT,
        Nom VARCHAR(40) NOT NULL,
        Url VARCHAR(100) NOT NULL,
        ID_categorie INT NOT NULL,
        CONSTRAINT ID_categorie FOREIGN KEY (ID_categorie) REFERENCES  Categories(ID)
);
					
CREATE TABLE Produits
(
	ID INT(6) AUTO_INCREMENT PRIMARY KEY NOT NULL,
	Image VARCHAR(200),
	Libelle VARCHAR(200),
        Description VARCHAR(500),
        Prix_vente FLOAT,
        Nombres_produit INT,
        Date_creation DATE,
        Date_modification DATE,
        ID_sous_categorie INT NOT NULL,
        CONSTRAINT Sous_categorie FOREIGN KEY (ID_sous_categorie) REFERENCES  Sous_categories(ID)
);
	
CREATE TABLE Contact
(
	ID INT(6) PRIMARY KEY NULL AUTO_INCREMENT,
	Email VARCHAR(75) NOT NULL,
	Objet VARCHAR(50) NOT NULL,
	Contenu VARCHAR(500) NOT NULL
);

CREATE TABLE Utilisateurs
(
	ID INT(6) PRIMARY KEY NULL AUTO_INCREMENT,
        Nom CHAR(30) NOT NULL,
        Prenom CHAR(30) NOT NULL,
	Date_de_naissance DATE,
	Telephone VARCHAR(10) NOT NULL,
	Ville varchar(50) NOT NULL,
	Adresse VARCHAR(200) NOT NULL,
	Mail VARCHAR(75) NOT NULL,
	Password VARCHAR(100) NOT NULL,
	Code_postale VARCHAR(5) NOT NULL,
	Pays varchar(20) NOT NULL,
	Sexe char(1),
	Rôle INT NOT NULL,
	CONSTRAINT Rôle FOREIGN KEY (Rôle) REFERENCES  Rôle(ID),
	Date_creation DATE,
	Date_modification DATE
);

CREATE TABLE Articles
(
	ID INT(6) PRIMARY KEY NULL AUTO_INCREMENT,
	Titre VARCHAR(50) NOT NULL,
	Image VARCHAR(1000),
	Contenu VARCHAR(1000),
	ID_utilisateur INT(6),
	Date_creation DATE,
	Nom VARCHAR(20)
);	

CREATE TABLE Produit_Utilisateur
(
	ID INT(6) PRIMARY KEY NULL AUTO_INCREMENT,
	ID_produit INT NOT NULL,
	CONSTRAINT ID_produit FOREIGN KEY (ID_produit) REFERENCES  Produits(ID),
	ID_utilisateur INT NOT NULL,
	CONSTRAINT ID_utilisateur FOREIGN KEY (ID_utilisateur) REFERENCES  Utilisateurs(ID)
);

/* Etape 4 */

/* Categories */

INSERT INTO Categories(Libelle, Description, Date_creation, Date_modification)
VALUES ('Traditionnel', 'Les outils permettant le dessin a la technique traditionnelle', '16/10/31', '16/10/31');

INSERT INTO Categories(Libelle, Description, Date_creation, Date_modification)
VALUES ('Digital', 'Les outils permettant le dessin a la technique digitale', '16/10/31', '16/10/31');

/* Sous categories */

INSERT INTO Sous_categories(Nom,Url,ID_categorie) VALUES ('Pastels','pastels.php',1);
INSERT INTO Sous_categories(Nom,Url,ID_categorie) VALUES ('Pinceaux','pinceaux.php',1);
INSERT INTO Sous_categories(Nom,Url,ID_categorie) VALUES ('Crayons','crayons.php',1);
INSERT INTO Sous_categories(Nom,Url,ID_categorie) VALUES ('Papiers','papiers.php',1);
INSERT INTO Sous_categories(Nom,Url,ID_categorie) VALUES ('Encres','encres.php',1);
INSERT INTO Sous_categories(Nom,Url,ID_categorie) VALUES ('Tablettes Graphiques','tablettes_graphiques.php',2);
INSERT INTO Sous_categories(Nom,Url,ID_categorie) VALUES ('Stylets','stylets.php',2);
INSERT INTO Sous_categories(Nom,Url,ID_categorie) VALUES ('Logiciels','logiciels.php',2);

/* produit */

INSERT INTO Produits (Image,Libelle,Description,Prix_vente,Nombres_produit,Date_creation,Date_modification,ID_sous_categorie) VALUES ('Ressources/Images/Pastels/vegetals.jpg','Coffret couleurs végétales','Au véritable pigment issu de plantes tinctoriales, Bleu pers (Isatis Tinctoria), laque de garance rouge (Rubia Tinctoria), laque de gaude jaune (Reseda luteola), laque de noyer (Juglans Regia)','15',3,'17/10/31','17/10/31',1);
INSERT INTO Produits (Image,Libelle,Description,Prix_vente,Nombres_produit,Date_creation,Date_modification,ID_sous_categorie) VALUES ('Ressources/Images/Pastels/bleus_de_pastels.jpg','Coffret bleu de pastel','Au véritable pigment issu du pastel des teinturiers (Isatis Tinctoria)Bleu naissant, bleu mignon, bleu céleste, bleu pers.','15',5,'17/10/31','17/10/31',1);
INSERT INTO Produits (Image,Libelle,Description,Prix_vente,Nombres_produit,Date_creation,Date_modification,ID_sous_categorie) VALUES ('Ressources/Images/Pastels/verts.jpg','Coffret verts','Vert jaune, vert clair, vessie, olive.','13.50',13,'17/10/31','17/10/31',1);
INSERT INTO Produits (Image,Libelle,Description,Prix_vente,Nombres_produit,Date_creation,Date_modification,ID_sous_categorie) VALUES ('Ressources/Images/Pastels/jaunes.jpg','Coffret jaunes','Orange, jaune dor, jaune moyen, citron','13',5,'17/10/31','17/10/31',1);
INSERT INTO Produits (Image,Libelle,Description,Prix_vente,Nombres_produit,Date_creation,Date_modification,ID_sous_categorie) VALUES ('Ressources/Images/Pastels/turquoises.jpg','Coffret turquoises','Bleu phtalo, céruleum, turquoise, émeraude.','13.50',8,'17/10/31','17/10/31',1);
INSERT INTO Produits (Image,Libelle,Description,Prix_vente,Nombres_produit,Date_creation,Date_modification,ID_sous_categorie) VALUES ('Ressources/Images/Pastels/rouges.jpg','Coffret rouges','Rubis, rouge, vermillon, corail.','13.50',1,'17/10/31','17/10/31',1);
INSERT INTO Produits (Image,Libelle,Description,Prix_vente,Nombres_produit,Date_creation,Date_modification,ID_sous_categorie) VALUES ('Ressources/Images/Pastels/violets.jpg','Coffret violets','Carmin, violet manganèse, parme outremer, laque violette.','13.50',10,'17/10/31','17/10/31',1);
INSERT INTO Produits (Image,Libelle,Description,Prix_vente,Nombres_produit,Date_creation,Date_modification,ID_sous_categorie) VALUES ('Ressources/Images/Pastels/ocres.jpg','Coffret ocres','Ocre rouge, ocre abricot, ocre doré, ocre jaune.','13',2,'17/10/31','17/10/31',1);
INSERT INTO Produits (Image,Libelle,Description,Prix_vente,Nombres_produit,Date_creation,Date_modification,ID_sous_categorie) VALUES ('Ressources/Images/Pastels/terres.jpg','Coffret terres','Ocre de Ru, Sienne naturelle, Sienne brûlée, brun Van','12',3,'17/10/31','17/10/31',1);
INSERT INTO Produits (Image,Libelle,Description,Prix_vente,Nombres_produit,Date_creation,Date_modification,ID_sous_categorie) VALUES ('Ressources/Images/Pinceaux/pinceau1.jpg','Spalter hobby serie 5073 20 mm','Spalter en fibres synthétiques gris fonçé sortie courte - Pinceau plat et large pour les surfaces importantes','5',12,'17/10/31','17/10/31',2);
INSERT INTO Produits (Image,Libelle,Description,Prix_vente,Nombres_produit,Date_creation,Date_modification,ID_sous_categorie) VALUES ('Ressources/Images/Pinceaux/pinceau2.jpg','Pinceau epee casaneo serie 704','Un pinceau Stryper réalisé avec la fibre Casaneo imitant le petit gris.','2',1,'17/10/31','17/10/31',2);
INSERT INTO Produits (Image,Libelle,Description,Prix_vente,Nombres_produit,Date_creation,Date_modification,ID_sous_categorie) VALUES ('Ressources/Images/Pinceaux/pinceau3.jpg','Pinceau a lavis casaneo serie 498','Un pinceau très souple avec une nervosité extraordinaire et une rétention capillaire extrêmement élevée.','10',2,'17/10/31','17/10/31',2);
INSERT INTO Produits (Image,Libelle,Description,Prix_vente,Nombres_produit,Date_creation,Date_modification,ID_sous_categorie) VALUES ('Ressources/Images/Pinceaux/pinceau4.jpg','Pinceau ovale casaneo serie 898','Un pinceau « ovale pointu » réalisé avec une rétention capillaire extrêmement élevée.','20',1,'17/10/31','17/10/31',2);
INSERT INTO Produits (Image,Libelle,Description,Prix_vente,Nombres_produit,Date_creation,Date_modification,ID_sous_categorie) VALUES ('Ressources/Images/Pinceaux/pinceau5.jpg','Pinceau repique extra court serie 5575','Un pinceau « repique» extra court réalisé avec la fibre Nova extrafine de couleur dorée.','3.50',5,'17/10/31','17/10/31',2);
INSERT INTO Produits (Image,Libelle,Description,Prix_vente,Nombres_produit,Date_creation,Date_modification,ID_sous_categorie) VALUES ('Ressources/Images/Pinceaux/pinceau6.jpg','Brosse serie 1203','Pinceau traînard en poils de martre rouge Kolinsky.','10',1,'17/10/31','17/10/31',2);
INSERT INTO Produits (Image,Libelle,Description,Prix_vente,Nombres_produit,Date_creation,Date_modification,ID_sous_categorie) VALUES ('Ressources/Images/Tablettes/tablette1.jpg','Cintiq 27 QHD Touch','Un écran à stylet haute définition avec des fonctionnalités tactiles multi-touch conçu pour les professionnels de la création.','2989',5,'17/10/31','17/10/31',6);
INSERT INTO Produits (Image,Libelle,Description,Prix_vente,Nombres_produit,Date_creation,Date_modification,ID_sous_categorie) VALUES ('Ressources/Images/Crayons/crayon1.jpg','Crayon graphite HB','La colle, qui empêche la mine de se décoller du bois, rend le crayon très résistant et facile à tailler','8.80',1,'17/10/31','17/10/31',3);
INSERT INTO Produits (Image,Libelle,Description,Prix_vente,Nombres_produit,Date_creation,Date_modification,ID_sous_categorie) VALUES ('Ressources/Images/Crayons/crayon3.jpg','Boite maxi crayons de couleurs','Une boite contenant une variete de couleurs impressionnante','36.55',1,'17/10/31','17/10/31',3);
INSERT INTO Produits (Image,Libelle,Description,Prix_vente,Nombres_produit,Date_creation,Date_modification,ID_sous_categorie) VALUES ('Ressources/Images/Papiers/papier1.jpg','Papier grain fin blanc lumineux','Le papier de référence pour l aquarelle.','20.40',1,'17/10/31','17/10/31',4);
INSERT INTO Produits (Image,Libelle,Description,Prix_vente,Nombres_produit,Date_creation,Date_modification,ID_sous_categorie) VALUES ('Ressources/Images/Papiers/papier1.jpg','Papier grain satine blanc lumineux','Fabriqué à l ancienne sur forme ronde, il offre un rendu des couleurs exceptionnel et une excellente tenue à l eau.','27.20',1,'17/10/31','17/10/31',4);
INSERT INTO Produits (Image,Libelle,Description,Prix_vente,Nombres_produit,Date_creation,Date_modification,ID_sous_categorie) VALUES ('Ressources/Images/Encres/encre1.jpg','Encre noire charbon','Une encre acrylique extra-fine constituée de pigments extra-fins.','15.95',1,'17/10/31','17/10/31',5);
INSERT INTO Produits (Image,Libelle,Description,Prix_vente,Nombres_produit,Date_creation,Date_modification,ID_sous_categorie) VALUES ('Ressources/Images/Tablettes/tablette4.jpg','Intuos Pro L','Une tablette à stylet haute performance avec des fonctionnalités tactiles multi-touch.','374',1,'17/10/31','17/10/31',6);
INSERT INTO Produits (Image,Libelle,Description,Prix_vente,Nombres_produit,Date_creation,Date_modification,ID_sous_categorie) VALUES ('Ressources/Images/Tablettes/tablette2.jpg','Cintiq 22 HD Touch','Un écran interactif haute définition conçu pour les professionnels de la création.','1824',1,'17/10/31','17/10/31',6);
INSERT INTO Produits (Image,Libelle,Description,Prix_vente,Nombres_produit,Date_creation,Date_modification,ID_sous_categorie) VALUES ('Ressources/Images/Stylets/stylet3.jpg','Bamboo alpha','Un stylet numérique élégant pour iPad et autres appareils mobile.','14',1,'17/10/31','17/10/31',7);
INSERT INTO Produits (Image,Libelle,Description,Prix_vente,Nombres_produit,Date_creation,Date_modification,ID_sous_categorie) VALUES ('Ressources/Images/Stylets/stylet2.jpg','Bamboo fine line','Un stylet haut de gamme pour une écriture confortable et authentique et des croquis précis sur certaines tablettes et appareils convertibles.','60',1,'17/10/31','17/10/31',7);
INSERT INTO Produits (Image,Libelle,Description,Prix_vente,Nombres_produit,Date_creation,Date_modification,ID_sous_categorie) VALUES ('Ressources/Images/Stylets/stylet5.jpg','Bamboo duo','Un stylet classique deux en un idéal pour ceux qui souhaitent tapoter en douceur, écrire ou dessiner sur tous les écrans tactiles et sur du papier.','27.90',1,'17/10/31','17/10/31',7);
INSERT INTO Produits (Image,Libelle,Description,Prix_vente,Nombres_produit,Date_creation,Date_modification,ID_sous_categorie) VALUES ('Ressources/Images/Logiciels/logiciel1.jpg','Paint Tool SAI','Un logiciel agreable et intuitif pour le dessin digital.','49.80',1,'17/10/31','17/10/31',8);
INSERT INTO Produits (Image,Libelle,Description,Prix_vente,Nombres_produit,Date_creation,Date_modification,ID_sous_categorie) VALUES ('Ressources/Images/Logiciels/logiciel2.jpg','Photoshop','Un logiciel professionnel performant permettant aussi bien la retouche photo que le dessin digital.','999.99',1,'17/10/31','17/10/31',8);
INSERT INTO Produits (Image,Libelle,Description,Prix_vente,Nombres_produit,Date_creation,Date_modification,ID_sous_categorie) VALUES ('Ressources/Images/Logiciels/logiciel3.jpg','Clip Studio Paint','Ce logiciel adapte aux besoins des dessinateurs de BD convient egalement tout a fait pour les illustrations et les animations en tout genre.','46',1,'17/10/31','17/10/31',8);


/* News */

INSERT INTO News(Image,Lien)
VALUES ('Ressources/Images/newbanner.png','http://www.louvre.fr/expositions/bouchardon-1698-1762une-idee-sublime-du-beau');

/* Role */

INSERT INTO Rôle (Libelle, Description, Date_creation, Date_modification)
VALUES ('admin','Un administrateur utilise ses outils au nom de la communauté, pour exécuter les décisions que la communauté a prises.','17/10/31','17/10/31');


INSERT INTO Rôle (Libelle, Description, Date_creation, Date_modification)
VALUES ('utilisateur','Un potenciel client.','17/10/31','17/10/31');

/* users */

INSERT INTO Utilisateurs(Nom, Prenom, Date_de_naissance, Ville, Adresse, Mail, Password, Code_postale, Pays, Sexe, Rôle, Date_creation, Date_modification)
VALUES ('Ketchum', 'Sacha', '98/01/11', 'Bourg-Palette', '02 rue du labo','admin@admin.admin','8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', '69530', 'France', 'M', '1', '16/10/31', '16/10/31');

/* Article */

INSERT INTO Articles(Titre,Image,Contenu,ID_utilisateur,Date_creation,Nom)
VALUES ('Nouvelle article disponible','Ressources/Images/Encres/encre1.jpg','Une encre qui vous change la vie !','1','2016/05/05','reuter_f');

INSERT INTO Articles(Titre,Image,Contenu,ID_utilisateur,Date_creation,Nom)
VALUES ('Tablette pour les PROS','Ressources/Images/Tablettes/tablette1.jpg','Parfaites pour tous les artistes !','1','2016/04/04','bernar_r');

/* Ventes */

INSERT INTO Ventes(ID_produit,Url) VALUES ('1','testreussi.php');
INSERT INTO Ventes(ID_produit,Url) VALUES ('2','testreussi.php');
INSERT INTO Ventes(ID_produit,Url) VALUES ('3','testreussi.php');

/* Partenaires */

INSERT INTO Partenaires(Url,Nom) VALUES ('http://www.wacom.com/fr-ca','Wacom');
INSERT INTO Partenaires(Url,Nom) VALUES	('http://www.artisanpastellier.com/pastels_tendres.php','Artisan Pastellier');
INSERT INTO Partenaires(Url,Nom) VALUES	('http://www.aquarelleetpinceaux.com/','Aquarelle');
