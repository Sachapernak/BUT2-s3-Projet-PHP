CREATE TABLE joueur(
   n_licence INT,
   nom VARCHAR(50)  NOT NULL,
   prenom VARCHAR(50)  NOT NULL,
   date_de_naissance DATE NOT NULL,
   taille INT   NOT NULL,
   poids DECIMAL(5,2)   NOT NULL,
   statut CHAR(3) ,
   PRIMARY KEY(n_licence)
);

CREATE TABLE entraineur(
   identifiant VARCHAR(15) ,
   nom VARCHAR(50) ,
   prenom VARCHAR(50) ,
   mot_de_passe VARCHAR(255) ,
   PRIMARY KEY(identifiant)
);

CREATE TABLE commentaire(
   n_licence INT,
   date_Com DATE,
   commentaire TEXT,
   PRIMARY KEY(n_licence, Date_Com),
   FOREIGN KEY(n_licence) REFERENCES joueur(n_licence)
);

CREATE TABLE match_basket(
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
   FOREIGN KEY(n_licence) REFERENCES joueur(n_licence),
   FOREIGN KEY(id_match) REFERENCES match_basket(id_match)
);

INSERT INTO joueur (n_licence, nom, prenom, date_de_naissance, taille, poids, statut)
VALUES 
    (20241001, 'Martin', 'Lucas', '1992-03-15', 175, 70, 'Act'),
    (20241002, 'Dupont', 'Julien', '1988-06-22', 180, 75, 'Ble'),
    (20241003, 'Leclerc', 'Hugo', '1995-09-08', 178, 78, 'Act'),
    (20241004, 'Garcia', 'Adrien', '1990-11-02', 170, 72, 'Abs'),
    (20241005, 'Moreau', 'Thomas', '1998-02-19', 172, 68, 'Act'),
    (20241006, 'Leroy', 'Merlin', '1987-12-25', 182, 80, 'Sus'),
    (20241007, 'Bernard', 'Alexis','1993-07-30',177, 74, 'Act'),
    (20241008, 'Rousseau', 'Maxime', '1996-05-12', 174, 73, 'Act'),
    (20241009, 'Dubois', 'Pierre', '1989-10-04', 176, 76, 'Act'),
    (20241010, 'Fournier', 'Arthur', '1994-01-20', 179, 77, 'Act');
    
    -- Matchs passés
INSERT INTO match_basket (id_match, date_et_heure, adversaire, lieu, resultat)
VALUES
    (1, '2023-11-01 15:00', 'Tigers Lyon', 'dom', 'V'),
    (2, '2023-01-05 18:30', 'Eagles Paris', 'ext', 'D'), 
    (3, '2023-05-10 14:00', 'Sharks Marseille', 'ext', 'N'), 
    (4, '2023-07-20 16:00', 'Lions Bordeaux', 'dom', 'N'),
    (5, '2023-10-10 18:00', 'Panthers Toulouse', 'ext', 'V'), 
    (6, '2023-11-15 20:30', 'Dragons Nice', 'dom', 'D'), 
    (7, '2023-12-12 17:00', 'Wolves Lille', 'ext', 'V'), 
    (8, '2024-01-10 14:00', 'Knights Montpellier', 'dom', 'N'); 

-- Matchs futurs 
INSERT INTO match_basket (id_match, date_et_heure, adversaire, lieu, resultat)
VALUES
    (9, '2026-04-01 15:00', 'Tigers Lyon', 'dom', null),
    (10,'2026-06-15 18:30', 'Eagles Paris', 'ext', null);
    
INSERT INTO jouer (n_licence, id_match, est_remplacant, note, position) 
VALUES
    (20241001, 1, False, 4, 'Pivot'),   
    (20241002, 1, False, 3, 'Ailier'),  
    (20241003, 1, False, 4, 'Meneur'),  
    (20241009, 1, False, 4, 'Pivot'),
    (20241010, 1, True, 1, 'Meneur'),
    (20241007, 1, False, 3, 'Ailier');   

INSERT INTO jouer (n_licence, id_match, est_remplacant, note, position)
VALUES
    (20241001, 2, False, 2, 'Pivot'),    
    (20241004, 2, False, 4, 'Ailier'),  
    (20241005, 2, False, 3, 'Pivot'),    
    (20241010, 2, False, 4, 'Meneur'), 
    (20241009, 2, True, 3, 'Ailier'),
    (20241008, 2, False, 3, 'Ailier');

INSERT INTO jouer (n_licence, id_match, est_remplacant, note, position)
VALUES
    (20241001, 3, False, 3, 'Pivot'),   
    (20241006, 3, False, 4, 'Ailier'),   
    (20241004, 3, False, 3, 'Meneur'),  
    (20241002, 3, False, 4, 'Ailier'),   
    (20241003, 3, False, 5, 'Pivot');    

INSERT INTO jouer (n_licence, id_match, est_remplacant, note, position)
VALUES
    (20241001, 4, False, 4, 'Pivot'),   
    (20241004, 4, False, 3, 'Ailier'),  
    (20241008, 4, False, 4, 'Meneur'),  
    (20241007, 4, False, 2, 'Ailier'), 
    (20241006, 4, False, 4, 'Pivot');   

INSERT INTO jouer (n_licence, id_match, est_remplacant, note, position)
VALUES
    (20241003, 5, False, 4, 'Pivot'),    
    (20241009, 5, False, 3, 'Ailier'),   
    (20241002, 5, False, 4, 'Meneur'),   
    (20241010, 5, False, 2, 'Ailier'),
    (20241001, 5, True, 3, 'Meneur'),
    (20241004, 5, False, 5, 'Pivot');   


INSERT INTO jouer (n_licence, id_match, est_remplacant, note, position)
VALUES
    (20241001, 6, False, 3, 'Pivot'),   
    (20241006, 6, False, 4, 'Ailier'), 
    (20241004, 6, False, 4, 'Meneur'),  
    (20241005, 6, False, 2, 'Ailier'), 
    (20241003, 6, true, 3, 'Pivot'),
    (20241009, 6, False, 4, 'Pivot');    

INSERT INTO jouer (n_licence, id_match, est_remplacant, note, position)
VALUES
    (20241007, 7, False, 4, 'Pivot'),   
    (20241008, 7, False, 3, 'Ailier'),  
    (20241006, 7, False, 3, 'Meneur'),  
    (20241002, 7, False, 4, 'Ailier'),  
    (20241004, 7, False, 2, 'Pivot');
    
INSERT INTO jouer (n_licence, id_match, est_remplacant, note, position)
VALUES
    (20241003, 8, False, 4, 'Pivot'),  
    (20241010, 8, False, 4, 'Ailier'),   
    (20241001, 8, False, 5, 'Meneur'),  
    (20241005, 8, False, 3, 'Ailier'),  
    (20241009, 8, True, 3, 'Ailier'),
    (20241002, 8, True, 3, 'Pivot'),
    (20241006, 8, False, 2, 'Pivot');   

    
INSERT INTO jouer (n_licence, id_match, est_remplacant, note, position)
VALUES
    (20241001, 9, False, null, 'Pivot'),   
    (20241005, 9, False, null, 'Ailier'),
    (20241003, 9, False, null, 'Meneur'),  
    (20241007, 9, False, null, 'Pivot'),   
    (20241009, 9, False, null, 'Ailier');  
    

INSERT INTO jouer (n_licence, id_match, est_remplacant, note, position)
VALUES
    (20241001, 10, False, null, 'Pivot'),  
    (20241005, 10, False, null, 'Ailier'),  
    (20241003, 10, False, null, 'Meneur'),  
    (20241009, 10, False, null, 'Pivot'), 
    (20241010, 10, True, null, 'Meneur'),
    (20241007, 10, False, null, 'Ailier');   
    

INSERT INTO commentaire (n_licence, date_com, commentaire)
VALUES
    -- Match 1 : 2023-11-01, Tigers Lyon
    (20241001, '2023-11-01', 'Bon effort lors du match contre Tigers Lyon en tant que Pivot.'),
    (20241002, '2023-11-01', 'Bonne prestation contre Tigers Lyon, mais peut mieux faire.'),
    (20241003, '2023-11-01', 'Très bon match contre Tigers Lyon, excellente performance en tant que Meneur.'),
    (20241009, '2023-11-01', 'Solide performance contre Tigers Lyon en tant que Pivot, mais encore perfectible.'),
    (20241007, '2023-11-01', 'Bonne participation contre Tigers Lyon, a bien joué en Ailier.'),

    -- Match 2 : 2024-01-05, Eagles Paris
    (20241001, '2024-01-05', 'Participation correcte contre Eagles Paris, rôle de Pivot bien joué.'),
    (20241004, '2024-01-05', 'Très bonne performance contre Eagles Paris en tant qu Ailier.'),
    (20241005, '2024-01-05', 'Bonne prestation contre Eagles Paris, solide au Pivot.'),
    (20241010, '2024-01-05', 'Bon match contre Eagles Paris, mais quelques erreurs en tant que Meneur.'),
    (20241008, '2024-01-05', 'Bonne contribution contre Eagles Paris, a montré une belle énergie en Ailier.'),

    -- Match 3 : 2024-05-10, Sharks Marseille
    (20241001, '2024-05-10', 'Bonne prestation contre Sharks Marseille en tant que Pivot.'),
    (20241006, '2024-05-10', 'Excellente performance contre Sharks Marseille, a dominé en Ailier.'),
    (20241004, '2024-05-10', 'Participation correcte contre Sharks Marseille, rôle de Meneur bien géré.'),
    (20241002, '2024-05-10', 'Bonne contribution contre Sharks Marseille, a bien soutenu l équipe en Ailier.'),
    (20241003, '2024-05-10', 'Performance impressionnante contre Sharks Marseille, en tant que Pivot, très solide.'),

    -- Match 4 : 2024-07-20, Lions Bordeaux
    (20241001, '2024-07-20', 'Solide prestation contre Lions Bordeaux, a bien joué en Pivot.'),
    (20241004, '2024-07-20', 'Bonne participation contre Lions Bordeaux en Ailier, a montré de bonnes actions.'),
    (20241008, '2024-07-20', 'Excellente contribution contre Lions Bordeaux, très bon en Meneur.'),
    (20241007, '2024-07-20', 'Performance correcte contre Lions Bordeaux en Ailier, mais des erreurs à corriger.'),
    (20241006, '2024-07-20', 'Bonne prestation contre Lions Bordeaux, a été un excellent Pivot.'),

    -- Match 5 : 2024-10-10, Panthers Toulouse
    (20241003, '2024-10-10', 'Bonne performance contre Panthers Toulouse, solide en Pivot.'),
    (20241009, '2024-10-10', 'Participation correcte contre Panthers Toulouse, en tant qu Ailier.'),
    (20241002, '2024-10-10', 'Excellente prestation contre Panthers Toulouse en Ailier.'),
    (20241010, '2024-10-10', 'Performance moyenne contre Panthers Toulouse, a dû mieux gérer le rôle de Meneur.'),
    (20241004, '2024-10-10', 'Excellente prestation contre Panthers Toulouse en Pivot.'),

    -- Match 6 : 2024-11-15, Dragons Nice
    (20241001, '2024-11-15', 'Bonne prestation contre Dragons Nice en Pivot, mais quelques manques.'),
    (20241006, '2024-11-15', 'Très bonne performance contre Dragons Nice, une très bonne partie en Ailier.'),
    (20241004, '2024-11-15', 'Excellente contribution contre Dragons Nice en Pivot.'),
    (20241005, '2024-11-15', 'Participation correcte contre Dragons Nice en Ailier, mais un peu moins actif.'),
    (20241009, '2024-11-15', 'Bonne prestation contre Dragons Nice, solide en Ailier.'),

    -- Match 7 : 2024-12-12, Wolves Lille
    (20241007, '2024-12-12', 'Bonne performance contre Wolves Lille en Pivot.'),
    (20241008, '2024-12-12', 'Participation correcte contre Wolves Lille, en Ailier.'),
    (20241006, '2024-12-12', 'Bonne prestation contre Wolves Lille, solide en Meneur.'),
    (20241002, '2024-12-12', 'Excellente prestation contre Wolves Lille en Ailier.'),
    (20241004, '2024-12-12', 'Participation moyenne contre Wolves Lille en Pivot.'),

    -- Match 8 : 2025-01-10, Knights Montpellier
    (20241003, '2025-01-10', 'Bonne performance contre Knights Montpellier, en Pivot.'),
    (20241010, '2025-01-10', 'Excellente prestation contre Knights Montpellier, a fait une superbe partie en Meneur.'),
    (20241001, '2025-01-10', 'Superbe performance contre Knights Montpellier, avec un excellent rôle de Meneur.'),
    (20241005, '2025-01-10', 'Participation correcte contre Knights Montpellier, bien joué en Ailier.'),
    (20241006, '2025-01-10', 'Performance moyenne contre Knights Montpellier, a besoin d améliorer son jeu en Pivot.');









