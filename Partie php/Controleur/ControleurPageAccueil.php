<?php

namespace Controleur;

use DAO\DaoEntraineur;
use DAO\MatchDAO;
use DAO\CommentaireDAO;
use DAO\JouerDAO;
use DAO\JoueurDAO;
use Controleur\RechercherMatchsPasses;
use Controleur\RechercherUnJoueur;
use Controleur\RechercherJouer;
use Controleur\RechercherUnCommentaire;

use Modele\Joueur;
use Modele\Jouer;

use DateTime;


class ControleurPageAccueil
{
    private $matchDAO;
    private $jouerDAO;
    private $joueurDAO;
    private $commentaireDAO;

     /**
     * Constructeur de la classe. Initialise les DAO pour les joueurs, les participations (jouerDAO), les matchs et les commentaires.
     */
    public function __construct(){
        $this->matchDAO = new MatchDAO();
        $this->jouerDAO = new JouerDAO();
        $this->joueurDAO = new JoueurDAO();
        $this->commentaireDAO = new CommentaireDAO();
    }

    /**
     * Récupère les informations d'un manager par son ID.
     * 
     * @param string $idManager L'identifiant du manager.
     * @return string Le prénom et le nom du manager, ou une chaîne vide si non trouvé.
     */
    public function infoPageAccueil($idManager) : string {
        $dao = new DaoEntraineur();

        $entraineur = $dao ->getById($idManager);

        if ($entraineur == null){
            $res = "";
        } else {
            $res =  $entraineur->getPrenom() ." ". $entraineur->getNom() ;
        }
        return $res;
    }

     /**
     * Récupère les matchs récents (les deux derniers matchs passés).
     * 
     * @return array Un tableau contenant les deux derniers matchs récents.
     */
    public function getMatchsRecents (){
        $recherche = new RechercherMatchsPasses($this->matchDAO, date('Y-m-d'));
        $res = $recherche->executer();
        return array_slice($res, 0, 2);   
    }

     /**
     * Récupère le meilleur joueur d'un match donné (soit le joueur ayant la plus haute note).
     * 
     * @param int $idMatch L'identifiant du match.
     * @return Joueur|null L'objet joueur représentant le meilleur joueur ou null s'il n'existe pas.
     */
    public function getMeilleurJoueur ($idMatch): ?Joueur{
        $res = null;
        $n_licence = $this->jouerDAO->getMeilleurJoueurMatch($idMatch);
        
        if ($n_licence != null){
            $recherche = new RechercherUnJoueur($this->joueurDAO, $n_licence);
            $res = $recherche->executer();
        }

        return $res;  
    }

    /**
     * Récupère le commentaire pour un joueur spécifique lors d'un match donné.
     * 
     * @param string $n_licence Le numéro de licence du joueur.
     * @param string $dateMatch La date du match.
     * @return string Le commentaire ou une chaîne vide s'il n'existe pas.
     */
    public function getCommentaireJoueur ($n_licence, $dateMatch) {
        $recherche = new RechercherUnCommentaire($this->commentaireDAO, $n_licence, $dateMatch);
        $res = $recherche->executer();
        if($res) {
            return $res->getCommentaire();
        }
        return "";
    }

    /**
     * Récupère les informations de participation d'un joueur à un match donné.
     * 
     * @param string $n_licence Le numéro de licence du joueur.
     * @param int $id_match L'identifiant du match.
     * @return Jouer|null Un objet représentant la participation ou null si non trouvée.
     */
    public function getParticipation ($n_licence, $id_match):?Jouer {
        $recherche = new RechercherJouer($this->jouerDAO, $n_licence, $id_match);
        $res = $recherche->executer();
        return $res;
    }

    /**
     * Affiche le résultat d'un match sous forme de texte.
     * 
     * @param string $resultat Le résultat brut (V, N, D).
     * @return string Le texte correspondant (Victoire, Match nul, Défaite).
     */
    public function afficherResultat ($resultat): string {
        switch ($resultat) {
            case 'N':
                return 'Match nul';
            case 'V':
                return 'Victoire';
            case 'D':
                return 'Défaite';
            default:
                return '';
        }
    }

    /**
     * Affiche le lieu d'un match sous forme de texte.
     * 
     * @param string $lieu Le lieu brut (dom, ext).
     * @return string Le texte correspondant (à domicile, à l'extérieur).
     */
    public function afficherLieu($lieu): string{
        switch ($lieu) {
            case 'ext':
                return 'à l\'extérieur';
            case 'dom':
                return 'à domicile';
            default: 
                return '';
        }
    }

    /**
     * Formate la date et l'heure d'un match.
     * 
     * @param  Match $match L'objet match contenant la date et l'heure.
     * @return string La date et l'heure formatées (Y-m-d H:i).
     */
    public function afficherDateHeure($match){
        $dateTimeObj = new DateTime($match->getDate_et_heure());
        $date_heure = $dateTimeObj->format('Y-m-d H:i'); 
        return $date_heure;
    }

    /**
     * Récupère les joueurs actifs
     * 
     * @return array Un tableau contenant les joueurs actifs.
     */
    public function getJoueursActifs(){
        $res = $this->joueurDAO->findByStatut('Act'); 
        return $res;
    }
}