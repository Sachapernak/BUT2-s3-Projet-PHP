<?php

namespace Controleur;
use DAO\CommentaireDAO;
class ObtenirTousLesCommentaires {

    private $commentaireDAO;
    private $n_licence;  // Optionnel, si nous voulons récupérer les commentaires d'un seul joueur

    public function __construct(CommentaireDAO $commentaireDAO, $n_licence = null) {
        $this->commentaireDAO = $commentaireDAO;
        $this->n_licence = $n_licence;
    }

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
