<?php

namespace Controleur;

use DAO\CommentaireDAO;
use Modele\Commentaire;
class CreerUnCommentaire {
    
    private $commentaireDAO;  // Objet CommentaireDAO pour interagir avec la base de données concernant les commentaires.
    private $n_licence;       // Numéro de licence du joueur qui a écrit le commentaire.
    private $date_com;        // Date du commentaire.
    private $commentaire;     // Contenu du commentaire.

     /**
     * Constructeur de la classe CreerUnCommentaire.
     * Il initialise les propriétés de l'objet avec les informations de l'objet Commentaire passé en paramètre.
     *
     * @param CommentaireDAO $commentaireDAO Objet CommentaireDAO utilisé pour interagir avec la base de données.
     * @param Commentaire $commentaire Objet Commentaire contenant les informations à insérer.
     */
    public function __construct(CommentaireDAO $commentaireDAO, Commentaire $commentaire) {
        $this->commentaireDAO = $commentaireDAO;
        $this->n_licence = $commentaire->getIdJoueur();
        $this->date_com = $commentaire->getDate();
        $this->commentaire = $commentaire->getCommentaire();
    }

    /**
     * Méthode exécutant l'insertion du commentaire dans la base de données.
     * Elle appelle la méthode d'insertion du CommentaireDAO avec les données nécessaires.
     */
    public function executer() {
        $this->commentaireDAO->insert(
            $this->n_licence,
            $this->date_com,
            $this->commentaire
        );
    }
}
?>
