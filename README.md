# Gestion d'une Équipe de Sport (basket-fauteuil)

Une application web permettant à un entraîneur de gérer son équipe de sport, d'organiser les matchs, et de suivre les performances des joueurs.

---

## À propos

Ce projet aide un entraîneur à gérer les joueurs et les matchs de son équipe. L'application permet de :
- Ajouter, modifier, supprimer des joueurs et des matchs.
- Sélectionner les joueurs actifs pour chaque match en leur attribuant une position (pivot, ailier ou meneur) et en les catégorisant en titulaires et en remplaçants.
- Évaluer les performances des joueurs après un match.
- Consulter des statistiques détaillées sur l'équipe et les joueurs.

---

## Fonctionnalités

- **Gestion des joueurs** : 
  - Ajout, modification, suppression.
  - Statut des joueurs : Actif, Blessé, Suspendu, Absent.
  - Notes personnelles et suivi des performances.

- **Gestion des matchs** :
  - Création de matchs avec date, heure, lieu, équipe adverse et résultat.
  - Feuille de match avec choix des positions et titulaires/remplaçants parmi les joueurs actifs.
  - Modification et suivi des résultats des matchs.

- **Statistiques** :
  - Résumé des performances de l'équipe : victoires, défaites, matchs nuls.
  - Statistiques individuelles des joueurs : statut, nombre de sélections, postes préférés, évaluations, etc.
  - Suivi des matchs consécutifs et pourcentage de victoires.

- **Authentification** :
  - Accès sécurisé par un système de connexion pour l'entraîneur.
  - Aucune page accessible sans authentification.

---

## Accéder au site

L'application est hébergée sur **Always Data**. Pour y accéder, suivez ces étapes :

1. Ouvrez un navigateur web récent (par exemple : Chrome, Firefox, Edge).
2. Rendez-vous à l'adresse suivante : https://handipromanager.alwaysdata.net/Vue/Accueil.php
3. Connectez-vous avec les identifiants de l'entraîneur :
- **Nom d'utilisateur** : `KTomato`
- **Mot de passe** : `azerty`

---

## Installation du site

Pour installer l'application, suivez ces étapes :

1. Créez les tables dans votre base de données (le script de génération des tables est fourni dans le répertoire `partie BD`).
2. Insérez les tables dans la base de données (le jeu de test est fourni dans le répertoire `partie BD`).
3. Entrez vos identifiants de base de données dans le fichier `Database.php` présent dans le répertoire Modèle.
4. Creer l'utilisateur souhaité en saisissant les identifiants dans le fichier `CreerUtilisateur.php` présent dans le répertoire `Modèle`.
5. Lancez le fichier `CreerUtilisateur.php` sur un navigateur.
6. Lancez enfin la page `Accueil.php` présent dans le répertoire `Vue` et identifiez vous.

---

## Structure de la Base de Données

### Tables principales
- **`joueur`** : Contient les informations des joueurs (numéro de licence, nom, prénom, date de naissance, taille, poids, statut).
- **`match_basket`** : Contient les informations des matchs (identifiant, date et heure, équipe adverse, lieu, résultat).
- **`jouer`** : Associe les joueurs aux matchs avec leur rôle (titulaire ou remplaçant) et leur position (pivot, ailier, meneur).
- **`commentaire`** : Stocke les commentaires des joueurs.

---
