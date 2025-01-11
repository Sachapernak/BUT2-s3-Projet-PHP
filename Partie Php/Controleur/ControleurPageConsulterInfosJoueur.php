<?php

namespace Controleur;

use Controleur\ModifierJoueur;
use DAO\JoueurDAO;
use DAO\CommentaireDAO;
use Controleur\ObtenirTousLesCommentaires;
use Modele\Commentaire;
use Modele\Joueur;
use DAO\JouerDAO;
use Controleur\RechercherJouerParJoueur;
use Controleur\SupprimerUnJoueur;

class ControleurPageConsulterInfosJoueur 
{
    private $joueurDAO;

    private $jouerDAO;
    private $commentaireDAO;

    public function __construct()
    {
        $this->joueurDAO = new JoueurDAO();
        $this->jouerDAO = new JouerDAO();
        $this->commentaireDAO = new commentaireDAO();

    }

    public function recupererJoueur($n_licence): Joueur {
        $rechercherUnJoueur = new RechercherUnJoueur($this->joueurDAO, $n_licence);
        $joueur = $rechercherUnJoueur->executer();
        return $joueur;
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

    public function peutEtreSupprime($n_licence){
        $recherche = new RechercherJouerParJoueur($this->jouerDAO, $n_licence);
        $res = $recherche->executer();
        return empty($res);
    }

    public function supprimerJoueur($n_licence) {
        $suppression = new SupprimerUnJoueur($this->joueurDAO, $n_licence);
        $suppression->executer();
        header('Location: Joueurs.php');
    }
}


?>