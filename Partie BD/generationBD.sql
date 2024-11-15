CREATE TABLE Joueur(
   n_licence INT,
   nom VARCHAR(50)  NOT NULL,
   prenom VARCHAR(50)  NOT NULL,
   date_de_naissance DATE NOT NULL,
   taille INT   NOT NULL,
   poids DECIMAL(5,2)   NOT NULL,
   statut CHAR(3) ,
   PRIMARY KEY(n_licence)
);

CREATE TABLE Entraineur(
   identifiant VARCHAR(15) ,
   nom VARCHAR(50) ,
   prenom VARCHAR(50) ,
   mot_de_passe VARCHAR(50) ,
   PRIMARY KEY(identifiant)
);

CREATE TABLE Commentaire(
   n_licence INT,
   date_Com DATE,
   commentaire TEXT,
   PRIMARY KEY(n_licence, Date_Com),
   FOREIGN KEY(n_licence) REFERENCES Joueur(n_licence)
);

CREATE TABLE Match_basket(
   id_match INT AUTO_INCREMENT,
   date_et_heure DATETIME NOT NULL,
   adversaire VARCHAR(50) ,
   lieu CHAR(3) ,
   resultat CHAR(1) ,
   PRIMARY KEY(id_match)
);

CREATE TABLE jouer(
   n_licence INT,
   id_match INT,
   est_remplacant BOOLEAN,
   note DECIMAL(2,1),
   position VARCHAR(50) ,
   PRIMARY KEY(n_licence, id_match),
   FOREIGN KEY(n_licence) REFERENCES Joueur(n_licence),
   FOREIGN KEY(id_match) REFERENCES Match_basket(id_match)
);

INSERT INTO joueur (n_licence, nom, prenom, date_de_naissance, taille, poids, statut)
VALUES 
    (20241001, 'Martin', 'Lucas', '1992-03-15', 175, 70, 'Act'),
    (20241002, 'Dupont', 'Julien', '1988-06-22', 180, 75, 'Bles'),
    (20241003, 'Leclerc', 'Hugo', '1995-09-08', 178, 78, 'Act'),
    (20241004, 'Garcia', 'Adrien', '1990-11-02', 170, 72, 'Abs'),
    (20241005, 'Moreau', 'Thomas', '1998-02-19', 172, 68, 'Act'),
    (20241006, 'Leroy', 'Merlin', '1987-12-25', 182, 80, 'Sus'),
    (20241007, 'Bernard', 'Alexis','1993-07-30',177, 74, 'Act'),
    (20241008, 'Rousseau', 'Maxime', '1996-05-12', 174, 73, 'Act'),
    (20241009, 'Dubois', 'Pierre', '1989-10-04', 176, 76, 'Act'),
    (20241010, 'Fournier', 'Arthur', '1994-01-20', 179, 77, 'Act');

INSERT INTO Match_basket (id_match,date_et_heure,adversaire,lieu,resultat)
VALUES
    (1, 2024-11-01 15:00, 'Tigers Lyon', 'dom', 'V'),
    (2, 2024-11-05 18:30, 'Eagles Paris', 'ext', 'D'),
    (3, 2024-11-10 14:00, 'Sharks Marseille', 'ext', 'N');

INSERT INTO jouer (n_licence, id_match, est_remplacant, note, position) 
VALUES
    (20241001, 1, False, 4,'Pivot'),
    (20241002, 1, False,3,'Ailier'),
    (20241003, 1, False, 4.5,'Meneur'),
    (20241009, 1, False, 3.5, 'Ailier Fort'),
    (20241007, 1, True, 2,'Ailier Fort'),
    (20241001, 2, False, 1, 'Pivot'),
    (20241004, 2, False, 4,'Ailier'),
    (20241005, 2, False, 3.5,'Pivot'),
    (20241010, 2, False, 4, 'Meneur'),
    (20241008, 2, False, 2.5, 'Ailier Fort'),
    (20241006, 2, True, 3, 'Meneur'),
    (20241006, 3, False, 4, 'Meneur'),
    (20241007, 3, False, 1.5, 'Ailier'),
    (20241008, 3, False, 3, 'Pivot'),
    (20241002, 3, False, 4, 'Ailier Fort'),
    (20241003, 3, False, 3, 'Ailier Fort'),
    (20241009, 3, True, 2, 'Pivot');







