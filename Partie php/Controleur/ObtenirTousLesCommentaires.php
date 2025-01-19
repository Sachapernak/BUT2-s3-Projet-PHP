<?php

namespace Controleur;
use DAO\CommentaireDAO;
class ObtenirTousLesCommentaires {

    private $commentaireDAO;
    private $n_licence;  // Optionnel, si nous voulons récupérer les commentaires d'un seul joueur

    /**
     * Constructeur de la classe ObtenirTousLesCommentaires.
     * Ce constructeur initialise les propriétés avec l'objet CommentaireDAO et un numéro de licence de joueur (optionnel).
     *
     * @param CommentaireDAO $commentaireDAO L'objet CommentaireDAO permettant d'effectuer des opérations sur les données des commentaires
     * @param string|null $n_licence Le numéro de licence du joueur dont on souhaite récupérer les commentaires. Si null, on récupère tous les commentaires.
     */
    public function __construct(CommentaireDAO $commentaireDAO, $n_licence = null) {
        $this->commentaireDAO = $commentaireDAO;
        $this->n_licence = $n_licence;
    }

     /**
     * Méthode pour exécuter l'obtention des commentaires.
     * Cette méthode vérifie si un numéro de licence a été fourni.
     * Si oui, elle récupère les commentaires d'un joueur spécifique, sinon elle récupère tous les commentaires.
     *
     * @return array Un tableau contenant les commentaires (soit de tous les joueurs, soit d'un joueur spécifique)
     */
    public function executer(): array {
        if ($this->n_licence) {
            // Récupérer les commentaires d'un joueur spécifique
            return $this->commentaireDAO->findAllByJoueur($this->n_licence);
        } else {
            // Récupérer tous les commentaires de tous les joueurs
            return $this->commentaireDAO->findAll();
        }
    }
}
?>
