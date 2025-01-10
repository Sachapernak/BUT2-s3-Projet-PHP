<?php

namespace Controleur;

use Controleur\CreerUnJoueur;
use DAO\JoueurDAO;
use Modele\Joueur;

class ControleurPageAjouterJoueur
{
    private $joueurDAO;

    public function __construct()
    {
        $this->joueurDAO = new JoueurDAO();

    }

    public function ajouterJoueur()
    {
        
        $n_licence = $_POST['licence'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $statut = $_POST['statut'];
        $date_naissance = $_POST['date_naissance'];
        $taille = $_POST['taille'];
        $poids = $_POST['poids'];

        $joueur = new Joueur($n_licence, $nom, $prenom, $date_naissance,$taille, $poids, $statut);

        $creationJoueur = new CreerUnJoueur($this->joueurDAO, $joueur);
        $creationJoueur->executer();
     
        header('Location: Joueurs.php');
    }
}


?>