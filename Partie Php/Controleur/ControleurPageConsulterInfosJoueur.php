<?php

namespace Controleur;

use Controleur\ModifierJoueur;
use DAO\JoueurDAO;
use Modele\Joueur;

class ControleurPageConsulterInfosJoueur 
{
    private $joueurDAO;

    public function __construct()
    {
        $this->joueurDAO = new JoueurDAO();

    }

    public function mettreAJourJoueur()
    {
        $n_licence = $_GET['nLicence'];

        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $statutComplet = $_POST['statut'];
        $statut = substr($statutComplet, 0, 3);
        $date_naissance = $_POST['date_naissance'];
        $taille = $_POST['taille'];
        $poids = $_POST['poids'];

        $joueur = $this->joueurDAO->findById($n_licence);
        $joueur->setNom($nom);
        $joueur->setPrenom($prenom);
        $joueur->setStatut($statut);
        $joueur->setTaille($taille);
        $joueur->setPoids($poids);
        $joueur->setDate_de_naissance($date_naissance);


        $modifierJoueur = new ModifierJoueur($this->joueurDAO, $joueur);
        $modifierJoueur->executer();

        return $this->joueurDAO->findById($n_licence);
        }
}


?>