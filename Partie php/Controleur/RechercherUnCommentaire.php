<?php

namespace Controleur;

use DAO\CommentaireDAO;
use Modele\Commentaire;

class RechercherUnCommentaire
{

    private $commentaireDAO;
    private $n_licence;
    private $date_com;

    /**
     * Constructeur de la classe. Initialise les attributs avec les valeurs passées en paramètre.
     * 
     * @param CommentaireDAO $commentaireDAO Instance de CommentaireDAO pour effectuer des requêtes sur les commentaires
     * @param string $n_licence Numéro de licence du joueur
     * @param string $date_com Date du commentaire à rechercher
     */
    public function __construct(CommentaireDAO $commentaireDAO, $n_licence, $date_com)
    {
        $this->commentaireDAO = $commentaireDAO;
        $this->n_licence = $n_licence;
        $this->date_com = $date_com;
    }

    /**
     * Exécute la recherche d'un commentaire spécifique en fonction du numéro de licence et de la date du commentaire.
     * 
     * @return Commentaire|null Le commentaire trouvé ou null si aucun commentaire n'est trouvé
     */
    public function executer(): ?Commentaire
    {
        return $this->commentaireDAO->findById($this->n_licence, $this->date_com);
    }
}
?>