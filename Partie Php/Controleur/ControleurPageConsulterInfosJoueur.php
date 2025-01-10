<?php

namespace Controleur;

use Controleur\ModifierJoueur;
use DAO\JoueurDAO;
use DAO\CommentaireDAO;
use Controleur\ObtenirTousLesCommentaires;
use Modele\Commentaire;

class ControleurPageConsulterInfosJoueur 
{
    private $joueurDAO;
    private $commentaireDAO;

    public function __construct()
    {
        $this->joueurDAO = new JoueurDAO();
        $this->commentaireDAO = new commentaireDAO();

    }

    public function recupererCommentaires() {
        $n_licence = $_GET['nLicence'];

        $obtenirTousLesCommentaires = new ObtenirTousLesCommentaires($this->commentaireDAO, $n_licence);
        return $obtenirTousLesCommentaires->executer();
    }

    public function ajouterCommentaire(){
        $n_licence = $_GET['nLicence'];
        $commentaireSaisi = $_POST['commentaire'];
        $date = date('Y-m-d'); 

        $commentaire = new Commentaire($n_licence, $date, $commentaireSaisi);

        $creationCommentaire = new CreerUnCommentaire($this->commentaireDAO, $commentaire);
        $creationCommentaire->executer();
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