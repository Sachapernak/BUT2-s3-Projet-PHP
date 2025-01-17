<?php

namespace Controleur;

use Modele\Jouer;

use DAO\JoueurDAO;
use DAO\MatchDAO;
use DAO\JouerDAO;
use DAO\CommentaireDAO;
use Controleur\RechercherJoueursActifs;
use Controleur\ObtenirTousLesCommentaires;


class ControleurPageFeuilleDeMatch
{
    private $joueurDAO;
    private $jouerDAO;
    private $matchDAO;
    private $commentaireDAO;
    private $controleurJoueursParticipants;

    public function __construct()
    {
        $this->joueurDAO = new JoueurDAO();
        $this->jouerDAO = new JouerDAO();
        $this->matchDAO = new MatchDAO();
        $this->commentaireDAO = new CommentaireDAO();

        $this->controleurJoueursParticipants = new ControleurPageMatchs();
    }

    public function afficherErreurs($erreurs, $messageErreurs){
        if ($erreurs){
            echo '<div class="message-erreur">'. $messageErreurs. '</div>';
        }
    }

    public function getJoueursActifs(): array{
        $recherche = new RechercherJoueursActifs($this->joueurDAO, 'act');
        return $recherche->executer();

    }

    
    public function creerParticipation(array $joueursSelectionnes, $idMatch) {
        foreach ($joueursSelectionnes as $joueurSelect) {
            $n_licence = $joueurSelect['licence'];
            $position = $joueurSelect['position'];
            $estRemplacant = $joueurSelect['role'];

            $jouer = new Jouer($n_licence,$idMatch,$estRemplacant, null, $position);
    
            $creationMatch = new CreerJouer($this->jouerDAO, $jouer);
            $creationMatch->executer();
        }
        header('Location: Matchs.php');
    }

    public function verifierPositionTitulaires(array $joueursSelectionnes): bool {
        $positionMeneur = 'Meneur';
        $positionAilier = 'Ailier';
        $positionPivot = 'Pivot';
        $countMeneur = 0;
        $countAilier = 0;
        $countPivot = 0;

        foreach ($joueursSelectionnes as $jouer) {
            if ($jouer['position'] === $positionMeneur && $jouer['role']===0) {
                $countMeneur++;
            }
            if ($jouer['position'] === $positionAilier && $jouer['role']===0) {
                $countAilier++;
            }
            if ($jouer['position'] === $positionPivot && $jouer['role']===0) {
                $countPivot++;
            }
        }
        return $countMeneur >= 1 && $countAilier >= 2 && $countPivot >=2;
    }

    public function verifierTailleJoueursSelec(array $joueurs): bool{
        return count($joueurs) >= 5;
    }

    public function getCommentairesJoueur($n_licence){
        $obtenirTousLesCommentaires = new ObtenirTousLesCommentaires($this->commentaireDAO, $n_licence);
        $commentaires = $obtenirTousLesCommentaires->executer();
  
        $tousLesCommentaires = "";

        foreach ($commentaires as $commentaire){
            $tousLesCommentaires.= "<p>". $commentaire['date']. " : ". $commentaire['commentaire']. "</p> <br>";
        }
        return $tousLesCommentaires;
    }

    public function getInfosParticipation($idMatch){
        $recherche = new RechercherJouerParMatch($this->jouerDAO, $idMatch);
        $listeJoueursParticipants= $recherche->executer();

        /*print_r($listeJoueursParticipants);*/
        return $listeJoueursParticipants;
    }
  
    


}

?>